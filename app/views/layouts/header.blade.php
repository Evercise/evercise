<header>
	<section>
		<nav>		
			<ul>
				<a href="{{ URL::route('home', null) }}">{{ HTML::image('/img/evercise logo yellow.png', 'evercise logo', array('class' => 'logo')); }}</a>
                <li>{{HTML::linkRoute('static.how_it_works', 'How it works')}}</li>
                {{--
                @if(isset($aboutNav))
                    <li>{{ $aboutNav }}</li>
                @endif
                
                @if(isset($proNav))
                    <li>{{ $proNav }}</li>
                @endif
                --}}
                <li>{{HTML::linkRoute('evercisegroups.search', 'Discover classes')}}</li>
                {{--
                @if(isset($discoverNav))
                    <li>{{ $discoverNav }}</li>
                @endif
                
                 <li>
                    {{ Form::open(array('id' => 'search_bar', 'url' => 'users', 'method' => 'post')) }}
                        @include('form.textfield', array('fieldname'=>'search_bar', 'placeholder'=>'Find Classes near you', 'maxlength'=>50, 'label'=>null, 'fieldtext'=>null , 'default' => null ))
                    {{ Form::close() }}
                </li>

                @if(isset($helpNav))
                    <li>{{ $helpNav }}</li>
                @endif
                --}}
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
                           </div>
                       </div>
                       <div class="nav-join">
                            <li>{{  HTML::linkRoute('trainers.create', 'Register as Trainer')}}</li>
                       </div>
                   @endif

                @else
                    <div class="nav-end">
                       <li>{{  HTML::linkRoute('trainers.create', 'Register as Trainer')}}</li>
                    </div>
                    <div class="nav-join">
                         <li>{{ HTML::linkRoute('users.create', 'Register') }}</li>
                         <div class="nav-login">
                            @if(isset($redirect_after_login))
                               <li>{{ HTML::link('/auth/login/'.Route::getCurrentRoute()->getName() , 'Login',  array('id'=>'login', 'class' => 'login'))}}</li>
                              
                            @else
                               <li> {{HTML::linkRoute('auth.login', 'Login', null, array('id'=>'login', 'class' => 'login'))}}</li>
                            @endif
                         </div>
                        
                    </div>
                @endif
                
                {{--
                @if(isset($userNav) )
                     @if( $userNav == 'trainer')
                        @include('layouts.loginStatus', array('group' => 'trainer'))

                     @elseif($userNav == 'user')
                         @include('layouts.loginStatus', array('group' => 'user'))
                     @else

                        <li>{{ $userNav }}</li>

                     @endif

                    
                @endif
                --}}
            </ul>
		</nav>
	</section>
</header>