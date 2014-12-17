<?php

use Carbon\Carbon;

/**
 * Class ArticlesController
 */
class MainController extends \BaseController
{


    public function __construct()
    {

        parent::__construct();

    }


    public function dashboard()
    {
        /** Stats */
        $this->data['gallery_images_counter'] = Gallery::sum('counter');
        $this->data['gallery_images_total'] = Gallery::where('counter', '>', 0)->count();


        /** Users */
        $this->data['total_users'] = User::all()->count();

        $trainer = Sentry::findGroupByName('Trainer');
        $this->data['total_trainers'] = Sentry::findAllUsersInGroup($trainer)->count();


        /** Sales */
        $this->data['total_sales'] = Sessionpayment::where('created_at', '>=',
            Carbon::now()->subDays(300))->where('processed', 1)->sum('total');
        $this->data['total_after_fees'] = Sessionpayment::where('created_at', '>=',
            Carbon::now()->subDays(300))->where('processed', 1)->sum('total_after_fees');
        $this->data['total_commission'] = ($this->data['total_sales'] - $this->data['total_after_fees']);


        $this->data['total_year'] = Sessionpayment::where('created_at', '>=', Carbon::now()->subYear())
            ->where('processed', 1)
            ->groupBy('month')
            ->orderBy(DB::raw('year asc, month'))
            ->get(array(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(total) as total'),
                DB::raw('SUM(total_after_fees) as total_after_fees')
            ));

        $start = Carbon::now()->subYear();
        $end = Carbon::now();
        $interval = DateInterval::createFromDateString('1 month');
        $period = new DatePeriod($start, $interval, $end);

        foreach ($period as $dt) {
            $this->data['total_months'][] = $dt->format("Y-m") . '-01';
            $this->data['total_year_total'][(int)$dt->format("m")] = 0;
            $this->data['total_year_fee'][(int)$dt->format("m")] = 0;
        }


        foreach ($this->data['total_year'] as $m) {
            $this->data['total_year_total'][$m->month] = round($m->total, 0);
            $this->data['total_year_fee'][$m->month] = round($m->total - $m->total_after_fees, 0);
        }


        /** Classes Stats */
        $this->data['total_classes'] = Evercisegroup::where('created_at', '>=', Carbon::now()->subYear())
            ->groupBy('month')
            ->orderBy(DB::raw('year asc, month'))
            ->get(array(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(id) as total')
            ));
        $this->data['total_sessions'] = Evercisesession::where('created_at', '>=', Carbon::now()->subYear())
            ->groupBy('month')
            ->orderBy(DB::raw('year asc, month'))
            ->get(array(
                DB::raw('YEAR(date_time) as year'),
                DB::raw('MONTH(date_time) as month'),
                DB::raw('COUNT(id) as total')
            ));

        foreach ($period as $dt) {
            $this->data['total_classes_count'][(int)$dt->format("m")] = 0;
            $this->data['total_sessions_count'][(int)$dt->format("m")] = 0;
        }


        foreach ($this->data['total_classes'] as $m) {
            $this->data['total_classes_count'][$m->month] = round($m->total, 0);
        }
        foreach ($this->data['total_sessions'] as $m) {
            $this->data['total_sessions_count'][$m->month] = round($m->total, 0);
        }


        $this->data['total_referrals'] = Referral::all()->count();


        return View::make('admin.dashboard', $this->data)->render();
    }


    public function expired($date = false)
    {
        if (!$date) {
            $date = date('Y-m-d', strtotime('-1 month', time()));
        }

        $date = $date . ' 00:00:00';

        $expired = DB::table('evercisesessions')
            ->select(DB::raw('evercisesessions.id, evercisesessions.date_time, evercisesessions.tickets as members, evercisesessions.price, evercisegroups.user_id, evercisegroups.name, users.email, users.first_name, users.last_name, users.phone'))
            ->leftJoin('evercisegroups', 'evercisegroups.id', '=', 'evercisesessions.evercisegroup_id')
            ->leftJoin('users', 'users.id', '=', 'evercisegroups.user_id')
            ->where('evercisesessions.date_time', '>', $date)
            ->whereNotIn('evercisesessions.evercisegroup_id', function ($query) {
                $query->select(DB::raw('evercisegroup_id'))
                    ->from('evercisesessions')
                    ->whereRaw('date_time > now()');
            })
            ->orderBy('evercisesessions.date_time', 'desc')
            ->get();
        return View::make('admin.expired', compact('expired'))->render();


    }


