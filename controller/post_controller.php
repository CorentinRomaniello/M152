<?php
require_once "../model/functions.php";

if (filter_has_var(INPUT_POST, 'action')) {

    $descriptionPost = filter_input(INPUT_POST, 'descriptionPost', FILTER_SANITIZE_STRING);

    $MAX_SIZE_FILE = 3000000;
    $MAX_SIZE_POST = 70000000;

    // Var use to know if the file is a file accpet
    $typesFiles = array();

    $target_file = array();
    $filesTmpName = array();
    $error = "";
    $size = 0;
    $idPost = 0;

    if (empty($descriptionPost))
        $error = "Description is empty !";

    // Directory for image
    $target_dir = "../file_uploads/";

    foreach ($_FILES['filePost']['tmp_name'] as $fileTmpName) {
        array_push($filesTmpName, $fileTmpName);
    }

    foreach ($_FILES['filePost']['type'] as $typeFile) {
        if (strpos($typeFile, "audio") !== false || strpos($typeFile, "video") !== false || strpos($typeFile, "image") !== false)
            array_push($typesFiles, $typeFile);
        else
            $error = "The entered file is not accepted";
    }

    foreach ($_FILES["filePost"]["name"] as $fileName) {
        array_push($target_file, $target_dir . uniqid() . "." . pathinfo($fileName, PATHINFO_EXTENSION));
    }

    foreach ($_FILES["filePost"]["size"] as $fileSize) {
        $size += $fileSize;
    }

    if (count($target_file) > 1) {
        if ($size > $MAX_SIZE_FILE)
            $error = "File is too big";
    } else 
    if ($size > $MAX_SIZE_POST)
        $error = "Post is too big";

    if ($error == "") {
        try {
            $db = EDatabase::getInstance();
            $db->beginTransaction();

            $idPost = AddPost($descriptionPost, date("Y.m.d H:i:s"));

            for ($i = 0; $i < count($target_file); $i++) {

                if (move_uploaded_file($filesTmpName[$i], $target_file[$i])) {

                    AddMedia($target_file[$i], explode('/', $typesFiles[$i])[0], date("Y.m.d H:i:s"), $idPost);
                }
            }
            $db->commit();
        } catch (Throwable $e) {
            $db->rollback();
            throw $e;
        }
    }
}
