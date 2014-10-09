<div class="class-panel center-block">
    <div class="row">
        <div class="class-image-wrapper col-xs-4">
            <img src="img/example-class-img.jpg">
        </div>
        <div class="class-title-wrapper col-xs-8">
            <a href="#"><h3>Fitness class for ladies</h3></a>
            <button class="btn btn-primary">Add Review</button>
        </div>
    </div>
    <div id="rate-it" class="row panel-body bg-grey class-info-wrapper text-center {{ (isset($show) && $show == 'rate-it') ? '' : 'hidden' }}">
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
    <div id="user-rating" class="row panel-body bg-grey class-info-wrapper {{ (isset($show)  && $show == 'user-rating') ? '' : 'hidden' }} ">
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
    <div id="next-session" class="row panel-body bg-grey class-info-wrapper {{ (isset($show) && $show == 'next-session') ? '' : 'hidden' }}">
        <div class=" col-sm-7">
            <span><span class="icon icon-clock"></span> Next class, Sept 27th, 4pm</span>
         </div>
        <div class=" col-sm-5">
            <div class="row">
                <div class="col-xs-4">
                    <strong class="text-primary">&pound;16</strong>
                </div>
                <div class="col-xs-8">
                    <button class="btn btn-default btn-block">Join Class</button>
                </div>
            </div>
        </div>
    </div>
    <div id="upcoming-session" class="row panel-body bg-grey class-info-wrapper {{ (isset($show) && $show == 'upcoming-session') ? '' : 'hidden' }}">
        <div class=" col-sm-7">
            <span><span class="icon icon-clock"></span> Sept 27th, 4pm</span>
         </div>
        <div class=" col-sm-5">
            <div class="row">
                <div class="col-xs-4">
                    <strong class="text-primary">&pound;16</strong>
                </div>
                <div class="col-xs-8">
                    <button class="btn btn-default btn-block">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <div id="no-session" class="row panel-body bg-grey class-info-wrapper {{ (isset($show) && $show == 'no-session') ? '' : 'hidden' }}">
        <div class=" col-sm-7">
            <span>No other classes available</span>
         </div>
    </div>
</div>