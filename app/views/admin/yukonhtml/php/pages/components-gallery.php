                    <div class="gallery_filer">
                        <div class="row">
                            <div class="col-sm-6">
                                <input class="form-control" type="text" placeholder="Filter by name, tag etc..." id="gallery_search" />
                                <span class="help-block">Eg. business, creative, photoshop</span>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    <ul class="gallery_grid">
<?php for($i=1;$i<=20;$i++) { ?>
                        <li>
                            <a href="assets/img/gallery/Image0<?php if($i<10) echo '0'; echo $i; ?>.jpg" class="img_wrapper" title="<?php echo $faker->sentence(4); ?>">
                                <img src="assets/img/gallery/Image0<?php if($i<10) echo '0'; echo $i; ?>.jpg" alt=""/>
                                <span class="gallery_image_zoom">
                                    <span class="arrow_expand"></span>
                                </span>
                                <span class="hide gallery_image_tags">
<?php $rand_tags = rand(2,4); for($ii=1;$ii<=$rand_tags;$ii++) { ?>
                                    <span><?php echo $tags[array_rand($tags)]; if($ii < $rand_tags) echo ',';?></span>
<?php }; ?>
                                </span>
                            </a>
                        </li>
<?php }; ?>
                    </ul>
