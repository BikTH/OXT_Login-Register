<?php
$title = isset($meta) && is_array($meta) && array_key_exists("title", $meta) ? $meta["title"] : "";
$description = isset($meta) && is_array($meta) && array_key_exists("description", $meta) ? $meta["description"] : "";

?>
<!-- DESIGNED BY OPENXTECH COMPANY, WWW.OPENXTECH.COM -->

<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="<?= $description; ?>" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?= assets("css/core/core.css", true); ?>">
    <link rel="stylesheet" type="text/css" href="<?= assets("css/core/website.css", true); ?>">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <title><?= $title; ?> — Oxt Template</title>

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:title" content="">
    <meta property="og:description" content="">

    <!-- Twitter -->
    <meta property="twitter:card" content="" />
    <meta property="twitter:url" content="" />
    <meta property="twitter:title" content="" />
    <meta property="twitter:description" content="" />

    <link rel="icon" type="image/png" href="/public/favicon.png" />
    <script src="<?= assets("js/jquery.min.js") ?>"></script>
</head>

<body id="">
    <div class="preloader_"><span class="isloading-wrapper" style="top: 223.5px;"><div class="centered"><img height="164" src="https://www.mymiqo.com/public/assets/img/brand/miqo.svg?c" alt=""></div></span></div>
    <script type="text/javascript">
        // window.isMobile = true;
        var w__ = parseInt( $(this).outerWidth(), 10); if( w__ < 768){ window.isMobile = true; } else { window.isMobile = false;}
        $(document).ready(function(){setTimeout(function () {$(".preloader_").fadeOut(500); $("body").css("overflow", "auto");}, 1000);});
        window.responsive = true;
    </script>