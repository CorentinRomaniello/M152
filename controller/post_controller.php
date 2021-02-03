<?php
require_once "../model/functions.php";

// Var use to know if the file is an image
$check = array();

$target_file = array();
$imgsTmpName = array();
$error = "";

// Directory for image
$target_dir = "../img_uploads/";

foreach ($_FILES['imgPost']['tmp_name'] as $imgTmpName) {
    array_push($check, getimagesize($imgTmpName));
    array_push($imgsTmpName, $imgTmpName);
}

foreach ($_FILES["imgPost"]["name"] as $imgName)
    array_push($target_file, $target_dir . basename($imgName));


if (in_array(false, $check))
    $error = "A file enter is not an image";
else {
    for ($i = 0; $i < count($target_file); $i++)
        move_uploaded_file($imgsTmpName[$i], $target_file[$i]);
}
