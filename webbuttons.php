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
    <?php
    // Handle the button presses
    $status = 'Not Connected';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['status'])) {
            $status = htmlspecialchars($_POST['status']); // Sanitize the input
            $encodedStatus = urlencode($status); // Encode the status value
            $url = "http://192.168.2.10555555555/control?status=$encodedStatus";

            // Initialize cURL session
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10); // Timeout after 10 seconds

            $response = curl_exec($ch);

            // Check for errors
            if ($response === FALSE) {
                $status = 'Failed to connect to Arduino: ' . curl_error($ch);
            } else {
                $status = 'Command sent: ' . $status;
            }

            curl_close($ch);
        }
    }
?>

        <div class="status mb-3 p-2 border border-primary rounded">
            <span id="connection-status"><?php echo $status; ?></span>
        </div>
        <form method="post" action="webbuttons.php">
            <div class="d-flex justify-content-center">
                <button type="submit" name="status" value="Blue Button Pressed" class="btn btn-primary mx-2">Blue</button>
                <button type="submit" name="status" value="Red Button Pressed" class="btn btn-danger mx-2">Red</button>
                <button type="submit" name="status" value="Green Button Pressed" class="btn btn-success mx-2">Green</button>
            </div>
        </form>
    </div>
</body>
</html>

<!-- <style>
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
</style> -->
