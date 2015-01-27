<nav class="navbar navbar-default" role="navigation" id="nav">
  <div class="container-fluid">
    <div class="navbar-header">
      {{HTML::linkRoute('home', '' , null , ['class' =>'navbar-brand', 'title' => 'Evercise Excercise' ])}}
    </div>
      <ul class="nav navbar-nav navbar-right">
        <li class="nav-list">
            <span>{{ HTML::decode(HTML::linkRoute('conversation', '', ['displayName'=>$user->display_name], ['class'=>'icon icon-mail', 'data-id' => $user->display_name])) }}{{ $newMessages }}</span>
        </li>
        <li class="dropdown cart-dropdown nav-list">
            <a href="#" title="Check your Shopping Cart" class="dropdown-toggle nav-cart nav-link" data-toggle="dropdown"><span class="icon icon-cart-white"></span>(0)</a>
            {{ isset($cart) ? $cart : '' }}
        </li>
        <li class="nav-list">
            {{ HTML::decode(HTML::linkRoute('users.edit', $user->display_name.  image( $user->directory.'/small_'.$user->image, $user->display_name.'s image', ['class' => 'img-circle']) , $user->display_name , ['class' => Route::currentRouteName() == 'profile' ? 'nav-profile active nav-link' : 'nav-link nav-profile'] ) )}}
        </li>
      </ul>
  </div>
</nav>
