<div class="side-bar class-preview  mb-scroll" id="{[{ preview.id }]}" ng-class="{ open : isPreviewOpen}">
    <div class="preview-return" ng-click="returnPreview()">
        <span class="icon icon-grey-left-arrow"></span>
    </div>
    <div class="hero hero-sm mb25" style="background-image: url( {{ url( '{[{ preview.image }]}' ) }} )">
        <nav class="navbar navbar-inverse nav-bar-bottom" role="navigation">
            <ul class="nav navbar-nav nav-justified nav-no-float">
                <li class="active"><a href="#about" data-toggle="tab">About</a></li>
                <li><a href="#schedule" data-toggle="tab">Schedule</a></li>
                <li><a href="#reviews" data-toggle="tab">Reviews</a></li>
            </ul>
        </nav>
    </div>
    <div class="col-sm-12 tab-content">
        <div role="tabpanel" class="tab-pane active" id="about">
            <div class="underline text-center">
                <h3>About the class</h3>
            </div>
            <div class="row text-center mb30">
                <div class="col-sm-5"><span class="icon icon-clock"></span>{[{ preview.nextClassDate | date : 'MMM d, h:mma'  }]}</div>
                <div class="col-sm-4"><span class="icon icon-watch"></span> {[{ preview.nextClassDuration}]} mins</div>
                <div class="col-sm-3"><span class="icon icon-ticket"></span> x {[{ preview.capacity }]}</div>
            </div>
            <div class="row mb40">
                <div class="col-sm-12 text-center">
                    <p>{[{ preview.description }]}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 mb20 text-center">
                    <a href="{[{ preview.link }]}" class="btn btn-grey btn-transparent">Read More</a>
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="schedule">
            <div ng-repeat="session in preview.sessions | orderBy: date_time:reverse">
                <div class="well" >
                    {[{ session.date_time }]}
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="reviews">
            <div ng-repeat="review in preview.reviews" >

                <div class="well" >
                    <div class="class-rating-wrapper">
                        <span class="icon icon-full-star" ng-repeat="n in [] | repeat:review.stars"></span>
                        <span class="icon icon-empty-star" ng-repeat="n in [] | repeat:5 - review.stars"></span>
                    </div>
                    <p>{[{ review.comment }]}</p>
                </div>

            </div>
        </div>
    </div>
</div>