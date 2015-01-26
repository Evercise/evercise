<nav class="navbar navbar-default" role="navigation" id="nav">
  <div class="container-fluid">
    <div class="navbar-header">

      {{HTML::linkRoute('home', '' , null , ['class' =>'navbar-brand', 'title' => 'Evercise Excercise' ])}}

    </div>
      <ul class="nav navbar-nav navbar-right">
        <li class="nav-btn nav-list">{{HTML::linkRoute('register', 'Join' , null , ['title'=>'Register Here', 'class' => Route::currentRouteName() == 'register' ? 'nav-link active' : 'nav-link'])}}</li>
        <li class="dropdown  login-drop nav-list">
            <a href="#" title="Login Here" class="dropdown-toggle nav-link" data-toggle="dropdown">Login</a>
            <ul class="dropdown-menu" role="menu">
                @include('v3.auth.login')
            </ul>
        </li>
        <li class="dropdown cart-dropdown nav-list">
            <a href="#" title="Check your Shopping Cart" class="dropdown-toggle nav-cart nav-link" data-toggle="dropdown"><span class="icon icon-cart-white"></span>(0)</a>
            {{ isset($cart) ? $cart : '' }}
        </li>
      </ul>

  </div>
</nav>