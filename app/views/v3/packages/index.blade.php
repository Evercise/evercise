@extends('v3.layouts.master')



@section('body')

<ul>

@foreach($packages as $p)
<li style="width: 30%; border: 1px solid #cc6633; margin:5px; float:left">
 <strong>{{ $p->name }}</strong>
 <hr/> <br/>
{{ $p->classes }} Class Package
 <hr/> <br/>
 <p>{{ $p->description }}</p><br/>
 <hr/>
 @if(!empty($p->bullets))
    <ul>
    @foreach(explode('|', $p->bullets) as $b)
        <li>{{ $b }}</li>
    @endforeach
    </ul> <hr/> <br/>
 @endif
Price £{{$p->price}}
 <hr/> <br/>
Savings {{$p->savings}}%
 <hr/> <br/>
Max Single Class Price £{{round($p->max_class_price, 2)}}
 <hr/> <br/>

    {{ Form::open(['route'=> 'cart.add','method' => 'post', 'id' => 'add-to-class'. $p->id, 'class' => 'add-to-class']) }}

        <div class="btn-group pull-right">
            {{ Form::submit('Add Package', ['class'=> 'btn btn-primary']) }}
            {{ Form::hidden('product-id', EverciseCart::toProductCode('package', $p->id)) }}
            {{ Form::hidden('quantity', 1) }}
        </div>
    {{ Form::close() }}

 </li>


@endforeach
</ul>
<br style="clear:both"/>

@stop