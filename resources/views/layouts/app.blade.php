<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Desarrollo Academico ITO </title>
    <link rel="icon" type="image/x-icon" href="{{ asset('/Template/src/assets/img/logoITO.png') }}" >
    <link href="{{ asset('/Template/layouts/vertical-light-menu/css/light/loader.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('/Template/layouts/vertical-light-menu/css/dark/loader.css') }}" rel="stylesheet" type="text/css" >
    <script src="{{ asset('/Template/layouts/vertical-light-menu/loader.js') }}"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset('/Template/src/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('/Template/layouts/vertical-light-menu/css/light/plugins.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('/Template/layouts/vertical-light-menu/css/dark/plugins.css') }}" rel="stylesheet" type="text/css" >
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link rel="stylesheet" href="{{ asset('/Template/src/plugins/src/filepond/filepond.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/Template/src/plugins/src/filepond/FilePondPluginImagePreview.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/Template/src/plugins/src/tagify/tagify.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('/Template/src/assets/css/light/forms/switches.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/Template/src/plugins/css/light/editors/quill/quill.snow.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/Template/src/plugins/css/light/tagify/custom-tagify.css') }}">
    <link href="{{ asset('Template/src/plugins/css/light/filepond/custom-filepond.css" rel="stylesheet" type="text/css') }}" >

    <link rel="stylesheet" type="text/css" href="{{ asset('/Template/src/assets/css/dark/forms/switches.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/Template/src/plugins/css/dark/editors/quill/quill.snow.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/Template/src/plugins/css/dark/tagify/custom-tagify.css') }}">
    <link href="{{ asset('/Template/src/plugins/css/dark/filepond/custom-filepond.css" rel="stylesheet" type="text/css') }}" >
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

</head>

<body>
    @yield('contenido')
</body>

</html>
