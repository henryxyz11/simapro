<header class="main-header">
    <a href="<?php echo site_url('dashboard'); ?> " class="logo">
        <span class="logo-mini"><b>TLK</b></span>
        <span class="logo-lg"><b>TELKOM</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-calendar"></i>
                        <span> <?php echo tanggal_new(); ?></span>
                    </a>                    
                </li>
            </ul>
        </div>
    </nav>
</header>
