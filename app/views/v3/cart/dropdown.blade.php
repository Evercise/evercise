<ul class="dropdown-menu dropdown-cart" role="menu">
    <div class="col-xs-10">
        <h4>Your classes cart</h4>
    </div>
    <div class="col-xs-2 text-center">
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
                <div class="col-xs-2 text-center mt10">
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
                    <div class="btn-group btn-block">
                        <button class="btn btn-primary">{{ $row['qty'] }}</button>
                        <button type="button" class="btn btn-primary btn-aside" data-toggle="dropdown">
                            <span class="caret"></span>
                        </button>
                    </div>

                </div>
                <div class="col-xs-7">
                    <strong>{{ $row['name'] }}</strong>
                    <br>
                    <strong class="text-primary">{{ ($row['grouped_price_discount'] != $row['grouped_price'] ? '<strike>£'.$row['grouped_price'].'</strike> £'.$row['grouped_price_discount'] : $row['grouped_price']) }}</strong>
                </div>
                <div class="col-xs-2 text-center mt10">
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
    <div class="col-xs-5">
        <strong class="text-primary">&pound;<span id="cart-sub-total">{{ $total['subtotal'] }}</span></strong>
    </div>
    <div class="col-xs-2">
        <strong>Discount</strong>
    </div>
    <div class="col-xs-2">
        <strong class="text-primary"><span id="cart-discount">{{ $discount['amount'] or 0 }}</span>%</strong>
    </div>
    <li class="divider col-xs-12"></li>

    <div class="col-xs-3">
        <strong>Total</strong>
    </div>
    <div class="col-xs-5">
        <strong class="text-primary">&pound;<span id="cart-total">{{ $total['final_cost'] }}</span></strong>
    </div>
    <div class="col-xs-4 mb10">
        <a href="/cart/checkout"><button class="btn btn-primary">Checkout</button></a>
    </div>
</ul>