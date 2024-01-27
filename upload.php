<?php

$url = array("http://localhost");
$url_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

reset($_FILES);
$temp = current($_FILES);

if (is_uploaded_file($temp['tmp_name'])) {

    if (preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $temp['name'])) {
        header("HTTP/1.1 400 Invalid file name,Bad request");
        return;
    }
//
    // Validating Image file type by extensions
    if (!in_array(strtolower(pathinfo($temp['name'], PATHINFO_EXTENSION)), array("gif", "jpg", "png"))) {
        header("HTTP/1.1 400 Invalid extension,Bad request");
        return;
    }

    date_default_timezone_set("Asia/Tashkent");
    $code = uniqid("", true) . "_" . date("Y-m-d_H-i-s") . "_";
    $fileName = "public/uploads/tinymce/$code" . $temp['name'];
    move_uploaded_file($temp['tmp_name'], $fileName);
    $url_link .= "/" . $fileName;
    echo json_encode(array('location' => $url_link));
} else {
    header("Location: /");
    die();
}
