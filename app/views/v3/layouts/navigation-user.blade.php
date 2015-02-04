<nav class="navbar navbar-default" role="navigation" id="nav">
  <div class="container-fluid">
    <div class="navbar-header">
      {{HTML::linkRoute('home', '' , null , ['class' =>'navbar-brand', 'title' => 'Evercise Excercise' ])}}
    </div>
    @if(isset($browse) && $browse)
        @include('v3.classes.browse')
    @endif
      <ul class="nav navbar-nav navbar-right">
        <li class="nav-list hidden">
            <span>{{ HTML::decode(HTML::linkRoute('conversation', '', ['displayName'=>$newMessages['user']], ['class'=>'icon icon-mail'])) }}{{ $newMessages['count'] }}</span>
        </li>
        <li class="dropdown cart-dropdown nav-list visible-md-block visible-lg-block">
            <a href="#" title="Check your Shopping Cart" class="dropdown-toggle nav-cart nav-link" data-toggle="dropdown"><span class="icon icon-cart-white"></span>(<span class="cart-items">{{ isset($cart_items) ? count($cart_items) : '0' }}</span>)</a>
            {{ isset($cart) ? $cart : '' }}
        </li>
        <li class="nav-list visible-xs-block visible-sm-block">
            <a href="/cart/checkout" title="Check your Shopping Cart" class="nav-cart nav-link"><span class="icon icon-cart-white"></span>(<span class="cart-items">{{ isset($cart_items) ? count($cart_items) : '0' }}</span>)</a>
        </li>
        <li class="nav-list">
            {{ HTML::decode(HTML::linkRoute('users.edit', $user->display_name.  image( $user->directory.'/small_'.$user->image, $user->display_name.'s image', ['class' => 'img-circle']) , $user->display_name , ['class' => Route::currentRouteName() == 'profile' ? 'nav-profile active nav-link' : 'nav-link nav-profile'] ) )}}
        </li>
      </ul>
  </div>
</nav>
