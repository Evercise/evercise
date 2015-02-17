
<div class="row">
    <div class="col-md-4">
        <select id="select_status" class="form-control">
            <option value="all">all</option>
            <option value="expired" {{ $status == 'expired'?'selected':'' }}>expired</option>
            <option value="active" {{ $status == 'active'?'selected':'' }}>active</option>
        </select>
    </div>
    <div class="col-md-4">
        <div class="input-group" id="search">
            <input type="text" class="form-control" placeholder="Search" value="{{ $search }}">
            <span class="input-group-btn">
                <button class="btn btn-primary" type="button"><span class="icon_search"></span></button>
            </span>
        </div>
    </div>
</div>

{{ Form::open(array('id' => 'edit_subcategories', 'url' => 'admin/edit_group_subcats', 'method' => 'post', 'class' => '')) }}
{{ Form::hidden('update_categories', null, ['id'=>'update_categories'] )}}

<br>
{{ Form::submit('Save Changes' , array('class'=>'btn')) }}
<br>
<br>

<div class="row" id="category_list">
    <div class="col10 push1">



        <table class="table-yuk table-categories">
            <thead>
                <tr class="table-header">
                    <th id="sort_by_id">id</th>
                    <th id="sort_by_name">name</th>
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
<br>
{{ Form::submit('Save Changes' , array('class'=>'btn ')) }}

{{ Form::close() }}
<script>
    var category_list = '<?php echo ($categories); ?>';
</script>