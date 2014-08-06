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
              {{ HTML::link('/auth/login/'.Route::getCurrentRoute()->getName() , trans('header.login'),  array('id'=>'login', 'class' => 'login '))}}
              
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
          
              {{ HTML::linkRoute('admin.pending', 'pending trainers') }}
              {{ HTML::linkRoute('admin.pending_withdrawal', 'pending withdrawals') }}
            </div>
          </div>
         @endif
        @endif

         {{-- <li>{{HTML::linkRoute('static.how_it_works', trans('header.how_it_works'))}}</li>

          <li></li>

          @if(isset($user))
              @if ($user->inGroup($trainerGroup))

                  <div class="nav-end">
                      <a  href="{{ URL::route( 'trainers.edit', $user->id ) }}">{{ HTML::image( $userImage, $user->display_name.'s image', array('class'=> 'profile-pic')); }}</a>
                      <li id="displayName">
                          {{ $user->display_name }}
                          {{ HTML::image( 'img/down-arrow.png', 'down-arrow', array('class'=> 'displayName-dropdown-arrow')) }}
                      </li>
                      <div id="displayName-dropdown" class="dropdown-menu">
                           <span>{{ HTML::linkRoute('trainers.edit', 'My Dashboard' , $user->id) }}</span>
                          <span>{{ HTML::linkRoute('evercisegroups.index', 'Class Hub') }}</span>

                          
                          @if ($user->inGroup($adminGroup))
                            <hr>
                            <span>{{ HTML::linkRoute('admin.pending', 'pending trainers') }}</span>
                            <span>{{ HTML::linkRoute('admin.pending_withdrawal', 'pending withdrawals') }}</span>
                          @endif
                      </div>
                  </div>
                  <div class="nav-join">
                    <div class="nav-login">
                      <li>{{ HTML::linkRoute('evercisegroups.index', 'Class Hub') }}</li>
                    </div>
                  </div>                    
             @else
                 <div class="nav-end">
                      <a  href="{{ URL::route( 'users.edit', $user->id ) }}">{{ HTML::image( $userImage, $user->display_name.'s image', array('class'=> 'profile-pic')); }}</a>
                     <li id="displayName">
                          {{ $user->display_name }}
                          {{ HTML::image( 'img/down-arrow.png', 'down-arrow', array('class'=> 'displayName-dropdown-arrow')) }}
                     </li>
                     <div id="displayName-dropdown" class="dropdown-menu">
                           <span>{{ HTML::linkRoute('users.edit', 'My Dashboard' , $user->id) }}</span>


                          @if ($user->inGroup($adminGroup))
                            <hr>
                            <span>{{ HTML::linkRoute('admin.pending', 'pending trainers') }}</span>
                            <span>{{ HTML::linkRoute('admin.pending_withdrawal', 'pending withdrawals') }}</span>
                          @endif
                     </div>
                 </div>
                 <div class="nav-join">
                 </div>
             @endif

          @else
              <div class="nav-end">
                 <li>{{  HTML::linkRoute('users.create', trans('header.register'))}}</li>
              </div>
              <div class="nav-join">
                   <div class="nav-login">
                      @if(isset($redirect_after_login))
                         <li>{{ HTML::link('/auth/login/'.Route::getCurrentRoute()->getName() , trans('header.login'),  array('id'=>'login', 'class' => 'login'))}}</li>
                        
                      @else
                         <li> {{HTML::linkRoute('auth.login', 'Login', null, array('id'=>'login', 'class' => 'login'))}}</li>
                      @endif
                   </div>
                  
              </div>
          @endif
          --}}
      </ul>
		</nav>
	</section>
</header>