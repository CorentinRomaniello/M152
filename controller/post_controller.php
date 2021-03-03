<?php
require_once "../model/functions.php";

if (filter_has_var(INPUT_POST, 'action')) {

    $descriptionPost = filter_input(INPUT_POST, 'descriptionPost', FILTER_SANITIZE_STRING);

    $MAX_SIZE_FILE = 3000000;
    $MAX_SIZE_POST = 70000000;

    // Var use to know if the file is an image
    $check = array();

    $target_file = array();
    $imgsTmpName = array();
    $error = "";
    $size = 0;
    $idPost = 0;

    if (empty($descriptionPost))
        $error = "Description is empty !";

    // Directory for image
    $target_dir = "../img_uploads/";

    foreach ($_FILES['imgPost']['tmp_name'] as $imgTmpName) {
        array_push($check, getimagesize($imgTmpName));
        array_push($imgsTmpName, $imgTmpName);
    }

    foreach ($_FILES["imgPost"]["name"] as $imgName) {
        array_push($target_file, $target_dir . uniqid() . "." . pathinfo($imgName, PATHINFO_EXTENSION));
    }

    foreach ($_FILES["imgPost"]["size"] as $imgSize) {
        $size += $imgSize;
    }

    if (count($target_file) > 1) {
        if ($size > $MAX_SIZE_FILE)
            $error = "File is too big";
    } else 
    if ($size > $MAX_SIZE_POST)
        $error = "Post is too big";

    if (in_array(false, $check))
        $error = "A file enter is not an image";

    if ($error == "") {
        try {
            $db = EDatabase::getInstance();
            $db->beginTransaction();

            $idPost = AddPost($descriptionPost, date("Y.m.d H:i:s"));

            for ($i = 0; $i < count($target_file); $i++) {

                if (move_uploaded_file($imgsTmpName[$i], $target_file[$i])) {

                    AddMedia($target_file[$i], pathinfo($target_file[$i], PATHINFO_EXTENSION), date("Y.m.d H:i:s"), $idPost);
                }
            }

            $db->commit();
        } catch (Throwable $e) {
            $db->rollback();
            throw $e;
        }
    }
}
