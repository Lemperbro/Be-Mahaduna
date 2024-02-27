<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('img/logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet" />
    @stack('head')
    <style>
        div.fr-quick-insert a.fr-floating-btn{
            display: flex;
            margin: auto;
            align-items: center;
        }
    </style>
    <title>Ma'haduNA</title>
</head>

<body class="bg-main">
