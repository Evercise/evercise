<nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="nav">
  <div class="container-fluid">
    <div class="navbar-header">

      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navy">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

      {{HTML::linkRoute('home', '' , null , ['class' =>'navbar-brand', 'title' => 'Evercise Excercise' ])}}
      <ul id="mobile-cart" class="nav navbar-nav navbar-right">
            <li class="dropdown cart-dropdown">
                <a href="#" class="dropdown-toggle nav-cart" data-toggle="dropdown"><span class="icon icon-cart hover"></span></a>
                {{ isset($cart) ? $cart : '' }}
            </li>
      </ul>
    </div>

    <div class="collapse navbar-collapse sm-text-center" id="navy">
      <ul class="nav navbar-nav">
        <li>{{HTML::linkRoute('evercisegroups.search', 'Discover Fitness Classes' , null , ['title' => 'Discover Fitness Classes', 'class' => Route::currentRouteName() == 'evercisegroups.search' ? 'nav-list active' : 'nav-list'])}}</li>
        <li>{{HTML::linkRoute('packages', 'Fitness Packages' , null , ['title'=> 'Fitness Packages', 'class' => Route::currentRouteName() == 'packages' ? 'nav-list active' : 'nav-list'])}}</li>
        <li>{{HTML::linkRoute('blog', 'Evercise Blog' , null , ['title'=> 'Evercise Blog', 'class' => Route::currentRouteName() == 'blog' ? 'nav-list active' : 'nav-list'])}}</li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown cart-dropdown no-mob">
            <a href="#" title="Check your Shopping Cart" class="dropdown-toggle nav-cart" data-toggle="dropdown"><span class="icon icon-cart hover"></span></a>
            {{ isset($cart) ? $cart : '' }}
        </li>

        <li class="dropdown  login-drop">
            <a href="#" title="Login Here" class="dropdown-toggle nav-list" data-toggle="dropdown">Login</a>
            <ul class="dropdown-menu" role="menu">
                @include('v3.auth.login')
            </ul>
        </li>
        <li class="nav-list">{{HTML::linkRoute('register', 'Register' , null , ['title'=>'Register Here', 'class' => Route::currentRouteName() == 'register' ? 'nav-list active' : 'nav-list'])}}</li>
      </ul>
    </div>
  </div>
</nav>