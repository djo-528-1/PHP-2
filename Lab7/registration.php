<?php
session_set_cookie_params(300);
session_start();
$message = "";
$message_color = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (isset($_SESSION['captcha_code']))
    {
        $user_input = $_POST['captcha'];
        $stored_code = $_SESSION['captcha_code'];
        if (strtolower($user_input) == strtolower($stored_code))
        {
            $message = "Данные введены верно! Вы успешно прошли проверку.";
            $message_color = "green";
            unset($_SESSION['captcha_code']); 
        }
        else
        {
            $message = "Ошибка: Введенный код не совпадает с изображением.";
            $message_color = "red";
        }
    }
    else
    {
        $message = "Ошибка сессии: Код изображения не найден. Возможно, показ картинок отключен или сессия истекла.";
        $message_color = "orange";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация с капчей</title>
    <style>
        .message { padding: 10px; border: 1px solid; margin-top: 15px; }
        .green { color: green; border-color: green; background-color: #e8ffeb; }
        .red { color: red; border-color: red; background-color: #ffe8e8; }
        .orange { color: orange; border-color: orange; background-color: #fff4e8; }
    </style>
</head>
<body>

<h2>Форма регистрации</h2>

<form method="POST" action="registration.php">
    <label for="username">Имя пользователя:</label><br>
    <input type="text" id="username" name="username"><br><br>
    <img src="noise-picture.php" alt="Изображение капчи" title="Если вы не видите изображение, включите показ картинок в браузере."><br><br>
    <label for="captcha">Введите символы с картинки:</label><br>
    <input type="text" id="captcha" name="captcha"><br><br>
    <input type="submit" value="Отправить">
</form>

<?php
if ($message)
{
    echo "<div class='message $message_color'>$message</div>";
}
?>

</body>
</html>
