<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SDSB</title>
  <meta content="Sumbangsih Dermawan Seni Berhadiah." name="description">
    <meta content="SDSB" property="og:title">
    <meta content="Sumbangsih Dermawan Seni Berhadiah." property="og:description">
    <meta content="https://res.cloudinary.com/sindikasi/image/upload/v1673108444/snd_open_graph_v7j8qq.webp" property="og:image">
    <meta content="SDSB" property="twitter:title">
    <meta content="Sumbangsih Dermawan Seni Berhadiah." property="twitter:description">
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
  <link href="<?php echo base_url();?>/resource/images/favicon.png" rel="shortcut icon" type="image/x-icon">
  <link href="<?php echo base_url();?>/resource/images/webclip.png" rel="apple-touch-icon">
</head>

<body>
<div class="web-head-section wf-section background-header">
    <div class="wb-head-wrapper">
      <div class="wb-head-col-1">
        <div class="wb-head-nav-logo">
          <a href="#" class="wb-head-lg w-inline-block"><img src="https://d33wubrfki0l68.cloudfront.net/4d393c9dc7f105b904c448e38083340914bc3ea3/5b929/images/logo_medium.b1bc581.c9be1a476612b6c1bb320543c218d756.png" loading="lazy" alt="Logo" class="wb-head-lg-img"></a>
        </div>
      </div>
      <nav aria-label="page navigation" role="navigation" class="wb-head-col-2 ">
        <a href="#" role="link" aria-label="navigation link" class="wb-head-nav-link">Riset &amp; Publikasi</a>
        <a href="#" class="wb-head-nav-link">Agenda</a>
        <a href="https://blog.sindikasi.org/" class="wb-head-nav-link">Blog</a>
          <a href="https://blog.sindikasi.org/tag/press-release/" class="wb-head-nav-link">Rilis Pers</a>
        <a href="#" class="wb-head-nav-link">Tentang Kami</a>
        <a aria-label="link to sindikasi kalkulator app" role="link" href="<?php echo base_url(); ?>" target="_self" class="wb-nav-link-kalkulator">Kalkulator Upah Layak</a>
        <a aria-label="link to sindikasi member app" role="link" href="#" target="_blank" class="wb-nav-link-member">Akses Anggota</a>
      </nav>
    </div>
  </div>
  
  <div class="container-fluid background-primary py-4">
    <div class="container background-primary">
      <div class="pt-3 pb-3 d-flex justify-content-center">
        <div class="rounded background-secondary p-2 text-dark">
          <strong>Kalkulator Upah Layak Freelancer</strong>
        </div>
      </div>
    </div>
  </div>
  <div class="modal" tabindex="-1" role="dialog" id="tooltipmodal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header d-flex justify-content-between">
          <h5 class="modal-title">Keterangan</h5>
          <button type="button" class="btn text-gray closetooltipmodal" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <p id="tooltipmessage"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary closetooltipmodal" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>