    public function users()
    {

        $users = User::all();

        $trainerGroup = Sentry::findGroupByName('Trainer');

        return View::make('admin.users', compact('users', 'trainerGroup'))->render();

    }


    public function trainerCreate() {

        return View::make('admin.users.create')->render();

    }
    public function trainerStore() {


        $inputs =  Input::except(['_token', 'trainer']);
        $validator = Validator::make(
            $inputs,
            array(
                'first_name' => 'required|max:15|min:2',
                'last_name' => 'required|max:25|min:2',
                'email' => 'required|unique:users,email',
                'display_name' => 'required|unique:users,display_name',
                'phone' => 'numeric',
                'gender' => 'required',
                'profession' => 'required|max:500|min:50',
                'bio'   =>  'required|max:500'
            )
        );


        if ($validator->fails()) {

            return Redirect::route('admin.users.trainerCreate')
                ->withErrors($validator)
                ->withInput();

        } else {

            $inputs['display_name'] = str_replace(' ', '_', $inputs['display_name']);
            $inputs['dob'] = null;
            $inputs['password'] = Functions::randomPassword(8);
            $inputs['activated'] = true;
            $inputs['gender'] = $inputs['gender'] == 'male' ? 1 : 2;

            $inputs['areacode'] = '+44';

            try {

                // register user and add to user group
                $user = User::registerUser($inputs);


                if ($user) {
                    UserHelper::generateUserDefaults($user->id);

                    Session::forget('email');

                    User::subscribeMailchimpNewsletter(
                        Config::get('mailchimp')['newsletter'],
                        $user->email,
                        $user->first_name,
                        $user->last_name
                    );
                    User::makeUserDir($user);

                }
            } catch (Cartalyst\Sentry\Users\UserExistsException $e) {
                die($e->getMessage());
            }


            Event::fire('user.registered', [$user]);

            $trainer=['confirmed' => 1, 'user_id' => $user->id];

            $include = ['bio', 'phone', 'website', 'profession'];


            foreach($inputs as $key => $val) {
                if(in_array($key, $include)) {
                    $trainer[$key] = $val;
                }
            }


            if($res = Trainer::createOrFail($trainer)) {


                Event::fire('trainer.registered', [$user, ]);


                Event::fire('user.admin.trainerCreate', compact('user', 'trainer'));

                Session::flash('notification', 'Trainer Created');
                return Redirect::route('admin.users');
            }
        }
    }

    public function logInAs()
    {
        $user = Sentry::findUserById(Input::get('user_id'));
        Sentry::login($user);

        return Redirect::route('users.edit');
    }


    public function categories()
    {

        return View::make('admin.categories', compact('categories'))->render();
    }


    public function subcategories()
    {
        $subcategories = \Subcategory::with('categories')->get();
        $categories = \Category::lists('name');

        array_unshift($categories, '');

        return View::make('admin.subcategories', compact('categories', 'subcategories'))->render();

    }


    /**
     * show all pending trainers.
     *
     * @return Response
     */
    public function pendingTrainers()
    {
        return View::make('admin.pendingtrainers')
            ->with('trainers', Trainer::getUnconfirmedTrainers());
    }


    /**
     * Approve trainers.
     *
     * @return Response
     */
    public function approveTrainer()
    {
        $user = User::getUserByTrainerId(Input::get('trainer'));

        Trainer::approve($user);

        return Redirect::route('admin.pendingtrainers');
    }


    /**
     * @return \Illuminate\View\View
     */
    public function pendingWithdrawal()
    {


        $pendingWithdrawals = Withdrawalrequest::where('processed', 0)->with('user')->orderBy('created_at', 'desc')->get();

        $processedWithdrawals = Withdrawalrequest::where('processed', 1)->with('user')->orderBy('created_at', 'desc')->get();

        return View::make('admin.pendingwithdrawals')
            ->with('pendingWithdrawals', $pendingWithdrawals)
            ->with('processedWithdrawals', $processedWithdrawals);
    }


