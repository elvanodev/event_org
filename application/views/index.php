<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>Kotawaringin Barat</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>resource/css/view/css/style.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>resource/css/view/css/jquery.treeview.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>resource/css/view/css/frmlayout.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>resource/css/view/css/jquery.bxslider.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>resource/gallery/css/lightbox.css" />
        <meta name="viewport" content="width=device-width" />
        <meta name="viewport" content="width=320" />
        <meta name="viewport" content="initial-scale=1" />
        <meta name="viewport" content="maximum-scale=1" />
        <meta name="viewport" content="user-scalable=no" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <script language="javascript" type="text/javascript" src="<?php echo base_url() ?>resource/js/jquery/jquery-1.9.1.js"></script>
        <script language="javascript" type="text/javascript" src="<?php echo base_url() ?>resource/js/common/jqmigrate.js"></script>
        <script language="javascript" type="text/javascript" src="<?php echo base_url() ?>resource/js/common/jquery.bxslider.js"></script>
        <script language="javascript" type="text/javascript" src="<?php echo base_url() ?>resource/gallery/js/lightbox-2.6.min.js"></script>
        <script language="javascript" type="text/javascript" src="<?php echo base_url() ?>resource/js/common/jquery.treeview.js"></script>
        <script language="javascript" type="text/javascript" src="<?php echo base_url() ?>resource/ajax/kobar.js"></script>
    </head>
    <div id="container">
        <div id="header">
            <div class="header-top">
                <a href="#">google translate</a><a href="#">RSS Feed</a>
                <marquee behavior="scroll" direction="left" style="color:white;">
                <?php 
                 for ($i = 0; $i < count($ticker); $i++) { 
                      echo  $ticker[$i]['isiawal'].' | ';
                 }?></marquee>
            </div>
            <div class="header-midle">
                <div class="logo">
                    <img src="<?php echo base_url() . 'resource/uploaded/img/' . $logo[0]['image1'] ?>"/>

                </div> 
               <!-- <div class="logo"><img src="images/logo.png" /></div> -->
                <div class="title">
                    <?php echo $logo[0]['isiawal'] ?>
                    <!--  <h3>kalteng.go.id</h3>
                      <h4>Situs resmi Pemerintah Provinsi Kalimantan Tengah</h4>
                    -->
                </div>



                <div class="connect"><p>Connect With Us</p>
                    <div class="social">
                        <?php
                        $xsocial = $social;
                        for ($i = 0; $i < count($xsocial); $i++) {
                            echo ' <a href="http://' . $xsocial[$i]['isiawal'] . '" target="_blank" title="' . $xsocial[$i]['judul'] . '"><img src="' . base_url() . 'resource/uploaded/img/' . $xsocial[$i]['image1'] . '" alt="' . $xsocial[$i]['judul'] . '"></a>';
                        }
                        ?>  
                      <!--  <a href="#" target="_blank" title="Visit us on Facebook!"><img src="Images/Facebook.png" alt="Facebook"></a>

                        <a href="#" target="_blank" title="Visit us on Twitter!"><img src="Images/Twitter.png" alt="Twitter"></a>

                        <a href="#" target="_blank" title="Visit us on LinkedIn!"><img src="Images/LinkedIn.png" alt="LinkedIn"></a>

                        <a href="#" rel="publisher" target="_blank" title="Visit us on Google+!"><img src="Images/Google.png" alt="Google"></a>

                        <a href="#" target="_blank" title="Visit us on Tumblr!"><img src="Images/Tumblr.png" alt="Tumblr"></a>		
                        -->
                    </div>
                </div>
                <div id="search" role="search">
                    <form method="POST" action="<?php echo base_url() . 'index.php/ctrhome/search'; ?>" id="searchform">
                        <div id="simpleSearch">
                            <input autocomplete="off" tabindex="1" name="search" placeholder="Search"  title="Search Wikipedia [alt-shift-f]" accesskey="f" id="searchInput">
                            </input><button type="submit" name="button" title="Search Wikipedia for this text" id="searchButton">GO</button>
                            <input name="title" value="Special:Search" type="hidden">
                        </div>
                    </form>
                </div>
            </div>
            <div class="menu">
                <ul>
                    <?php
                    $xmenu = $menu;
                    //print_r($xmenu);
                    for ($i = 0; $i < count($xmenu); $i++) {
                        echo '<li><a href="' . base_url() . 'index.php/ctrhome/index/' . $xmenu[$i]['idmenu'] . '/' . $xmenu[$i]['idcontent'] . '">' . $xmenu[$i]['nmmenu'] . '</a></li>';
                        //echo ' <a href="'.$xsocial[$i]['isiawal'].'" target="_blank" title="'.$xsocial[$i]['judul'].'!"><img src="'.  base_url().'resource/uploaded/img/'.$xsocial[$i]['image1'].'" alt="'.$xsocial[$i]['judul'].'"></a>';   
                    }
                    ?>  
                    <!--                    <li><a href="index2.html">HOME</a></li>
                                        <li><a href="profile.html">PROFILE</a></li>
                                        <li><a href="instansi.html">INSTANSI</a></li>
                                        <li><a href="layanan.html">LAYANAN</a></li>
                                        <li><a href="archive.html">ARCHIVE</a></li>
                                        <li><a href="bukutamu.html">BUKU TAMU</a></li>
                                        <li><a href="kontak.html">KONTAK</a></li>-->
                </ul>
            </div>
        </div>
        <div id="slide">
            <div id="imgslide">
                <img src="<?php echo base_url() . 'resource/uploaded/img/' . $xximgslide[0]['image1'] ?>"/> 
            </div>
            <div id="linkkecamatan">
                <?php
                for ($i = 0; $i < count($linkkecamatan); $i++) {
                    echo '<div class="linkkec"> 
                             <div class="buletan"></div>   
                             <div class="judullinkkec"><a href="http://' . $linkkecamatan[$i]['link'] . '" target="_blank" title="' . $linkkecamatan[$i]['kecamatan'] . '">' . $linkkecamatan[$i]['kecamatan'] . '</a></div>
                            </div> 
                           ';
                }
                ?>
            </div>
