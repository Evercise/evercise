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
        @foreach($cartRows as $key => $row)
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
                    <strong>{{ $row->name }}</strong>
                    <br>
                    <strong class="text-primary">&pound;{{ $row->price }}</strong>
                </div>
                <div class="col-xs-2 text-center mt10">
                    <span class="icon icon-cross hover"></span>
                </div>
            </div>
        @endforeach
    </div>

    <li class="divider col-xs-12"></li>

    <div class="col-xs-3">
        <strong>Sub-total</strong>
    </div>
    <div class="col-xs-5">
        <strong class="text-primary">&pound;<span id="cart-sub-total">0</span></strong>
    </div>
    <div class="col-xs-2">
        <strong>Discount</strong>
    </div>
    <div class="col-xs-2">
        <strong class="text-primary"><span id="cart-discount">0</span>%</strong>
    </div>
    <li class="divider col-xs-12"></li>

    <div class="col-xs-3">
        <strong>Total</strong>
    </div>
    <div class="col-xs-5">
        <strong class="text-primary">&pound;<span id="cart-total">0</span></strong>
    </div>
    <div class="col-xs-4 mb10">
        <button class="btn btn-primary">Checkout</button>
    </div>
</ul>