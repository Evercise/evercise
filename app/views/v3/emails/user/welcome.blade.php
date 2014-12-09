@extends('v3.emails.template')
<?php View::share('align', 'center') ?>

@section('body')
<p>Evercise is the exciting new <span class="pink-text">Pay As You Go</span> fitness community that&apos;s flexible enough to fit in with your lifestyle and doesn&apos;t tie you down to an expensive gym membership.</p>
<p>The Evercise network gives you access to a huge array of fun and flexible fitness classes wherever you are and our simple three-step process means it&apos;s quick and easy to <span class="pink-text">sign up</span> and get involved.</p>
@stop
@section('extra')
    <table width="640" height="auto" align="center" cellspacing="0" cellpadding="0" bgcolor="#ff1b7e">
        <tr>
            <td>
                <div class="container">
                    <div class="mb30">
                        <div class="image-left">
                            {{ image('/img/home/wie.png') }}
                        </div>
                        <br>
                        <h3 class="white-text">Search</h3>
                        <p class="white-text">Evercise makes it easy to search your area and discover the perfect class for you. With classes covering everything from aerobics to zumba you&apos;re sure to find something nearby that takes your fancy.</p>
                    </div>
                    <div class="mb30 text-right">
                        <div class="image-right">
                            {{ image('/img/home/wie.png') }}
                        </div>
                        <br>
                        <h3 class="white-text">Select</h3>
                        <p class="white-text">You can see reviews of all our classes, find out more about the venue and facilities and ask the trainer any questions you might have. </p>
                    </div>
                    <div class="mb30">
                        <div class="image-left">
                            {{ image('/img/home/wie.png') }}
                        </div>
                        <br>
                        <h3 class="white-text">Sign up</h3>
                        <p class="white-text">When you&apos;ve found a class you like the look of our simple Pay As You Go booking system ensures that joining your class is as quick and easy as ordering a pizza! </p>
                    </div>
                    <br>
                    <br>
                    <div class="text-center mb30">
                        {{ Html::linkRoute('evercisegroups.search', 'Get Started', null, ['class' => 'btn btn-blue']) }}
                    </div>

                </div>

            </td>
        </tr>
    </table>
@stop