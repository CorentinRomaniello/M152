<?php
require_once "../controller/home_controller.php";
?>
<!--
    Auteur : Romaniello Corentin
    Fichier : home.php
-->
<!DOCTYPE html>
<html lang="fr" style="width: 100%; height: 100%;">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>M152-Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    <!-- JQuery -->
    <script src="jquery-3.5.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body style="width: 100%; height: 100%;">

    <!-- Navbar --->
    <nav style="width: 100%; height: 8%" class="navbar navbar-dark bg-dark justify-content-between">
        <a class="navbar-brand">M152</a>
        <div>
            <a class="navbar-brand" href="../view/home.php">Home</a>
            <a class="navbar-brand" href="../view/post.php">Post</a>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white" class="bi bi-person-circle" viewBox="0 0 16 16">
            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
        </svg>

    </nav>

    <div class="bg-secondary mt-5 w-100 h-25 d-flex justify-content-center align-items-center">
        <h1 class="display-1 text-light">Welcome</h1>
    </div>

    <div class="mt-5 d-flex flex-column justify-content-center align-items-center" id="post">

        <?= $result; ?>

    </div>

</body>

</html>

<script>
    /*
    function GetData() {
        $.ajax({
            url: '../controller/home_controller.php',
            type: 'POST',
            success: function(res) {
                document.getElementById('post').innerHTML = res;
            },
        })
    }*/
</script>