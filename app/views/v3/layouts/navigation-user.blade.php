<!--
<nav class="navbar navbar-default navbar-fixed-top" role="navigation"  id="nav">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navnav">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      {{HTML::linkRoute('home', '' , null , ['class' =>'navbar-brand' ])}}
    </div>

    <div class="collapse navbar-collapse sm-text-center " id="navnav">
      <ul class="nav navbar-nav">
        <li>{{HTML::linkRoute('evercisegroups.search', 'Discover Classes' , null , ['class' => Route::currentRouteName() == 'evercisegroups.search' ? 'nav-list active' : 'nav-list'])}}</li>
        <li>{{HTML::linkRoute('evercisegroups.search', 'Popular Classes' , null , ['class' => Route::currentRouteName() == 'evercisegroups.search' ? 'nav-list active' : 'nav-list'])}}</li>
        <li>{{HTML::linkRoute('packages', 'Packages' , null , ['class' => Route::currentRouteName() == 'packages' ? 'nav-list active' : 'nav-list'])}}</li>
        <li>{{HTML::linkRoute('blog', 'Blog' , null , ['class' => Route::currentRouteName() == 'blog' ? 'nav-list active' : 'nav-list'])}}</li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
       <li class="dropdown">
           <a href="#" class="dropdown-toggle nav-cart" data-toggle="dropdown"><span class="icon icon-cart hover"></span></a>
           {{ isset($cart) ? $cart : '' }}
       </li>
        <li >
            {{ HTML::decode(HTML::linkRoute('users.edit', $user->display_name.  image( $user->directory.'/small_'.$user->image, $user->display_name.'s image', ['class' => 'img-circle']) , $user->display_name , ['class' => Route::currentRouteName() == 'profile' ? 'nav-profile active nav-list' : 'nav-list nav-profile'] ) )}}
        </li>
      </ul>
    </div>
  </div>
</nav>
-->
<nav id="sidenav" class="navmenu navmenu-default navmenu-fixed-left offcanvas" role="navigation">
     <ul class="nav navbar-nav list-group">
       <li class="list-group-item">
         {{ HTML::decode(HTML::linkRoute('users.edit', $user->display_name.  image( $user->directory.'/small_'.$user->image, $user->display_name.'s image', ['class' => 'img-circle']) , $user->display_name , ['class' => Route::currentRouteName() == 'profile' ? 'nav-profile active nav-list' : 'nav-list nav-profile'] ) )}}
       </li>
       <li class="list-group-item">{{HTML::linkRoute('evercisegroups.search', 'Discover Classes' , null , ['class' => Route::currentRouteName() == 'evercisegroups.search' ? 'nav-list active' : 'nav-list'])}}</li>
       <li class="list-group-item">{{HTML::linkRoute('evercisegroups.search', 'Popular Classes' , null , ['class' => Route::currentRouteName() == 'evercisegroups.search' ? 'nav-list active' : 'nav-list'])}}</li>
       <li class="list-group-item">{{HTML::linkRoute('packages', 'Packages' , null , ['class' => Route::currentRouteName() == 'packages' ? 'nav-list active' : 'nav-list'])}}</li>
       <li class="list-group-item">{{HTML::linkRoute('blog', 'Blog' , null , ['class' => Route::currentRouteName() == 'blog' ? 'nav-list active' : 'nav-list'])}}</li>
       <li class="list-group-item">{{HTML::linkRoute('cart.checkout', 'Checkout' , null , ['class' => Route::currentRouteName() == 'cart.checkout' ? 'nav-list active' : 'nav-list'])}}</li>
     </ul>

</nav>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation"  id="nav">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="offcanvas" data-target="#sidenav" data-canvas="body">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      {{HTML::linkRoute('home', '' , null , ['class' =>'navbar-brand' ])}}
    </div>

    <div class="collapse navbar-collapse sm-text-center " id="navcollapse">
      <ul class="nav navbar-nav">
        <li>{{HTML::linkRoute('evercisegroups.search', 'Discover Classes' , null , ['class' => Route::currentRouteName() == 'evercisegroups.search' ? 'nav-list active' : 'nav-list'])}}</li>
        <li>{{HTML::linkRoute('evercisegroups.search', 'Popular Classes' , null , ['class' => Route::currentRouteName() == 'evercisegroups.search' ? 'nav-list active' : 'nav-list'])}}</li>
        <li>{{HTML::linkRoute('packages', 'Packages' , null , ['class' => Route::currentRouteName() == 'packages' ? 'nav-list active' : 'nav-list'])}}</li>
        <li>{{HTML::linkRoute('blog', 'Blog' , null , ['class' => Route::currentRouteName() == 'blog' ? 'nav-list active' : 'nav-list'])}}</li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
       <li id="cart-dropdown" class="dropdown">
           <a href="#" class="dropdown-toggle nav-cart" data-toggle="dropdown"><span class="icon icon-cart hover"></span></a>
           {{ isset($cart) ? $cart : '' }}
       </li>
        <li >
            {{ HTML::decode(HTML::linkRoute('users.edit', $user->display_name.  image( $user->directory.'/small_'.$user->image, $user->display_name.'s image', ['class' => 'img-circle']) , $user->display_name , ['class' => Route::currentRouteName() == 'profile' ? 'nav-profile active nav-list' : 'nav-list nav-profile'] ) )}}
        </li>
      </ul>
    </div>
  </div>
</nav>
