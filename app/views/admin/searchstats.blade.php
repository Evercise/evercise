


@extends('admin.main')

@section('css')

@stop

@section('script')
            <script src="/admin/assets/lib/DataTables/media/js/jquery.dataTables.min.js"></script>
            <script src="/admin/assets/lib/DataTables/extensions/FixedHeader/js/dataTables.fixedHeader.min.js"></script>
            <script src="/admin/assets/lib/DataTables/media/js/dataTables.bootstrap.js"></script>

<script>
   $(document).ready(function() {
       $('#search_table').dataTable( {
           "processing": true,
           "serverSide": true,
           "ajax": "{{URL::route('admin.ajax.searchstats')}}"
       } );
   } );
</script>

@stop

@section('body')



    <div class="row">

{{ Form::open(['route' => 'admin.ajax.searchstats.download', 'method' => 'post']) }}
 {{ Form::submit('download', ['class' => 'btn btn-success btn-sm']) }}
 {{Form::close()}}
        <div class="col-md-12">
            <table id="search_table" class="table table-yuk2 " cellspacing="0" width="100%">

                <thead>
                    <tr>
                        <th>Query</th>
                        <th>Size</th>
                        <th>Results</th>
                        <th>Radius</th>
                        <th>User</th>
                        <th>Location</th>
                        <th>Date</th>
                    </tr>
                </thead>

                <tfoot>
                    <tr>
                        <th>Query</th>
                        <th>Size</th>
                        <th>Results</th>
                        <th>Radius</th>
                        <th>User</th>
                        <th>Location</th>
                        <th>Date</th>
                    </tr>
                </tfoot>
            </table>
        </div>
</div>



@stop