<!--            <img src="images/slide.jpg" />-->
        </div>
        <div id="content">
            <div class="left-content">
                <div class="subdomain">
                    <h4><?php echo $subdomain[0]['judulmenu']; ?></h4>
                    <div>
                        <?php
                        $xsubdom = $subdomain;
                        for ($i = 0; $i < count($xsubdom); $i++) {
                            echo ' <a href="http://' . $xsubdom[$i]['isiawal'] . '" target="_blank"><img src="' . base_url() . 'resource/uploaded/img/' . $xsubdom[$i]['image1'] . '" alt="' . $xsubdom[$i]['isiawal'] . '"></a>';
                        }
                        ?>
<!--                        <a href="#"><img src="images/subdomain1.jpg"/></a>
                        <a href="#"><img src="images/subdomain2.jpg"/></a>
                        <a href="#"><img src="images/subdomain3.jpg"/></a>
                        <a href="#"><img src="images/subdomain4.jpg"/></a>-->
                    </div>
                </div>
                <div class="subdomain">
                    <h4><?php echo $kebijakan[0]['judulmenu']; ?></h4>
                    <div>
                        <?php
                        $xsubdom = $kebijakan;
                        for ($i = 0; $i < count($xsubdom); $i++) {
                            echo ' <a href="http://' . $xsubdom[$i]['isiawal'] . '" target="_blank"><img src="' . base_url() . 'resource/uploaded/img/' . $xsubdom[$i]['image1'] . '" alt="' . $xsubdom[$i]['isiawal'] . '"></a>';
                        }
                        ?>  
