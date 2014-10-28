@extends('admin.main')

@section('css')

@stop

@section('script')

            <!-- c3 charts -->
            <script src="assets/lib/d3/d3.min.js"></script>
            <script src="assets/lib/c3/c3.min.js"></script>
            <!-- vector maps -->
            <script src="assets/lib/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
            <script src="assets/lib/jvectormap/maps/jquery-jvectormap-world-mill-en.js"></script>
            <!-- countUp animation -->
            <script src="assets/js/countUp.min.js"></script>
            <!-- switchery -->
            <script src="assets/lib/switchery/dist/switchery.min.js"></script>
            <!-- easePie chart -->
            <script src="assets/lib/easy-pie-chart/dist/jquery.easypiechart.min.js"></script>

            <script>
                $(function() {
                    // c3 charts
                    yukon_charts.p_dashboard();
                    // countMeUp
                    yukon_count_up.init();
                    // easy pie chart
                    yukon_easyPie_chart.p_dashboard();
                    // vector maps
                    yukon_vector_maps.p_dashboard();
                    // switchery
                    yukon_switchery.init();



                    if($('#classes_all').length) {
                            var classes_all = c3.generate({
                                bindto: '#classes_all',
                                data: {
                                    x: 'x',
                                    columns: [
                                        ['x', '{{ implode("','", $total_months) }}'],
                                        ['TOTAL', {{ implode(",", $total_classes_count) }}],
                                        ['SESSIONS', {{ implode(",", $total_sessions_count) }}],
                                    ],
                                    types: {
                                        'TOTAL': 'area',
                                        'SESSIONS': 'line'
                                    }
                                },
                                axis: {
                                    x: {
                                        type: 'timeseries',
                                        tick: {
                                            culling: false,
                                            fit: true,
                                            format: "%b"
                                        }
                                    },
                                    y : {
                                        tick: {
                                            format: d3.format("£,")
                                        }
                                    }
                                },
                                point: {
                                    r: '4',
                                    focus: {
                                        expand: {
                                            r: '5'
                                        }
                                    }
                                },
                                bar: {
                                    width: {
                                        ratio: 0.4 // this makes bar width 50% of length between ticks
                                    }
                                },
                                grid: {
                                    x: {
                                        show: true
                                    },
                                    y: {
                                        show: true
                                    }
                                },
                                color: {
                                    pattern: ['#1f77b4', '#ff7f0e', '#2ca02c', '#d62728', '#9467bd', '#8c564b', '#e377c2', '#7f7f7f', '#bcbd22', '#17becf']
                                }
                            });


                            $(window).on("debouncedresize", function() {
                                sales_all.resize();
                            });
                    }




                    if($('#sales_all').length) {
                            var sales_all = c3.generate({
                                bindto: '#sales_all',
                                data: {
                                    x: 'x',
                                    columns: [
                                        ['x', '{{ implode("','", $total_months) }}'],
                                        ['TOTAL', {{ implode(",", $total_year_total) }}],
                                        ['FEE', {{ implode(",", $total_year_fee) }}],
                                    ],
                                    types: {
                                        'TOTAL': 'area',
                                        'FEE': 'line'
                                    }
                                },
                                axis: {
                                    x: {
                                        type: 'timeseries',
                                        tick: {
                                            culling: false,
                                            fit: true,
                                            format: "%b"
                                        }
                                    },
                                    y : {
                                        tick: {
                                            format: d3.format("£,")
                                        }
                                    }
                                },
                                point: {
                                    r: '4',
                                    focus: {
                                        expand: {
                                            r: '5'
                                        }
                                    }
                                },
                                bar: {
                                    width: {
                                        ratio: 0.4 // this makes bar width 50% of length between ticks
                                    }
                                },
                                grid: {
                                    x: {
                                        show: true
                                    },
                                    y: {
                                        show: true
                                    }
                                },
                                color: {
                                    pattern: ['#1f77b4', '#ff7f0e', '#2ca02c', '#d62728', '#9467bd', '#8c564b', '#e377c2', '#7f7f7f', '#bcbd22', '#17becf']
                                }
                            });


                            $(window).on("debouncedresize", function() {
                                sales_all.resize();
                            });
                    }
                })
            </script>

@stop

@section('body')

    <div class="row">
        <div class="col-lg-3 col-sm-6">
            <div class="info_box_var_1 box_bg_a">
                <div class="info_box_body">
                    <span class="info_box_icon icon_images"></span>
                    <span class="countUpMe" data-endVal="{{ $gallery_images_counter }}">{{ $gallery_images_counter }}</span>
                </div>
                <div class="info_box_footer">
                    Total uses left from {{ $gallery_images_total }} images
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="info_box_var_1 box_bg_b">
                <div class="info_box_body">
                    <span class="info_box_icon el-icon-user"></span>
                    <span class="countUpMe" data-endVal="{{ $total_users }}">{{ $total_users }}</span>
                </div>
                <div class="info_box_footer">
                    Total users including {{ $total_trainers }} trainers
                 </div>
            </div>
        </div>


        <div class="col-lg-3 col-sm-6">
            <div class="info_box_var_1 box_bg_c">
                <div class="info_box_body">
                    <span class="info_box_icon icon_wallet"></span>
                    £<span class="countUpMe" data-endVal="{{ $total_sales }}">{{ $total_sales }}</span>
                </div>
                <div class="info_box_footer">
                    Sales (with commission of: £{{ $total_commission }}
                    <small>(last 30days)</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="info_box_var_1 box_bg_d">
                <div class="info_box_body">
                    <span class="info_box_icon el-icon-slideshare"></span>
                    <span class="countUpMe" data-endVal="{{ $total_referrals }}">{{ $total_referrals }}</span>
                </div>
                <div class="info_box_footer">
                    Total Referrals
                </div>
            </div>
        </div>
    </div>
    



    <div class="row">
        <div class="col-md-12">
            <div class="heading_a">
                <span class="heading_text">Sales</span>
            </div>
            <div id="sales_all" style="height:280px"></div>
        </div>
    </div>





    <div class="row">
        <div class="col-md-12">
            <div class="heading_a">
                <span class="heading_text">Classes</span>
            </div>
            <div id="classes_all" style="height:280px"></div>
        </div>
    </div>


@stop
