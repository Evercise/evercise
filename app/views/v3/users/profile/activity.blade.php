<div class="container-fluid bg-grey">
    <div class="container">
        <div class="underline text-center">
            <h1>Activitys</h1>
        </div>
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <ul class="list-group row">


                  @if(count($data['activity']) == 0)
                    <div class="text-center">
                        <strong class="text-center">Hey <span class="text-primary">{{ $user->display_name }}</span> You currently have no activity on Evercise</strong>
                    </div>

                  @else
                    @foreach($data['activity'] as $date => $activities)
                        <li class="list-group-item">
                                <strong class="list-group-item-heading">{{ $date }}</strong>
                        </li>
                        @foreach($activities as $a)
                        <li class="list-group-item clearfix activity_{{$a->cartcompleted}}">
                            <div class="row">
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            {{ image($a->image, $a->type, ['class'=>'img-responsive list-group-item-img'])}}
                                        </div>
                                        <div class="col-sm-9 sm-mt20 sm-text-center">
                                            <strong class="list-group-item-heading">{{ $a->title }}</strong>
                                            <p class="list-group-item-text">{{ $a->description }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-3 sm-mt20">
                                    @if($a->link)
                                        {{ Html::link( $a->link, $a->link_title, ['class' => 'btn btn-primary btn-block']) }}
                                    @endif
                                </div>
                            </div>



                        </li>
                        @endforeach

                    @endforeach


                  @endif





                </ul>

            </div>
</div>


    </div>
</div>