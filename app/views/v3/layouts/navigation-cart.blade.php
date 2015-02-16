<nav class="navbar navbar-default" role="navigation" id="nav">
  <div class="container">
    <div class="navbar-header">
      {{HTML::linkRoute('home', '' , null , ['class' =>'navbar-brand', 'title' => 'Evercise Excercise' ])}}
    </div>
      <ul class="nav navbar-nav navbar-right">
           <span class="icon icon-padlock"></span><h3 class="mt5 ml10 mb0 mr50 sm-mr0 text-grey pull-left">secure shopping</h3>
           {{ Html::linkRoute('home', 'Continue Shopping', null ,['class' => 'link']) }}
      </ul>
  </div>
</nav>
