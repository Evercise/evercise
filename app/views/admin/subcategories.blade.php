

<div class="row">
    <div class="col-md-4">
        <select id="select_category_type" class="form-control">
            <option>categories</option>
            <option selected="selected">subcategories</option>
        </select>
    </div>
</div>

<div class="row" id="category_list">
    {{ Form::open(array('id' => 'edit_subcategories', 'url' => 'admin/edit_subcategories', 'method' => 'post', 'class' => '')) }}
        {{form::hidden('update_categories', null, ['id'=>'update_categories'] )}}
        {{ Form::submit('Update' , array('class'=>'btn-yellow ')) }}
    {{ Form::close() }}
    <table class="table-condensed">
        @foreach($subcategories as $key => $subcategory)
            <tr data-subid="{{$subcategory->id}}">
                <td>{{$subcategory->name}}</td>

                <td>{{ Form::select( ''.$subcategory->id.'_1' , $categories, count($subcategory->categories) > 0 ? ($subcategory->categories[0]->id) : 0) }}</td>
                <td>{{ Form::select( ''.$subcategory->id.'_2' , $categories, count($subcategory->categories) > 1 ? ($subcategory->categories[1]->id) : 0) }}</td>
                <td>{{ Form::select( ''.$subcategory->id.'_3' , $categories, count($subcategory->categories) > 2 ? ($subcategory->categories[2]->id) : 0) }}</td>
            </tr>
        @endforeach
    </table>
</div>