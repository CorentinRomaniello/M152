<?php

require_once "../model/database.php";

// MEDIA
function AddMedia($nomFichierMedia, $typeMedia, $dateCreationMedia, $idPost)
{
    $sql = "INSERT INTO media(nomFichierMedia, typeMedia, dateCreationMedia, idPost) " .
        " VALUES (:nomFichierMedia, :typeMedia, :dateCreationMedia, :idPost)";
    $request = EDatabase::prepare($sql);
    if ($request->execute(array(
        'nomFichierMedia' => $nomFichierMedia,
        'typeMedia' => $typeMedia,
        'dateCreationMedia' => $dateCreationMedia,
        'idPost' => $idPost
    ))) {
        return EDatabase::lastInsertID();
    } else {
        return NULL;
    }
}

function UpdateMedia($idMedia, $nomFichierMedia, $typeMedia, $dateModificationMedia, $idPost)
{
    $sql = "UPDATE media SET "
        . "nomFichierMedia = :nomFichierMedia, "
        . "typeMedia = :typeMedia, "
        . "dateModificationMedia = :dateModificationMedia,"
        . "idPost = :idPost "
        . "WHERE idMedia = :idMedia ";

    $request = EDatabase::prepare($sql);
    if ($request->execute(array(
        'nomFichierMedia' => $nomFichierMedia,
        'typeMedia' => $typeMedia,
        'dateModificationMedia' => $dateModificationMedia,
        'idPost' => $idPost,
        'idMedia' => $idMedia,
    ))) {
        return $idMedia;
    } else {
        return NULL;
    }
}

function DeleteMedia($idMedia)
{
    $sql = "DELETE FROM media WHERE idMedia = :idMedia";
    $request = EDatabase::prepare($sql);
    $request->execute(array("idMedia" => $idMedia));
}

function GetMedia()
{
    $sql = "SELECT * FROM media";
    $res = EDatabase::query($sql)->fetchAll(PDO::FETCH_ASSOC);
    return $res;
}

// POST
function AddPost($commentaire, $creationDatePost)
{
    $sql = "INSERT INTO post(commentaire, creationDatePost) " .
        " VALUES (:commentaire, :creationDatePost)";
    $request = EDatabase::prepare($sql);
    if ($request->execute(array(
        'commentaire' => $commentaire,
        'creationDatePost' => $creationDatePost,
    ))) {
        return EDatabase::lastInsertID();
    } else {
        return NULL;
    }
}

function UpdatePost($idPost, $commentaire, $modificationDatePost)
{
    $sql = "UPDATE post SET "
        . "commentaire = :commentaire, "
        . "modificationDatePost = :modificationDatePost "
        . "WHERE idPost = :idPost ";

    $request = EDatabase::prepare($sql);
    if ($request->execute(array(
        'commentaire' => $commentaire,
        'modificationDatePost' => $modificationDatePost,
        'idPost' => $idPost,
    ))) {
        return $idPost;
    } else {
        return NULL;
    }
}

function DeletePost($idPost)
{
    $sql = "DELETE FROM post WHERE idPost = :idPost";
    $request = EDatabase::prepare($sql);
    $request->execute(array("idPost" => $idPost));
}

function GetPost()
{
    $sql = "SELECT * FROM post";
    $res = EDatabase::query($sql)->fetchAll(PDO::FETCH_ASSOC);
    return $res;
}

function GetPostById($idPost)
{
    $sql = "SELECT * FROM post where idPost = :idPost";
    $res = EDatabase::prepare($sql);
    $res->bindParam(':idPost', $idPost, PDO::PARAM_INT);
    $res->execute();
    return $res->fetchAll(PDO::FETCH_ASSOC);
}

function GetMediaByIdPost($idPost)
{
    $sql = "SELECT * FROM media where idPost = :idPost";
    $res = EDatabase::prepare($sql);
    $res->bindParam(':idPost', $idPost, PDO::PARAM_INT);
    $res->execute();
    return $res->fetchAll(PDO::FETCH_ASSOC);
}
