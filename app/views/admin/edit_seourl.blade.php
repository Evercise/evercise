@extends('admin.main')

@section('script')

    <script src="/admin/assets/lib/select2/select2.min.js"></script>

    <script>
        function MultiAjaxAutoComplete(element, url) {
            $(element).select2({
                placeholder: "Search for a movie",
                minimumInputLength: 1,
                multiple: true,
                id: function(e) { return e.id+":"+e.title; },
                ajax: {
                    url: url,
                    dataType: 'json',
                    data: function(term, page) {

                        return {
                            q: term,
                            page_limit: 10,
                            apikey: "z4vbb4bjmgsb7dy33kvux3ea" //my own apikey
                        };
                    },
                    results: function(data, page) {
                        alert(data);
                        return {
                            results: data.movies
                        };
                    }
                },
                formatResult: formatResult,
                formatSelection: formatSelection,
                initSelection: function(element, callback) {
                    var data = [];
                    $(element.val().split(",")).each(function(i) {
                        var item = this.split(':');
                        data.push({
                            id: item[0],
                            title: item[1]
                        });
                    });
//$(element).val('');
                    callback(data);
                }
            });
        };

        function formatResult(movie) {
            return '<div>' + movie.title + '</div>';
        };

        function formatSelection(data) {
            return data.title;
        };



        MultiAjaxAutoComplete('#e6', {{route('admin.load')}}}});

    </script>

@stop


@section('body')


{{ Form::open(['id' => 'manage_seourl', 'route' => 'admin.update_seourl', 'method' => 'post', 'form-control', 'files'=> true]) }}
{{ Form::hidden('id', (!empty($seoUrl->id) ? $seoUrl->id : 0)) }}


<div class="col-md-12">
    <div class="col-lg-9">
        <div class="form-group">
            <label>Location:</label>
            <input type='text' id="e6" style="width: 500px;" value="34:Donnie Darko,54:Heat,27:No Country for Old Men"  />
        </div>
        <div class="form-group">
            <label>Location:</label>
            {{ Form::text('location', (!empty($seoUrl->location) ? $seoUrl->location : null), ['placeholder'=> 'location', 'class' => 'form-control', 'id'=>'title']) }}
        </div>
        <div class="form-group">
            <label>Search:</label>
            {{ Form::text('search', (!empty($seoUrl->search) ? $seoUrl->search : null), ['placeholder'=> 'search', 'class' => 'form-control', 'id'=>'title']) }}
        </div>
        <div class="form-group">
            <label>Title:</label>
            {{ Form::text('title', (!empty($seoUrl->title) ? $seoUrl->title : null), ['placeholder'=> 'title', 'class' => 'form-control', 'id'=>'title']) }}
        </div>
        <div class="form-group">
            <label>Description:</label>
            {{ Form::text('description', (!empty($seoUrl->description) ? $seoUrl->description : null), ['placeholder'=> 'description', 'class' => 'form-control', 'id'=>'title']) }}
        </div>

    </div>
</div>

<div class="col-md-12">
    {{ Form::submit('Save Changes' , array('class'=>'btn btn-sm btn-info')) }}
    {{ Form::close() }}
</div>

@stop