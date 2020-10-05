<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ Session::token() }}">
    <title>Contact List</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="icon" href="favicon.ico">


    <link rel="stylesheet" href="{{url('assets/css/vendor.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/autocomplete.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/elephant.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/application.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/dropzone.css')}}">



  </head>
  <body class="layout">

    <div class="layout-main">


    <script src="{{url('assets/js/vendor.min.js')}}"></script>
    <script src="{{url('assets/js/jquery.autocomplete.min.js')}}"></script>
    <script src="{{url('assets/js/jquery.maskMoney.js')}}"></script>
    <script src="{{url('assets/js/elephant.min.js')}}"></script>
    <script src="{{url('assets/js/application.min.js')}}"></script>
    <script src="{{url('assets/js/dropzone.js')}}"></script>

        @yield('content')



      <div class="layout-footer">
        <div class="layout-footer-body">

        </div>
      </div>
    </div>





  </body>
</html>