<!--                        <a href="#"><img src="images/subdomain1.jpg"/></a>
                        <a href="#"><img src="images/subdomain2.jpg"/></a>
                        <a href="#"><img src="images/subdomain3.jpg"/></a>
                        <a href="#"><img src="images/subdomain4.jpg"/></a>-->
                    </div>
                </div>
            </div>
            <div class="top-content">
                <?php
                $xsubdom = $beritautama;
                if (!$isdetail) {
                    echo '<div class="sub-top-content">';
                    echo '<h4>' . $beritautama[0]['judulmenu'] . '</h4>';
                    for ($i = 0; $i < count($xsubdom); $i++) {
                        echo ' <div>
                                     <h5><a href="' . base_url() . 'index.php/ctrhome/index/' . $beritautama[$i]['idmenu'] . '/' . $beritautama[$i]['idcontent'] . '">' . $xsubdom[$i]['judul'] . '</a></h5>
                                     <span class="span">' . $xsubdom[$i]['haritanggal'] . '</span>
                                     <img src="' . base_url() . 'resource/uploaded/img/' . $xsubdom[$i]['image1'] . '" alt="' . $xsubdom[$i]['judul'] . '">
                                     <p>' . substr(strip_tags($xsubdom[$i]['isi']), 0, 300) . '...</p>
                                  </div>';
                    }
                    echo '<p class="no-hal">' . $beritautama[0]['linkpage'] . '</p>';
                    echo'</div>';
                } else {
                    if ($beritautama[0]['isfromcontent']) {
                        echo '<div class="detail-top-content">';
                        echo '<h4>' . $beritautama[0]['judulmenu'] . '</h4>';
                        echo '<div>';
                        if ($beritautama[0]['judul'] != 'undefined')
                            echo '  <h5>' . $beritautama[0]['judul'] . '</h5>
                               <span class="span">' . $beritautama[0]['haritanggal'] . '</span>';
                        if ($beritautama[0]['image1'] != 'undefined')
                            echo ' <img src="' . base_url() . 'resource/uploaded/img/' . $beritautama[0]['image1'] . '" alt="' . $xsubdom[0]['judul'] . '">';

                        echo '  <p>' . $beritautama[0]['isi'] . '</p>
                             </div></div>';
                    } else {
                        echo '<div class="detail-top-content">';
                        echo '<h4>' . $beritautama[0]['judulmenu'] . '</h4>';
                        echo $beritautama[0]['isi'];
                        echo '</div>';
                    }
                }
                ?>  

                <!--                    <div>
                                        <h5>Kegiatan Dinas Kelautan & Perikanan</h5>
                                        <span class="span">Minggu, 30 Juni 2013</span>
                                        <img src="images/berita1.jpg"/>
                                        <p>Gemarikan adalah kegiatan yang dilaksanakan melalui berbagai kegiatan promosi dan kampanye yang melibatkan seluruh stakeholder terkait di wilayah provinsi Kalimantan Tengah untuk mendorong peningkatan konsumsi ikan</p>
                
                                    </div>
                                    <div>
                                        <h5>Kegiatan Dinas Kelautan & Perikanan</h5>
                                        <span class="span">Minggu, 30 Juni 2013</span>
                                        <img src="images/berita1.jpg"/>
                                        <p>Gemarikan adalah kegiatan yang dilaksanakan melalui berbagai kegiatan promosi dan kampanye yang melibatkan seluruh stakeholder terkait di wilayah provinsi Kalimantan Tengah untuk mendorong peningkatan konsumsi ikan</p>
                
                                    </div>-->

<!--                    <p class="no-hal"><a href="#">1</a><a href="#">2</a><a href="#">3</a><a href="#">4</a><a href="#">5</a></p>-->

            </div>
            <div class="right-content">
                <h4><?php echo $akutalitas[0]['judulmenu']; ?></h4>
<?php
$xsubdom = $akutalitas;
for ($i = 0; $i < count($xsubdom); $i++) {
    echo '<div>
                               <h5>' . $xsubdom[$i]['judul'] . '</h5>
                         <span class="span">' . $xsubdom[$i]['haritanggal'] . '</span>
                         <img src="' . base_url() . 'resource/uploaded/img/' . $xsubdom[$i]['image1'] . '" alt="' . $xsubdom[$i]['judul'] . '">
                         <p>' . substr(strip_tags($xsubdom[$i]['isi']), 0, 150) . '</p>
                          <span class="more"><a href="' . base_url() . 'index.php/ctrhome/index/' . $xsubdom[$i]['idmenu'] . '/' . $xsubdom[$i]['idcontent'] . '">read more</a></span>
                         </div>';
}
?>       
                <!--                <div>
                                    <h5>Kegiatan Dinas Kelautan & Perikanan</h5>
                                    <span class="span">Minggu, 30 Juni 2013</span>
                                    <img src="images/berita1.jpg"/>
                                    <p>Gemarikan adalah kegiatan yang dilaksanakan melalui berbagai kegiatan promosi dan kampanye yang melibatkan seluruh stakeholder terkait di wilayah provinsi Kalimantan Tengah untuk mendorong peningkatan konsumsi ikan</p>
                                    <span class="more">more</span>
                                </div>-->
            </div>
     <div class="slide-content">
<!--        <div class="previous"><a href="#"><img src="Kalimantan tengah_files/previuos.jpg"/></a></div>-->
<!--        <div class="slide-conten-img">-->
             <h3><?php echo $gallery[0]['judulmenu']; ?></h3>
            <?php 
            echo '<div id="xslider"> ';
            for ($i = 0; $i < count($gallery); $i++) { 
             echo '<div class="slider">
                    <div class="thumbimage">
                     <a href="' . base_url() . 'resource/uploaded/img/' . $gallery[$i]['image1'] . '" data-lightbox="roadtrip">
                         <img src="' . base_url() . 'resource/uploaded/img/' . $gallery[$i]['image1'] . '" title="' . $gallery[$i]['isiawal'] . '" class="thumbnail"/>
                     </a>     
                    </div>      
                  </div>';
            }
            echo '</div>';
          ?>
          <!--  <div class="img-content">
                
            <div class="img-content">
                <img src="Kalimantan%20tengah_files/berita1.jpg" alt="Penetapan WPR Tunggu Perda RTRW">
            </div>
            <div class="img-content">
                <img src="Kalimantan%20tengah_files/berita1.jpg" alt="Penetapan WPR Tunggu Perda RTRW">
            </div>
            <div class="img-content">
                <img src="Kalimantan%20tengah_files/berita1.jpg" alt="Penetapan WPR Tunggu Perda RTRW">
            </div>
            <div class="img-content">
                <img src="Kalimantan%20tengah_files/berita1.jpg" alt="Penetapan WPR Tunggu Perda RTRW">
            </div>
          -->
