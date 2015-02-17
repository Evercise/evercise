                    <div class="row">
                        <div class="col-md-5">
                            <h3 class="heading_a"><span class="heading_text">Default Map</span></h3>
                            <div class="gmaps_wrapper">
                                <div class="gmap" id="gmap_basic"></div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <h3 class="heading_a"><span class="heading_text">Map with markers</span></h3>
                            <div class="gmaps_wrapper">
                                <div class="gmap" id="gmap_markers"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7">
                            <h3 class="heading_a"><span class="heading_text">Geocoding</span></h3>
                            <div class="sepH_b">
                                <form id="geocoding_form">
                                    <div class="input-group input-group-sm">
                                        <input type="text" class="form-control" id="gmaps_address" >
                                        <div class="input-group-btn">
                                            <button type="submit" class="btn btn-primary">Find</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="gmaps_wrapper">
                                <div class="gmap" id="gmap_geocoding"></div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <h3 class="heading_a"><span class="heading_text">Static Map</span></h3>
                            <div class="gmaps_wrapper">
                                <div class="gmap" id="gmap_static"></div>
                            </div>
                        </div>
                    </div>
                    <script type="text/javascript" src="//maps.google.com/maps/api/js?sensor=true"></script>
