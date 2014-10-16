
<div class="row">
    <div class="col-md-4">
        <select id="select_category_type" class="form-control">
            <option>categories</option>
            <option selected="selected">subcategories</option>
        </select>
    </div>
</div>
<br>

{{ Form::open(array('id' => 'add_subcategory', 'url' => 'admin/add_subcategory', 'method' => 'post', 'class' => '')) }}
{{ Form::text('new_subcategory', null, ['id'=>'new_subcategory'] )}}
{{ Form::submit('Add new subcategory' , array('class'=>'btn-yellow ')) }}
{{ Form::close() }}
<br>
<div class="row" id="category_list">
    {{ Form::open(array('id' => 'edit_subcategories', 'url' => 'admin/edit_subcategories', 'method' => 'post', 'class' => '')) }}
    {{ Form::hidden('update_categories', null, ['id'=>'update_categories'] )}}
    {{ Form::hidden('update_associations', null, ['id'=>'update_associations'] )}}
    {{ Form::submit('Save Changes' , array('class'=>'btn-yellow ')) }}
    <br>
    <table class="table-yuk table-categories">
        <thead>
            <tr class="table-header">
                <th>Subcategory</th>
                <th>Category 1</th>
                <th>Category 2</th>
                <th>Category 3</th>
                <th>Associated Words</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subcategories as $key => $subcategory)
                <tr data-subid="{{$subcategory->id}}">
                    <td>{{$subcategory->name}}</td>

                    <td>{{ Form::select( ''.$subcategory->id.'_1' , $categories, count($subcategory->categories) > 0 ? ($subcategory->categories[0]->id) : 0) }}</td>
                    <td>{{ Form::select( ''.$subcategory->id.'_2' , $categories, count($subcategory->categories) > 1 ? ($subcategory->categories[1]->id) : 0) }}</td>
                    <td>{{ Form::select( ''.$subcategory->id.'_3' , $categories, count($subcategory->categories) > 2 ? ($subcategory->categories[2]->id) : 0) }}</td>

                    <td>
                        <label class="associations_label">{{$subcategory->associations ? $subcategory->associations : '...'}}</label>
                        <input data-id="{{$subcategory->id}}" style="display:none;" type="text" class="form-control associations" data-value="{{$subcategory->associations}}" value="" id="associations_{{$subcategory->id}}" name="associations_{{$subcategory->id}}">
                    </td>
                </tr>
            @endforeach
        <tbody>
    </table>
    {{ Form::submit('Save Changes' , array('class'=>'btn-yellow ')) }}
    {{ Form::close() }}
</div>