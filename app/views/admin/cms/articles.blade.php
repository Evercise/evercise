@extends('admin.main')

@section('css')
<link href="/admin/assets/lib/footable/css/footable.core.min.css" rel="stylesheet" media="screen">
<link href="/admin/assets/lib/jBox-0.3.0/Source/jBox.css" rel="stylesheet" media="screen">
<link href="/admin/assets/lib/jBox-0.3.0/Source/themes/NoticeBorder.css" rel="stylesheet" media="screen">
@stop

@section('script')
  <!-- footable -->
<script src="/admin/assets/lib/footable/footable.min.js"></script>
<script src="/admin/assets/lib/footable/footable.paginate.min.js"></script>
<script src="/admin/assets/lib/footable/footable.filter.min.js"></script>
<script src="/admin/assets/lib/jBox-0.3.0/Source/jBox.min.js"></script>


<script>
    $(function() {
        yukon_footable.p_plugins_tables_footable();
        yukon_jBox.p_components_notifications_popups();
    })
</script>

@stop

@section('body')
<div class="row">
        <div class="col-md-3">
            <input id="textFilter" type="text" class="form-control input-sm">
            <span class="help-block">Filter</span>
        </div>
        <div class="col-md-3">
            <select class="form-control input-sm" id="userStatus">
                <option></option>
                <option value="active">Active</option>
                <option value="disabled">Disabled</option>
                <option value="suspended">Suspended</option>
            </select>
            <span class="help-block">Status</span>
        </div>
        <div class="col-md-3">
            <a class="btn btn-default btn-sm" id="clearFilters">Clear</a>
        </div>
        <div class="col-md-3">
            <a class="btn btn-success btn-sm" href="{{ URL::route('admin.article.manage', ['id'=> 0]) }}">Create New Article</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-yuk2 toggle-arrow-tiny" id="footable_demo" data-filter="#textFilter" data-page-size="20">
                <thead>
                    <tr>
                        <th data-toggle="true">ID</th>
                        <th>TITLE</th>
                        <th>Category</th>
                        <th data-hide="phone,tablet">Preview</th>
                        <th data-hide="phone,tablet" data-name="Date Of Birth"> Published date</th>
                        <th data-hide="phone"> Status</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($articles as $a)

                    <tr>
                        <td>{{ $a->id }}</td>
                        <td>{{ $a->title }}</td>
                        <td>{{ $a->category->title or '' }}</td>
                        <td><a href="{{ URL::to(Articles::createUrl($a)) }}?preview=true">Preview</a></td>
                        <td>{{ $a->published_on->format('d/m/Y') }}</td>
                        <td data-value="{{ $a->status }}">
                        @if($a->status == 0)
                        <span class="label label-warning status-active" title="Active">Draft</span></td>
                        @endif
                        @if($a->status == 1)
                        <span class="label label-success status-active" title="Active">Published</span></td>
                        @endif
                        @if($a->status == 2)
                        <span class="label label-default status-disabled" title="Unpublished">Unpublished</span></td>
                        @endif
                        </td>

                        <td>

                        <a  title="Edit" href="{{ Url::route('admin.article.manage', ['id' => $a->id]) }}"><span class="el-icon-edit bs_ttip" title="" data-original-title=".el-icon-edit"></span></a>
                        <a  title="Delete" href="{{ Url::route('admin.article.delete',['id' => $a->id]) }}" data-confirm="Are you sure you want to delete this Article? It cant be UNDONE!!!" ><span class="el-icon-remove bs_ttip" style="color:#c00" title="" data-original-title="Remove Article"></span></a>

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



@stop