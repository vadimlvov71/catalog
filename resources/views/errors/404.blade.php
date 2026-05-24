<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8" />
    <title>{{ __('error404.404_title') }}</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            text-align: center; 
            padding-top: 100px;
            background-color: #f8f9fa;
            color: #333;
        }
        a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>404</h1>
    <h2>{{ __('error404.404_title') }}</h2>
    <p>{{ __('error404.404_message') }}</p>
    <a href="/{{ app()->getLocale() }}/">{{ __('error404.404_back_home') }}</a>
</body>
</html>
