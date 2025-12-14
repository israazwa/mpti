{{-- <div>
    <!-- Simplicity is an acquired taste. - Katharine Gerould -->
</div> --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Welcome Guess'; ?></title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @include('users.components.header')
    @include('users.components.hero')
    @include('users.components.topProduct')
    @include('users.components.costom')
    @include('users.components.whyUs')
    @include('users.components.footer')
</body>
</html>