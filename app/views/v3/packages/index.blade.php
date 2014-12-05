@extends('v3.layouts.master')



@section('body')
<div class="container first-container">
    <div class="row text-center">
        <div class="underline">
            <h1>Evercise class packages</h1>
        </div>
    </div>
    <div class="row">
        @foreach($packages as $index => $p)
            <div class="col-sm-4 text-center">
                <ul class="list-group package-block-module 'package-{{ $p->style }}">

                    <li class="list-group-item package-title">
                        <h3>{{ $p->name }}</h3>
                    </li>
                    <li class="list-group-item package-description">
                        <h4>{{ $p->classes }} Class Package</h4>
                        <p>{{ $p->description }}</p>
                    </li>
                    <li class="list-group-item package-list">
                        @if(!empty($p->bullets))
                            <div>
                                <ul>
                                    <li><span class="icon icon-point"></span>Any {{$p->classes }} classes up to £{{ round($p->max_class_price,2) }}</li>
                                    <li><span class="icon icon-point"></span>Save {{$p->savings()}}% on standard price</li>
                                    <li><span class="icon icon-point"></span>Up to {{ $p->availableClasses()}} classes to choose from</li>
                                    @foreach(explode('|', $p->bullets) as $b)
                                        <li><span class="icon icon-point"></span>{{ $b }}</li>
                                    @endforeach
                                </ul>
                            </div>
                         @endif
                    </li>
                    <li class="list-group-item package-pay">
                        <div class="row">
                            <div class="col-sm-5 text-left">
                                <strong>£{{round($p->price,2)}}</strong>
                                <small>Savings of {{$p->savings()}}%</small>
                            </div>
                            <div class="col-sm-7">
                                {{ Form::open(['route'=> 'cart.add','method' => 'post', 'id' => 'add-to-class'. $p->id, 'class' => 'add-to-class']) }}
                                    {{ Form::submit('Buy Package', ['class'=> 'btn btn-block add-btn']) }}
                                    {{ Form::hidden('product-id', EverciseCart::toProductCode('package', $p->id)) }}
                                    {{ Form::hidden('quantity', 1) }}
                                {{ Form::close() }}
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        @endforeach
    </div>
</div>

@stop