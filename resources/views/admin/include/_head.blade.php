<head>
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title> @yield('title') </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('backend_assets/images/favicon.png') }}">
    <!-- Pignose Calender -->
    <link href="{{ asset('backend_assets/plugins/pg-calendar/css/pignose.calendar.min.css') }}" rel="stylesheet">
    <!-- Chartist -->
    <link rel="stylesheet" href="{{ asset('backend_assets/plugins/chartist/css/chartist.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend_assets/plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css') }}">
    <!-- DataTable -->
    <link href="{{asset('backend_assets/plugins/tables/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <!-- jqueryui date picker -->
    <link rel="stylesheet" href="{{asset('backend_assets/css/jquery-ui.css') }}">
    <!-- Custom Stylesheet -->
    <link href="{{ asset('backend_assets/css/style.css') }}" rel="stylesheet">
    <!-- TagsInput -->
    <link rel="stylesheet" href="{{ asset('backend_assets/css/tagsinput.css') }}">
    <!-- Rich Text Editor -->
    <!-- <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> -->
    <script src="{{ asset('backend_assets/js/richTextEditor/tinyRTE.js') }}"></script>
    <!-- jQuery library -->
    <script src="{{ asset('backend_assets/js/jQuery/jquery-3.6.0.js"') }}"></script>


    @yield('css')
</head>