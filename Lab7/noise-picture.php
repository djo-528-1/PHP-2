<?php
session_set_cookie_params(300);
session_start();

$image = imagecreatefromjpeg('noise.jpg');
if (!$image) {
    die('Не удалось загрузить фоновое изображение noise.jpg');
}

$text_color = imagecolorallocate($image, 50, 50, 50);
$font_folder = 'fonts/';
$fonts = glob($font_folder . '*.ttf');
if (empty($fonts)) {
    die('В папке fonts/ не найдено ни одного TTF шрифта.');
}

$chars = 'abcdefghijkmnpqrstuvwxyz23456789';
$captcha_string = '';
$length = rand(5, 6);
for ($i = 0; $i < $length; $i++) {
    $captcha_string .= $chars[rand(0, strlen($chars) - 1)];
}

$_SESSION['captcha_code'] = $captcha_string;

$x = 20;
$y = 30;
$spacing = 40;
for ($i = 0; $i < strlen($captcha_string); $i++) {
    $char = $captcha_string[$i];
    $font = $fonts[array_rand($fonts)];
    $size = rand(18, 30);
    $angle = rand(-15, 15);
    imagettftext($image, $size, $angle, $x, $y, $text_color, $font, $char);
    $x += $spacing;
}

header('Content-Type: image/jpeg');
imagejpeg($image, null, 50);
imagedestroy($image);
?>
