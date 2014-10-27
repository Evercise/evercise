<header class="navigation">
	<section>
		<nav>		
			<ul>
				<a class="evercise-logo" href="{{ URL::route('home', null) }}">{{ HTML::image('/img/evercise logo yellow.png', 'evercise logo', array('class' => 'logo')); }}</a>

        {{HTML::linkRoute('evercisegroups.search', trans('header.discover_classes') , null , ['class' => Route::currentRouteName() == 'evercisegroups.search' ? 'active' : ''])}}
        {{HTML::linkRoute('static.how_it_works', trans('header.how_it_works') , null , ['class' => Route::currentRouteName() == 'static.how_it_works' ? 'active' : ''])}}

        @if(isset($user))
          <div class="nav-end">
            @if ($user->inGroup($trainerGroup))
              {{ HTML::linkRoute('evercisegroups.index', 'Class Hub' , null , ['class' => Route::currentRouteName() == 'evercisegroups.index' ? 'active' : '']) }}
              <div class="user-box">
                <a  class = "{{Route::currentRouteName() == 'trainers.edit' ? 'active' : null}}"  href="{{ URL::route( 'trainers.edit', $user->id ) }}">{{ HTML::image( $userImage, $user->display_name.'s image') }} <span>{{ $user->display_name }}</span></a>
              </div>
            @else
              <div class="user-box">
                <a  class  = "{{Route::currentRouteName() == 'users.edit' ? 'active' : null}}" href="{{ URL::route( 'users.edit', $user->id ) }}">{{ HTML::image( $userImage, $user->display_name.'s image'); }} <span>{{ $user->display_name }}</span></a>
              </div>

            @endif
          </div>
        @else
          <div class="nav-end">
             
             @if(isset($redirect_after_login))
              {{ HTML::linkRoute('auth.login.redirect_after_login', trans('header.login'),  array('id'=>'login', Route::getCurrentRoute()->getName() , 'class' => 'login '))}}
              
            @else
              {{HTML::linkRoute('auth.login', 'Login', null, array('id'=>'login', 'class' => 'login'))}}
            @endif
            {{  HTML::linkRoute('users.create', trans('header.register') , null , [ 'class' =>  Route::currentRouteName() == 'users.create' ? 'active' : ''])}}
          </div>

        @endif
        @if(isset($user))
         @if ($user->inGroup($adminGroup))
         <div class="nav-admin">
          <div id="displayName-dropdown" class="dropdown-menu">
              {{ HTML::linkRoute('admin.page', 'pending trainers', 'pendingtrainers') }}
              {{ HTML::linkRoute('admin.pending_withdrawal', 'pending withdrawals') }}
            </div>
          </div>
         @endif
        @endif

        
      </ul>
		</nav>
	</section>
</header>