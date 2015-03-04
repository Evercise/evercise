@extends('admin.main')



@section('side_menu')

<nav class="menu slide-menu-right smr-open">
<button class="close-menu">Close &rarr;</button>

</nav><!-- /slide menu right -->
@stop
@section('css')
<link href="/admin/assets/lib/footable/css/footable.core.min.css" rel="stylesheet" media="screen">
<link href="/admin/assets/lib/jBox-0.3.0/Source/jBox.css" rel="stylesheet" media="screen">
<link href="/admin/assets/lib/jBox-0.3.0/Source/themes/NoticeBorder.css" rel="stylesheet" media="screen">

<style>
/* general style for all menus */

.delete_it:hover{ color:#c00}
.categories_modal:hover, .get_image:hover{ color:#00dd00}
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


    function deleteIt(id){

            currentRequest = $.ajax({
                   type: "POST",
                   url: AJAX_URL + "pending_evercisegroups/delete",
                   cache: false,
                   dataType: 'json',
                   data: 'id='+id,
                   beforeSend: function (json) {
                       if (currentRequest != null) currentRequest.abort();
                   },
                   success:function(res){

                       if(res.deleted) {

                            $('.class_'+id).css('background', '#ff1b7e').fadeOut('slow');
                            notify('Class update Deleted.');

                       } else {
                            notify(res.message);
                       }
                   }
           });
        }
   $(document).ready(function(){
        yukon_footable.p_plugins_tables_footable();
        yukon_jBox.p_components_notifications_popups();

    });




</script>

@stop

@section('body')
    <div class="row">
        <div class="col-md-12">
            <p><strong>New classes</strong></p>
            <table class="table toggle-arrow-tiny" id="footable_demo" data-filter="#textFilter" data-page-size="50">
                <thead>
                    <tr>
                        <th data-toggle="true">ID</th>
                        <th>Name</th>
                        <th>Trainer</th>
                        <th>Status</th>
                        <th data-sort-initial="descending"  width="140">Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($newClasses as $a)
                    @if(! $a->evercisegroup_id && $a->status == 0)
                    <tr class="class_{{$a->id}}">
                        <td>{{ $a->id }}</td>
                        <td>{{ $a->name }}</td>
                        <td><a href="{{ URL::route('trainer.show', ['id' => $a->user->display_name])}}" target="_blank">{{ $a->user->display_name }}</a></td>

                        <td>
                            @if($a->status == 1)
                            <span class="label label-warning status-active" title="Active">Verified</span>
                            @elseif($a->status == 0)
                            <span class="label label-default status-disabled" title="Unpublished">Unverified</span>
                            @endif
                        </td>

                        <td width="140">

                            <a  title="Edit" href="{{URL::route('admin.pendinggroups.new.manage', [$a->id]) }}"><span class="el-icon-edit bs_ttip" title="" data-original-title=".el-icon-edit"></span></a>
                            <span data-confirm="Are you sure you want to delete this class?" onclick="deleteIt({{ $a->id }})" class="el-icon-remove bs_ttip cp delete_it" style="margin-left:5px" data-id="{{ $a->id }}"></span>

                        </td>

                   </tr>

                    @endif
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
            <p><strong>Edited classes</strong></p>
            <table class="table toggle-arrow-tiny" id="footable_demo" data-filter="#textFilter" data-page-size="50">
                <thead>
                    <tr>
                        <th data-toggle="true">ID</th>
                        <th>Name</th>
                        <th>Trainer</th>
                        <th>Status</th>
                        <th data-sort-initial="descending"  width="140">Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($editedClassed as $a)
                    @if($a->evercisegroup_id && $a->status == 0)
                    <tr class="class_{{$a->id}}">
                        <td>{{ $a->id }}</td>
                        <td>{{ $a->name }}</td>
                        <td><a href="{{ URL::route('trainer.show', ['id' => $a->user->display_name])}}" target="_blank">{{ $a->user->display_name }}</a></td>

                        <td>
                            @if($a->status == 1)
                            <span class="label label-warning status-active" title="Active">Verified</span>
                            @elseif($a->status == 0)
                            <span class="label label-default status-disabled" title="Unpublished">Unverified</span>
                            @endif
                        </td>

                        <td width="140">

                            <a  title="Edit" href="{{URL::route('admin.pendinggroups.manage', [$a->id]) }}"><span class="el-icon-edit bs_ttip" title="" data-original-title=".el-icon-edit"></span></a>
                            <span data-confirm="Are you sure you want to delete this class?" onclick="deleteIt({{ $a->id }})" class="el-icon-remove bs_ttip cp delete_it" style="margin-left:5px" data-id="{{ $a->id }}"></span>

                        </td>

                   </tr>


                    @endif
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
            <p><strong>Recently approved classes</strong></p>
            <table class="table toggle-arrow-tiny" id="footable_demo" data-filter="#textFilter" data-page-size="50">
                <thead>
                <tr>
                    <th data-toggle="true">ID</th>
                    <th>Name</th>
                    <th>Trainer</th>
                    <th>Status</th>
                    <th data-sort-initial="descending"  width="140">Options</th>
                </tr>
                </thead>
                <tbody>
                @foreach($editedClassed as $a)
                    @if($a->status == 1)
                        <tr class="class_{{$a->id}}">
                            <td>{{ $a->id }}</td>
                            <td>{{ $a->name }}</td>
                            <td><a href="{{ URL::route('trainer.show', ['id' => $a->user->display_name])}}" target="_blank">{{ $a->user->display_name }}</a></td>

                            <td>
                                @if($a->status == 1)
                                    <span class="label label-warning status-active" title="Active">Verified</span>
                                @elseif($a->status == 0)
                                    <span class="label label-default status-disabled" title="Unpublished">Unverified</span>
                                @endif
                            </td>

                            <td width="140">

                                <a  title="Edit" href="{{URL::route('admin.pendinggroups.manage', [$a->id]) }}"><span class="el-icon-edit bs_ttip" title="" data-original-title=".el-icon-edit"></span></a>
                                <span data-confirm="Are you sure you want to delete this class?" onclick="deleteIt({{ $a->id }})" class="el-icon-remove bs_ttip cp delete_it" style="margin-left:5px" data-id="{{ $a->id }}"></span>

                            </td>

                        </tr>

                    @endif
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