<!--        </div>-->
<!--        <div class="next"><a href="#"><img src="Kalimantan tengah_files/next.jpg"/></a></div>-->
     </div>
            <div class="vdo">
             <h3><?php echo $videogal[0]['judulmenu']; ?></h3>
            <?php 
            echo $videogal[0]['isi'];
//              for ($i = 0; $i < count($videogal); $i++) { 
//                echo  '<div style="position:relative;floatleft;width:50%">'.$videogal[$i]['isi'].'</div>';
//              }
//            echo '<iframe title="YouTube video player" class="youtube-player" type="text/html" 
//                    width="640" height="390" src="http://www.youtube.com/embed/W-Q7RMpINVo" frameborder="0" allowFullScreen></iframe>';
//             echo '<div id="xslider2">';
//            for ($i = 0; $i < count($videogal); $i++) { 
//             echo '<div class="slider">
//                         ' . $videogal[$i]['isi'] . '
//                    </div>';
//            }
//            echo '</div>';
          ?>
            </div>


            <div class="bottom-content">
                <div class="sub-bottom-content-left">
                    <h4><?php echo $bawah1[0]['judulmenu']; ?></h4>
<?php
$xsubdom = $bawah1;
echo '<div>';
for ($i = 0; $i < count($xsubdom); $i++) {
    echo '<a href="' . base_url() . 'index.php/ctrhome/index/' . $xsubdom[$i]['idmenu'] . '/' . $xsubdom[$i]['idcontent'] . '"><p>' . $xsubdom[$i]['judul'] . '</p></a>';
}
echo '</div>';
?>
                    <!--                    <div>
                                            <a href="#"><p>Passing GradeTes CPNS 2012</p></a>
                                            <a href="#"><p>Menyorot peran dan fungsi wakil kepala daerah dalam tata pemerintahan NKRI</p></a>
                                            <a href="#"><p>Passing GradeTes CPNS 2012</p></a>
                                            <a href="#"><p>Membangkitkan jiwa wirausaha di Kalteng</p></a>
                                            <a href="#"><p>Kamus Bahasa Dayak Ma'anyan</p></a>
                                            <span class="more">more</span>
                                        </div>-->
                </div>
                <div class="sub-bottom-content-midle">
                    <h4><?php echo $bawah2[0]['judulmenu']; ?></h4>
<?php
$xsubdom = $bawah2;
echo '<div>';
for ($i = 0; $i < count($xsubdom); $i++) {
    echo '<a href="' . base_url() . 'index.php/ctrhome/index/' . $xsubdom[$i]['idmenu'] . '/' . $xsubdom[$i]['idcontent'] . '"><p>' . $xsubdom[$i]['judul'] . '</p></a>';
}
echo '</div>';
?>
                    <!--                    <h4>Opini Publik</h4>
                                        <div>
                                            <a href="#"><p>Passing GradeTes CPNS 2012</p></a>
                                            <a href="#"><p>Menyorot peran dan fungsi wakil kepala daerah dalam tata pemerintahan NKRI</p></a>
                                            <a href="#"><p>Passing GradeTes CPNS 2012</p></a>
                                            <a href="#"><p>Membangkitkan jiwa wirausaha di Kalteng</p></a>
                                            <a href="#"><p>Kamus Bahasa Dayak Ma'anyan</p></a>
                                            <span class="more">more</span>
                                        </div>-->
                </div>
                <div class="sub-bottom-content-right">
                    <h4><?php echo $bawah3[0]['judulmenu']; ?></h4>
<?php
$xsubdom = $bawah3;
echo '<div>';
for ($i = 0; $i < count($xsubdom); $i++) {
    echo '<a href="' . base_url() . 'index.php/ctrhome/index/' . $xsubdom[$i]['idmenu'] . '/' . $xsubdom[$i]['idcontent'] . '"><p>' . $xsubdom[$i]['judul'] . '</p></a>';
}
echo '</div>';
?>
                </div>
            </div>
        </div>
        <div id="footer">
            <p>Hak Cipta</p>
            <p>Pemerintah Provinsi Kalimantan Tengah</p>
        </div>
    </div>
    <body>
    </body>
</html>
