<ul class="dropdown-menu dropdown-cart" role="menu">
    <div class="col-xs-10">
        <h4>Your classes cart</h4>
    </div>
    <div class="col-xs-2 text-right">
        {{ Form::open(['route' =>'cart.emptyCart', 'method' => 'post', 'id' => 'empty-cart']) }}
            {{ HTML::decode( Form::submit('', ['class' => 'btn btn-icon icon icon-bin hover mt10']) )}}
        {{Form::close()}}
    </div>


    <li class="divider col-xs-12"></li>
    <div class="cart-rows">
        @foreach($packages as $row)
            <div class="cart-row">
                <div class="col-xs-3">
                    <div class="btn-group btn-block">
                        <button class="btn btn-primary">1</button>
                        <button type="button" class="btn btn-primary btn-aside" data-toggle="dropdown">
                            <span class="caret"></span>
                        </button>
                    </div>

                </div>
                <div class="col-xs-7">
                    <strong>{{ $row['name'] }}</strong>
                    <br>
                    <strong class="text-primary">&pound;{{ $row['price'] }}</strong>
                </div>
                <div class="col-xs-2 text-right mt10">
                    {{ Form::open(['route' =>'cart.delete', 'method' => 'post', 'class' => 'remove-row']) }}
                        {{ Form::hidden('product-id', EverciseCart::toProductCode('package', $row['id'])) }}
                        {{ HTML::decode( Form::submit('', ['class' => 'btn btn-icon icon icon-cross hover']) )}}
                    {{Form::close()}}
                </div>
            </div>
        @endforeach

        @foreach($sessions_grouped as $row)
            <div class="cart-row">
                <div class="col-xs-3">

                    {{ Form::open(['route'=> 'cart.add','method' => 'post', 'id' => 'add-to-class'. $row['id'], 'class' => 'add-to-class']) }}
                        {{ Form::hidden('product-id', EverciseCart::toProductCode('session', $row['id'])) }}
                        {{ Form::hidden('force', true) }}

                        <div class="btn-group pull-right custom-btn-dropdown-select">
                            {{ Form::submit( $row['qty'], ['class'=> 'btn btn-primary add-btn']) }}

                            <select name="quantity" id="quantity" class="btn btn-primary  btn-select">
                                <option value=""></option>
                                @for($i = 1; $i < 10; $i++)
                                    <option value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                    {{ Form::close() }}

                </div>
                <div class="col-xs-7">
                    <strong>{{ $row['name'] }}</strong>
                    <br>
                    <strong class="text-primary">{{ ($row['grouped_price_discount'] != $row['grouped_price'] ? '<strike>£'.$row['grouped_price'].'</strike> £'.$row['grouped_price_discount'] : $row['grouped_price']) }}</strong>
                </div>
                <div class="col-xs-2 text-right mt10">
                    {{ Form::open(['route' =>'cart.delete', 'method' => 'post', 'class' => 'remove-row']) }}
                        {{ Form::hidden('product-id', EverciseCart::toProductCode('session', $row['id'])) }}
                        {{ HTML::decode( Form::submit('', ['class' => 'btn btn-icon icon icon-cross hover']) )}}
                    {{Form::close()}}
                </div>
            </div>
        @endforeach
    </div>

    <li class="divider col-xs-12"></li>

    <div class="col-xs-3">
        <strong>Sub-total</strong>
    </div>
    <div class="col-xs-3">
        <strong class="text-primary">&pound;<span id="cart-sub-total">{{ $total['subtotal'] }}</span></strong>
    </div>
    <div class="col-xs-6 text-right">
        @if($total['package_deduct'] > 0)
            <strong>Package deduct: <span class="text-primary"> £{{ $total['package_deduct']  }}</span></strong>
            <br>
        @endif
        @if($total['from_wallet'] > 0)
            <strong>From Wallet: <span class="text-primary">£{{ $total['from_wallet']  }}</span></strong>
            <br>
        @endif
        @if(!empty($discount['amount']) && $discount['amount'] > 0)
            <strong>
                Voucher discount: <span class="text-primary">- £{{ $discount['amount'] }}</span>
                 @if($discount['type'] == 'percentage')
                     <span class="text-primary">{{ $discount['percentage']}}%</span>
                 @endif
            </strong>
        @endif
    </div>

    <li class="divider col-xs-12"></li>

    <div class="col-xs-3">
        <strong>Total</strong>
    </div>
    <div class="col-xs-5">
        <strong class="text-primary">&pound;<span id="cart-total">{{ $total['final_cost'] }}</span></strong>
    </div>
    <div class="col-xs-4 mb10 text-right">
        <a href="/cart/checkout"><button class="btn btn-primary">Checkout</button></a>
    </div>
</ul>