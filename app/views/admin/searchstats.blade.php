


@extends('admin.main')

@section('css')

@stop

@section('script')
            <script src="/admin/assets/lib/DataTables/media/js/jquery.dataTables.min.js"></script>
            <script src="/admin/assets/lib/DataTables/extensions/FixedHeader/js/dataTables.fixedHeader.min.js"></script>
            <script src="/admin/assets/lib/DataTables/media/js/dataTables.bootstrap.js"></script>

            <script src="/admin/assets/lib/d3/d3.min.js"></script>
            <script src="/admin/assets/lib/c3/c3.min.js"></script>



<script>
   $(document).ready(function() {
       $('#search_table').dataTable( {
           "processing": true,
           "serverSide": true,
           "ajax": "{{URL::route('admin.ajax.searchstats')}}"
       } );



       // combined chart
       var top_searches = c3.generate({
           bindto: '#top_searches',
           data: {
               columns: [

                   @foreach($top_searches as $s)
                       @if(!empty($s->search))
                        ['{{ $s->search }} | {{ round($s->avg, 0) }}', {{ $s->total  }}, {{ round($s->avg, 0) }}],
                       @endif
                   @endforeach
               ],
               type: 'bar',
           },
           bar: {
               width: {
                   ratio: 2 // this makes bar width 50% of length between ticks
               }
               // or
               //width: 100 // this makes bar width 100px
           },
           grid: {
               x: {
                   show: true
               },
               y: {
                   show: true
               }
           },
           color: {
               pattern: ['#ff7f0e', '#2ca02c', '#9467bd', '#1f77b4', '#d62728']
           }
       });

       var top_cities =  c3.generate({
           bindto: '#top_cities',
           data: {
               columns: [

                   @foreach($top_cities as $s)
                       @if(!empty($s->name))
                       ['{{ $s->name }}', {{ $s->total  }}],
                       @endif
                    @endforeach
           ],
           type : 'donut',
               onclick: function (d, i) { console.log("onclick", d, i); },
               onmouseover: function (d, i) { console.log("onmouseover", d, i); },
               onmouseout: function (d, i) { console.log("onmouseout", d, i); }
           },
           donut: {
               title: "Top Location"
           }
       });


   } );
</script>

@stop

@section('body')



    <div class="row">

{{ Form::open(['route' => 'admin.ajax.searchstats.download', 'method' => 'post']) }}
 {{ Form::submit('download', ['class' => 'btn btn-success btn-sm']) }}
 {{Form::close()}}

        <a href="{{ url('/ajax/admin/importStatsToDB') }}" class="btn btn-warning  btn-sm">Refresh Graphs</a>


        <div class="col-md-12">
            <div class="col-sm-7">
                <h3 class="heading_a"><span class="heading_text">Top Searches</span></h3>

                <div id="top_searches"></div>
            </div>
            <div class="col-sm-5">
                <h3 class="heading_a"><span class="heading_text">Top Location <small>(Global keyword London holds {{ round($percentage_london,0)-5 }}% of searches)</small></span></h3>
                <div id="top_cities"></div>
            </div>

        </div>




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