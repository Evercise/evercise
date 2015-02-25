@if( !empty($sessions_grouped) || !empty($packages))
<div class="basket">

    <a href="#" title="Check your Shopping Cart" class="checkout__button nav-cart nav-link"><span class="icon icon-cart-white"></span>(<span class="cart-items">{{ isset($cart_items) ? count($cart_items) : '0' }}</span>)</a>

    <div class="checkout__order">

        <div class="checkout__order-inner">
            <div class="title">
                <span class="icon icon-cart"></span>
                <strong class="h3">Basket</strong>
            </div>

            <div class="cart-rows">
                @foreach($sessions_grouped as $row)
                    <div class="cart-row row">
                        <div class="col-sm-8 title">
                            <strong>{{ HTML::linkRoute('class.show', $row['name'], [$row['slug']] ) }}</strong><br>
                            {{ date('D, j F Y g:i A', strtotime(  $row['date_time'] ))}}
                        </div>
                        <div class="col-sm-2 text-center">
                            {{$row['qty']}}
                        </div>
                        <div class="col-sm-2 text-right">
                            <b class="text-primary">{{ ($row['grouped_price_discount'] != $row['grouped_price'] ? '<strike>£'.$row['grouped_price'].'</strike> £'.$row['grouped_price_discount'] : '£'.round($row['grouped_price'],2) ) }}</b>
                        </div>
                    </div>
                @endforeach
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-6">
                        <div class="cart-row row">
                            <div class="col-sm-5">
                                <strong class="h5">Total</strong>
                            </div>
                            <div class="col-sm-7 text-right">
                                <b class="text-primary">&pound;{{ round($total['final_cost'] , 2) }}</b>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt20">
                    <div class="col-sm-5">{{ Html::linkRoute('home', 'Continue Shopping',null, ['class' => 'btn btn-block btn-white-primary btn-lg']) }}</div>
                    <div class="col-sm-5 col-sm-offset-2">{{ Html::linkRoute('cart.checkout', 'Checkout', null, ['class' => 'btn btn-block btn-primary btn-lg']) }}</div>
                </div>
            </div>
            <span class="icon icon-cross checkout__close js-checkout__cancel"></span>
        </div><!-- /checkout__order-inner -->
    </div><!-- /checkout__order -->
</div><!-- /checkout -->
@else
<div class="basket">
    <a href="#" title="Check your Shopping Cart"  class="checkout__button disabled nav-cart nav-link"><span class="icon icon-cart-white"></span>(0)</a>
</div>

@endif
