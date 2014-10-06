                    <div class="row">
                        <div class="col-md-3">
                            <h1 class="page_heading">
                                Help/Faq
                                <span>Get Help. Find Answers</span>
                            </h1>
                        </div>
                        <div class="col-md-9">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="What would you like to know?">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="button"><span class="icon_search"></span></button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="heading_b"><span class="heading_text">Categories</span></div>
                            <div class="list-group">
                                <a href="javascript:void(0)" class="active list-group-item">All</a>
                                <a href="javascript:void(0)" class="list-group-item">Customer Service</a>
                                <a href="javascript:void(0)" class="list-group-item">Configuration & Data Management</a>
                                <a href="javascript:void(0)" class="list-group-item">Mobile</a>
                                <a href="javascript:void(0)" class="list-group-item">Reports & Dashboards</a>
                                <a href="javascript:void(0)" class="list-group-item">Sales & Marketing</a>
                            </div>
                        </div>
                        <div class="col-md-9 col-sep-md">
                            <div class="panel-group">
<?php for($i=1;$i<=20;$i++) { ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" href="#helpFaq_sect_<?php echo $i;?>">
                                                <?php echo $i.'. '.$faker->sentence(4); ?>

                                            </a>
                                        </h4>
                                    </div>
                                    <div id="helpFaq_sect_<?php echo $i;?>" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <?php echo $faker->sentence(40); ?>

                                        </div>
                                    </div>
                                </div>
<?php }; ?>
                            </div>
                        </div>
                    </div>
