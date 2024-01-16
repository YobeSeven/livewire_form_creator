<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{env("APP_NAME")}}</title>
    @vite(["resources/js/app.js"])
    @livewireStyles
</head>
<body>
    @include("layouts.flash")
    <a href="{{route("forms.index")}}">
        <h1>All Form</h1>
    </a>
    @yield("content")
    @livewireScripts
</body>
</html>
