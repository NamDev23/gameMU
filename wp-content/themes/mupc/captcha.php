<?php
session_start();
if (!isset($_SESSION['captcha_code'])) {
    $_SESSION['captcha_code'] = rand(1000, 9999);
}
$captcha_code = $_SESSION['captcha_code'];
// Thiết lập kích thước ảnh
$width = 100;
$height = 40;

$image = imagecreatetruecolor($width, $height);

// Màu nền trắng và màu chữ đen
$bgColor = imagecolorallocate($image, 255, 255, 255);
$textColor = imagecolorallocate($image, 0, 0, 0);

// Điền nền
imagefilledrectangle($image, 0, 0, $width, $height, $bgColor);

// (Tùy chọn) Vẽ một vài đường nhiễu
for ($i = 0; $i < 3; $i++) {
    $lineColor = imagecolorallocate($image, rand(100, 255), rand(100, 255), rand(100, 255));
    imageline($image, 0, rand() % $height, $width, rand() % $height, $lineColor);
}

// Vẽ mã captcha lên ảnh
// Sử dụng font built-in (imagestring)
imagestring($image, 5, 20, 10, $captcha_code, $textColor);

// Gửi header để trình duyệt nhận dạng là ảnh PNG
header('Content-Type: image/png');
imagepng($image);
imagedestroy($image);
