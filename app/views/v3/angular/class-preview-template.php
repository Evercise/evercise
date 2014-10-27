<div class="side-bar class-preview  mb-scroll" id="{{ preview.id }}" ng-class="{ open : isPreviewOpen}">
    <div class="preview-return" ng-click="returnPreview()">
        <span class="icon icon-grey-left-arrow"></span>
    </div>
    <div class="hero hero-sm mb25" style="background-image: {{ preview.image }}  ">
        <nav class="navbar navbar-inverse nav-bar-bottom" role="navigation">
            <ul class="nav navbar-nav nav-justified nav-no-float">
                <li class="active"><a href="#about">About</a></li>
                <li><a href="#schedule">Schedule</a></li>
                <li><a href="#facilities">Reviews</a></li>
            </ul>
        </nav>
    </div>
    <div class="col-sm-12">
        <div class="underline text-center">
            <h3>About the class</h3>
        </div>
        <div class="row text-center mb30">
            <div class="col-sm-5"><span class="icon icon-clock"></span>{{ preview.nextClassDate | date : 'MMM d, h:mma'  }}</div>
            <div class="col-sm-4"><span class="icon icon-watch"></span> {{ preview.nextClassDuration}} mins</div>
            <div class="col-sm-3"><span class="icon icon-ticket"></span> x {{ preview.capacity }}</div>
        </div>
        <div class="row mb40">
            <div class="col-sm-12 text-center">
                <p>{{ preview.description }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 mb20 text-center">
                <a href="{{ preview.link }}" class="btn btn-grey btn-transparent">Read More</a>
            </div>
        </div>
    </div>
</div>