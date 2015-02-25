<nav class="navbar navbar-default {{(isset($browse) && $browse) ? 'bg-dark' : null}}" role="navigation" id="nav">
  <div class="container-fluid">
    <div class="navbar-header">
      {{HTML::linkRoute('home', '' , null , ['class' =>'navbar-brand', 'title' => 'Evercise Excercise' ])}}
    </div>
    @if(isset($browse) && $browse)
        @include('v3.classes.browse')
    @endif
      <ul class="nav navbar-nav cart-wrapper navbar-right ">
          <li class="nav-list pull-right visible-md-block visible-lg-block">
              {{ isset($cart) ? $cart : '' }}
          </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="nav-list hidden">
            <span>{{ HTML::decode(HTML::linkRoute('conversation', '', ['displayName'=>$newMessages['user']], ['class'=>'icon icon-mail'])) }}{{ $newMessages['count'] }}</span>
        </li>
        <li class="nav-list  visible-md-block visible-lg-block">
            {{ HTML::decode(HTML::linkRoute('users.edit', $user->display_name.  image( $user->directory.'/small_'.$user->image, $user->display_name.'s image', ['class' => 'img-circle']) , $user->display_name , ['class' => Route::currentRouteName() == 'profile' ? 'nav-profile active nav-link' : 'nav-link nav-profile'] ) )}}
        </li>
        <li class="nav-list visible-xs-block visible-sm-block">
            {{ HTML::decode(HTML::linkRoute('users.edit', image( $user->directory.'/small_'.$user->image, $user->display_name.'s image', ['class' => 'img-circle']) , $user->display_name , ['class' => Route::currentRouteName() == 'profile' ? 'nav-profile active nav-link' : 'nav-link nav-profile'] ) )}}
        </li>
        <li class="nav-list visible-xs-block visible-sm-block">
            <a href="/cart/checkout" title="Check your Shopping Cart" class="nav-cart nav-link"><span class="icon icon-cart-white"></span>(<span class="cart-items">{{ isset($cart_items) ? count($cart_items) : '0' }}</span>)</a>
        </li>
      </ul>
  </div>
</nav>
