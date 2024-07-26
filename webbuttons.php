<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NodeMCU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    <div class="d-flex flex-column align-items-center">
      <div class="status mb-3 p-2 border border-primary rounded">
        <span id="connection-status">Not Connected</span>
      </div>
      <div class="d-flex justify-content-center">
        <button type="button" class="btn btn-primary mx-2">Blue</button>
        <button type="button" class="btn btn-danger mx-2">Red</button>
        <button type="button" class="btn btn-success mx-2">Green</button>
      </div>
    </div>
  </body>
</html>

<style>
  body {
    display: flex;
    height: 100vh;
    align-items: center;
    justify-content: center;
  }

  .btn {
    height: 50px;
    width: 100px;
  }

  .status{
    width: 200px;
    text-align: center;
  }
</style>
