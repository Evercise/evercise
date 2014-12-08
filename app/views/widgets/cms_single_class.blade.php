
<div class="cms_widget" style="height:200px;border:1px solid #ccc; width:50%;float:left;text-align: center; margin:5px; background: url({{ URL::to($user->directory.'/module_'.$image) }} ) no-repeat; background-size:100% auto">

    <div style="background-color:rgba(255, 255, 255, 0.8); height: 100px;margin-top:100px">
        <p>{{ $name }}</p>
         <span class="pull-left">£{{ $default_price }}</span>
        <a href="{{ URL::route('class.show', ['id' => $slug]) }}" class="btn btn-primary add-btn pull-right">Join class</a>
    </div>
</div>