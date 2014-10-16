                    <div class="row">
                        <div class="col-md-3 col-lg-2">
                            <button class="btn btn-info btn-outline btn-sm">Compose</button>
                            <hr/>
                            <div class="list-group mailbox_menu">
                                <a href="pages-mailbox.html" class="list-group-item">
                                    <span class="badge badge-danger">96</span>
                                    <span class="menu_icon icon_download"></span>Inbox
                                </a>
                                <a href="pages-mailbox.html" class="list-group-item">
                                    <span class="menu_icon icon_upload"></span>Sent
                                </a>
                                <a href="pages-mailbox.html" class="list-group-item">
                                    <span class="badge badge-danger">52</span>
                                    <span class="menu_icon icon_error-circle_alt"></span>Spam
                                </a>
                                <a href="pages-mailbox.html" class="list-group-item">
                                    <span class="menu_icon icon_pencil-edit"></span>Drafts
                                </a>
                                <a href="pages-mailbox.html" class="list-group-item">
                                    <span class="menu_icon icon_trash_alt"></span>Trash
                                </a>
                            </div>
                        </div>
                        <div class="col-md-9 col-lg-10">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="btn-group btn-group-sm">
                                        <button type="button" class="btn btn-default">Reply</button>
                                        <button type="button" class="btn btn-default">Spam</button>
                                        <button type="button" class="btn btn-default text-danger">Delete</button>
                                    </div>
                                </div>
                                <div class="col-md-4 col-md-offset-4 text-right">
                                    <div class="btn-group btn-group-sm">
                                        <button type="button" class="btn btn-default bs_ttip" data-placement="bottom" title="Prev"><span class="el-icon-chevron-left"></span></button>
                                        <button type="button" class="btn btn-default bs_ttip" data-placement="bottom" title="Next"><span class="el-icon-chevron-right"></span></button>
                                    </div>
                                </div>
                            </div>
                            <hr/>
                            <div class="mail_details_top clearfix">
                                <div class="mail_date">
                                    Thu 26.11.2015
                                </div>
                                <div class="mail_user_image">
                                    <img src="assets/img/avatars/avatar0<?php echo rand(1,9); ?>_tn.png" width="38" height="38" alt="">
                                </div>
                                <div class="mail_user_info">
                                    <h2><?php echo $faker->name; ?></h2>
                                    <span class="text-muted"><?php echo $faker->email; ?></span>
                                </div>
                            </div>
                            <div class="mail_details_content">
                                <?php echo $faker->sentence(80); ?>
                                
                            </div>
                            <div class="mail_details_send">
                                <textarea name="mail_reply" id="mail_reply" cols="30" rows="3" class="form-control" placeholder="Start typing here to replay or forward..."></textarea>
                            </div>
                        </div>
                    </div>
