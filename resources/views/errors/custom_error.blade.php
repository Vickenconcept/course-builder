<!DOCTYPE html>
<html>

<head>
    <title>Error</title>
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <link href="{{ asset('build/assets/app-7cac587f.css') }}" rel='stylesheet'>
    <link href="{{ asset('build/assets/app-a461d729.css') }}" rel='stylesheet'>
</head>

<body class="flex justify-center">
    <div class="text-center mt-12 text-gray-700">
        <h1 class="text-4xl mb-2">Something went wrong</h1>
        <p class="mb-4">We're sorry, but something unexpected happened. Please try again later or contact support for assistance.</p>
        <x-main-button><a href="{{ route('login') }}">Go back to home</a></x-main-button>
    </div>
    <script src="{{ asset('build/assets/app-dd6eec69.js') }}"></script>
</body>

</html>