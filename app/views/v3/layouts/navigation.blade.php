<nav class="navbar navbar-default {{(isset($browse) && $browse) ? 'bg-dark' : null}}" role="navigation" id="nav">
  <div class="container-fluid">
    <div class="navbar-header">
      {{HTML::linkRoute('home', '' , null , ['class' =>'navbar-brand', 'title' => 'Evercise Excercise' ])}}
    </div>
    @if(isset($browse) && $browse)
        @include('v3.classes.browse')
    @endif
    <ul class="nav navbar-nav cart-wrapper navbar-right ">
          <li class="nav-list pull-right">
              {{ isset($cart) ? $cart : '' }}
          </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
        <li class="nav-btn nav-list">{{HTML::linkRoute('register', 'Join' , null , ['title'=>'Register Here', 'class' => Route::currentRouteName() == 'register' ? 'nav-link active' : 'nav-link'])}}</li>
        <li class="dropdown  login-drop nav-list">
            <a href="#" title="Login Here" class="dropdown-toggle nav-link" data-toggle="dropdown">Login</a>
            <ul class="dropdown-menu" role="menu">
                @include('v3.auth.login')
            </ul>
        </li>
    </ul>
  </div>
</nav>
