<!DOCTYPE html>
<html>
    <head>
		<meta charset="UTF-8">
		<title>{{ $title or "EVercise Admin" }}</title>
        <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
        <!-- favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">

        <!-- bootstrap framework -->
		<link href="/admin/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">

        <!-- icon sets -->
            <!-- elegant icons -->
                <link href="/admin/assets/icons/elegant/style.css" rel="stylesheet" media="screen">
            <!-- elusive icons -->
                <link href="/admin/assets/icons/elusive/css/elusive-webfont.css" rel="stylesheet" media="screen">
            <!-- flags -->
                <link rel="stylesheet" href="/admin/assets/icons/flags/flags.css">

        @yield('css')

        <!-- select2 -->
        <link href="/admin/assets/lib/select2/select2.css" rel="stylesheet" media="screen">

        <!-- google webfonts -->
		<link href='//fonts.googleapis.com/css?family=Open+Sans&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>

        <!-- main stylesheet -->
		<link href="/admin/assets/css/main.css" rel="stylesheet" media="screen" id="mainCss">

        <!-- moment.js (date library) -->
        <script src="/admin/assets/js/moment-with-langs.min.js"></script>

    </head>
    <body class="side_menu_active side_menu_expanded fx_width">
        <div id="page_wrapper">
            @include('admin.include.header')

            @include('admin.include.breadcrumbs')

            <!-- main content -->
            <div id="main_wrapper">
                <div class="container-fluid">
                    @yield('body')
                </div>
            </div>

            @include('admin.include.side_menu')


        </div>

        <!-- jQuery -->
        <script src="/admin/assets/js/jquery.min.js"></script>
        <!-- jQuery Cookie -->
        <script src="/admin/assets/js/jqueryCookie.min.js"></script>
        <!-- Bootstrap Framework -->
        <script src="/admin/assets/bootstrap/js/bootstrap.min.js"></script>
        <!-- retina images -->
        <script src="/admin/assets/js/retina.min.js"></script>

        <!-- Yukon Admin functions -->
        <script src="/admin/assets/js/yukon_all.js"></script>
        <!-- Yukon Admin functions -->
        <script src="/assets/application.js"></script>

        @yield('script')

        <script>
            var DEBUG_APP = <?=getenv('DEBUG_APP') ? 'true' : 'false'?>;
            var BASE_URL = '{{ URL::to('/').'/' }}';
            var AJAX_URL = '{{ URL::to('/ajax').'/admin/' }}';
        </script>

        <!-- select2 -->
        <script src="/admin/assets/lib/select2/select2.min.js"></script>

        <script>
            function getURLParameter(name) {
                return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search)||[,""])[1].replace(/\+/g, '%20'))||null
            }

            var category_updates = {};

            var urlParams = {};
            urlParams.status = getURLParameter('status');
            urlParams.search = getURLParameter('search');
            urlParams.order = getURLParameter('order');

            var pageName = (window.location.href.split('/').pop()).split('?')[0];

            $( document ).ready( function(){
                $('#select_user_type').change(function(){
                    window.location.href = $(this).val();
                });
                $('#select_category_type').change(function(){
                    window.location.href = $(this).val();
                });

                $('#select_status').change(function(){
                    urlParams.status = $(this).val();
                    reloadWithParams();
                });

                initPut('{"selector": ".reset_password"}');
                initPut('{"selector": ".unapprove_trainer"}');

                $('#user_list li').click(function(){
                    $(this).find('.user-table').slideToggle(500);
                });
/*                $('.user-table tr').click(function(e){
                    e.stopPropagation();
                    trace($(this).attr('id'));
                });*/

                // ----- TRAINERS, GROUPS -----
                $('#search button').click(function(e){
                    e.stopPropagation();
                    urlParams.search = $('#search input').val();
                    reloadWithParams();

                   window.location.href = linkTo;
                });

                // ----- SUBCATEGORIES -----
                $('#category_list select').change(function(){
                    //trace( $(this).val() );
                    //trace( $(this).attr('name') );
                    var row = $(this).closest('tr');
                    var sub = row.data('subid');

                    var selects = row.find('select');
                    var values = '';
                    for (var i=0; i<selects.length; i++) {
                        //trace(selects[i].value);
                        if (i!=0) values += '_';
                        values += selects[i].value;
                    }

                    category_updates[sub] = values ;

                    var output = '';
                    for (var key in category_updates) {
                        output = output + key+'='+category_updates[key]+'-';
                    }

                    $('#update_categories').val(output);
                    console.debug(output);


                });

                //yukon_select2.p_forms_extended();

                $('.associations_label').click(function(e){
                    var input = $(this).next('input');
                    if(input.length) {
                        var update_associations = $('#update_associations');
                        update_associations.val(update_associations.val() + input.data('id')+',');
                        trace(update_associations.val());
                        $(this).hide();
                        input.show();
                        input.val(input.data('value'));
                        input.select2({
                            placeholder: "Type here...",
                            tags:[],
                            tokenSeparators: [",", " "]
                        });
                        //input.focus();
                    }
                });

                // ----- CATEGORIES -----
                $('.categories_label').click(function(e){
                    //trace(category_list);

                    var category_array = $.parseJSON(category_list);
                    var input = $(this).next('input');
                    if(input.length) {
                        var update_categories = $('#update_categories');
                        update_categories.val(update_categories.val() + input.data('id')+',');
                        //trace(update_categories.val());
                        $(this).hide();
                        input.show();
                        input.val(input.data('value'));
                        input.select2({
                            placeholder: "Type here...",
                            tags:category_array,
                            tokenSeparators: [","]
                        });
                        //input.focus();
                    }
                });

                $('.featured').click(function(e){
                    var update_categories = $('#update_categories');
                    update_categories.val(update_categories.val() + $(this).data('id')+',');
                });

                $('#sort_by_name').click(function(e){
                    urlParams.order = 'name';
                    reloadWithParams();
                });

                initPut('{"selector": "#edit_subcategories"}');
                initPut('{"selector": "#add_subcategory"}');
                initPut('{"selector": "#edit_classes"}');

            });

            function reloadWithParams()
            {
                var linkTo = pageName+'?'
                    + (urlParams.status != '' ? 'status='+urlParams.status+'&' : '')
                    + (urlParams.order ? 'order='+urlParams.order+'&' : '')
                    + (urlParams.search != '' ? 'search='+urlParams.search+'' : '');
                window.location.href = linkTo;
            }

        </script>


    </body>
</html>