<nav class="navbar navbar-default" role="navigation" id="nav">
  <div class="container-fluid">
    <div class="navbar-header">
      {{HTML::linkRoute('home', '' , null , ['class' =>'navbar-brand', 'title' => 'Evercise Excercise' ])}}
    </div>
    <ul class="nav navbar-nav nav-browse {{ (!isset($browse) ? 'hidden' : null ) }}">
        <div class="row">
            <div class="col-xs-2">
                <li class="custom-cat-select dropdown">
                    <a href="#" data-toggle="dropdown">Classes by<br><strong>Category </strong><span class="caret ml5"></span></a>
                </li>
            </div>
            <div class="col-xs-10">
                <div class="row">
                    {{ Form::open(['route' => 'evercisegroups.search', 'method' => 'get',  'role' => 'form', 'id' => 'search-form'] ) }}
                    <div class="col-sm-6">
                        <div class="input-group">
                              <div class="input-group-addon"><span class="icon icon-search"></span></div>
                              {{ Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Search for Classes...']) }}
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="input-group">
                            <div class="input-group-addon"><span class="icon icon-pointer"></span></div>
                            {{ Form::text('location', null, ['class' => 'form-control', 'placeholder' => 'Location', 'id' => 'location-auto-complete', 'data-toggle' => 'dropdown',  'autocomplete' => 'off']) }}
                            <ul id="locaction-autocomplete" class="dropdown-menu category-select" >
                                <li id="near-me" class="heading locator"><span class="icon icon-locator-pink-small"></span>Use my Current Location</li>
                                <div class="autocomplete-content"></div>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        {{ Form::hidden('city', null) }}
                        {{ Form::submit('Find a class' , ['class' => 'btn btn-primary btn-block']) }}
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        <div class="nav-categories" id="browse-cats">
            <div class="row no-gutter ml0 mr0">
                <div class="col-xs-4">
                    <ul class="items">
                        <li><a href="#" class="active">Yoga<span class="caret-right"></span></a></li>
                        <li><a href="#">Yoga<span class="caret-right"></span></a></li>
                        <li><a href="#">Yoga<span class="caret-right"></span></a></li>
                        <li><a href="#">Yoga<span class="caret-right"></span></a></li>
                        <li><a href="#">Yoga<span class="caret-right"></span></a></li>
                        <li><a href="#">Yoga<span class="caret-right"></span></a></li>
                        <li><a href="#">Yoga<span class="caret-right"></span></a></li>
                        <li><a href="#">Yoga<span class="caret-right"></span></a></li>
                        <li><a href="#">Yoga<span class="caret-right"></span></a></li>
                        <li><a href="#">Yoga<span class="caret-right"></span></a></li>
                        <li><a href="#">Yoga<span class="caret-right"></span></a></li>
                        <li><a href="#">Yoga<span class="caret-right"></span></a></li>
                    </ul>
                </div>
                <div class="col-xs-8">
                    <div class="tab">
                        <p>Pilates is a physical fitness system developed in the early 20th century by German-born Joseph Pilates. It is especially practiced in the United States (where</p>
                        <strong class="text-larger">Popular Classes</strong>
                        <div class="mt10 mb15">
                            <button class="btn btn-rounded btn-white mr20">Line dancing</button>
                            <button class="btn btn-rounded btn-white mr20">flips</button>
                            <button class="btn btn-rounded btn-white">ninja</button>
                        </div>
                        <strong class="text-larger">Types of pilates</strong>
                        <ul class="mt10">
                            <li><a href="#">Ultimate fighting(29)</a></li>
                            <li><a href="#">Ultimate fighting(29)</a></li>
                            <li><a href="#">Ultimate fighting(29)</a></li>
                            <li><a href="#">Ultimate fighting(29)</a></li>
                            <li><a href="#">Ultimate fighting(29)</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </ul>
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
