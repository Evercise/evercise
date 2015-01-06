@extends('v3.layouts.master')



@section('body')
<div class="container first-container">
    <div class="row text-center mb40">
        <div class="underline">
            <h1>High Five Fitness</h1>
        </div>
        <strong>Get fit and stay active with an Evercise 5 class package</strong>
        <br>
        <strong>Grab a five-class package to save money, speed up your booking process and stay active</strong>
        <br>
        <p>All packages have a 60-day expiry date, please read through the {{ Html::linkRoute('general.terms', 'terms',['#packages'], []) }} before purchase.</p>
    </div>
    <div class="row mb30">
        @foreach($packages as $index => $p)
            @if($p->classes == 5)
                <div class="col-md-4 text-left">
                    <ul class="list-group package-block-module package-{{ isset($p->style) ? $p->style : 'blue' }}">
                        <li class="list-group-item package-title">
                            <h2 class="h1">{{ $p->name }} Fitness Classes</h2>
                        </li>
                        <li class="list-group-item package-description">
                            <h4>£{{ round($p->max_class_price,2) }} {{ $p->classes }} Class Package</h4>
                            <p>{{ $p->description }}</p>
                        </li>
                        <li class="list-group-item package-list">
                            @if(!empty($p->bullets))
                                <div>
                                    <ul>
                                        <li></span>Any <span class="colour">{{$p->classes }}</span> classes up to <span class="colour">£{{ round($p->max_class_price,2) }}</span> </li>
                                        <li></span>Save <span class="colour">{{$p->savings()}}%</span> on standard price</li>
                                        <li>Up to <span class="colour">{{ $p->availableClasses()}}</span> classes to choose from</li>
                                        @foreach(explode('|', $p->bullets) as $b)
                                            <li>{{ $b }}</li>
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
            @endif
        @endforeach
    </div>
    <div class="row text-center mb40">
        <div class="underline">
            <h1>Perfect Ten Fitness Classes</h1>
        </div>
        <strong>Feel the burn! Become an Evercise fitness VIP with a 10 class package</strong>
        <br>
        <strong>Serious about getting fit? Save up to 50% and enjoy the VIP treatment with one of our 10 class packages</strong>
        <br>
        <p>All packages have a 60-day expiry date, please read through the {{ Html::linkRoute('general.terms', 'terms',['#packages'], []) }} before purchase.</p>
    </div>
    <div class="row">
        @foreach($packages as $index => $p)
            @if($p->classes == 10)
                <div class="col-md-4 text-left">
                    <ul class="list-group package-block-module package-{{ isset($p->style) ? $p->style : 'blue' }}">
                        <li class="list-group-item package-title">
                            <h2 class="h1">{{ $p->name }} Fitness Classes</h2>
                        </li>
                        <li class="list-group-item package-description">
                            <h4>{{ $p->classes }} Class Package</h4>
                            <p>{{ $p->description }}</p>
                        </li>
                        <li class="list-group-item package-list">
                            @if(!empty($p->bullets))
                                <div>
                                    <ul>
                                        <li></span>Any <span class="colour">{{$p->classes }}</span> classes up to <span class="colour">£{{ round($p->max_class_price,2) }}</span> </li>
                                        <li></span>Save <span class="colour">{{$p->savings()}}%</span> on standard price</li>
                                        <li>Up to <span class="colour">{{ $p->availableClasses()}}</span> classes to choose from</li>
                                        @foreach(explode('|', $p->bullets) as $b)
                                            <li>{{ $b }}</li>
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
            @endif
        @endforeach
    </div>
</div>

@stop