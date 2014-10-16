<!DOCTYPE html>
<html>
    <head>
		<meta charset="UTF-8">
		<title>Yukon Admin HTML 1.1(dashboard)</title>
        <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
        <!-- favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">

        <!-- bootstrap framework -->
		<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
		
        <!-- icon sets -->
            <!-- elegant icons -->
                <link href="assets/icons/elegant/style.css" rel="stylesheet" media="screen">
            <!-- elusive icons -->
                <link href="assets/icons/elusive/css/elusive-webfont.css" rel="stylesheet" media="screen">
            <!-- flags -->
                <link rel="stylesheet" href="assets/icons/flags/flags.css">


        <!-- google webfonts -->
		<link href='http://fonts.googleapis.com/css?family=Open+Sans&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>

        <!-- main stylesheet -->
		<link href="assets/css/main.min.css" rel="stylesheet" media="screen" id="mainCss">

        <!-- moment.js (date library) -->
        <script src="assets/js/moment-with-langs.min.js"></script>

    </head>
    <body class="side_menu_active side_menu_expanded">
        <div id="page_wrapper">

            <!-- header -->
            <header id="main_header">
                <div class="container-fluid">
                    <div class="brand_section">
                        <a href="dashboard.html"><img src="assets/img/logo.png" alt="site_logo" width="63" height="26"></a>
                    </div>
                    <ul class="header_notifications clearfix">
                        <li class="dropdown">
                            <span class="label label-danger">8</span>
                            <a data-toggle="dropdown" href="#" class="dropdown-toggle"><i class="el-icon-envelope"></i></a>
                            <div class="dropdown-menu">
                                <ul>
                                    <li>
                                        <img src="assets/img/avatars/avatar02_tn.png" alt="" width="38" height="38">
                                        <p><a href="#">Lorem ipsum dolor sit amet&hellip;</a></p>
                                        <small class="text-muted">14.07.2014</small>
                                    </li>
                                    <li>
                                        <img src="assets/img/avatars/avatar03_tn.png" alt="" width="38" height="38">
                                        <p><a href="#">Lorem ipsum dolor sit&hellip;</a></p>
                                        <small class="text-muted">14.07.2014</small>
                                    </li>
                                    <li>
                                        <img src="assets/img/avatars/avatar04_tn.png" alt="" width="38" height="38">
                                        <p><a href="#">Lorem ipsum dolor&hellip;</a></p>
                                        <small class="text-muted">14.07.2014</small>
                                    </li>
                                    <li>
                                        <img src="assets/img/avatars/avatar05_tn.png" alt="" width="38" height="38">
                                        <p><a href="#">Lorem ipsum dolor sit amet&hellip;</a></p>
                                        <small class="text-muted">14.07.2014</small>
                                    </li>
                                    <li>
                                        <a href="#" class="btn btn-xs btn-primary btn-block">All messages</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="dropdown" id="tasks_dropdown">
                            <span class="label label-danger">14</span>
                            <a data-toggle="dropdown" href="#" class="dropdown-toggle"><i class="el-icon-tasks"></i></a>
                            <div class="dropdown-menu">
                                <ul>
                                    <li>
                                        <div class="clearfix">
                                            <div class="label label-warning pull-right">Medium</div>
                                            <small class="text-muted">YUK-21 (24.07.2014)</small>
                                        </div>
                                        <p>Lorem ipsum dolor sit amet&hellip;</p>
                                    </li>
                                    <li>
                                        <div class="clearfix">
                                            <div class="label label-danger pull-right">High</div>
                                            <small class="text-muted">YUK-8 (26.07.2014)</small>
                                        </div>
                                        <p>Lorem ipsum dolor sit amet&hellip;</p>
                                    </li>
                                    <li>
                                        <div class="clearfix">
                                            <div class="label label-success pull-right">Medium</div>
                                            <small class="text-muted">DES-14 (25.07.2014)</small>
                                        </div>
                                        <p>Lorem ipsum dolor sit amet&hellip;</p>
                                    </li>
                                    <li>
                                        <a href="#" class="btn btn-xs btn-primary btn-block">All tasks</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="dropdown">
                            <span class="label label-primary">2</span>
                            <a data-toggle="dropdown" href="#" class="dropdown-toggle"><i class="el-icon-bell"></i></a>
                            <div class="dropdown-menu">
                                <ul>
                                    <li>
                                        <p>Lorem ipsum dolor sit amet&hellip;</p>
                                        <small class="text-muted">20 minutes ago</small>
                                    </li>
                                    <li>
                                        <p>Lorem ipsum dolor sit&hellip;</p>
                                        <small class="text-muted">44 minutes ago</small>
                                    </li>
                                    <li>
                                        <p>Lorem ipsum dolor&hellip;</p>
                                        <small class="text-muted">10:55</small>
                                    </li>
                                    <li>
                                        <p>Lorem ipsum dolor sit amet&hellip;</p>
                                        <small class="text-muted">14.07.2014</small>
                                    </li>
                                    <li>
                                        <a href="#" class="btn btn-xs btn-primary btn-block">All Alerts</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                    <div class="header_user_actions dropdown">
                        <div data-toggle="dropdown" class="dropdown-toggle user_dropdown">
                            <div class="user_avatar">
                                <img src="assets/img/avatars/avatar08_tn.png" alt="" title="Carrol Clark (carrol@example.com)" width="38" height="38">
                            </div>
                            <span class="caret"></span>
                        </div>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="pages-user_profile.html">User Profile</a></li>
                            <li><a href="login_page.html">Log Out</a></li>
                        </ul>
                    </div>
                    <div class="search_section hidden-sm hidden-xs">
                        <input type="text" class="form-control input-sm">
                        <button class="btn btn-link btn-sm" type="button"><span class="icon_search"></span></button>
                    </div>
                </div>
            </header>

            <!-- breadcrumbs -->
            <nav id="breadcrumbs">
                <ul>
                    <li><a href="dashboard.html">Home</a></li>        </ul>
            </nav>

            <!-- main content -->
            <div id="main_wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6">
                            <div class="info_box_var_1 box_bg_a">
                                <div class="info_box_body">
                                    <span class="info_box_icon icon_group"></span>
                                    <span class="countUpMe" data-endVal="1342">1342</span>
                                </div>
                                <div class="info_box_footer">
                                    New Users
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="info_box_var_1 box_bg_b">
                                <div class="info_box_body">
                                    <span class="info_box_icon icon_cart_alt"></span>
                                    <span class="countUpMe" data-endVal="57">57</span>%
                                </div>
                                <div class="info_box_footer">
                                    Orders Completed
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="info_box_var_1 box_bg_c">
                                <div class="info_box_body">
                                    <span class="info_box_icon icon_wallet"></span>
                                    $<span class="countUpMe" data-endVal="13578">13 578</span>
                                </div>
                                <div class="info_box_footer">
                                    Sale
                                    <small>(last 24h)</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="info_box_var_1 box_bg_d">
                                <div class="info_box_body">
                                    <span class="info_box_icon icon_mail_alt"></span>
                                    <span class="countUpMe" data-endVal="531">531</span>
                                </div>
                                <div class="info_box_footer">
                                    Sent Messages
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row row_full">
                        <div class="col-lg-4">
                            <div class="easy_chart_wrapper">
                                <div class="easy_chart_a easy_chart" data-percent="86">
                                    <span class="easy_chart_percent"></span>
                                </div>
                                <div class="easy_chart_info">
                                    <h4 class="easy_chart_heading">Orders completed</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laboriosam doloremque mollitia possimus tempora&hellip; <a href="#">more</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="easy_chart_wrapper">
                                <div class="easy_chart_b easy_chart" data-percent="40">
                                    <span class="easy_chart_percent">136</span>
                                </div>
                                <div class="easy_chart_info">
                                    <h4 class="easy_chart_heading">Confirmed registrations</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laboriosam doloremque mollitia possimus tempora&hellip; <a href="#">more</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="easy_chart_wrapper">
                                <div class="easy_chart_c easy_chart" data-percent="72">
                                    <span class="easy_chart_icon icon_chat_alt"></span>
                                </div>
                                <div class="easy_chart_info">
                                    <h4 class="easy_chart_heading">New comments</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laboriosam doloremque mollitia possimus tempora&hellip; <a href="#">more</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="heading_a"><span class="heading_text">Audience (location)</span></div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div id="world_map_vector" style="width:100%;height:300px">
                                        <script>
                                            countries_data = {
                                                "US": 2320,
                                                "BR": 1945,
                                                "IN": 1779,
                                                "AU": 1486,
                                                "TR": 1024,
                                                "CN": 753
                                            };
                                        </script>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <table class="table table-yuk">
                                        <thead>
                                        <tr>
                                            <th colspan="2">Location</th>
                                            <th>Visits</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="cw"><span class="flag-US"></span></td>
                                            <td>United States</td>
                                            <td>2320</td>
                                        </tr>
                                        <tr>
                                            <td class="cw"><span class="flag-BR"></span></td>
                                            <td>Brazil</td>
                                            <td>1945</td>
                                        </tr>
                                        <tr>
                                            <td class="cw"><span class="flag-IN"></span></td>
                                            <td>India</td>
                                            <td>1779</td>
                                        </tr>
                                        <tr>
                                            <td class="cw"><span class="flag-AU"></span></td>
                                            <td>Australia</td>
                                            <td>1486</td>
                                        </tr>
                                        <tr>
                                            <td class="cw"><span class="flag-TR"></span></td>
                                            <td>Turkey</td>
                                            <td>1024</td>
                                        </tr>
                                        <tr>
                                            <td class="cw"><span class="flag-CN"></span></td>
                                            <td>China</td>
                                            <td>753</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row row_full">
                        <div class="col-md-12">
                            <div class="heading_a">
                                <span class="heading_text">Tasks assigned to Me</span>
                                <div class="pull-right">
                                    <a href="#"><i class="el-icon-tasks heading_icon"></i></a>
                                </div>
                            </div>
                            <ul class="list-group list_group_sep">
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-1"><span class="icon_star list_icon"></span></div>
                                        <div class="col-md-2">
                                            <div class="label label-danger">High</div>
                                        </div>
                                        <div class="col-md-2"><a href="#"><strong>YUK-31</strong></a></div>
                                        <div class="col-md-4"><span class="text-muted small">Lorem ipsum dolor sit amet&hellip;</span></div>
                                        <div class="col-md-3">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-danger" style="width: 28%">
                                                    <span class="sr-only">28% Complete</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-1"><span class="icon_star_alt list_icon"></span></div>
                                        <div class="col-md-2">
                                            <div class="label label-warning">Medium</div>
                                        </div>
                                        <div class="col-md-2"><a href="#"><strong>ARW-21</strong></a></div>
                                        <div class="col-md-4"><span class="text-muted small">Lorem ipsum dolor&hellip;</span></div>
                                        <div class="col-md-3">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-warning" style="width: 62%">
                                                    <span class="sr-only">62% Complete</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-1"><span class="icon_star_alt list_icon"></span></div>
                                        <div class="col-md-2">
                                            <div class="label label-success">Low</div>
                                        </div>
                                        <div class="col-md-2"><a href="#"><strong>YUK-63</strong></a></div>
                                        <div class="col-md-4"><span class="text-muted small">Lorem ipsum dolor sit&hellip;</span></div>
                                        <div class="col-md-3">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-success" style="width: 80%">
                                                    <span class="sr-only">80% Complete</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-1"><span class="icon_star list_icon"></span></div>
                                        <div class="col-md-2">
                                            <div class="label label-danger">High</div>
                                        </div>
                                        <div class="col-md-2"><a href="#"><strong>DES-31</strong></a></div>
                                        <div class="col-md-4"><span class="text-muted small">Lorem ipsum dolor&hellip;</span></div>
                                        <div class="col-md-3">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-danger" style="width: 12%">
                                                    <span class="sr-only">12% Complete</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <div class="heading_a">
                                <span class="heading_text">Quick Settings</span>

                                <div class="pull-right">
                                    <a href="#"><i class="el-icon-cog heading_icon"></i></a>
                                </div>
                            </div>
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <div class="pull-right">
                                        <input type="checkbox" class="js-switch mini-switch" checked>
                                    </div>
                                    Site Online
                                </li>
                                <li class="list-group-item">
                                    <div class="pull-right">
                                        <input type="checkbox" class="js-switch mini-switch">
                                    </div>
                                    Cache Enabled
                                </li>
                                <li class="list-group-item">
                                    <div class="pull-right">
                                        <input type="checkbox" class="js-switch mini-switch" checked>
                                    </div>
                                    Catalog Mode
                                </li>
                                <li class="list-group-item">
                                    <div class="pull-right">
                                        <input type="checkbox" class="js-switch-blue mini-switch" checked>
                                    </div>
                                    Statistics
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="heading_a">
                                <span class="heading_text">Orders</span>
                            </div>
                            <div id="c3_orders" style="height:220px"></div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="heading_a">
                                <span class="heading_text">Users (by age)</span>
                            </div>
                            <div id="c3_users_age" style="height:220px"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="heading_a">
                                <span class="heading_text">Sales</span>
                                <div class="pull-right">
                                    <button class="btn btn-xs btn-default chart_switch" data-chart="line">Line</button>
                                    <button class="btn btn-xs btn-link chart_switch" data-chart="bar">Bar</button>
                                </div>
                            </div>
                            <div id="c3_7_days" style="height:280px"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- main menu -->
            <nav id="main_menu">
                <ul>
                    <li class="first_level">
                        <a href="dashboard.html">
                            <span class="icon_house_alt first_level_icon"></span>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="first_level">
                        <a href="javascript:void(0)">
                            <span class="icon_document_alt first_level_icon"></span>
                            <span class="menu-title">Forms</span>
                        </a>
                        <ul>
                            <li class="submenu-title">Forms</li>
                            <li><a href="forms-regular_elements.html">Regular Elements</a></li>
                            <li><a href="forms-extended_elements.html">Extended Elements</a></li>
                            <li><a href="forms-gridforms.html">Gridforms</a></li>
                            <li><a href="forms-validation.html">Validation</a></li>
                            <li><a href="forms-wizard.html">Wizard</a></li>
                        </ul>
                    </li>
                    <li class="first_level">
                        <a href="javascript:void(0)">
                            <span class="icon_folder-alt first_level_icon"></span>
                            <span class="menu-title">Pages</span>
                            <span class="label label-danger">7</span>
                        </a>
                        <ul>
                            <li class="submenu-title">Pages</li>
                            <li><a href="pages-chat.html">Chat</a></li>
                            <li><a href="error_404.html">Error 404</a></li>
                            <li><a href="pages-help_faq.html">Help/Faq</a></li>
                            <li><a href="pages-invoices.html">Invoices</a></li>
                            <li><a href="pages-mailbox.html">Mailbox</a></li>
                            <li><a href="pages-search_page.html">Search Page</a></li>
                            <li><a href="pages-user_list.html">User List</a></li>
                            <li><a href="pages-user_profile.html">User Profile</a></li>
                        </ul>
                    </li>
                    <li class="first_level">
                        <a href="javascript:void(0)">
                            <span class="icon_puzzle first_level_icon"></span>
                            <span class="menu-title">Components</span>
                        </a>
                        <ul>
                            <li class="submenu-title">Components</li>
                            <li><a href="components-bootstrap.html">Bootstrap</a></li>
                            <li><a href="components-gallery.html">Gallery</a></li>
                            <li><a href="components-grid.html">Grid</a></li>
                            <li><a href="components-icons.html">Icons</a></li>
                            <li><a href="components-notifications_popups.html">Notifications/Popups</a></li>
                            <li><a href="components-typography.html">Typography</a></li>
                        </ul>
                    </li>
                    <li class="first_level">
                        <a href="javascript:void(0)">
                            <span class="icon_lightbulb_alt first_level_icon"></span>
                            <span class="menu-title">Plugins</span>
                            <span class="label label-danger">6</span>
                        </a>
                        <ul>
                            <li class="submenu-title">Plugins</li>
                            <li><a href="plugins-calendar.html">Calendar</a></li>
                            <li><a href="plugins-charts.html">Charts</a></li>
                            <li><a href="plugins-google_maps.html">Google Maps</a></li>
                            <li><a href="plugins-tables_footable.html">Tables</a></li>
                            <li><a href="plugins-vector_maps.html">Vector Maps</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="menu_toggle">
                    <span class="icon_menu_toggle">
                        <i class="arrow_carrot-2left toggle_left"></i>
                        <i class="arrow_carrot-2right toggle_right" style="display:none"></i>
                    </span>
                </div>
            </nav>

        </div>

        <!-- jQuery -->
        <script src="assets/js/jquery.min.js"></script>
        <!-- jQuery Cookie -->
        <script src="assets/js/jqueryCookie.min.js"></script>
        <!-- Bootstrap Framework -->
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <!-- retina images -->
        <script src="assets/js/retina.min.js"></script>

        <!-- Yukon Admin functions -->
        <script src="assets/js/yukon_all.js"></script>

	    <!-- page specific plugins -->

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
                })
            </script>
		
        <!-- style switcher -->
        <div id="style_switcher">
            <a class="switcher_toggle"><i class="icon_cog"></i></a>
            <div class="style_items">
                <div class="heading_b"><span class="heading_text">Top Bar Color</span></div>
                <ul class="clearfix" id="topBar_style_switch">
                    <li class="sw_tb_style_0 style_active" title=""><span class="icon_check_alt2"></span></li> <li class="sw_tb_style_1" title="topBar_style_1"><span class="icon_check_alt2"></span></li> <li class="sw_tb_style_2" title="topBar_style_2"><span class="icon_check_alt2"></span></li> <li class="sw_tb_style_3" title="topBar_style_3"><span class="icon_check_alt2"></span></li> <li class="sw_tb_style_4" title="topBar_style_4"><span class="icon_check_alt2"></span></li> <li class="sw_tb_style_5" title="topBar_style_5"><span class="icon_check_alt2"></span></li> <li class="sw_tb_style_6" title="topBar_style_6"><span class="icon_check_alt2"></span></li> <li class="sw_tb_style_7" title="topBar_style_7"><span class="icon_check_alt2"></span></li> <li class="sw_tb_style_8" title="topBar_style_8"><span class="icon_check_alt2"></span></li> <li class="sw_tb_style_9" title="topBar_style_9"><span class="icon_check_alt2"></span></li> <li class="sw_tb_style_10" title="topBar_style_10"><span class="icon_check_alt2"></span></li> <li class="sw_tb_style_11" title="topBar_style_11"><span class="icon_check_alt2"></span></li> <li class="sw_tb_style_12" title="topBar_style_12"><span class="icon_check_alt2"></span></li> <li class="sw_tb_style_13" title="topBar_style_13"><span class="icon_check_alt2"></span></li> <li class="sw_tb_style_14" title="topBar_style_14"><span class="icon_check_alt2"></span></li>
                </ul>
            </div>
            <div class="style_items hidden-sm hidden-md" id="layout_switch">
                <div class="heading_b"><span class="heading_text">Layout</span></div>
                <select class="form-control input-sm" id="layout_style_switch">
                    <option value="full_width">Full Width</option>
                    <option value="fixed">Fixed</option>
                </select>
            </div>
        </div>

    </body>
</html>
