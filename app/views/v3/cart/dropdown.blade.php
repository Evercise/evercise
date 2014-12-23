@if( !empty($sessions_grouped) || !empty($packages))
    <ul class="dropdown-menu dropdown-cart" role="menu">
        <div class="col-xs-10 sm-mt10">
            <h4>Your classes cart</h4>
        </div>
        <div class="col-xs-2 text-right sm-mt10">
            {{ Form::open(['route' =>'cart.emptyCart', 'method' => 'post', 'id' => 'empty-cart']) }}
                {{ HTML::decode( Form::submit('', ['class' => 'btn btn-icon icon icon-bin hover mt10']) )}}
            {{Form::close()}}
        </div>


        <li class="divider col-xs-12"></li>
        <div class="cart-rows">
            @foreach($packages as $row)
                <div class="cart-row sm-mt10">
                    <div class="col-sm-3 hidden-mob">
                        {{ image('assets/img/More_'.$row['style'].'.png', 'package', ['class' => 'img-responsive']) }}
                    </div>
                    <div class="col-sm-7">
                        {{ Html::linkRoute('packages', $row['name'], null,  ['class' => 'sm-strong']) }}
                        <br class="hidden-mob">
                        <strong class="text-primary text-right sm-pull-right">&pound;{{ $row['price'] }}</strong>
                    </div>
                    <div class="col-xs-2 text-right mt10 hidden-mob">
                        {{ Form::open(['route' =>'cart.delete', 'method' => 'post', 'class' => 'remove-row']) }}
                            {{ Form::hidden('product-id', EverciseCart::toProductCode('package', $row['id'])) }}
                            {{ HTML::decode( Form::submit('', ['class' => 'btn btn-icon icon icon-cross hover']) )}}
                        {{Form::close()}}
                    </div>
                    <div class="visible-sm-block visible-xs-block sm-mt25">
                        <div class="col-xs-6">
                            {{ Form::open(['route' =>'cart.delete', 'method' => 'post', 'class' => 'remove-row']) }}
                                {{ Form::hidden('product-id', EverciseCart::toProductCode('session', $row['id'])) }}
                                {{ Form::submit('Remove', ['class' => 'btn btn-light btn-block']) }}
                            {{Form::close()}}
                        </div>
                    </div>
                </div>
            @endforeach

            @foreach($sessions_grouped as $row)
                <div class="cart-row sm-mt10">
                    <div class="col-sm-3 hidden-mob">
                    {{ Form::open(['route'=> 'cart.add','method' => 'post', 'id' => 'add-to-class'. $row['id'], 'class' => 'add-to-class']) }}
                    {{ Form::hidden('product-id', EverciseCart::toProductCode('session', $row['id'])) }}
                    {{ Form::hidden('force', true) }}

                        <div class="btn-group btn-block">
                            {{ Form::submit( $row['qty'], ['class'=> 'btn btn-primary add-btn']) }}
                            <div class="btn btn-primary btn-aside">
                                <div class="custom-select btn-drop">
                                    <select name="quantity" id="quantity" class="btn-primary btn-select ">
                                        <option value=""></option>
                                        @for($i = 1; $i <= ($row['tickets_left'] /*<= 10 ? $row['tickets_left'] : 10*/); $i++)
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>

                                    <span class="caret"></span>
                                </div>
                            </div>

                        </div>

                    {{ Form::close() }}
                    </div>
                    <div class="col-sm-7">
                        {{ Html::linkRoute('class.show', $row['name'], [$row['slug']] , ['class' => 'sm-strong']) }}
                        <br class="hidden-mob">
                        <div class="sm-pull-right sm-text-right">
                            <strong class="text-primary">{{ ($row['grouped_price_discount'] != $row['grouped_price'] ? '<strike>£'.$row['grouped_price'].'</strike> £'.$row['grouped_price_discount'] : '£'.round($row['grouped_price'],2) ) }}</strong>
                        </div>

                    </div>
                    <div class="col-xs-2 text-right mt10 hidden-mob">
                        {{ Form::open(['route' =>'cart.delete', 'method' => 'post', 'class' => 'remove-row']) }}
                            {{ Form::hidden('product-id', EverciseCart::toProductCode('session', $row['id'])) }}
                            {{ HTML::decode( Form::submit('', ['class' => 'btn btn-icon icon icon-cross hover']) )}}
                        {{Form::close()}}
                    </div>
                    <div class="visible-sm-block visible-xs-block sm-mt25">
                        <div class="col-xs-6">
                            {{ Form::open(['route' =>'cart.delete', 'method' => 'post', 'class' => 'remove-row']) }}
                                {{ Form::hidden('product-id', EverciseCart::toProductCode('session', $row['id'])) }}
                                {{ Form::submit('Remove', ['class' => 'btn btn-light btn-block']) }}
                            {{Form::close()}}
                        </div>
                        {{ Form::open(['route'=> 'cart.add','method' => 'post', 'id' => 'add-to-class'. $row['id'], 'class' => 'add-to-class']) }}
                        {{ Form::hidden('product-id', EverciseCart::toProductCode('session', $row['id'])) }}
                        {{ Form::hidden('force', true) }}
                        <div class="col-xs-6">
                            <div class="toggle-select row" data-trigger="true" data-qty="{{$row['tickets_left']}}">
                                <div class="switch col-xs-3"><a href="#minus">-</a></div>
                                <div id="qty" class="col-xs-6 text-center">{{ !empty($cart_items[$row['id']]) ?  $cart_items[$row['id']] : 1}}</div>
                                <div class="switch col-xs-3"><a href="#plus">+</a> </div>
                                {{Form::hidden('quantity', !empty($cart_items[$row['id']]) ?  $cart_items[$row['id']] : 1 ,['id' => 'toggle-quantity'])}}
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            @endforeach
        </div>

        <li class="divider col-xs-12"></li>

        <div class="col-xs-3">
            <strong>Sub-total</strong>
        </div>
        <div class="col-xs-3">
            <strong class="text-primary">&pound;<span id="cart-sub-total">{{ round($total['subtotal'], 2) }}</span></strong>
        </div>
        <div class="col-xs-6 text-right">
            @if($total['package_deduct'] > 0)
                <strong>Package deduct: <span class="text-primary"> £{{ round($total['package_deduct'] ,2)  }}</span></strong>
                <br>
            @endif
            @if($total['from_wallet'] > 0)
                <strong>From Wallet: <span class="text-primary">£{{ round($total['from_wallet'] ,2)  }}</span></strong>
                <br>
            @endif
            @if(!empty($discount['amount']) && $discount['amount'] > 0)
                <strong>
                    Voucher discount: <span class="text-primary">- £{{ round($discount['amount'] , 2) }}</span>
                     @if($discount['type'] == 'percentage')
                         <span class="text-primary">{{ $discount['percentage']}}%</span>
                     @endif
                </strong>
            @endif
        </div>

        <li class="divider col-xs-12"></li>

        <div class="col-xs-3 mt10">
            <strong>Total</strong>
        </div>
        <div class="col-xs-3 mt10">
            <strong class="text-primary">&pound;<span id="cart-total">{{ round($total['final_cost'] , 2) }}</span></strong>
        </div>
        <div class="col-xs-6 mb10 text-right">
            <a href="/cart/checkout"><button class="btn btn-primary btn-block">Checkout</button></a>
        </div>
    </ul>
@else
    <ul class="dropdown-menu dropdown-cart" role="menu">
        <div class="col-xs-12 text-center">
            <strong>You have nothing in your cart at the moment</strong>
        </div>
    </ul>
@endif