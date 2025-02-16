<?php
// Bắt buộc session phải lưu được trước khi gửi header hình ảnh
session_start();

// Kiểm tra session ID có đúng không
if (!isset($_SESSION['captcha_code'])) {
    $_SESSION['captcha_code'] = rand(1000, 9999);
}
$width = 100;
$height = 40;


// Chỉ gửi ảnh nếu session đã thiết lập
header('Content-Type: image/png');
$image = imagecreate(120, 40);
$bg_color = imagecolorallocate($image, 255, 255, 255);
$text_color = imagecolorallocate($image, 0, 0, 0);
imagestring($image, 5, 35, 10, $_SESSION['captcha_code'], $text_color);
imagepng($image);
imagedestroy($image);
