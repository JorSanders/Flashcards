<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('layouts.head')
    <title>@yield('title', config('app.name', 'Laravel')) </title>
</head>
<body>

@include('layouts.navbar')

@include('layouts.body')

@include('layouts.footer')

</body>
</html>
