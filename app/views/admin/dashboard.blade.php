@extends('admin.main')

@section('css')
<style>


                .livelogger{
                    padding:0;
                    margin:0;
                    background: #000;
                    height:100%;
                    min-height:650px;
                }
                #notify-messages {
                    margin:0;
                    padding:0;
                    list-style-type: none;

                }

                #notify-messages li{
                    width:100%;
                    clear:both;
                    font-weight: bold;
                }

                .message{
                    padding:3px;
                    min-height: 30px;
                    font-size:12px;
                }
                .level_debug{color:#fff}
                .level_info{color:#4bb1b1}
                .level_notice{color:#8ed9f6}
                .level_warning{color:#ffc033}
                .level_error{font-size:14px; color:#f5aca6}
                .level_emergency{font-size:16px; color:#c00}
                .level_live{color:#4288CE}

                a, a:visited {
                    text-decoration:none;
                }

            </style>

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

            <script src="//js.pusher.com/2.2/pusher.min.js" type="text/javascript"></script>

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





                <script type="text/javascript">

                    (function($){

                        $.extend({
                            playSound: function(){
                                return $("<embed src='"+arguments[0]+".mp3' hidden='true' autostart='true' loop='false' class='playSound'>" + "<audio autoplay='autoplay' style='display:none;' controls='controls'><source src='"+arguments[0]+".mp3' /><source src='"+arguments[0]+".ogg' /></audio>").appendTo('body');
                            }
                        });

                    })(jQuery);



                    var pusher = new Pusher('{{ Config::get('laravel-livelogger::pusher_api_key') }}');
                    var channel = pusher.subscribe('livelogger');
                    channel.bind('log', function(data) {
                        $('#notify-messages').prepend('<li class="message level_'+data.level+'">['+data.date+'] '+data.message+'</li>');

                        console.log(data);

                        if(data.level == 'error') {
                            $.playSound('/admin/assets/lib/jBox-0.3.0/Source/audio/bling2');
                        }


                    });
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
                    Total users including {{ $total_trainers }} trainers.
                 </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6">
            <div class="info_box_var_1 box_bg_b">
                <div class="info_box_body">
                    <span class="info_box_icon el-icon-user"></span>
                    <span class="countUpMe" data-endVal="{{ $users_today }}">{{ $users_today }}</span>
                </div>
                <div class="info_box_footer">
                    Users registered today including {{ $trainers_today }} trainers.
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
        <div class="col-md-8">
             <div class="row">
                <div class="heading_a">
                    <span class="heading_text">Sales</span>
                </div>
                <div id="sales_all" style="height:280px"></div>
            </div>
            <div class="row">
                <div class="heading_a">
                    <span class="heading_text">Classes</span>
                </div>
                <div id="classes_all" style="height:280px"></div>
            </div>
        </div>

        <div class="col-md-4 livelogger">


                <ul id="notify-messages">

                </ul>
        </div>
    </div>


@stop
