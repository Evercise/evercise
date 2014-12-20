@extends('admin.main')



@section('side_menu')

<nav class="menu slide-menu-right smr-open">
<button class="close-menu">Close &rarr;</button>

    <ul>
    @foreach($images as $i)
        <li><span class="set_image" data-image_id="{{$i->id}}">
        <img src="{{ URL::to('/files/gallery_defaults/thumb_'.$i->image) }}" alt=""/>
        </span>
        </li>
    @endforeach
    </ul>
</nav><!-- /slide menu right -->
@stop
@section('css')
<link href="/admin/assets/lib/footable/css/footable.core.min.css" rel="stylesheet" media="screen">
<link href="/admin/assets/lib/jBox-0.3.0/Source/jBox.css" rel="stylesheet" media="screen">
<link href="/admin/assets/lib/jBox-0.3.0/Source/themes/NoticeBorder.css" rel="stylesheet" media="screen">

<style>
/* general style for all menus */

.delete_it:hover{ color:#c00}
nav.menu {
  position: fixed;
  z-index: 10000;
  background-color: #67b5d1;
  overflow: hidden;
  -webkit-transition: all 0.3s;
  -moz-transition: all 0.3s;
  -ms-transition: all 0.3s;
  -o-transition: all 0.3s;
  transition: all 0.3s; }
  nav.menu ul {
    list-style-type: none;
    overflow: auto;
    margin: 0;
    padding: 0; }
  nav.menu a {
    font-weight: 300;
    color: #fff; }

button.close-menu {
  background-color: #3184a1;
  color: #fff; }
  button.close-menu:focus {
    outline: none; }

/* slide menu left and right, push menu left and right */
nav.slide-menu-left,
nav.slide-menu-right,
nav.push-menu-left,
nav.push-menu-right {
  top: 0;
  width: 200px;
  height: 100%; }
  nav.slide-menu-left li,
  nav.slide-menu-right li,
  nav.push-menu-left li,
  nav.push-menu-right li {
    text-align: center;
    border-bottom: solid 1px #3184a1;
    border-top: solid 1px #b5dbe9; }
    nav.slide-menu-left li:first-child,
    nav.slide-menu-right li:first-child,
    nav.push-menu-left li:first-child,
    nav.push-menu-right li:first-child {
      border-top: none; }
    nav.slide-menu-left li:last-child,
    nav.slide-menu-right li:last-child,
    nav.push-menu-left li:last-child,
    nav.push-menu-right li:last-child {
      border-bottom: none; }
  nav.slide-menu-left a,
  nav.slide-menu-right a,
  nav.push-menu-left a,
  nav.push-menu-right a {
    display: block;
    padding: 10px;
    font-size: 18px;
     float:left;
     width:120px}
  nav.slide-menu-left button.close-menu,
  nav.slide-menu-right button.close-menu,
  nav.push-menu-left button.close-menu,
  nav.push-menu-right button.close-menu {
    margin: 10px 0;
    padding: 10px 30px;
    background-color: #3184a1;
    color: #fff; }

nav.slide-menu-left,
nav.push-menu-left {
  left: -300px; }

nav.slide-menu-right,
nav.push-menu-right {
  right: -300px; }

body.sml-open nav.slide-menu-left,
body.pml-open nav.push-menu-left {
  left: 0; }

body.smr-open nav.slide-menu-right,
body.pmr-open nav.push-menu-right {
  right: 0;
  overflow:scroll}

</style>
@stop

@section('script')
  <!-- footable -->
<script src="/admin/assets/lib/footable/footable.min.js"></script>
<script src="/admin/assets/lib/footable/footable.paginate.min.js"></script>
<script src="/admin/assets/lib/footable/footable.filter.min.js"></script>
<script src="/admin/assets/lib/footable/footable.sort.min.js"></script>
<script src="/admin/assets/js/light.js"></script>


<script>
var currentRequest;
var activeImageClass;

   $(document).ready(function(){
        yukon_footable.p_plugins_tables_footable();


        $('.feature_it').click(function(e){

            var id = $(this).data('id');

                var row = $(this);

                currentRequest = $.ajax({
                        type: "POST",
                        url: AJAX_URL + "featureClass",
                        cache: false,
                        dataType: 'json',
                        data: 'id='+id,
                        beforeSend: function (json) {
                            if (currentRequest != null) currentRequest.abort();
                        },
                        success:function(res){

                            console.log(res);
                            if(res.featured) {
                                row.css('color', '#d58512');
                            } else {

                                row.css('color', '#222');
                            }
                        }
                })

        });

        $('.categories_modal').click(function(e){

            var id = $(this).data('id');
            var url = $(this).data('url');
            $('#ajaxModal').html('<div class="modal-dialog"><div class="modal-content" style="text-align: center"><div class="modal-header">'+
                                    '<h4 class="modal-title">Edit Categories</h4></div><div class="modal-body">'+
                                    '<img src="/assets/img/spinning-circles.svg" style="width:130px; text-align:center;margin:5px auto"/>'+
                                    '</div></div></div>');

                currentRequest = $.ajax({
                        type: "GET",
                        url: url,
                        cache: false,
                        dataType: 'json',
                        data: 'id='+id,
                        beforeSend: function (json) {
                            if (currentRequest != null) currentRequest.abort();
                        },
                        success:function(res){
                            $('#ajaxModal').html(res.view);
                        }
                })

        });

        $('body').append('<div class="modal" id="ajaxModal"><div class="modal-body"></div></div>');

        $('.delete_it').click(function(e){

            var id = $(this).data('id');

                var row = $(this);

                currentRequest = $.ajax({
                        type: "DELETE",
                        url: AJAX_URL + "evercisegroups/delete",
                        cache: false,
                        dataType: 'json',
                        data: 'id='+id,
                        beforeSend: function (json) {
                            if (currentRequest != null) currentRequest.abort();
                        },
                        success:function(res){

                            if(res.deleted) {

                                 $('.class_'+id).css('background', '#ff1b7e').fadeOut('slow');

                                 new jBox('Notice', {
                                     offset: {
                                         y: 100,
                                         x: 100
                                     },
                                     stack: false,
                                     autoClose: 3000,
                                     animation: {
                                         open: 'slide:top',
                                         close: 'slide:right'
                                     },
                                     onInit: function () {
                                         this.options.content = 'Class Deleted.';
                                     }
                                });

                            } else {

                                 new jBox('Notice', {
                                     offset: {
                                         y: 100,
                                         x: 100
                                     },
                                     stack: false,
                                     autoClose: 3000,
                                     animation: {
                                         open: 'slide:top',
                                         close: 'slide:right'
                                     },
                                     onInit: function () {
                                         this.options.content = res.message;
                                     }
                                });

                            }
                            if(res.featured) {
                                row.css('color', '#d58512');
                            } else {

                                row.css('color', '#222');
                            }
                        }
                })

        });


        $('.get_image').click(function(e) {

            activeImageClass = $(this).data('class_id');
            $('body').addClass('smr-open');

        });

        $('.close-menu').click(function(e) {

            $('body').removeClass('smr-open');

        });

        $('.set_image').click(function(e) {

            image_id = $(this).data('image_id');

            currentRequest = $.ajax({
                    type: "POST",
                    url: AJAX_URL + "set_class_image",
                    cache: false,
                    dataType: 'json',
                    data: 'class_id='+activeImageClass+'&image_id='+image_id,
                    beforeSend: function (json) {
                        if (currentRequest != null) currentRequest.abort();
                    },
                    success:function(res){
                     console.log('done');
                         $('body').removeClass('smr-open');

                         new jBox('Notice', {
                             offset: {
                                 y: 100,
                                 x: 100
                             },
                             stack: false,
                             autoClose: 3000,
                             animation: {
                                 open: 'slide:top',
                                 close: 'slide:right'
                             },
                             onInit: function () {
                                 this.options.content = 'Image Set';
                             }
                        });
                    }
            })

        });




        $('.image_upload').click(function(e) {
            var id = $(this).data('id');

            $('.upload_'+id).trigger('click');

        });
        $('.upload_input').change(function(e) {
            var id = $(this).data('id');

            $('.form_'+id).submit();

        });
        $('.check_box').change(function(e) {
            var id = $(this).data('id');

            var data = 'id='+id+'&checked='+this.checked;
             currentRequest = $.ajax({
                type: "POST",
                url: AJAX_URL + "sliderStatus",
                cache: false,
                dataType: 'json',
                data: data,
                beforeSend: function (json) {
                    if (currentRequest != null) currentRequest.abort();
                },
                success:function(res){
                    console.log(res);
                }
             })


        });


    });

</script>

@stop

@section('body')
<div class="row">
        <div class="col-md-3">
            <input id="textFilter" type="text" class="form-control input-sm">
            <span class="help-block">Filter</span>
        </div>

        <div class="col-md-3">
            <a class="btn btn-default btn-sm" id="clearFilters">Clear</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table toggle-arrow-tiny" id="footable_demo" data-filter="#textFilter" data-page-size="50">
                <thead>
                    <tr>
                        <th data-toggle="true">ID</th>
                        <th>Name</th>
                        <th>Trainer</th>
                        <th>IMAGE</th>
                        <th class="warning">Capacity</th>
                        <th>Default price</th>
                        <th>Future Sessions</th>
                        <th>Status</th>
                        <th>Frontpage Image</th>
                        <th>Frontpage Image</th>
                        <th data-sort-initial="descending" >Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($classes as $a)
                    <?php
                    $slider = $a->slider()->first();
                    $slider_image = (!empty($slider->image) ? '/files/slider/medium_'.$slider->image : false);
                    ?>


                    <tr class="class_{{$a->id}}">
                        <td>{{ $a->id }}</td>
                        <td><a href="/classes/{{$a->slug}}" target="_blank">{{ $a->name }}</a></td>
                        <td><a href="{{ URL::route('trainer.show', ['id' => $a->user->display_name])}}" target="_blank">{{ $a->user->display_name }}</a></td>
                        <td><span class="get_image el-icon-picture cp" data-class_id="{{ $a->id }}"></span> </td>
                        <td class="warning">{{ round($a->evercisesession()->avg('tickets'),0) }}</td>
                        <td>{{ $a->default_price }}</td>
                        <td>{{ $a->futuresessions()->count() }}</td>
                        <td>
                        @if($a->published == 1)
                        <span class="label label-warning status-active" title="Active">Published</span></td>
                        @endif
                        @if($a->published == 0)
                        <span class="label label-default status-disabled" title="Unpublished">Unpublished</span></td>
                        @endif


                        <td>
                        {{$slider->image or ''}}
                        @if($slider_image)
                            <span class="el-icon-zoom-in cp" href="{{ $slider_image }}" data-featherlight="image" data-image="{{$slider->image}}"></span>
                        @endif
                        </td>

                        <td>
                            <input type="checkbox" class="check_box {{ (!$slider_image ? 'hide':'') }}" {{ ( !empty($slider->active) && $slider->active == 1 ? 'checked="checked"':'') }} data-id="{{ $a->id }}"/>
                            <span class="icon_upload cp image_upload " style="margin-left: {{ (!$slider_image ? '36':'20') }}px" data-id="{{ $a->id }}"></span>
                            <form class="form_{{$a->id}}" action="{{ URL::route('admin.ajax.slider_upload') }}" method="post" enctype="multipart/form-data">
                                 <input type="file" name="file" class="hide upload_{{$a->id}} upload_input" data-id="{{ $a->id }}"/>
                                 <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                 <input type="hidden" name="id" value="{{$a->id}}"/>
                             </form>

                        </td>

                        <?php
                        $featured_count = count($a->featuredClasses);
                        ?>
                        <td data-value="{{ $featured_count }}">

                            <span class="el-icon-star bs_ttip cp feature_it" data-id="{{ $a->id }}" style="{{ ($featured_count == 1 ? 'color:#d58512':'')}}"></span>
                            <span class="el-icon-remove bs_ttip cp delete_it" data-id="{{ $a->id }}"></span>
                            <span class="el-icon-remove bs_ttip cp categories_modal" data-toggle="modal" data-target="#ajaxModal" data-id="{{ $a->id }}" data-url="{{ URL::route('ajax.admin.modal.categories', [$a->id]) }}"></span>


                        </td>

                   </tr>


                    @endforeach

                </tbody>
                <tfoot class="hide-if-no-paging">
                    <tr>
                        <td colspan="5">
                            <ul class="pagination pagination-sm"></ul>
                        </td>
                    </tr>
                </tfoot>
            </table>
</div>
</div>


<div class="modal fade" id="ajaxModal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title">Empty Modal</h4>
                                </div>
                                <div class="modal-body">
                                    <p>Loading</p>
                                </div>
                            </div>
                        </div>
                    </div>




@stop