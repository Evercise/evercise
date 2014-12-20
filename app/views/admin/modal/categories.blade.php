
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edit Categories for {{ $evercisegroup->name }}</h4>
        </div>
        <div class="modal-body">
            <style>
            ul.subs{list-style-type: none}
            ul.subs li{width:30%; float:left}
            .label_box:hover{background:#4bb1b1}
            </style>
            <ul class="subs">
                @foreach($all_subs as $c)
                    <li>
                        <label for="sc_{{$c->id}}" class="label_box">
                            <input type="checkbox" id="sc_{{$c->id}}" class="sub_cats_checkbox" value="{{$c->id}}" {{ !empty($subcategories[$c->id]) ? 'checked="checked"': '' }}/>
                            {{ $c->name }}</label></li>
                @endforeach
            </ul>
            <br style="clear:both"/>

        </div>
        <div class="modal-footer">
            <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
            <a href="#" class="btn btn-primary save_categories" data-dismiss="modal">Save</a>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->