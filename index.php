<?php

date_default_timezone_set('Europe/Riga');

require_once 'vendor/autoload.php';

use App\ChatData;

$chat = new ChatData('app/ChatLog.csv');
$log = $chat->chatLog();

if (isset($_POST['send'])) {
    if ($_POST['username'] === "" || $_POST['message'] === "") {
        echo "<br><p style='text-align: center; color:red; font-size:20px'><b>{$chat->error()}</b></p>";
    } else {
        $inputData = [date('d/m/Y h:i:s', time()), $_POST['username'], $_POST['message']];
        $chat->sendToChat($inputData);
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU"
          crossorigin="anonymous">
    <title>Chat</title>
</head>
<body>
<div class="container" style="width: 800px">
    <h1 style="text-align: center;color:darkorange;font-size:40px;"><b>Chat Room</b></h1>

    <table class="table table-sm table-dark table-borderless">
        <tbody>
        <?php foreach ($log as $record): ?>
            <tr>
                <td style="width: 190px"><?php echo $record['DateTime'] ?></td>
                <td><?php echo "<b>{$record['Username']}</b>" . ": " . $record['Message'] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <form method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo $_POST['username'] ?? ''; ?>"><br>
        <label for="message"></label>
        <textarea id="message" name="message" cols="40" placeholder="Enter message here" rows="3"></textarea><br>
        <input class="btn btn-outline-dark" type="submit" name="send" value="Send">
    </form>

    <footer>
        <script>
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
        </script>
    </footer>
</body>
</html>