<nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="nav">
  <div class="container-fluid">
    <div class="navbar-header">

      {{HTML::linkRoute('home', '' , null , ['class' =>'navbar-brand', 'title' => 'Evercise Excercise' ])}}

    </div>
      <ul class="nav navbar-nav navbar-right mt10">
        <li class="nav-btn">{{HTML::linkRoute('register', 'Join' , null , ['title'=>'Register Here', 'class' => Route::currentRouteName() == 'register' ? 'nav-list active' : 'nav-list'])}}</li>
        <li class="dropdown  login-drop">
            <a href="#" title="Login Here" class="dropdown-toggle" data-toggle="dropdown">Login</a>
            <ul class="dropdown-menu" role="menu">
                @include('v3.auth.login')
            </ul>
        </li>
        <li class="dropdown cart-dropdown">
            <a href="#" title="Check your Shopping Cart" class="dropdown-toggle nav-cart" data-toggle="dropdown"><span class="icon icon-cart hover"></span></a>
            {{ isset($cart) ? $cart : '' }}
        </li>
      </ul>

  </div>
</nav>