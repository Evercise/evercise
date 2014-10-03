<ul class="nav nav-pills footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <h3>Evercise Classes</h3>
                <li>{{HTML::linkRoute('evercisegroups.search', 'Discover Classes' , null , ['class' => Route::currentRouteName() == 'evercisegroups.serach' ? 'active' : ''])}}</li>
                <li>{{HTML::linkRoute('popular', 'Popular Classes' , null , ['class' => Route::currentRouteName() == 'popular' ? 'active' : ''])}}</li>
            </div>
            <div class="col-sm-4">
                <h3>About Evercise</h3>
                <li>{{HTML::linkRoute('static.about', 'What is Evercise' , null , ['class' => Route::currentRouteName() == 'static.about' ? 'active' : ''])}}</li>
                <li>{{HTML::linkRoute('static.class_guidelines', 'Evercise Class Guidelines' , null , ['class' => Route::currentRouteName() == 'static.class_guidelines' ? 'active' : ''])}}</li>
                <li>{{HTML::linkRoute('static.faq', 'Need Help' , null , ['class' => Route::currentRouteName() == 'static.faq' ? 'active' : ''])}}</li>
                <li>{{HTML::linkRoute('static.the_team', 'Meet the Evercise Team' , null , ['class' => Route::currentRouteName() == 'static.the_team' ? 'active' : ''])}}</li>
                <li>{{HTML::linkRoute('static.about', 'Evercise Careers' , null , ['class' => Route::currentRouteName() == 'static.about' ? 'active' : ''])}}</li>
            </div>
            <div class="col-sm-4">
                <h3>Contact Us</h3>
                <li><a href="#">+44 (0)203 322 216</a></li>
                {{ HTML::mailto('hello@evercise.com') }}
                <ul class="list-inline">
                    <li><a href="https://www.facebook.com/evercise"><span class="icon-lg icon-lg-fb hover"></span></a></li>
                    <li><a href="https://twitter.com/Evercise"><span class="icon-lg icon-lg-tweeter hover"></span></a></li>
                    <li><a href="https://plus.google.com/+Evercisefitness"><span class="icon-lg icon-lg-google hover"></span></a></li>
                </ul>
            </div>
        </div>

    </div>

</ul>