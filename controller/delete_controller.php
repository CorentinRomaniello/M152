<?php
require_once '../model/functions.php';

$error = "";

$idPost = filter_input(INPUT_POST, 'idPost', FILTER_VALIDATE_INT);

$namesMedias = array();

if (empty($idPost))
    $error = "Post doesn't exist";

if ($error != null) {
    header("Location: ../view/home.php?error=" . $error);
    exit;
}

if ($error == "") {
    try {
        $db = EDatabase::getInstance();
        $db->beginTransaction();
        foreach (GetMediaByIdPost($idPost) as $m)
            array_push($namesMedias, $m['nomFichierMedia']);

        foreach ($namesMedias as $nm)
            unlink($nm);

        DeletePost($idPost);
        $db->commit();
    } catch (Throwable $e) {
        $db->rollback();
        throw $e;
    }
}

header("Location: ../view/home.php");
exit;
