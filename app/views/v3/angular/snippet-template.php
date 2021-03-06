<div ng-repeat="marker in markers"
     id = {{marker.id}}
     class="class-snippet"
     ng-click="clicked(marker)"
     infinite-scroll-container="'#snippets'">
    <div class="class-image-wrapper col-sm-4">
        <img src="{{ marker.image}} " alt="{{ marker.name}}"/>
    </div>
    <div class="class-title-wrapper panel-body col-sm-8">
        <div class="ml10">
            <h3>{{ marker.name | truncate:20  }}</h3>
        </div>
        <div class="class-rating-wrapper col-xs-9">
            <span class="icon icon-full-star" ng-repeat="n in [] | repeat:marker.stars"></span>
            <span class="icon icon-empty-star" ng-repeat="n in [] | repeat:5 - marker.stars"></span>
        </div>
        <div class="col-xs-3">

            <strong class="text-primary">&pound;{{ marker.price }}</strong>
        </div>
    </div>
</div>