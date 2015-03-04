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

        $today = new DateTime();
        $today->setTime(0, 0, 0);
        $this->data['users_today'] = User::where('created_at', '>', $today)->count();
        $this->data['trainers_today'] = Trainer::where('created_at', '>', $today)->count();

        $trainer = Sentry::findGroupByName('Trainer');
        $this->data['total_trainers'] = Sentry::findAllUsersInGroup($trainer)->count();

        $this->data['new_sessions_today'] = Evercisesession::where('created_at', '>', $today)->count();
        $this->data['new_groups_today'] = Evercisegroup::where('created_at', '>', $today)->count();

        $sevenDaysTime = new DateTime();
        $sevenDaysTime->add(new DateInterval('P7D'));
        $this->data['upcoming_sessions_7'] = Evercisesession::where('date_time', '>',
            (new DateTime()))->where('date_time', '<', $sevenDaysTime)->count();

        $thirtyDaysTime = new DateTime();
        $thirtyDaysTime->add(new DateInterval('P30D'));
        $this->data['upcoming_sessions_30'] = Evercisesession::where('date_time', '>',
            (new DateTime()))->where('date_time', '<', $thirtyDaysTime)->count();


        /** Sales */
        $this->data['total_sales'] = Sessionpayment::where('created_at', '>=',
            Carbon::createFromDate(2015, 1, 1))->where('processed', 1)->sum('total');
        $this->data['total_after_fees'] = Sessionpayment::where('created_at', '>=',
            Carbon::createFromDate(2015, 1, 1))->where('processed', 1)->sum('total_after_fees');
        $this->data['total_commission'] = ($this->data['total_sales'] - $this->data['total_after_fees']);

        $this->data['session_sold_today'] = Sessionmember::todaysSales();

        $this->data['transactions_today'] = DB::table('transactions')->where('created_at', '>=',
            Carbon::now()->setTime(0, 0, 0))->count();


        $this->data['total_year'] = Sessionpayment::where('created_at', '>=', Carbon::now()->subYear())
            ->where('processed', 1)
            ->groupBy('month')
            ->orderBy(DB::raw('year asc, month'))
            ->get([
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(total) as total'),
                DB::raw('SUM(total_after_fees) as total_after_fees')
            ]);

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
            ->get([
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(id) as total')
            ]);
        $this->data['total_sessions'] = Evercisesession::where('created_at', '>=', Carbon::now()->subYear())
            ->groupBy('month')
            ->orderBy(DB::raw('year asc, month'))
            ->get([
                DB::raw('YEAR(date_time) as year'),
                DB::raw('MONTH(date_time) as month'),
                DB::raw('COUNT(id) as total')
            ]);

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

        $this->data['complete_referrals'] = Referral::where('referee_id', '>', 0)->count();
        $this->data['pending_referrals'] = Referral::where('referee_id', '=', 0)->count();

        return View::make('admin.dashboard', $this->data)->render();
    }


    public function expired($date = FALSE)
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


    public function trainerCreate()
    {

        return View::make('admin.users.create')->render();

    }

    public function trainerStore()
    {

        $validationRules = array_merge([
            'first_name'   => 'required|max:15|min:2',
            'last_name'    => 'required|max:25|min:2',
            'email'        => 'required|unique:users,email',
            'display_name' => 'required|unique:users,display_name',
            'phone'        => 'numeric',
            'gender'       => 'required',
        ],
            Trainer::$validationRules
        );
        $validationRules['image'] = 'sometimes';

        $inputs = Input::except(['_token', 'trainer']);
        $validator = Validator::make(
            $inputs,
            $validationRules
        );


        if ($validator->fails()) {

            return Redirect::route('admin.users.trainerCreate')
                ->withErrors($validator)
                ->withInput();

        } else {

            $password = Functions::randomPassword(8);

            $inputs['display_name'] = str_replace(' ', '_', $inputs['display_name']);
            $inputs['dob'] = NULL;
            $inputs['password'] = $password;
            $inputs['activated'] = TRUE;
            $inputs['gender'] = $inputs['gender'] == 'male' ? 1 : 2;

            $inputs['areacode'] = '+44';

            try {

                // register user and add to user group
                $user = User::registerUser($inputs);

                $userGroup = Sentry::findGroupById(3);
                $user->addGroup($userGroup);

                if ($user) {
                    UserHelper::generateUserDefaults($user->id);

                    Session::forget('email');

                    if (FALSE) {
                        User::subscribeMailchimpNewsletter(
                            Config::get('mailchimp')['newsletter'],
                            $user->email,
                            $user->first_name,
                            $user->last_name
                        );
                    }
                    User::makeUserDir($user);

                }
            } catch (Cartalyst\Sentry\Users\UserExistsException $e) {
                die($e->getMessage());
            }

            try {
                event('user.registered', [$user]);
            } catch (Exception $e) {
                Log::error($e);
            }

            $trainer = ['confirmed' => 1, 'user_id' => $user->id];

            $include = ['bio', 'phone', 'website', 'profession'];


            foreach ($inputs as $key => $val) {
                if (in_array($key, $include)) {
                    $trainer[$key] = $val;
                }
            }


            if ($res = Trainer::createOrFail($trainer)) {


                //event('trainer.registered', [$user,]);


                event('user.admin.trainerCreate', compact('user', 'trainer', 'password'));

                Session::flash('notification', 'Trainer Created');

                return Redirect::route('admin.users');
            }
        }
    }

    public function logInAs()
    {
        $user = Sentry::findUserById(Input::get('user_id'));
        Sentry::login($user);

        return Redirect::route('users.edit', ['id' => Input::get('user_id')]);
    }


    public function editCategories()
    {
        $cats = \Category::orderBy('order', 'asc')->get();

        return View::make('admin.categories', compact('cats'))->render();
    }


    public function subcategories()
    {
        $subcategories = \Subcategory::with('categories')->get();
        $categories = \Category::all();

        $category = [];
        $category[0] = '';
        foreach ($categories as $c) {
            $category[$c->id] = $c->name;
        }

        return View::make('admin.subcategories',
            compact('categories', 'subcategories', 'category', 'subcatCats'))->render();

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


        $pendingWithdrawals = Withdrawalrequest::where('processed', 0)->with('user')->orderBy('created_at',
            'desc')->get();

        $processedWithdrawals = Withdrawalrequest::where('processed', 1)->with('user')->orderBy('created_at',
            'desc')->get();

        return View::make('admin.pendingwithdrawals')
            ->with('pendingWithdrawals', $pendingWithdrawals)
            ->with('processedWithdrawals', $processedWithdrawals);
    }


    public function processWithdrawalMulti()
    {

        $process = Input::get('process');

        $payments = Withdrawalrequest::whereIn('id', array_keys($process))->get();

        if ($payments->count() == 0) {
            return Redirect::route('admin.pending_withdrawal')->with('notification', 'You need to select somebody !!!');
        }


        $paypal = App::make('WithdrawalPayment');

        foreach ($payments as $p) {
            $paypal->addUser([
                'id'     => $p->id,
                'email'  => $p->account,
                'amount' => number_format($p->transaction_amount, 2)
            ]);
        }

        $res = $paypal->pay();

        if ($res['ACK'] !== 'Success') {
            return Redirect::route('admin.pending_withdrawal')->with('notification',
                'Check if all the emails are Correct!!!!!');
        }

        foreach ($payments as $p) {
            $transaction = Transactions::create(
                [
                    'user_id'          => $p->user_id,
                    'total'            => $p->transaction_amount,
                    'total_after_fees' => $p->transaction_amount,
                    'coupon_id'        => 0,
                    'commission'       => 0,
                    'token'            => 0,
                    'transaction'      => 0,
                    'payment_method'   => 'paypal',
                    'payer_id'         => $p->user_id
                ]);

            event('user.withdraw.completed',
                [User::find($p->user_id), $transaction, Wallet::where('user_id', $p->user_id)->pluck('balance')]);
        }

        foreach ($payments as $p) {
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
        $logFile = file_get_contents('../app/storage/logs/laravel.log', TRUE);

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
        $fakeuserLoggedIn = $this->user ? $this->user->inGroup($fakeusers) : FALSE;

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


        $from = Carbon::now()->subDays(30);
        $to = Carbon::now();
        /** Top Searches The past Week */
        $top_searches = StatsModel::select(DB::raw('count(*) as total, search, AVG(results) as avg'))
            ->whereBetween('created_at', [$from, $to])
            ->groupBy('search')
            ->orderBy(DB::raw('count(*)'), 'desc')
            ->limit(20)
            ->get();

        $top_cities = StatsModel::select(DB::raw('count(*) as total, name, AVG(results) as avg'))
            ->whereBetween('created_at', [$from, $to])
            ->where('name', '!=', 'London')
            ->groupBy('name')
            ->orderBy(DB::raw('count(*)'), 'desc')
            ->limit(15)
            ->get();

        $total_london = StatsModel::whereBetween('created_at', [$from, $to])
            ->where('name', 'London')
            ->count();

        $percentage_london = ($total_london / ($top_cities->count() + $total_london)) * 100;


        return View::make('admin.searchstats', compact('top_searches', 'top_cities', 'percentage_london'));
    }

    public function salesStats()
    {
        $sessionmembers = Sessionmember::orderBy('id', 'desc')->get();

        $sales = [];
        foreach ($sessionmembers as $sm) {
            $session = Evercisesession::find($sm->evercisesession_id);

            $sales[] = [
                'id'             => $sm->id,
                'user_id'        => $sm->user_id,
                'user'           => User::where('id', $sm->user_id)->first(),
                'class_id'       => $session->evercisegroup_id,
                'session'        => $session,
                'class'          => $session->evercisegroup,
                'date'           => $sm->created_at->format('M jS, Y g:ia'),
                'amount'         => $session->price,
                'transaction_id' => $sm->transaction_id,
                'payment_method' => $sm->payment_method,
            ];
        }

        return View::make('admin.sales')
            ->with('sales', $sales);
    }

    public function transactions()
    {
        $transactions = Transactions::orderBy('id', 'desc')->get();

        $userIds = [];
        foreach ($transactions as $tr) {
            $userIds[] = $tr->user_id;
        }

        $userNames = User::whereIn('id', $userIds)->lists('display_name', 'id');

        //return var_dump($userNames);

        $trans = [];
        foreach ($transactions as $tr) {
            $trans[] =
                [
                    'id'               => $tr->id,
                    'user_id'          => $tr->user_id,
                    'user_name'        => $userNames[$tr->user_id],
                    'total'            => $tr->total,
                    'total_after_fees' => $tr->total_after_fees,
                    'payment_method'   => $tr->payment_method,
                    'token'            => $tr->token,
                    'transaction'      => $tr->transaction,
                    'processed'        => $tr->processed,
                    'date_time'        => $tr->created_at,
                ];
        }

        return View::make('admin.transactions')
            ->with('transactions', $trans);
    }

    public function userPackages()
    {
        $userPackages = UserPackages::with('user')
            ->with('classes')
            ->get();

        $packages = [];
        foreach ($userPackages as $up) {
            $numClassesUsed = count($up->classes);
            $packages[] = [
                'user_id'      => $up->user_id,
                'package_id'   => $up->package_id,
                'package_name' => $up->package->name,
                'active'       => ($numClassesUsed < $up->package->classes ? '1' : '0'),
                'used'         => $numClassesUsed,
                'total'        => $up->package->classes,
            ];
        }


        return View::make('admin.packages')
            ->with('userPackages', $packages);
    }


    public function listClasses()
    {
        $classes = Evercisegroup::all();
        $images = Gallery::where('counter', '>', 0)->get();


        return View::make('admin.classes', compact('classes', 'images'));
    }


    public function landings()
    {

        $landings = LandingPages::all();

        return View::make('admin.landings', compact('landings'));


    }

    public function landing($id)
    {

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

    public function categoriesManage($id)
    {
        $category = Category::find($id);

        $groups = Evercisegroup::where('published', 1)->has('futuresessions')
            ->whereHas('subcategories', function ($query) use ($id) {
                $query->whereHas('categories', function ($query) use ($id) {
                    $query->where('categories.id', $id);
                });
            })
            ->lists('name', 'id');

        foreach ($groups as $id => $group) {
            $groups[$id] = $id . ' - ' . $group;
        }


        $subcategories = [];
        foreach ($category->subcategories as $subcat) {
            $subcategories[$subcat->id] = $subcat->name;
        }


        return View::make('admin.edit_category', compact('category', 'groups', 'subcategories'));
    }

    public function seoUrls()
    {
        $seourls = SeoUrls::get();

        return View::make('admin.seo_urls', compact('seourls'));
    }

    public function seoUrlsManage($id)
    {
        if($id > 0)
            $seoUrl = SeoUrls::find($id);

        else
            $seoUrl = 0;

        return View::make('admin.edit_seourl', compact('seoUrl'));
    }

    public function updateSeoUrl()
    {
        $id = Input::get('id');

        $location = Input::get('location');

        if(! Place::find($location))
        {
            if(! $placeId = Place::where('name', $location)->pluck('id'))
            {
                return Redirect::route('admin.seourls')->with('error', 'Could not update record');
            }
        }
        else
        {
            $placeId = $location;
        }

        if($id > 0)
        {
            $seoUrl = SeoUrls::find($id);
            $seoUrl->area_id = $placeId;
            $seoUrl->search = Input::get('search');
            $seoUrl->title = Input::get('title');
            $seoUrl->description = Input::get('description');

            $seoUrl->save();
        }
        else
        {
            SeoUrls::create([
                'area_id' => $location,
                'search' => Input::get('search'),
                'title' => Input::get('title'),
                'description' => Input::get('description'),
            ]);
        }

        return Redirect::route('admin.seourls')->with('notification', 'Record updated');
    }

    public function pendingGroups()
    {
        $editedClassed = PendingEvercisegroup::get();
        $newClasses =    Evercisegroup::where('confirmed', 0)->get();

        return View::make('admin.pending_classes', compact('editedClassed', 'newClasses'));
    }

    public function pendinggroupsManage($id) // Edited class (PendingEvercisegroup)
    {
        if($id > 0)
            $pendinggroup = PendingEvercisegroup::find($id);

        else
            $pendinggroup = 0;

        $subcategories = Subcategory::getIdList();

        $evercisegroup = Evercisegroup::find($pendinggroup->evercisegroup_id);


        return View::make('admin.edit_pending_class', compact('pendinggroup', 'subcategories', 'evercisegroup'));
    }

    public function createClassUpdate($evercisegroup_id)
    {
        $evercisegroup = Evercisegroup::find($evercisegroup_id);

        $pendingG = PendingEvercisegroup::storeUpdate($this->user, $evercisegroup);

        return Redirect::route('admin.pendinggroups.manage', [$pendingG->id])->with('notification', 'Update created');
    }

    public function pendingNewGroupManage($id) // new class (EverciseGroup)
    {
        if($id > 0)
            $evercisegroup = Evercisegroup::find($id);

        else
            $evercisegroup = 0;

        $subcategories = Subcategory::getIdList();


        return View::make('admin.review_new_class', compact('subcategories', 'evercisegroup'));
    }

}