    public function processWithdrawalMulti() {

        $process = Input::get('process');

        $payments = Withdrawalrequest::whereIn('id', array_keys($process))->get();

        if($payments->count() == 0) {
            return Redirect::route('admin.pending_withdrawal')->with('notification', 'You need to select somebody !!!');
        }


        $paypal = App::make('WithdrawalPayment');

        foreach($payments as $p) {
            $paypal->addUser([
                'id'    => $p->id,
                'email' => $p->account,
                'amount' => number_format($p->transaction_amount, 2)
            ]);
        }

        $res = $paypal->pay();

        if($res['ACK'] !== 'Success') {
            return Redirect::route('admin.pending_withdrawal')->with('notification', 'Check if all the emails are Correct!!!!!');
        }


        foreach($payments as $p) {
            $p->processed = 1;
            $p->save();
        }

        return Redirect::route('admin.pending_withdrawal')->with('notification', 'Yaay.. you payed Somebody!!!');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function processWithdrawal()
    {
        $withdrawal_id = Input::get('withdrawal_id');

        Withdrawalrequest::find($withdrawal_id)->markProcessed();

        return Redirect::route('admin.pending_withdrawal');

    }

    /**
     * @return \Illuminate\View\View
     */
    public function showLog()
    {
        $logFile = file_get_contents('../app/storage/logs/laravel.log', true);

        $logFile = str_replace('[] []', '[] [] < br><br ><br > ', $logFile);
        $logFile = str_replace('#', '<br><span style="color:#c00; margin-left:20px">#</span>', $logFile);

        return View::make('admin.log')
            ->with('log', $logFile);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteLog()
    {
        $del = Input::get('del');

        if ($del == 'delete_all') {
            file_put_contents('../app/storage/logs/laravel.log', '');
        }

        return Redirect::to('admin/log');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function showGroups()
    {
        $evercisegroups = Evercisegroup::with('subcategories')->with('featuredClasses')->get();

        return View::make('admin.groups')
            ->with('evercisegroups', $evercisegroups);
    }

    /**
     * TODO - make this function (add categories to groups)
     *
     * @return \Illuminate\View\View
     */
    public function addGroup()
    {
        return View::make('admin.groups');
    }

    /**
     * @return \Illuminate\View\View|string
     */
    public function showGroupRatings()
    {

        $fakeusers = Sentry::findGroupById(6);
        $fakeuserLoggedIn = $this->user ? $this->user->inGroup($fakeusers) : false;

        if (!$fakeuserLoggedIn) {
            return 'please log in with a fake user';
        }

        $evercisegroups = Evercisegroup::whereHas('futuresessions', function ($query) {
            $query->with('ratings');
            $query->with('fakeRatings');
        })->get();

        return View::make('admin.fakeratings')
            ->with('evercisegroups', $evercisegroups);
    }

    public function yukon($page = 'dashboard')
    {
        //$users = User::with('evercisegroups')->where('display_name', 'LIKE', 'Peter_ATP')->get();
        //return $page;
        //return $users;

        $unconfirmedTrainers = Trainer::getUnconfirmedTrainers();
        $pendingWithdrawals = Withdrawalrequest::getPendingWithdrawals();

        return View::make('admin.yukonhtml.index')
            ->with('admin_version', '1.0')
            ->with('sPage', '1')
            ->with('unconfirmedTrainers', $unconfirmedTrainers)
            ->with('pendingWithdrawals', $pendingWithdrawals)
            ->with('includePage', View::make('admin.' . $page));

    }


    public function searchUsers()
    {
        $searchTerm = Input::get('search');
        $sentryUsers = Sentry::findAllUsers();

        $users = User::with('evercisegroups')->where('display_name', 'like', $searchTerm);

        return View::make('admin.users')
            ->with('users', $users)
            ->with('sentryUsers', $sentryUsers);
    }


    public function searchStats()
    {
        return View::make('admin.searchstats');
    }


    public function listClasses()
    {
        $classes = Evercisegroup::all();


        return View::make('admin.classes', compact('classes'));
    }


    public function landings() {

        $landings = LandingPages::all();

        return View::make('admin.landings', compact('landings'));


    }

    public function landing($id) {

        $page = LandingPages::find($id);

        $categories = [];

        foreach (Subcategory::all() as $sub) {
            if (!in_array($sub->name, $categories)) {
                $categories[$sub->name] = $sub->name;
            }

            foreach ($sub->categories()->get() as $cat) {
                if (!in_array($cat->name, $categories)) {
                    $categories[$cat->name] = $cat->name;
                }
            }
        }

        return View::make('admin.landing_manage', compact('page', 'categories'));


    }





}