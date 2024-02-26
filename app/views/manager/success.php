<!-- error.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sucess</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        h1 {
            color: #d9534f;
        }

        p {
            color: #333;
            font-size: 18px;
            margin-bottom: 20px;
        }

        #countdown {
            font-size: 24px;
            font-weight: bold;
            color: #5bc0de;
        }
    </style>
    <script>
        // Countdown function
        function countdown(seconds, url) {
            document.getElementById('countdown').textContent = seconds;
            if (seconds > 0) {
                setTimeout(function() {
                    countdown(seconds - 1, url);
                }, 1000); // 1000 milliseconds = 1 second
            } else {
                // Redirect after countdown
                window.location.href = url;
            }
        }
    </script>
</head>
<body>
    <div>
        <h1>Error</h1>
        <p><?php echo $data['success_message']; ?></p>
        <!-- Countdown display -->
        <p>Redirecting in <span id="countdown"><?php echo $data['redirectDelay']; ?></span> seconds...</p>
    </div>

    <!-- JavaScript to start the countdown -->
    <script>
        // Start countdown when the page loads
        countdown(<?php echo $data['redirectDelay']; ?>, '<?php echo $data['redirectUrl']; ?>');
    </script>
</body>
</html>
