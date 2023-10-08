<?php
header("content-type:image/jpeg");
$font = "BRUSHSCI.TTF";
$image = imagecreatefromjpeg("cert.jpg");
$color = imagecolorallocate($image, 19, 21, 22);
$name = $_GET['name'];
$collage = $_GET['collage'];
$program = "BCU Science Fest";
$currentMonth = date('F');
$currentYear = date('Y');
$monYear = $currentMonth . ", " . $currentYear;
$res = $_GET['res'];
if($res=="1st"){
    $rank="Winner";
}else{
    $rank="Runner";
}
$game = $_GET['ename'];

$placDat='Bangaluru, '.date('d/m/Y');
$placDat='Bangaluru, '.date('d/m/Y');
// $placDat = 'Bangaluru, 6/6/2023';
$principal = "BCU Principal";
// imagettftext($image,50,0,365,420,$color,$font,$name);
imagettftext($image, 30, 0, 710, 390, $color, $font, $program);
imagettftext($image, 25, 0, 850, 450, $color, $font, $name);
imagettftext($image, 25, 0, 550, 500, $color, $font, $collage);
imagettftext($image, 25, 0, 600, 550, $color, $font, $program);
imagettftext($image, 25, 0, 430, 600, $color, $font, $monYear);
imagettftext($image, 25, 0, 885, 600, $color, $font, $rank);
imagettftext($image, 25, 0, 700, 650, $color, $font, $game);
imagettftext($image, 20, 0, 400, 750, $color, $font, $placDat);
imagettftext($image, 20, 0, 860, 750, $color, $font, $principal);

imagejpeg($image);
imagejpeg($image, $name . ".jpg");

imagedestroy($image);
?>
<!-- Central College Campus, Dr. Ambedkar Veedhi, Bengaluru - 560001, Karnataka, India -->