@extends('v3.layouts.master')
@section('body')
    <div class="jumbotron">
        <div class="hero">
          <div class="container text-center">
            <h1>spin class in king&apos;s cross</h1>
            <h1 class="text-primary">only &pound;5</h1>
          </div>
        </div>
      
    </div>
    <div class="container">
        <h1>// Nav bars (add class "navbar-fixed-top" to stick)</h1>
    </div>
    <nav class="navbar navbar-default" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"></a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li><a href="#">Discover Classes</a></li>
            <li><a href="#">Popular Classes</a></li>

          </ul>

          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle nav-cart" data-toggle="dropdown"><span class="icon icon-cart hover"></span></a>
                <ul class="dropdown-menu dropdown-cart" role="menu">
                    <div class="row">
                        <div class="col-xs-10">
                            <h4>Your classes cart</h4>
                        </div>
                        <div class="col-xs-2">
                            <h4><span class="icon icon-bin hover"></span></h4>
                        </div>

                    </div>

                    <li class="divider"></li>
                    <div class="row">
                        <div class="col-xs-3">
                            <div class="btn-group">
                                <button class="btn btn-primary">1</button>
                                <button type="button" class="btn btn-primary btn-aside" data-toggle="dropdown">
                                    <span class="caret"></span>
                                </button>
                            </div>

                        </div>
                        <div class="col-xs-7">
                            <strong>Hartha Yoga Restore & energise</strong>
                            <strong class="text-primary">&pound;18</strong>
                        </div>
                        <div class="col-xs-2">
                            <span class="icon icon-cross hover"></span>
                        </div>
                    </div>
                    <li class="divider"></li>
                    <div class="row">
                        <div class="col-xs-3">
                            <strong>Sub-total</strong>
                        </div>
                        <div class="col-xs-5">
                            <strong class="text-primary">&pound;18</strong>
                        </div>
                        <div class="col-xs-2">
                            <strong>Discount</strong>
                        </div>
                        <div class="col-xs-2">
                            <strong class="text-primary">10%</strong>
                        </div>
                    </div>
                    <li class="divider"></li>
                    <div class="row">
                        <div class="col-xs-3">
                            <strong>Total</strong>
                        </div>
                        <div class="col-xs-5">
                            <strong class="text-primary">&pound;16.20</strong>
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-primary">Checkout</button>
                        </div>
                    </div>
                </ul>
            </li>
            <li><a href="#">Login</a></li>
            <li><a href="#">Register</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
    <nav class="navbar navbar-default" role="navigation">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"></a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">

            <li><a href="#">Discover Classes</a></li>
            <li><a href="#">Popular Classes</a></li>

          </ul>

          <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle nav-cart" data-toggle="dropdown"><span class="icon icon-cart hover"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">some cart options</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li class="divider"></li>
                  <li><a href="#">Separated link</a></li>
                </ul>
              </li>
              <li class="dropdown">
                  <a href="#" class="dropdown-toggle nav-profile" data-toggle="dropdown">
                    Lewis
                    <img class="img-circle" src="img/lewis.jpg"/>
                  </a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">some cart options</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                  </ul>
              </li>

          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>




    <div class="container">
        <div class="row">
           <h1><u>// Heading tags</u></h1>
           <h1>h1. Heading 34px <small>Secondary text</small></h1>
           <h2>h2. Heading 30px <small>Secondary text</small></h2>
           <h3>h3. Heading 24px <small>Secondary text</small></h3>
           <h4>h4. Heading 20px <small>Secondary text</small></h4>
           <h5>h5. Heading 14px <small>Secondary text</small></h5>
           <h6>h6. Heading 12px <small>Secondary text</small></h6>
           <br>
           <h1><u>// paragraphs</u></h1>
           <p>p tag - Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</p>
           <p>p tag - Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a</p>
           <p class="lead">p class=lead tag - This is a lead paragraph</p>
           <p class="text-left">Left aligned text.</p>
            <p class="text-center">Center aligned text.</p>
            <p class="text-right">Right aligned text.</p>
            <p class="text-justify">Justified Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu sem tempor, varius quam at, luctus dui. Mauris magna metus, dapibus nec turpis vel, semper malesuada ante. Vestibulum id metus ac nisl bibendum scelerisque non non purus. Suspendisse varius nibh non aliquet sagittis. In tincidunt orci sit amet elementum vestibulum. Vivamus fermentum in arcu in aliquam.</p>
            <p class="text-nowrap">No wrap text.</p>
           <br>
           <h1><u>// Buttons</u></h1>
           <div class=".col-md-12 bg-danger">
               <button class="btn btn-primary">btn-primary</button>
               <button class="btn btn-default">btn-default</button>
               <button class="btn btn-grey btn-transparent">btn-grey btn-transparent</button>
               <button class="btn btn-warning">btn-warning</button>
               <button class="btn btn-white btn-transparent">btn-white btn-transparent</button>
               <button class="btn btn-primary disabled">btn-primary disabled</button>
               <button class="btn btn-default disabled">btn-default disabled</button>
               <button class="btn btn-primary btn-block">btn-primary btn-block - 100% of container</button>
               <button class="btn btn-white btn-transparent"> btn-transparent with icon<span class="icon icon-clock"></span></button>
           </div>
        </div>
        <div class="row">
           <h1>// Grid</h1>
           <div class="col-md-1 bg-primary">.col-md-1</div>
           <div class="col-md-1 bg-success">.col-md-1</div>
           <div class="col-md-1 bg-info">.col-md-1</div>
           <div class="col-md-1 bg-warning">.col-md-1</div>
           <div class="col-md-1 bg-danger">.col-md-1</div>
           <div class="col-md-1 bg-primary">.col-md-1</div>
           <div class="col-md-1 bg-success">.col-md-1</div>
           <div class="col-md-1 bg-info">.col-md-1</div>
           <div class="col-md-1 bg-warning">.col-md-1</div>
           <div class="col-md-1 bg-danger">.col-md-1</div>
           <div class="col-md-1 bg-primary">.col-md-1</div>
           <div class="col-md-1 bg-success">.col-md-1</div>
        </div>
        <div class="row">
          <div class="col-md-8 bg-info">.col-md-8</div>
          <div class="col-md-4 bg-warning">.col-md-4</div>
        </div>
        <div class="row">
          <div class="col-md-4 bg-danger">.col-md-4</div>
          <div class="col-md-4 bg-primary">.col-md-4</div>
          <div class="col-md-4 bg-success">.col-md-4</div>
        </div>
        <div class="row">
          <div class="col-md-6 bg-info">.col-md-6</div>
          <div class="col-md-6 bg-warning">.col-md-6</div>
        </div>
        <div class="row">
          <div class="col-md-3 bg-danger">.col-md-3</div>
          <div class="col-md-3 bg-primary">.col-md-3</div>
          <div class="col-md-3 bg-success">.col-md-3</div>
          <div class="col-md-3 bg-warning">.col-md-3</div>
        </div>
        <div class="row">
            <h1> //class blocks</h1>
            <h4>Class blocks use nested columns for graceful responsive stacking  </h4>
            <h3>class-module</h3>

            <div class="col-md-4">
                <div class="class-module center-block">
                    <div class="class-image-wrapper">
                        <img src="img/example-class-img.jpg">
                    </div>
                    <div class="class-title-wrapper text-center">
                        <a href="#"><h3>Fitness class for ladies</h3></a>
                        <div class="class-rating-wrapper">
                            <span class="icon icon-full-star"></span>
                            <span class="icon icon-full-star"></span>
                            <span class="icon icon-full-star"></span>
                            <span class="icon icon-empty-star"></span>
                            <span class="icon icon-empty-star"></span>
                        </div>
                    </div>
                    <div class="class-info-wrapper panel-body bg-grey row">
                        <div class="col-xs-6">
                            <span class="icon icon-clock"></span> Sept 27th, 4pm
                        </div>
                        <div class="col-xs-6">
                            <div class="row no-gutter">
                                <div class="col-xs-7"><span class="icon icon-watch"></span> 1 hour</div>
                                <div class="col-xs-5"><span class="icon icon-ticket"></span> x 5</div>
                            </div>

                        </div>

                    </div>
                    <div class="class-info-wrapper panel-body bg-grey row">
                        <div class="col-xs-6" ><strong class="text-primary">&pound;16</strong></div>
                        <div class="col-xs-6"> <button class="btn btn-default pull-right">Join Class</button></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="class-module center-block">
                    <div class="class-image-wrapper">
                        <img src="img/example-class-img.jpg">
                    </div>
                    <div class="class-title-wrapper text-center">
                        <a href="#"><h3>Fitness class for ladies</h3></a>
                        <div class="class-rating-wrapper">
                            <span class="icon icon-full-star"></span>
                            <span class="icon icon-full-star"></span>
                            <span class="icon icon-full-star"></span>
                            <span class="icon icon-empty-star"></span>
                            <span class="icon icon-empty-star"></span>
                        </div>
                    </div>
                    <div class="class-info-wrapper panel-body bg-grey row">
                        <div class="col-xs-6">
                            <span class="icon icon-clock"></span> Sept 27th, 4pm
                        </div>
                        <div class="col-xs-6">
                            <div class="row no-gutter">
                                <div class="col-xs-7"><span class="icon icon-watch"></span> 1 hour</div>
                                <div class="col-xs-5"><span class="icon icon-ticket"></span> x 5</div>
                            </div>

                        </div>

                    </div>
                    <div class="class-info-wrapper panel-body bg-grey row">
                        <div class="col-xs-6" ><strong class="text-primary">&pound;16</strong></div>
                        <div class="col-xs-6"> <button class="btn btn-default pull-right">Join Class</button></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="class-module center-block">
                    <div class="class-image-wrapper">
                        <img src="img/example-class-img.jpg">
                    </div>
                    <div class="class-title-wrapper text-center">
                        <a href="#"><h3>Fitness class for ladies</h3></a>
                        <div class="class-rating-wrapper">
                            <span class="icon icon-full-star"></span>
                            <span class="icon icon-full-star"></span>
                            <span class="icon icon-full-star"></span>
                            <span class="icon icon-empty-star"></span>
                            <span class="icon icon-empty-star"></span>
                        </div>
                    </div>
                    <div class="class-info-wrapper panel-body bg-grey row">
                        <div class="col-xs-6">
                            <span class="icon icon-clock"></span> Sept 27th, 4pm
                        </div>
                        <div class="col-xs-6">
                            <div class="row no-gutter">
                                <div class="col-xs-7"><span class="icon icon-watch"></span> 1 hour</div>
                                <div class="col-xs-5"><span class="icon icon-ticket"></span> x 5</div>
                            </div>

                        </div>

                    </div>
                    <div class="class-info-wrapper panel-body bg-grey row">
                        <div class="col-xs-6" ><strong class="text-primary">&pound;16</strong></div>
                        <div class="col-xs-6"> <button class="btn btn-default pull-right">Join Class</button></div>
                    </div>
                </div>
            </div>


            <h3>class-list</h3>


            <div class="col-md-12">
                <div class="class-list center-block row">
                    <div class="class-image-wrapper col-xs-2">
                        <img src="img/example-class-img.jpg">
                    </div>
                    <div class="class-title-wrapper col-xs-8">
                        <a href="#"><h3>Fitness class for ladies</h3></a>
                        <div class="class-rating-wrapper">
                            <span class="icon icon-full-star"></span>
                            <span class="icon icon-full-star"></span>
                            <span class="icon icon-full-star"></span>
                            <span class="icon icon-full-star"></span>
                            <span class="icon icon-full-star"></span>
                        </div>
                         <div class="row">
                             <div class="col-xs-6">
                                 <span class="icon icon-clock"></span> Sept 27th, 4pm
                             </div>
                             <div class="col-sm-6">
                                 <div class="row">
                                     <div class="col-md-6"><span class="icon icon-clock"></span> 1 hour</div>
                                     <div class="col-dm-6"><i class="fa fa-ticket"></i> x 5 tickets left</div>
                                 </div>
                             </div>
                         </div>
                    </div>
                    <div class="class-info-wrapper col-xs-2 bg-grey text-center">
                        <strong class="text-primary center-block">&pound;16</strong>
                        <button class="btn btn-default center-block">Join Class</button>
                    </div>
                </div>
            </div>

            <h3>class-panel</h3>

            <div class="col-md-6">
                <div class="class-panel center-block">
                    <div class="row">
                        <div class="class-image-wrapper col-xs-4">
                            <img src="img/example-class-img.jpg">
                        </div>
                        <div class="class-title-wrapper col-xs-8">
                            <a href="#"><h3>Fitness class for ladies</h3></a>
                            <button class="btn btn-primary">A button</button>
                        </div>
                    </div>
                    <div class="row panel-body bg-grey class-info-wrapper">
                        <div class=" col-sm-7">
                            <span><span class="icon icon-clock"></span> Next class, Sept 27th, 4pm</span>
                         </div>
                        <div class=" col-sm-5">
                            <div class="row">
                                <div class="col-xs-4">
                                    <strong class="text-primary">&pound;16</strong>
                                </div>
                                <div class="col-xs-8">
                                    <button class="btn btn-default">Join Class</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-6">
                <div class="class-panel center-block">
                    <div class="row">
                        <div class="class-image-wrapper col-xs-4">
                            <img src="img/example-class-img.jpg">
                        </div>
                        <div class="class-title-wrapper col-xs-8">
                            <a href="#"><h3>Fitness class for ladies</h3></a>
                            <div class="class-rating-wrapper">
                                <span class="icon icon-full-star"></span>
                                <span class="icon icon-full-star"></span>
                                <span class="icon icon-full-star"></span>
                                <span class="icon icon-full-star"></span>
                                <span class="icon icon-full-star"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row panel-body bg-grey class-info-wrapper">
                        <div class=" col-sm-7">
                            <span><span class="icon icon-clock"></span> Next class, Sept 27th, 4pm</span>
                         </div>
                        <div class=" col-sm-5">
                            <div class="row">
                                <div class="col-xs-4">
                                    <strong class="text-primary">&pound;16</strong>
                                </div>
                                <div class="col-xs-8">
                                    <button class="btn btn-default">Join Class</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="class-panel center-block">
                    <div class="row">
                        <div class="class-image-wrapper col-xs-4">
                            <img src="img/example-class-img.jpg">
                        </div>
                        <div class="class-title-wrapper col-xs-8">
                            <a href="#"><h3>Fitness class for ladies</h3></a>
                            <div class="class-rating-wrapper">
                                <span class="icon icon-full-star"></span>
                                <span class="icon icon-full-star"></span>
                                <span class="icon icon-full-star"></span>
                                <span class="icon icon-full-star"></span>
                                <span class="icon icon-full-star"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row panel-body bg-grey class-info-wrapper text-center">
                        Rate it
                        <br>
                        <strong><i class="fa fa-star-o"></i></strong>
                        <strong><i class="fa fa-star-o"></i></strong>
                        <strong><i class="fa fa-star-o"></i></strong>
                        <strong><i class="fa fa-star-o"></i></strong>
                        <strong><i class="fa fa-star-o"></i></strong>
                        <form role="form">
                            <div class="form-group">
                                <textarea rows="6" class="form-control" type="text" placeholder="Add your review about the class..."></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-default">Cancel</button>
                                <button type="submit" class="btn btn-primary">Add Review</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
             <div class="col-md-6">
                <div class="class-panel center-block">
                    <div class="row">
                        <div class="class-image-wrapper col-xs-4">
                            <img src="img/example-class-img.jpg">
                        </div>
                        <div class="class-title-wrapper col-xs-8">
                            <a href="#"><h3>Fitness class for ladies</h3></a>
                            <div class="class-rating-wrapper">
                                <span class="icon icon-full-star"></span>
                                <span class="icon icon-full-star"></span>
                                <span class="icon icon-full-star"></span>
                                <span class="icon icon-full-star"></span>
                                <span class="icon icon-full-star"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row panel-body bg-grey class-info-wrapper">
                        <div class=" col-sm-7">
                            <span>No other classes available</span>
                         </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="class-panel center-block">
                    <div class="row">
                        <div class="class-image-wrapper col-xs-4">
                            <img src="img/example-class-img.jpg">
                        </div>
                        <div class="class-title-wrapper col-xs-8">
                            <a href="#"><h3>Fitness class for ladies</h3></a>
                            <div class="class-rating-wrapper">
                                <span class="icon icon-full-star"></span>
                                <span class="icon icon-full-star"></span>
                                <span class="icon icon-full-star"></span>
                                <span class="icon icon-full-star"></span>
                                <span class="icon icon-full-star"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row panel-body bg-grey class-info-wrapper">
                        <div class="col-sm-12">
                            <em><small>You said:</small></em>

                        </div>
                        <div class="col-sm-12">
                            <div class="class-rating-wrapper">
                                <span class="icon icon-full-star"></span>
                                <span class="icon icon-full-star"></span>
                                <span class="icon icon-full-star"></span>
                                <span class="icon icon-full-star"></span>
                                <span class="icon icon-full-star"></span>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</p>
                        </div>
                    </div>
                    <div class="row panel-body bg-dark-grey class-info-wrapper">
                        <div class=" col-sm-7">
                            <span><span class="icon icon-clock"></span> Next class, Sept 27th, 4pm</span>
                         </div>
                        <div class=" col-sm-5">
                            <div class="row">
                                <div class="col-xs-4">
                                    <strong class="text-primary">&pound;16</strong>
                                </div>
                                <div class="col-xs-8">
                                    <button class="btn btn-default">Join Class</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h3>class-snippet</h3>

        <div class="col-md-5">
            <div class="class-snippet center-block">
                <div class="row">
                    <div class="class-image-wrapper col-sm-4">
                        <img src="img/example-class-img.jpg">
                    </div>
                    <div class="class-title-wrapper panel-body col-sm-8">
                        <div class="col-xs-12">
                            <a href="#"><h3>Fitness class for ladies</h3></a>
                        </div>

                        <div class="class-rating-wrapper col-xs-9">
                            <span class="icon icon-full-star"></span>
                            <span class="icon icon-full-star"></span>
                            <span class="icon icon-full-star"></span>
                            <span class="icon icon-full-star"></span>
                            <span class="icon icon-full-star"></span>
                        </div>
                        <div class="col-xs-3">
                            <strong class="text-primary">&pound;16</strong>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-5">
            <div class="class-snippet class-unactive center-block">
                <div class="row">
                    <div class="class-image-wrapper col-sm-4">
                        <img src="img/example-class-img.jpg">
                    </div>
                    <div class="class-title-wrapper panel-body col-sm-8">
                        <div class="col-xs-12">
                            <a href="#"><h3>Fitness class for ladies</h3></a>
                        </div>

                        <div class="class-rating-wrapper col-xs-9">
                            <span class="icon icon-full-star"></span>
                            <span class="icon icon-full-star"></span>
                            <span class="icon icon-full-star"></span>
                            <span class="icon icon-full-star"></span>
                            <span class="icon icon-full-star"></span>
                        </div>
                        <div class="col-xs-3">
                            <strong class="text-primary">&pound;16</strong>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-5">
            <div class="class-snippet class-active center-block">
                <div class="row">
                    <div class="class-image-wrapper col-sm-4">
                        <img src="img/example-class-img.jpg">
                    </div>
                    <div class="class-title-wrapper panel-body col-sm-8">
                        <div class="col-xs-12">
                            <a href="#"><h3>Fitness class for ladies</h3></a>
                        </div>

                        <div class="class-rating-wrapper col-xs-9">
                            <span class="icon icon-full-star"></span>
                            <span class="icon icon-full-star"></span>
                            <span class="icon icon-full-star"></span>
                            <span class="icon icon-full-star"></span>
                            <span class="icon icon-full-star"></span>
                        </div>
                        <div class="col-xs-3">
                            <strong class="text-primary">&pound;16</strong>
                        </div>

                    </div>
                </div>

            </div>
        </div>



        <div class="col-sm-8 col-md-offset-2">
            <h1>//Forms</h1>
            <div class="row">
                <form role="form">
                    <div class="col-sm-6">
                       <div class="form-group">
                         <label for="forename">Forename</label>
                         <input type="text" class="form-control" id="forename" placeholder="Enter your first name">
                       </div>
                       <div class="form-group">
                         <label for="forename">Your Evercise Display Name</label>
                         <input type="text" class="form-control" id="display" placeholder="Enter your first name">
                         <em class="help-block">evercise.com/users/</em>
                       </div>
                       <div class="form-group">
                         <label for="password">Password</label>
                         <input type="text" class="form-control" id="password" placeholder="Enter your first name">
                       </div>

                       <div class="form-group">

                         <label for="forename">Phone Number<small> (Get alerts about classes)</small></label>

                         <div class="input-group">
                             <div class="input-group-addon">+44</div>
                             <input type="text" class="form-control" id="phone">
                        </div>

                       </div>

                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="forename">Surname</label>
                        <input type="text" class="form-control" id="surname" placeholder="Enter your second name">
                      </div>
                      <div class="form-group">
                        <label for="forename">Forename</label>
                        <input type="text" class="form-control" id="forename" placeholder="Enter your first name">
                      </div>
                      <div class="form-group">
                        <label for="forename">Forename</label>
                        <input type="text" class="form-control" id="forename" placeholder="Enter your first name">
                      </div>
                      <div class="form-group">
                        <label for="forename">Forename</label>
                        <input type="text" class="form-control" id="forename" placeholder="Enter your first name">
                      </div>
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
            </div>

        </div>



    </div>

    <ul class="nav nav-pills footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <h3>Evercise Classes</h3>
                    <li><a href="#">Discover Classes</a></li>
                    <li><a href="#">Popular Classes</a></li>
                </div>
                <div class="col-sm-4">
                    <h3>About Evercise</h3>
                    <li><a href="#">What is Evercise?</a></li>
                    <li><a href="#">Evercise Class Guidelines</a></li>
                    <li><a href="#">Need Help</a></li>
                    <li><a href="#">Meet the Evercise Team</a></li>
                    <li><a href="#">Evercise Careers</a></li>
                </div>
                <div class="col-sm-4">
                    <h3>Contact Us</h3>
                    <li><a href="#">+44 (0)203 322 216</a></li>
                    <li><a href="#">hello@evercise.com</a></li>
                    <ul class="list-inline">
                        <li><a href="#"><span class="icon-lg icon-lg-fb"></span></a></li>
                        <li><a href="#"><span class="icon-lg icon-lg-tweeter"></span></a></li>
                        <li><a href="#"><span class="icon-lg icon-lg-google"></span></a></li>
                    </ul>
                </div>
            </div>

        </div>

    </ul>

@stop