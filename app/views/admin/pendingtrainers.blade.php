
<div class="row">
    <ul id="user_list" class="pending_list">
			@foreach($trainers as $key => $trainer)

                <li>
                    <h3 class="ul_userName"><span class="ul_firstName"><?php echo $trainer->user->first_name ?></span> <span class="ul_lastName"><?php  echo $trainer->user->last_name ?></span></h3>

                   	<div>
                   	    <img class="user_profile_img" src="<?php echo '../../profiles/'.$trainer->user->directory.'/'.$trainer->user->image ?>" alt="" width="76" height="76">
                   	</div>
                    <p>
                        <small class="text-muted">Phone:</small> <span class="ul_phone"><?php  echo $trainer->user->display_name ?></span>
                        <small class="text-muted">Phone:</small> <span class="ul_phone"><?php  echo $trainer->user->phone ?></span>
                        <small class="text-muted">Email:</small> <span class="ul_email"><?php  echo $trainer->user->email ?></span>
                    </p>

					{{ Form::open(array('id' => 'approve'.$key, 'url' => 'admin/approve_trainer', 'method' => 'post', 'class' => '')) }}

						{{ Form::hidden( 'trainer' , $trainer->id, array('id' => 'trainer')) }}

						{{ Form::submit('Approval' , array('class'=>'btn-yellow ')) }}

					{{ Form::close() }}
                </li>
			@endforeach
			
    </ul>
</div>