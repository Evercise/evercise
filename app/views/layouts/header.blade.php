<header class="row">
	<section>
		<nav>		
			<ul>
				<a href="{{ URL::route('home', null) }}">{{ HTML::image('/img/evercise logo yellow.png', 'evercise logo', array('class' => 'logo')); }}</a>
                <li>{{HTML::linkRoute('static.how_it_works', trans('header.how_it_works'))}}</li>

                <li>{{HTML::linkRoute('evercisegroups.search', trans('header.discover_classes'))}}</li>

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
                                <hr>
                                <span>{{ HTML::linkRoute('users.logout', 'Log Out') }}</span>
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
                                <!--span>{{ HTML::linkRoute('evercisegroups.index', 'My Cart') }}</span--> 
                                <hr>
                                <span>{{ HTML::linkRoute('users.logout', 'Log Out') }}</span>
                                @if ($user->inGroup($adminGroup))
                                  <hr>
                                  <span>{{ HTML::linkRoute('admin.pending', 'pending trainers') }}</span>
                                  <span>{{ HTML::linkRoute('admin.pending_withdrawal', 'pending withdrawals') }}</span>
                                @endif
                           </div>
                       </div>
                       <div class="nav-join">
                           {{--<li>{{  HTML::linkRoute('trainers.create', 'Register as Trainer')}}</li>--}} 
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
                
            </ul>
		</nav>
	</section>
</header>