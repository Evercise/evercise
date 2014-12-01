<div class="container-fluid bg-grey">
    <div class="container">
        <div class="underline text-center">
            <h1>Activitys</h1>
        </div>
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <ul class="list-group row">


                  @if(count($data['activity']) == 0)

                    NO activity
                  @else
                    @foreach($data['activity'] as $date => $activities)
                        <li class="list-group-item">
                                <strong class="list-group-item-heading">{{ $date }}</strong>
                        </li>

                           {{--
                            [id] => 2
                            [type] => cartcompleted
                            [type_id] => 10
                            [user_id] => 323
                            [description] => Bought a total of 4 sessions for £40
                            [created_at] => 2014-11-28 10:39:11
                            [updated_at] => 2014-11-28 10:39:11
                            [title] =>
                            [image] => cartcompleted.png
                            [link] => transaction/10
                            [link_title] => View transaction
                            [format_date] => November 28th 2014
                            --}}
                        @foreach($activities as $a)
                        <li class="list-group-item clearfix activity_{{$a->cartcompleted}}">
                          {{ image( $user->directory.'/medium_'.$user->image, $user->display_name.'s image', ['class' => 'img-resposive list-group-item-img']) }}
                          <div class="pull-left">
                              <strong class="list-group-item-heading">{{ $a->title }}</strong>
                              <p class="list-group-item-text">{{ $a->description }}</p>
                          </div>
                          <div class="pull-right">
                           {{-- THis should not be a button since we need a link --}}
                            <button type="button" href="{{ URL::to($a->link)}}" class="btn btn-primary">{{ $a->link_title }}</button>
                          </div>


                        </li>
                        @endforeach

                    @endforeach


                  @endif




                  <li class="list-group-item">
                    <strong class="list-group-item-heading">September 27th 2014</strong>
                  </li>
                  <li class="list-group-item clearfix">
                      {{ image( $user->directory.'/medium_'.$user->image, $user->display_name.'s image', ['class' => 'img-resposive list-group-item-img']) }}
                      <div class="pull-left">
                          <strong class="list-group-item-heading">You recently joined</strong>
                          <p class="list-group-item-text">A really shiiity class</p>
                      </div>
                      <div class="pull-right">
                        <button type="button" class="btn btn-primary">Bollocks</button>
                      </div>


                  </li>
                  <li class="list-group-item">
                      <strong class="list-group-item-heading">You recently joined</strong>
                      <p class="list-group-item-text">A really shiiity class</p>
                  </li>
                  <li class="list-group-item">
                      <strong class="list-group-item-heading">You recently joined</strong>
                      <p class="list-group-item-text">A really shiiity class</p>
                  </li>
                  <li class="list-group-item">
                      <strong class="list-group-item-heading">You recently joined</strong>
                      <p class="list-group-item-text">A really shiiity class</p>
                  </li>
                </ul>

            </div>
</div>


    </div>
</div>