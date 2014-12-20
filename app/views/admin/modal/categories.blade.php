<style>
ul.subs{list-style-type: none}
ul.subs li{width:340%; float:left}

</style>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edit Categories for {{ $evercisegroup->name }}</h4>
        </div>
        <div class="modal-body">

            <ul class="subs">
                @foreach($all_subs as $c)
                    <li><input type="checkbox" value="cat[{{$c->id}}]" {{ !empty($subcategories[$c->id]) ? 'checked="checked"': '' }}/> {{ $c->name }}</li>
                @endforeach
            </ul>

        </div>
        <div class="modal-footer">
            <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
            <a href="#" class="btn btn-primary">Save</a>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->