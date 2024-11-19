<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <title>Restauranty</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>

<body class="font-kantumruy w-full bg-white h-full overflow-x-hidden">

@livewireScripts

@include('layout.components.errors')

@include('layout.components.success')

@if(request()->attributes->get('header'))
    @include('layout.components.header')
@endif
@yield('content')

</body>

</html>
