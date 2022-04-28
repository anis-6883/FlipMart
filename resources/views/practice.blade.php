<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @foreach ($subcategories as $sc)
        <p>{{ $sc->subcategory_name }} => <b>{{ $sc->category->category_name }}</b></p>
    @endforeach
</body>
</html>