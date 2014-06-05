<header>
	<section>
		<nav>		
			<ul>
				<a href="{{ URL::route('home', null) }}">{{ HTML::image('/img/evercise logo yellow.png', 'evercise logo'); }}</a>
                @if(isset($aboutNav))
                    <li>{{ $aboutNav }}</li>
                @endif
                @if(isset($proNav))
                    <li>{{ $proNav }}</li>
                @endif
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
                @if(isset($joinNav))
                    <li>{{ $joinNav }}</li>
                @endif
                @if(isset($userNav) )
                     @if( $userNav == 'trainer')
                        @include('layouts.loginStatus', array('group' => 'trainer'))

                     @elseif($userNav == 'user')
                         @include('layouts.loginStatus', array('group' => 'user'))
                     @else

                        <li>{{ $userNav }}</li>

                     @endif

                    
                @endif
            </ul>
		</nav>
	</section>
</header>