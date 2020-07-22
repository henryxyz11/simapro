<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" style="height: auto;">
        <!-- Sidebar user panel -->


        <!-- search form -->                    
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header bg-blue-active">MAIN NAVIGATION</li>     
                <li class=""><a href="<?php echo site_url('pegawai/dashboard'); ?>"><i class="fa fa-dashboard fa-lg"></i>  <span class="treeview">DASHBOARD</span></a></li>
                    
                <li class=""><a href="<?php echo base_url('index.php/auth/logout'); ?>"><i class="glyphicon glyphicon-log-out"></i>  <span class="treeview">LOG OUT</span></a></li>

            <li class="header bg-blue-active">DATA NAVIGATION</li>
            <li class="active" treeview=""><a href="#" class="dropdown-toggle"><i class="fa fa-gears"></i>
            
                                <span class="treeview">DATA</span>
                                <b class="fa fa-angle-left pull-right"></b></a>
            <ul class="treeview-menu"><li class="active" treeview=""><a href="<?php echo site_url('pegawai/tabelpelanggan'); ?>"><i class="fa fa-th-list"></i>CUSTOMER</a></li></ul>
            
            <ul class="treeview-menu"><li class="active" treeview=""><a href="<?php echo site_url('pegawai/tabelodp'); ?>"><i class="fa fa-suitcase"></i>DATA ODP</a></li></ul>

            <ul class="treeview-menu"><li class="active" treeview=""><a href="<?php echo site_url('pegawai/tabelsto'); ?>"><i class="fa fa-suitcase"></i>DATA STO</a></li></ul>
     
            
            
            </li>
        </ul> 
        <!--/.nav-list-->             
    </section>
    <!-- /.sidebar -->
</aside>