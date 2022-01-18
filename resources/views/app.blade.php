<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" value="{{ csrf_token() }}"/>
    <title>Customer Information</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/app.css') }}" type="text/css" rel="stylesheet"/>
    <style>
        .bg-light {
            background-color: #eae9e9 !important;
        }
    </style>
</head>
<body>
<div id="app">
<app></app>
</div>
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.4.2/vue.js" defer></script>
<script src="../../node_modules/vuejs-datatable/dist/vuejs-datatable.js" defer></script>
<script src="/myscript.js" defer></script>--}}
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
