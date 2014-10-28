<div class="class-hub-panel center-block">
    <div class="row">
        <div class="class-image-wrapper col-xs-6">
            <img src="/img/example-class-img.jpg">
        </div>
        <div class="class-title-wrapper col-xs-6">
            <a href="#"><h3>{{ $evercisegroup->name }}</h3></a>
            <div class="class-rating-wrapper">
                <span class="icon icon-full-star"></span>
                <span class="icon icon-full-star"></span>
                <span class="icon icon-full-star"></span>
                <span class="icon icon-full-star"></span>
                <span class="icon icon-full-star"></span>
            </div>
            <button class="btn btn-default mr15">Clone Class</button>
            {{ isset($type) && $type == 'edit' ? '<button class="btn btn-grey btn-transparent">Done Editing</button>' : '<button class="btn btn-default">Edit Class</button>' }}

        </div>
    </div>
</div>