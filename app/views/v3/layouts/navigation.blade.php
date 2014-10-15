<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      {{HTML::linkRoute('home', '' , null , ['class' =>'navbar-brand' ])}}
    </div>

    <div class="collapse navbar-collapse sm-text-center" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li>{{HTML::linkRoute('evercisegroups.search', 'Discover Classes' , null , ['class' => Route::currentRouteName() == 'evercisegroups.search' ? 'nav-list active' : 'nav-list'])}}</li>
        <li>{{HTML::linkRoute('evercisegroups.search', 'Popular Classes' , null , ['class' => Route::currentRouteName() == 'evercisegroups.search' ? 'nav-list active' : 'nav-list'])}}</li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle nav-cart" data-toggle="dropdown"><span class="icon icon-cart hover"></span></a>
            @include('v3.cart.dropdown')
        </li>

        <li class="dropdown">
            <a href="#" class="dropdown-toggle nav-list" data-toggle="dropdown">Login</a>
            <ul class="dropdown-menu" role="menu">
                @include('v3.auth.login')
            </ul>
        </li>
        <li class="nav-list">{{HTML::linkRoute('register', 'Register' , null , ['class' => Route::currentRouteName() == 'register' ? 'nav-list active' : 'nav-list'])}}</li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>