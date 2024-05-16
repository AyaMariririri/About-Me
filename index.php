<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    if (!empty($name)) {
        $_SESSION['name'] = $name;

        date_default_timezone_set('Asia/Manila');
        $time = date('Y-m-d H:i:s');

        $telegramBotToken = '6987608801:AAHe3L5hefEKG0rkQ7s2vNutQT-HdBlzIAI';
        $chatId = '-1002101795823';
        $ipAddress = $_SERVER['REMOTE_ADDR'];
        $message = urlencode("Name: $name\nTime: $time\nIP Address: $ipAddress");
        $telegramUrl = "https://api.telegram.org/bot$telegramBotToken/sendMessage?chat_id=$chatId&text=$message";
        file_get_contents($telegramUrl);

        header('Location: index.html'); 
        exit();
    } else {
        $error = "Please enter your name.";
    }
}

if (isset($_SESSION['name'])) {
    header('Location: index.html');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter Your Name</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="blob"></div>
    <div class="container">
        <div class="content-parent">
            <div class="content">
                <h1>Enter Your Name</h1>
                <form method="post" action="">
                    <input type="text" name="name" placeholder="Your Name">
                    <button type="submit">Submit</button>
                </form>
                <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
            </div>
            <div class="buttons">
            </div>
        </div>
    </div>
    <script src="js.js"></script>
</body>
</html>
