<nav class="navbar navbar-default {{(isset($browse) && $browse) ? 'bg-dark' : null}}" role="navigation" id="nav">
  <div class="container-fluid">
    <div class="navbar-header">
      {{HTML::linkRoute('home', '' , null , ['class' =>'navbar-brand', 'title' => 'Evercise Excercise' ])}}
    </div>
    @if(isset($browse) && $browse)
        @include('v3.classes.browse')
    @endif
    <ul class="nav navbar-nav navbar-right">
        <li class="nav-btn nav-list">{{HTML::linkRoute('register', 'Join' , null , ['title'=>'Register Here', 'class' => Route::currentRouteName() == 'register' ? 'nav-link active' : 'nav-link'])}}</li>
        <li class="dropdown  login-drop nav-list">
            <a href="#" title="Login Here" class="dropdown-toggle nav-link" data-toggle="dropdown">Login</a>
            <ul class="dropdown-menu" role="menu">
                @include('v3.auth.login')
            </ul>
        </li>
        <li class="dropdown cart-dropdown nav-list visible-md-block visible-lg-block">
            <a href="#" title="Check your Shopping Cart" class="dropdown-toggle nav-cart nav-link" data-toggle="dropdown"><span class="icon icon-cart-white"></span>(<span class="cart-items">{{ isset($cart_items) ? count($cart_items) : '0' }}</span>)</a>
            {{ isset($cart) ? $cart : '' }}
        </li>
        <li class="nav-list visible-xs-block visible-sm-block">
            <a href="/cart/checkout" title="Check your Shopping Cart" class="nav-cart nav-link"><span class="icon icon-cart-white"></span>(<span class="cart-items">{{ isset($cart_items) ? count($cart_items) : '0' }}</span>)</a>
        </li>
    </ul>
  </div>
</nav>
