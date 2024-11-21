<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        body,
        h2,
        p {
            font-family: "Times New Roman", Times, serif;
        }

        h1,
        h3,
        h5,
        h6 {
            text-align: center;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
    @yield('style')
</head>

<body>
    @yield('content')
</body>
</html>
