
<li class="headers">
    <div class="col-xs-6">Session</div>
    <div class="col-xs-3 text-center">Quantity</div>
    <div class="col-xs-2 text-center">Price</div>
    <div class="col-xs-1"></div>
</li>
<hr class="dark">
@foreach($sessions_grouped as $row)

<li class="item">
    <div class="col-xs-6 info">
        <strong>{{ $row['name']}}</strong><br>
        <span>{{ date('D, j F Y g:i A', strtotime($row['date_time']))  }}</span>
    </div>
    <div class="col-xs-3 switch-cart ">
        {{ Form::open(['route'=> 'cart.add','method' => 'post', 'id' => 'add-to-class'. $row['id'], 'class' => 'add-to-class']) }}
            {{ Form::hidden('product-id', EverciseCart::toProductCode('session', $row['id'])) }}
            {{ Form::hidden('force', true) }}
            {{ Form::hidden('refresh-page', true) }}
            <div class="qty-wrapper">
                <div class="visible-md-block visible-lg-block visible-sm-block">
                    <select name="quantity" id="quantity" class="select-box btn-select qty-select">
                        @for($i = 1; $i <= ($row['tickets_left']); $i++)
                            <option value="{{$i}}" {{ (!empty($cart_items[$row['id']]) && $cart_items[$row['id']] == $i ? 'selected="selected"' : '') }}>{{$i}}</option>
                        @endfor
                    </select>
                </div>
                <div class="visible-xs-block">
                    <select name="quantity" id="quantity" class="form-control select-default btn-select qty-select">
                        @for($i = 1; $i <= ($row['tickets_left']); $i++)
                            <option value="{{$i}}" {{ (!empty($cart_items[$row['id']]) && $cart_items[$row['id']] == $i ? 'selected="selected"' : '') }}>{{$i}}</option>
                        @endfor
                    </select>
                </div>
            </div>
        {{Form::close()}}
    </div>
    <div class="col-xs-3 hidden text-center switch-back">{{$cart_items[$row['id']]}}</div>
    <div class="col-xs-2 text-right"><b class="text-primary">{{ ($row['grouped_price_discount'] != $row['grouped_price'] ? '<strike>&pound'.number_format($row['grouped_price'],2,'.','').'</strike> &pound'.number_format($row['grouped_price_discount'],2,'.','') : '&pound'.number_format($row['grouped_price'],2,'.','') ) }}</b></div>
    <div class="col-xs-1 text-right">
        {{ Form::open(['route' =>'cart.delete', 'method' => 'post', 'class' => 'remove-row']) }}
            {{ Form::hidden('product-id', EverciseCart::toProductCode('session', $row['id'])) }}
            {{ Form::hidden('refresh-page', true) }}
            {{ HTML::decode( Form::submit('', ['class' => 'btn btn-icon icon icon-cross hover']) )}}
        {{Form::close()}}
    </div>
</li>
<hr>
@endforeach
@foreach($packages as $row)
<li class="item">
    <div class="col-xs-6 info">
        <strong>{{ $row['name']}}</strong><br>
        <span>{{ $row['classes'] }} classes for {{ $row['price'] }}</span>
    </div>
    <div class="col-xs-3 text-center">
        1
    </div>
    <div class="col-xs-2 text-right"><b class="text-primary">£{{ $row['price'] }}</b></div>
    <div class="col-xs-1 text-right">
        {{ Form::open(['route' =>'cart.delete', 'method' => 'post', 'class' => 'remove-row']) }}
            {{ Form::hidden('product-id', EverciseCart::toProductCode('package', $row['id'])) }}
            {{ Form::hidden('refresh-page', true) }}
            {{ HTML::decode( Form::submit('', ['class' => 'btn btn-icon icon icon-cross hover']) )}}
        {{Form::close()}}
    </div>
</li>
<hr>
@endforeach

@if(empty($discount['amount']) || $discount['amount'] == 0)
    <hr class="dark up">
    <li id="voucher" class="voucher switch-cart">
        <div class="col-sm-10 col-sm-offset-1">
            {{ Form::open(['route'=> 'cart.coupon', 'method' => 'post', 'id' => 'add-voucher']) }}
                <div class="row">
                    <div class="col-md-4">
                        I have a voucher code:
                    </div>
                    <div class="col-md-6">
                        {{ Form::text('coupon', null, ['class' => 'form-control input-sm', 'placeholder' => 'Enter your voucher']) }}
                    </div>
                    <div class="col-md-2 sm-mt10">
                        {{ Form::submit('Add Code', ['class' => 'btn btn-primary btn-sm btn-block']) }}
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </li>
@endif
<hr class="dark switc-cart">
<li class="total">
    <div class="col-xs-8"><strong>Sub-Total</strong></div>
    <div class="col-xs-4 text-right"><strong class="text-larger text-primary">£{{ number_format($total['subtotal'], 2,'.','') }}</strong></div>
</li>
@if(!empty($discount['amount']) && $discount['amount'] > 0)
      <hr class="dark">
      <li class="total bg-light-grey">
      <div class="col-xs-8"><strong class="ml15">Discounts</strong></div>
      <div class="col-xs-4 text-right">
          <strong class="text-larger text-primary">
              -£{{ number_format($discount['amount'] ,2, '.', '')}}
              @if($discount['type'] == 'percentage')
                   <span class="text-primary">{{ $discount['percentage']}}%</span>
              @endif
          </strong>
      </div>
      </li>
@endif
@if(!empty($rewards))
    @foreach($rewards as $reward)
        <hr class="dark">
        @foreach($reward as $key => $rew)

            <li class="total bg-light-grey">
            <div class="col-xs-8"><strong class="ml15">{{$key}}</strong></div>
            <div class="col-xs-4 text-right">
                <strong class="text-larger text-primary">
                    -£{{ number_format($rew ,2, '.', '')}}
                </strong>
            </div>
            </li>
        @endforeach

    @endforeach
@endif

<hr class="dark">
<li class="total">
    <div class="col-xs-8"><strong>Total</strong></div>
    <div class="col-xs-4 text-right"><strong class="text-larger text-primary">£{{number_format($total['final_cost'], 2, '.', '')}}</strong></div>
</li>