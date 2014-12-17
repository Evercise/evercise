<div class="side-bar class-preview  mb-scroll" id="{[{ preview.id }]}" ng-class="{ open : isPreviewOpen}">
    <div class="preview-return" ng-click="returnPreview()">
        <span class="icon icon-grey-left-arrow"></span>
    </div>
    <div class="hero hero-sm mb25" style="background-image: url( {{ url( '{[{ preview.image }]}' ) }} )">
        <nav class="navbar navbar-inverse nav-bar-bottom" role="navigation">
            <ul class="nav navbar-nav nav-justified nav-no-float">
                <li class="active"><a href="#about" data-toggle="tab">About</a></li>
                <li ng-show="(preview.sessions | filter:hasTickets ).length > 0"><a href="#schedule" data-toggle="tab">Schedule</a></li>
                <li ng-if="preview.reviews.length > 0"><a  href="#reviews" data-toggle="tab">Reviews</a></li>
            </ul>
        </nav>
    </div>
    <div class="col-sm-12 tab-content">
        <div role="tabpanel" class="tab-pane active" id="about">

            <div class="underline text-center">
                <h3>{[{ preview.name }]}</h3>
            </div>

            <div class="row text-center mb30">
                <div class="col-sm-5"><span class="icon icon-clock"></span>{[{ preview.nextClassDate }]}</div>
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
            <!--
            <div class="underline text-center">
                <h3>Schedule</h3>
            </div>
            -->

            <div class="row preview-row" ng-repeat="session in preview.sessions | filter:hasTickets | orderBy: date_time:reverse | limitTo:4">
                <div class="col-sm-6 mt5">
                    <span class="icon icon-clock"></span>
                    {[{ session.date_time }]}
                </div>
                <div ng-if="session.remaining > 0" class="col-sm-6">
                    {{ Form::open(['route'=> 'cart.add','method' => 'post', 'id' => 'add-to-class-{[{ session.id  }]}', 'class' => 'add-to-class']) }}
                        <div class="btn-group pull-right">
                            {{ Form::submit('join class', ['class'=> 'btn btn-primary add-btn']) }}
                            {{ Form::hidden('product-id', EverciseCart::toProductCode('session', '{[{ session.id  }]}')) }}

                            <select name="quantity" id="quantity" class="btn btn-primary btn-select">
                                 <option ng-repeat="n in [] | repeat:session.remaining" value="{[{ n + 1 }]}">{[{ n + 1}]}</option>
                            </select>

                        </div>
                    {{ Form::close() }}

                </div>
            </div>
            <div class="row mt20">
                <div class="col-sm-12 mb20 text-center">
                    <a href="{[{ preview.link }]}" class="btn btn-grey btn-transparent">See More</a>
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="reviews">

            <div ng-repeat="review in preview.reviews" >
                <div class="row">
                    <div class="col-sm-3">
                        {{ image('{[{ review.image }]}', '{[{ review.name }]})', ['class' => 'img-responsive img-circle']) }}
                    </div>
                    <div class="col-sm-9 mt15">
                        <div class="condensed">
                            <strong>{[{ review.name }]}</strong>
                        </div>
                        <i>{[{ review.date_left | date : 'MMM d, h:mma'  }]}</i>
                        <div class="mb25">
                            <div class="class-rating-wrapper">
                                <span class="icon icon-full-star" ng-repeat="n in [] | repeat:review.stars"></span>
                                <span class="icon icon-empty-star" ng-repeat="n in [] | repeat:5 - review.stars"></span>
                            </div>
                        </div>
                        <p>{[{ review.comment }]}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>