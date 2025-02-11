<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HTML Sitemap</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        h1 {
            color: #333;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            margin: 5px 0;
        }

        a {
            text-decoration: none;
            color: #007bff;
        }
    </style>
</head>

<body>
    <h1>HTML Sitemap</h1>
    <ul>
        @foreach ($urls as $url)
            <li><a href="{{ $url['loc'] }}" target="_blank">{{ $url['loc'] }}</a></li>
        @endforeach
    </ul>
</body>

</html>
