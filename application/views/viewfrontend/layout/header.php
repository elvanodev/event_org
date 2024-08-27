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
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=La+Belle+Aurore&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo base_url(); ?>resource/css/custom.css">
    <script src="https://kit.fontawesome.com/6f75ab249e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css" integrity="sha512-ELV+xyi8IhEApPS/pSj66+Jiw+sOT1Mqkzlh8ExXihe4zfqbWkxPRi8wptXIO9g73FSlhmquFlUOuMSoXz5IRw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="<?php echo base_url(); ?>/resource/uploaded/img/<?php echo $event->poster_image; ?>" rel="shortcut icon" type="image/x-icon">
    <link href="<?php echo base_url(); ?>/resource/uploaded/img/<?php echo $event->poster_image; ?>" rel="apple-touch-icon">
    <style>
        @font-face {
            font-family: "earth-2073";
            src: url(<?php echo base_url(); ?>resource/font/earth_2073.ttf);
        }
    </style>
</head>

<body>
    <!-- website background -->
    <div id="bgOuter">
        <section id="bgUp"></section>
        <section id="bgDown"></section>
        <section id="bgLeft"></section>
        <section id="bgRight"></section>
    </div>

    <!-- Modal modalArtist -->
    <div class="modal fade" id="modalArtist" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content default-bg-color text-light">
                <div class="modal-header">
                    <div class="text-light w-100 d-flex justify-content-between">
                        <p>
                            <span>Share Artist Profile</span>
                            <br>
                            <a href="#" target="_blank" class="text-light" id="waLink"><i class="fa-brands fa-whatsapp"></i></a>
                            <a href="#" target="_blank" class="text-light" id="instagramLink"><i class="fa-brands fa-instagram"></i></a>
                            <a href="#" target="_blank" class="text-light" id="twitterLink"><i class="fa-brands fa-x-twitter"></i></a>
                            <a href="#" target="_blank" class="text-light" id="mailLink"><i class="fa-solid fa-envelope"></i></a>
                        </p>
                        <button type="button" class="close btn text-light" onclick="onclickclose()" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" id="artistPhoto">
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                            <div class="row">
                                <div class="col-12">
                                    <h3 id="artistName"></h3>
                                </div>
                                <div class="col-12">
                                    <p id="bornPlaceDate" class="text-light"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="col-12 text-light p-3">
                    <p class="justify" id="artistBio"></p>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid web-head-section py-4 text-white">
        <div class="desktop-view">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                    <select class="form-control earth-2073 custom-border" name="editionId" id="editionId">
                        <?php
                        foreach ($editions as $edition) {
                            $selected = '';
                            if ($edition->idx == $selected_edition) {
                                $selected = 'selected';
                            }
                        ?>
                            <option value="<?php echo $edition->idx; ?>" <?php echo $selected; ?>><?php echo $edition->name; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <input type="hidden" id="editionstartdate">
                    <input type="hidden" id="editionenddate">
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="d-flex justify-content-center">
                        <h2 class="earth-2073 text-center"><?php echo $event->long_name; ?></h2>
                    </div>
                    <div class="d-flex justify-content-center">
                        <strong class="earth-2073 selectedEdition"> </strong>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 col-xs-0 d-flex justify-content-end">
                    <!-- disable for temporary -->
                    <!-- <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="languageSwith">
                        <label class="form-check-label" for="languageSwith">Eng</label>
                    </div> -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <marquee>
                        <h4 class="la-belle-aurore-regular w-100 text-center mt-2"><?php echo $event->descriptions; ?></h4>
                    </marquee>
                </div>
            </div>
        </div>
        <div class="mobile-view">
            <div class="d-flex justify-content-center">
                <h2 class="earth-2073 text-center"><?php echo $event->long_name; ?></h2>
            </div>
            <div class="d-flex justify-content-center">
                <strong class="earth-2073 selectedEdition"> </strong>
            </div>
            <div>
                <marquee>
                    <h4 class="la-belle-aurore-regular w-100 text-center mt-2"><?php echo $event->descriptions; ?></h4>
                </marquee>
            </div>
            <nav class="navbar navbar-expand-lg bg-transparent navbar-dark">
                <div class="container-fluid">
                    <select class="form-control earth-2073 custom-border w-50" name="editionIdMobile" id="editionIdMobile">
                        <?php
                        foreach ($editions as $edition) {
                            $selected = '';
                            if ($edition->idx == $selected_edition) {
                                $selected = 'selected';
                            }
                        ?>
                            <option value="<?php echo $edition->idx; ?>" <?php echo $selected; ?>><?php echo $edition->name; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerMenu" aria-controls="navbarTogglerMenu" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarTogglerMenu">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="--bs-scroll-height: 120px;">
                            <li class="nav-item">
                                <a href="<?php echo base_url(); ?>" class="nav-link earth-2073 <?php echo isset($active_home) ? 'active' : ''; ?>">Beranda</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo base_url(); ?>frontend/eventinfo" type="button" class="nav-link earth-2073 <?php echo isset($active_info) ? 'active' : ''; ?>">Info</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo base_url(); ?>frontend/collaborators" type="button" class="nav-link earth-2073 <?php echo isset($active_collaborator) ? 'active' : ''; ?>">Kolaborator</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://saweria.co/dermawanseni" type="button" class="nav-link earth-2073">Jadi Dermawan Seni</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo base_url(); ?>frontend/couponselling" type="button" class="nav-link earth-2073">Beli Kupon Online</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo base_url(); ?>frontend/doorprize" type="button" class="nav-link earth-2073 <?php echo isset($active_doorprize) ? 'active' : ''; ?>">Doorprize</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo base_url(); ?>frontend/about" type="button" class="nav-link earth-2073 <?php echo isset($active_about) ? 'active' : ''; ?>">About</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo base_url(); ?>frontend/gallery" type="button" class="nav-link earth-2073 <?php echo isset($active_gallery) ? 'active' : ''; ?>">Gallery</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>