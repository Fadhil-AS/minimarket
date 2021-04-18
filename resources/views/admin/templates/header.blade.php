<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Minimarket</title>
    <link href="{{asset('assets')}}/css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    <script src="{{asset('assets')}}/swal2/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="{{asset('assets')}}/swal2/dist/sweetalert2.min.css">
    @stack('style')
</head>

<div>
    @yield('content')
</div>

@include('admin.templates.script')