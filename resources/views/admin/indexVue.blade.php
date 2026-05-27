<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/js/app.js'])
</head>
   
<body>
    <script>
        window.appData = {
            locale: @json($locale)
        };
    </script>
    <div id="app"></div>
</body>