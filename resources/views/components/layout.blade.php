<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Add your stylesheets and scripts here -->
</head>
<body>
    <header>
        {{ $header }}
    </header>
    <main>
        {{ $slot }}
    </main>
</body>
</html> 