<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <title> @yield('title') </title>
    </head>
    <body>
        <form method="POST" action='/insert'>
            @csrf
            <div> 
                <label for="product_id">Product ID</label>
                <input type='text' name='product_id' maxlength='10'>
            </div>
            <div>
                <label for="title">Title</label>
                <input type='text' name='title'>
            </div>
            <div>
                <label for="price">Price</label>
                <input type='number' name='price' min=0>
            </div>
            <div>
                <label for="quantity">Quantity</label>
                <input type='number' name='quantity' min=0>
            </div>
            <a href='/'> <input type='submit' value='Apply'> </a>
        </form>
    </body>
</html>