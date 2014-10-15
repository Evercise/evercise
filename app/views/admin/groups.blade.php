
<div class="row">
    <div class="col-md-4">
        <select id="select_status" class="form-control">
            <option value="all">all</option>
            <option value="expired">expired</option>
            <option value="active">active</option>
        </select>
    </div>
</div>

{{ Form::open(array('id' => 'edit_subcategories', 'url' => 'admin/edit_group_subcats', 'method' => 'post', 'class' => '')) }}
{{ Form::hidden('update_categories', null, ['id'=>'update_categories'] )}}
{{ Form::submit('Save Changes' , array('class'=>'btn-yellow ')) }}

<div class="row" id="category_list">
    <div class="col10 push1">
        <div class="mb30" id="findByName">
            {{ Form::text('findByName', null, ['placeholder' => 'search']) }}
        </div>



        <table class="table-yuk table-categories">
            <thead>
                <tr class="table-header">
                    <th>id</th>
                    <th>name</th>
                    <th>featured</th>
                    <th>subcategories (max 3)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($selectedGroups as $evercisegroup)
                    <tr data-egid="{{$evercisegroup->id}}">
                        <td>{{ $evercisegroup->id  }}</td>
                        <td>{{ $evercisegroup->name }}</td>

                        <td class="col1 mt15">{{ Form::checkbox('featured_'.$evercisegroup->id, 1, $evercisegroup->isFeatured()? true: false, ['class' => 'featured', 'data-id' => $evercisegroup->id]) }}</td>



                        <td class="col10">

                            <?php
                            $subcatString = '';
                            foreach($evercisegroup->subcategories as $subcat)
                                $subcatString .= ($subcatString==''?'':',') .$subcat->name;
                            ?>
                            <label class="categories_label">{{ $subcatString != '' ? $subcatString : '...'  }}</label>
                            <input data-id="{{$evercisegroup->id}}" style="display:none;" type="text" class="form-control associations" data-value="{{ $subcatString }}" value="{{$subcatString}}" id="categories_{{$evercisegroup->id}}" name="categories_{{$evercisegroup->id}}" >

                        </td>
                    </tr>
                @endforeach
            <tbody>
        </table>
    </div>

</div>
{{ Form::close() }}
<script>
    var category_list = '<?php echo ($categories); ?>';
</script>