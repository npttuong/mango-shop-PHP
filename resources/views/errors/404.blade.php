<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>404 Not Found</title>
  <style>
    @import url('https://fonts.googleapis.com/css?family=Montserrat:300');

    body {
      background: #3498DB;
      color: #fff;
      font-family: 'Roboto', sans-serif;
      font-size: 16px;
    }

    h1 {
      font-size: 100px;
      margin: 15px;
    }

    h2 span {
      font-size: 4rem;
      font-weight: 600;
    }

    a:link,
    a:visited {
      text-decoration: none;
      color: #fff;
    }

    h3 a:hover {
      text-decoration: none;
      background: #fff;
      color: #3498DB;
      cursor: pointer;
    }

    .container {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }
  </style>
</head>

<body>


  <div class="container">
    <h1>:(</h1><br>
    <h2>A <span>404</span> error occured, Page not found</h2>
    @if ($exception->getMessage() == null)
      <h2>Check the URL and try again.</h2>
    @else
      <h2>{{ $exception->getMessage() }}</h2>
    @endif
    <h3><a href="/">Return to home</a>&nbsp;|&nbsp;<a href="javascript:history.back()">Go Back</a></h3>
  </div>


</body>

</html>
