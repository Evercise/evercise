@extends('admin.main')

@section('script')

    <script src="/admin/assets/lib/select2/select2.min.js"></script>

    <script>
        function MultiAjaxAutoComplete(element, url) {
            $(element).select2({
                placeholder: "Start typing place name",
                minimumInputLength: 1,
                maximumSelectionSize: 1,
                multiple: false,
                ajax: {
                    url: url,
                    dataType: 'json',
                    type: 'post',
                    cache: true,
                    data: function(term) {
                        return {
                            q: term
                        };
                    },
                    results: function(data, page) {
                        console.log(data);
                        return {
                            results: data
                        };
                    }
                },
                formatResult: FormatResult,
                formatSelection: FormatSelection,
                escapeMarkup: function (m) { return m; },
                initSelection : function (element, callback) {
                    var data = {id: 1545, text: "whatever"};
                    callback(data);
                }
            }).select2('val', [1545]);
        };

        function FormatResult(item) {
            var markup = "";
            console.log(item);
            if (item.name !== undefined) {
                markup += "<option value='" + item.id + "'>" + item.name + "</option>";
            }
            return markup;
        }

        function FormatSelection(item) {
            return item.name;
        }


        $('#location').bind('click',function() {
            console.log('twat');
            MultiAjaxAutoComplete('#location', '{{ route('admin.ajax.search_places') }}' );
            $('#location').unbind('click');
        });

    </script>

@stop


@section('body')


{{ Form::open(['id' => 'manage_seourl', 'route' => 'admin.update_seourl', 'method' => 'post', 'form-control', 'files'=> true]) }}
{{ Form::hidden('id', (!empty($seoUrl->id) ? $seoUrl->id : 0)) }}


<div class="col-md-12">
    <div class="col-lg-9">
        <div class="form-group">
            <label>Location:</label>
            {{ Form::text('location', $seoUrl->locationName(), ['multiple'=>true, 'placeholder'=> 'Start typing location', 'class' => 'form-control', 'id'=>'location']) }}
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