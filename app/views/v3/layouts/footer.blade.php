<ul class="nav footer sm-text-center">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <h3>Evercise Classes</h3>
                <li>{{HTML::linkRoute('evercisegroups.search', 'Discover Classes' , null , ['class' => Route::currentRouteName() == 'evercisegroups.serach' ? 'active' : ''])}}</li>
                <li>{{HTML::linkRoute('static.class_guidelines', 'Evercise Class Guidelines' , null , ['class' => Route::currentRouteName() == 'static.class_guidelines' ? 'active' : ''])}}</li>
                <li>{{HTML::linkRoute('static.faq', 'Need Help' , null , ['class' => Route::currentRouteName() == 'static.faq' ? 'active' : ''])}}</li>
                <!--<li>{{HTML::linkRoute('popular', 'Popular Classes' , null , ['class' => Route::currentRouteName() == 'popular' ? 'active' : ''])}}</li>-->
            </div>
            <div class="col-sm-4">
                <h3>About Evercise</h3>
                <li>{{HTML::linkRoute('general.about', 'What is Evercise' , null , ['class' => Route::currentRouteName() == 'static.about' ? 'active' : ''])}}</li>
                <li>{{HTML::linkRoute('general.terms', 'Terms' , null , ['class' => Route::currentRouteName() == 'static.about' ? 'active' : ''])}}</li>
                <li>{{HTML::linkRoute('static.the_team', 'Meet the Team' , null , ['class' => Route::currentRouteName() == 'static.the_team' ? 'active' : ''])}}</li>
                <li>{{HTML::linkRoute('static.careers', 'Evercise Careers' , null , ['class' => Route::currentRouteName() == 'static.about' ? 'active' : ''])}}</li>
            </div>
            <div class="col-sm-4">
                <h3>Contact Us</h3>
                <li>+44 (0)20 3515 0157</li>
                {{ HTML::mailto('contact@evercise.com') }}
                <ul class="list-inline">
                    <li><a title="evercise facebook" target="_blank" href="https://www.facebook.com/evercise"><span class="icon-lg icon-lg-fb hover"></span></a></li>
                    <li><a title="evercise twitter" target="_blank" href="https://twitter.com/Evercise"><span class="icon-lg icon-lg-tweeter hover"></span></a></li>
                    <li><a title="evercise google plus" target="_blank" href="https://plus.google.com/101137623160353437102" rel="publisher"><span class="icon-lg icon-lg-google hover"></span></a></li>
                    <li><a title="evercise instagram" target="_blank" href="http://instagram.com/evercisefitness"><span class="icon-lg icon-lg-instagram hover"></span></a></li>
                </ul>
            </div>
        </div>

    </div>

</ul>

<!-- session alerts  -->
@if(Session::has('success'))
    <div class="mt10 alert alert-success alert-dismissible fixed" role="alert">
        {{ Session::get('success')  }}
        <button type="button" class="close" data-dismiss="alert">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
    </div>
@endif

<!-- session alerts  -->
@if(Session::has('error'))
    <div class="mt10 alert alert-danger alert-dismissible fixed" role="alert">
        {{ Session::get('error')  }}
        <button type="button" class="close" data-dismiss="alert">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
    </div>
@endif

<!-- session alerts  -->
@if(Session::has('notification'))
    <div class="mt10 alert alert-info alert-dismissible fixed" role="alert">
        {{ Session::get('notification')  }}
        <button type="button" class="close" data-dismiss="alert">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
    </div>
@endif