<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $event->name; ?></title>
    <meta content="<?php echo $event->descriptions; ?>" name="description">
    <meta content="SDSB" property="og:title">
    <meta content="<?php echo $event->descriptions; ?>" property="og:description">
    <meta content="https://res.cloudinary.com/sindikasi/image/upload/v1673108444/snd_open_graph_v7j8qq.webp" property="og:image">
    <meta content="SDSB" property="twitter:title">
    <meta content="<?php echo $event->descriptions; ?>" property="twitter:description">
    <meta content="https://res.cloudinary.com/sindikasi/image/upload/v1673108444/snd_open_graph_v7j8qq.webp" property="twitter:image">
    <meta property="og:type" content="website">
    <meta content="summary_large_image" name="twitter:card">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>resource/css/custom.css">
    <script src="https://kit.fontawesome.com/6f75ab249e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css" integrity="sha512-ELV+xyi8IhEApPS/pSj66+Jiw+sOT1Mqkzlh8ExXihe4zfqbWkxPRi8wptXIO9g73FSlhmquFlUOuMSoXz5IRw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="<?php echo base_url(); ?>/resource/images/favicon.png" rel="shortcut icon" type="image/x-icon">
    <link href="<?php echo base_url(); ?>/resource/images/webclip.png" rel="apple-touch-icon">
</head>

<body>

    <div class="container-fluid web-head-section pt-4 wrapper text-white">
        <div class="row">
            <div class="col-2">
                <select class="form-control" name="editionId" id="editionId">
                    <?php
                    $selected = false;
                    foreach ($editions as $edition) {
                    ?>
                        <option value="<?php echo $edition->idx; ?>" <?php if(!$selected) { echo "selected"; $selected = true; }  ?>><?php echo $edition->name; ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="col-8">
                <div class="d-flex justify-content-center">
                    <h2><?php echo $event->long_name; ?></h2>
                </div>
                <div class="d-flex justify-content-center">
                    <strong id="selectedEdition"> </strong>
                </div>
            </div>
            <div class="col-2 d-flex justify-content-end">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="languageSwith">
                    <label class="form-check-label" for="languageSwith">Eng</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <marquee width="100%" height="40"><?php echo $event->descriptions; ?></marquee>
            </div>
        </div>
