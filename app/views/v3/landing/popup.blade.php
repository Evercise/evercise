<div class="landing-mask"></div>
<div class="landing-popup" style="background-image:  url('{{url().'/assets/img/landings/popup/bootcamp_modal_img.jpg'}}')">
    <h1 class="text-primary">Get up to £10</h1>
    <h2>For you first {cat} class</h2>
    <strong>Fun & flexible, No commitment</strong>
    <br>
    <strong>Huge Array of Fitness Classes</strong>
    <br>
    {{ Form::open(['url' => 'landings', 'method' => 'post',]) }}

        <div class="row mt30">
            <div class="col-sm-12">
                <div class="input-wrapper email pull-left mr20">
                    {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email Address']) }}
                </div>
                <div class="input-wrapper location pull-left">
                    {{ Form::text('location', null, ['class' => 'form-control', 'placeholder' => 'Preferred Location']) }}
                </div>
            </div>

        </div>
        <div class="row mt20">
            <div class="col-sm-5">
                {{ Form::submit('Claim the offer', ['class' => 'btn btn-primary btn-lg btn-block']) }}
            </div>
        </div>
    {{ Form::close() }}
</div>
