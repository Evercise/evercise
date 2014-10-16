<?php
	require_once 'php/faker/autoload.php';
	$faker = Faker\Factory::create();

    $admin_version = '1.1';

    function dateRange( $first, $last, $step = '+1 day', $format = 'D d.m.Y' ) {

        $dates = array();
        $current = strtotime( $first );
        $last = strtotime( $last );

        while( $current <= $last ) {

            $dates[] = date( $format, $current );
            $current = strtotime( $step, $current );
        }

        return $dates;
    }

    $tags = array( 'advertising', 'ajax', 'business', 'company', 'creative', 'css', 'design', 'designer', 'developer', 'e-commerce', 'finance', 'graphic', 'home', 'internet', 'javascript', 'marketing', 'mysql', 'online', 'photoshop', 'service', 'software', 'webdesign', 'website' );

    $sPage = $_GET['page'];
	if( !isset($sPage) ) $sPage = 'dashboard';

    if($sPage == "dashboard") {
		$includePage = 'php/pages/dashboard.php';
		$script = '
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
		';
	}

    if($sPage == "forms-regular_elements") {
		$includePage = 'php/pages/forms-regular_elements.php';
		$breadcrumbs = '<li><span>Forms</span></li><li><span>Regular Elements</span></li>';
	}

    if($sPage == "forms-extended_elements") {
		$includePage = 'php/pages/forms-extended_elements.php';
		$breadcrumbs = '
                    <li><span>Forms</span></li>
                    <li><span>Extended Elements</span></li>
        ';
        $css = '
            <!-- select2 -->
            <link href="assets/lib/select2/select2.css" rel="stylesheet" media="screen">
            <!-- datepicker -->
            <link href="assets/lib/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" media="screen">
            <!-- date range picker -->
            <link href="assets/lib/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" media="screen">
            <!-- rangeSlider -->
            <link href="assets/lib/ion.rangeSlider/css/ion.rangeSlider.css" rel="stylesheet" media="screen">
            <link href="assets/lib/ion.rangeSlider/css/ion.rangeSlider.skinFlat.css" rel="stylesheet" media="screen">
            <!-- uplaoder -->
            <link href="assets/lib/plupload/js/jquery.plupload.queue/css/jquery.plupload.queue.css" rel="stylesheet" media="screen">
		';
        $script = '
            <!-- select2 -->
            <script src="assets/lib/select2/select2.min.js"></script>
            <!-- datepicker -->
            <script src="assets/lib/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
            <!-- date range picker -->
            <script src="assets/lib/bootstrap-daterangepicker/daterangepicker.js"></script>
            <!-- rangeSlider -->
            <script src="assets/lib/ion.rangeSlider/js/ion-rangeSlider/ion.rangeSlider.min.js"></script>
            <!-- switchery -->
            <script src="assets/lib/switchery/dist/switchery.min.js"></script>
            <!-- autosize -->
            <script src="assets/lib/autosize/jquery.autosize.min.js"></script>
            <!-- inputmask -->
            <script src="assets/lib/jquery.inputmask/jquery.inputmask.bundle.min.js"></script>
            <!-- maxlength for textareas -->
            <script src="assets/lib/stopVerbosity/stopVerbosity.min.js"></script>
            <!-- uplaoder -->
            <script src="assets/lib/plupload/js/plupload.full.min.js"></script>
            <script src="assets/lib/plupload/js/jquery.plupload.queue/jquery.plupload.queue.min.js"></script>
            <!-- wysiwg editor -->
            <script src="assets/lib/ckeditor/ckeditor.js"></script>
            <script src="assets/lib/ckeditor/adapters/jquery.js"></script>

            <script>
                $(function() {
                    // select2
                    yukon_select2.p_forms_extended();
                    // datepicker
                    yukon_datepicker.p_forms_extended();
                    // date range picker
                    yukon_date_range_picker.p_forms_extended();
                    // rangeSlider
                    yukon_rangeSlider.p_forms_extended();
                    // switchery
                    yukon_switchery.init();
                    // textarea autosize
                    yukon_textarea_autosize.init();
                    // masked inputs
                    yukon_maskedInputs.p_forms_extended();
                    // maxlength for textareas
                    yukon_textarea_maxlength.p_forms_extended();
                    // multiuploader
                    yukon_uploader.p_forms_extended();
                    // wysiwg editor
                    yukon_wysiwg.p_forms_extended_elements();
                })
            </script>
        ';
	}

    if($sPage == "forms-gridforms") {
		$includePage = 'php/pages/forms-gridforms.php';
		$breadcrumbs = '
		            <li><span>Forms</span></li>
		            <li><span>Gridforms</span></li>
        ';
        $css = '
            <!-- gridforms -->
            <link href="assets/lib/gridforms/gf-forms.min.css" rel="stylesheet" media="screen">
		';
        $script = '
            <!-- gridforms -->
            <script src="assets/lib/gridforms/gf-forms.min.js"></script>
        ';
	}

    if($sPage == "forms-validation") {
		$includePage = 'php/pages/forms-validation.php';
		$breadcrumbs = '
		            <li><span>Forms</span></li>
		            <li><span>Validation</span></li>
        ';
        $css = '
            <!-- select2 -->
            <link href="assets/lib/select2/select2.css" rel="stylesheet" media="screen">
		';
        $script = '
            <!-- select2 -->
            <script src="assets/lib/select2/select2.min.js"></script>
            <!-- validation (parsley.js) -->
            <script src="assets/js/parsley.config.js"></script>
            <script src="assets/lib/parsley/dist/parsley.min.js"></script>
            <!-- wysiwg editor -->
            <script src="assets/lib/ckeditor/ckeditor.js"></script>
            <script src="assets/lib/ckeditor/adapters/jquery.js"></script>

            <script>
                $(function() {
                    // wysiwg editor
                    yukon_wysiwg.p_forms_validation();
                    // multiselect
                    yukon_select2.p_forms_validation();
                    // validation
                    yukon_parsley_validation.p_forms_validation();
                })
            </script>
        ';
	}

    if($sPage == "forms-wizard") {
		$includePage = 'php/pages/forms-wizard.php';
		$breadcrumbs = '
		            <li><span>Forms</span></li>
		            <li><span>Wizard</span></li>
		';
        $css = '
            <!-- select2 -->
            <link href="assets/lib/select2/select2.css" rel="stylesheet" media="screen">
            <!-- prism highlight -->
            <link href="assets/lib/prism/prism_default.css" rel="stylesheet" media="screen">
            <link href="assets/lib/prism/line_numbers.css" rel="stylesheet" media="screen">
		';
        $script = '
            <!-- select2 -->
            <script src="assets/lib/select2/select2.min.js"></script>
            <!-- prism highlight -->
            <script src="assets/lib/prism/prism.min.js"></script>
            <!-- jquery steps -->
            <script src="assets/js/jquery.steps.custom.min.js"></script>
            <!-- validation (parsley.js) -->
            <script src="assets/js/parsley.config.js"></script>
            <script src="assets/lib/parsley/dist/parsley.min.js"></script>

            <script>
                $(function() {
                    // wizard
                    yukon_steps.init();
                    // select2 country,languages
                    yukon_select2.p_forms_wizard();
                    // form validation
                    yukon_parsley_validation.p_forms_wizard();
                })
            </script>
        ';
	}

    if($sPage == "pages-chat") {
		$includePage = 'php/pages/pages-chat.php';
		$breadcrumbs = '
		            <li><span>Pages</span></li>
		            <li><span>Chat</span></li>
		';
        $script = '
            <script>
                $(function() {
                    // chat
                    yukon_chat.init();
                })
            </script>
        ';
	}

    if($sPage == "pages-help_faq") {
		$includePage = 'php/pages/pages-help_faq.php';
		$breadcrumbs = '
                    <li><span>Pages</span></li>
                    <li><span>Help/Faq</span></li>
		';
 	}

    if($sPage == "pages-invoices") {
		$includePage = 'php/pages/pages-invoices.php';
		$breadcrumbs = '
		            <li><span>Pages</span></li>
		            <li><span>Invoices</span></li>
		';
        $script = '
            <!-- qrcode -->
            <script src="assets/lib/jquery-qrcode-0.10.1/jquery.qrcode-0.10.1.min"></script>

            <script>
                $(function() {
                    // qrcode
                    yukon_qrcode.p_pages_invoices();
                })
            </script>
        ';
	}

    if($sPage == "pages-mailbox") {
		$includePage = 'php/pages/pages-mailbox.php';
		$breadcrumbs = '
		            <li><span>Pages</span></li>
		            <li><span>Mailbox</span></li>
		';
        $css = '
            <!-- footable -->
            <link href="assets/lib/footable/css/footable.core.min.css" rel="stylesheet" media="screen">
		';
        $script = '
            <!-- footable -->
            <script src="assets/lib/footable/footable.min.js"></script>
            <script src="assets/lib/footable/footable.paginate.min.js"></script>
            <script src="assets/lib/footable/footable.filter.min.js"></script>

            <script>
                $(function() {
                    // footable
                    yukon_footable.p_pages_mailbox();

                    yukon_mailbox.init();
                })
            </script>
        ';
	}

    if($sPage == "pages-mailbox_message") {
		$includePage = 'php/pages/pages-mailbox_message.php';
		$breadcrumbs = '
                    <li><span>Pages</span></li>
                    <li><a href="pages-mailbox.html">Mailbox</a></li>
                    <li><span>Details</span></li>
		';
	}

    if($sPage == "pages-search_page") {
		$includePage = 'php/pages/pages-search_page.php';
		$breadcrumbs = '
		            <li><span>Pages</span></li>
		            <li><span>Search Page</span></li>
		';
	}

    if($sPage == "pages-user_list") {
		$includePage = 'php/pages/pages-user_list.php';
		$breadcrumbs = '
                    <li><span>Pages</span></li>
                    <li><span>User List</span></li>
		';
        $script = '
            <!-- iOS list -->
            <script src="assets/lib/jquery-listnav/dist/js/jquery-listnav-2.4.0.min.js"></script>

            <script>
                $(function() {
                    // count users
                    yukon_user_list.init();

                    // iOS list
                    yukon_listNav.p_pages_user_list();
                })
            </script>
        ';
	}

    if($sPage == "pages-user_profile") {
		$includePage = 'php/pages/pages-user_profile.php';
		$breadcrumbs = '
		            <li><span>Pages</span></li>
		            <li><span>User Profile</span></li>
		';
        $script = '
            <!-- easePie chart -->
            <script src="assets/lib/easy-pie-chart/dist/jquery.easypiechart.min.js"></script>

            <script>
                $(function() {
                    // easePie chart
                    yukon_easyPie_chart.p_pages_user_profile();
                })
            </script>
        ';
	}

    if($sPage == "components-bootstrap") {
		$includePage = 'php/pages/components-bootstrap.php';
		$breadcrumbs = '
		            <li><span>Components</span></li>
		            <li><span>Bootstrap Framework</span></li>
		';
	}

    if($sPage == "components-gallery") {
		$includePage = 'php/pages/components-gallery.php';
		$breadcrumbs = '
		            <li><span>Components</span></li>
		            <li><span>Gallery</span></li>
		';
        $css = '
            <!-- magnific -->
            <link href="assets/lib/magnific-popup/magnific-popup.css" rel="stylesheet" media="screen">
		';
        $script = '
            <!-- magnific -->
            <script src="assets/lib/magnific-popup/jquery.magnific-popup.min.js"></script>

            <script>
                $(function() {
                    // gallery filter
                    yukon_gallery.search_gallery();
                    // magnific lightbox
                    yukon_magnific.p_components_gallery();
                })
            </script>
        ';
	}

    if($sPage == "components-grid") {
		$includePage = 'php/pages/components-grid.php';
		$breadcrumbs = '
		            <li><span>Components</span></li>
		            <li><span>Grid</span></li>
		';
	}

    if($sPage == "components-icons") {
		$includePage = 'php/pages/components-icons.php';
		$breadcrumbs = '
		            <li><span>Components</span></li>
		            <li><span>Icons</span></li>
		';
        $script = '
            <script>
                $(function() {
                    // icon filter
                    yukon_icons.search_icons();
                })
            </script>
        ';
	}

    if($sPage == "components-notifications_popups") {
		$includePage = 'php/pages/components-notifications_popups.php';
		$breadcrumbs = '
		            <li><span>Components</span></li>
		            <li><span>Notifications/Popups</span></li>
		';
        $css = '
            <!-- jBox -->
            <link href="assets/lib/jBox-0.3.0/Source/jBox.css" rel="stylesheet" media="screen">
            <link href="assets/lib/jBox-0.3.0/Source/themes/NoticeBorder.css" rel="stylesheet" media="screen">
		';
        $script = '
            <!-- jBox -->
            <script src="assets/lib/jBox-0.3.0/Source/jBox.min.js"></script>

            <script>
                $(function() {
                    // jBox
                    yukon_jBox.p_components_notifications_popups();
                })
            </script>
        ';
	}

    if($sPage == "components-typography") {
		$includePage = 'php/pages/components-typography.php';
		$breadcrumbs = '
		            <li><span>Components</span></li>
		            <li><span>Typography</span></li>
		';
	}

    if($sPage == "plugins-calendar") {
		$includePage = 'php/pages/plugins-calendar.php';
		$breadcrumbs = '
                    <li><span>Plugins</span></li>
                    <li><span>Calendar</span></li>
		';
        $css = '
            <!-- full calendar -->
            <link href="assets/lib/fullcalendar/fullcalendar.css" rel="stylesheet" media="screen">
		';
        $script = '
            <!-- jquery UI -->
            <script src="assets/lib/fullcalendar/lib/jquery-ui.custom.min.js"></script>
            <!-- full calendar -->
            <script src="assets/lib/fullcalendar/fullcalendar.min.js"></script>
            <script src="assets/lib/fullcalendar/gcal.js"></script>
            <script>
                $(function() {
                    // full calendar
                    yukon_fullCalendar.p_plugins_calendar();
                })
            </script>
        ';
	}

    if($sPage == "plugins-charts") {
		$includePage = 'php/pages/plugins-charts.php';
		$breadcrumbs = '
		            <li><span>Plugins</span></li>
		            <li><span>Charts</span></li>
		';
        $script = '
            <!-- c3 charts -->
            <script src="assets/lib/d3/d3.min.js"></script>
            <script src="assets/lib/c3/c3.min.js"></script>
            <script>
                $(function() {
                    // c3 charts
                    yukon_charts.p_plugins_charts();
                })
            </script>
        ';
	}

    if($sPage == "plugins-google_maps") {
		$includePage = 'php/pages/plugins-google_maps.php';
		$breadcrumbs = '
		            <li><span>Plugins</span></li>
		            <li><span>Google Maps</span></li>
		';
        $script = '
            <!-- gmaps -->
            <script src="assets/lib/gmaps/gmaps.js"></script>
            <script>
                $(function() {
                    // gmaps
                    yukon_gmaps.init();
                })
            </script>
        ';
	}

    if($sPage == "plugins-tables_footable") {
		$includePage = 'php/pages/plugins-tables_footable.php';
		$breadcrumbs = '
		            <li><span>Plugins</span></li>
		            <li><span>Tables</span></li>
		            <li><span>Footable</span></li>
		';
        $css = '
            <!-- footable -->
            <link href="assets/lib/footable/css/footable.core.min.css" rel="stylesheet" media="screen">
        ';
        $script = '
            <!-- footable -->
            <script src="assets/lib/footable/footable.min.js"></script>
            <script src="assets/lib/footable/footable.paginate.min.js"></script>
            <script src="assets/lib/footable/footable.filter.min.js"></script>

            <script>
                $(function() {
                    // footable
                    yukon_footable.p_plugins_tables_footable();
                })
            </script>
        ';
	}

    if($sPage == "plugins-tables_datatable") {
		$includePage = 'php/pages/plugins-tables_datatable.php';
		$breadcrumbs = '
		            <li><span>Plugins</span></li>
		            <li><span>Tables</span></li>
		            <li><span>Datatable</span></li>
		';
        $script = '
            <!-- datatable -->
            <script src="assets/lib/DataTables/media/js/jquery.dataTables.min.js"></script>
            <script src="assets/lib/DataTables/extensions/FixedHeader/js/dataTables.fixedHeader.min.js"></script>
            <script src="assets/lib/DataTables/media/js/dataTables.bootstrap.js"></script>

            <script>
                $(function() {
                    // footable
                    yukon_datatables.p_plugins_tables_datatable();
                })
            </script>
        ';
	}

    if($sPage == "plugins-vector_maps") {
		$includePage = 'php/pages/plugins-vector_maps.php';
		$breadcrumbs = '
		            <li><span>Plugins</span></li>
		            <li><span>Vector Maps</span></li>
		';
        $script = '
            <!-- vector maps -->
            <script src="assets/lib/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
            <script src="assets/lib/jvectormap/maps/jquery-jvectormap-world-mill-en.js"></script>
            <script src="assets/lib/jvectormap/maps/jquery-jvectormap-ca-mill-en.js"></script>

            <script>
                $(function() {
                    // vector maps
                    yukon_vector_maps.p_plugins_vector_maps();
                })
            </script>
        ';
	}