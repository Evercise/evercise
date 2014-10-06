                    <div class="row">
                        <div class="col-md-12">
                            <div class="ul_main_info">
                                Showing <strong class="countUsers"></strong> contact(s)
                            </div>
                            <ul id="user_list">
<?php for($i=1;$i<=120;$i++) { ?>
                                <li>
                                    <h3 class="ul_userName"><span class="ul_firstName"><?php echo $faker->firstName; ?></span> <span class="ul_lastName"><?php echo $faker->firstName; ?></span></h3>
                                    <p class="ul_company"><small class="text-muted">Company:</small> <?php echo $faker->company; ?></p>
                                    <p><small class="text-muted">Phone:</small> <span class="ul_phone"><?php echo $faker->phoneNumber; ?></span>; <small class="text-muted">E-mail:</small> <span class="ul_email"><?php echo $faker->email; ?></span></p>
                                </li>
<?php }; ?>
                            </ul>
                        </div>
                    </div>
