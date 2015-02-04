@extends('admin.main')

@section('css')
@stop

@section('script')
    <script>

        $( document ).ready( function(){

            $('.delete_subcategory').on('click',function() {
                var id = $(this).data('subcategory_id');

                console.log(id);
                currentRequest = $.ajax({
                    type: "POST",
                    url: BASE_URL + "ajax/admin/subcategory/delete",
                    cache: false,
                    data: 'id=' + id,
                    beforeSend: function (html) {
                        if (currentRequest != null) currentRequest.abort();
                    },
                    success: function (data) {
                        $('.sub_'+data.id).css('background', '#FFCCCC').fadeOut('slow');
                    }
                });
            });
        });

    </script>


@stop

@section('body')
<div class="row">
    <div class="col-md-4">
        <select id="select_category_type" class="form-control">
            <option>categories</option>
            <option selected="selected">subcategories</option>
        </select>
    </div>
</div>
<br>

{{ Form::open(array('id' => 'add_subcategory', 'route' => 'admin.add_subcategory', 'method' => 'post', 'class' => '')) }}
{{ Form::text('new_subcategory', null, ['id'=>'new_subcategory'] )}}
<br>
{{ Form::submit('Add new subcategory' , array('class'=>'btn')) }}
<br>
{{ Form::close() }}
<br>
<div class="row" id="category_list">
    <br>
    {{ Form::open(array('id' => 'edit_subcategories', 'route' => 'admin.edit_subcategories', 'method' => 'post', 'class' => '')) }}
    {{ Form::hidden('update_categories', NULL, ['id'=>'update_categories'] )}}
    {{ Form::hidden('update_associations', NULL, ['id'=>'update_associations'] )}}
    {{ Form::submit('Save changes' , array('class'=>'btn')) }}
    <br>
    <br>
    <table class="table-yuk table-categories">
        <thead>
            <tr class="table-header">
                <th>Subcategory</th>
                <th></th>
                <th>#</th>
                <th>TYPE</th>
                <th>Categories</th>
                <th>Associated Words</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subcategories as $key => $subcategory)
                <tr data-subid="{{$subcategory->id}}" class="sub_{{ $subcategory->id}}">
                    <td>{{$subcategory->name}}</td>

                    <td>
                        <span class="el-icon-remove cp delete_subcategory bs_ttip"  style="color:#c00;padding:4px" title="" data-original-title="Remove Subcategory" data-subcategory_id="{{ $subcategory->id }}"></span>
                    </td>
                    <td>
                        <span style="padding:5px"> {{ DB::table('evercisegroup_subcategories')->where('subcategory_id', $subcategory->id)->count() }} </span>
                    </td>
                    <td>
                        <label class="radio-inline">
                            <input type="radio" name="type[{{ $subcategory->id }}]" value="" {{ ($subcategory->type == '' ? 'checked="checked"' : '') }}>
                            Non
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="type[{{ $subcategory->id }}]"  {{ ($subcategory->type == 'low' ? 'checked="checked"' : '') }} value="low">
                            Low
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="type[{{ $subcategory->id }}]"  {{ ($subcategory->type == 'med' ? 'checked="checked"' : '') }} value="med">
                            Med
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="type[{{ $subcategory->id }}]"  {{ ($subcategory->type == 'high' ? 'checked="checked"' : '') }} value="high">
                            High
                        </label>
                    </td>

                    <?php $cats = []; foreach($subcategory->categories as $cat){ $cats[] = $cat->id; } ?>
                    <td>
                        <label class="category_label" data-id="{{$subcategory->id}}">edit</label>
                        {{ Form::select( 'categories_'.$subcategory->id.'[]' , $category, $cats, ['class'=>'categories', 'multiple'=>'multiple', 'style'=>'width:300px;background-color:#ccc;display:none;', 'data-id'=>$subcategory->id]) }}
                    </td>

                    <td>
                        <label class="associations_label">{{$subcategory->associations ? str_replace(',', ', ', $subcategory->associations) : '...'}}</label>
                        <input data-id="{{$subcategory->id}}" style="display:none;" type="text" class="form-control associations" data-value="{{$subcategory->associations}}" value="" id="associations_{{$subcategory->id}}" name="associations_{{$subcategory->id}}">
                    </td>
                </tr>
            @endforeach
        <tbody>
    </table>
    <br>
    {{ Form::submit('Save changes' , ['class'=>'btn']) }}
    {{ Form::close() }}
    <br>
</div>

@stop