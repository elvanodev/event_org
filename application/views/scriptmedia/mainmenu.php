<div class="primary-nav row">
    <nav class="navbar">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php
                 $i = 1;
                 $menu = (!empty($menu))?$menu : array();
                $xbuf = "";
                foreach ($menu as $showmenu) {
                    //print_r($showmenu['childmenu']);
               
                    if (!empty($showmenu['childmenu'])) {
                        $attr = 'class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false"';
                        $childicon = '<span class="caret"></span>';
                        $childclass = 'dropdown';
                        
                    }else {
                        $childclass = '';
                        $childicon = '';
                        $attr = '';
                    }
                    $xbuf .= '<li role="presentation" class="' . $childclass . ' border-bottom-' . $i . '"><a '.$attr.' href="'.$showmenu['urlmenu'].'">' . $showmenu['namamenu'] . $childicon.'</a>';
                    if (!empty($showmenu['childmenu'])) {
                        $xbuf .= '<ul class="dropdown-menu" role="menu">';
                        foreach ($showmenu['childmenu'] as $anak) {
                            $xbuf .= '<li role="presentation" class=""><a href="'.$anak['urlmenu'].'">' . $anak['namamenu'] . '</a></li>';
                        }
                        $xbuf .= '</ul>';
                    }
                    $xbuf .= '</li>';
                    $i++;
                }
                echo $xbuf;
                ?>
            </ul>
        </div>
    </nav>
</div>