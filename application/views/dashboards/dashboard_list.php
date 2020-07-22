<section class='content-header'>
    <h1>
        DASHBOARD
        <small>Data Management</small>
    </h1>
</section>        
<section class='content'>
    <div class="row">
        
         <div class='col-xs-12'>
            <div class='box'>  
                <div class='box-header with-border'>
        
        <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
                    
                    
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>
                        
                    </h3>
                    <p>Customer</p>
                </div>
                <div class="icon">
                    <i class="fa fa-th-list"></i>
                </div>
                <a href="<?php echo base_url('tabelpelanggan'); ?>" class="small-box-footer">More Detail <i class="fa fa-arrow-circle-right"></i></a>
            </div>
    </div>
    
    
    <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>
                        
                    </h3>
                    <p>Data ODP</p>
                </div>
                <div class="icon">
                    <i class="fa fa-suitcase"></i>
                </div>
                <a href="<?php echo base_url('tabelodp'); ?>" class="small-box-footer">More Detail <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    
                    
                    <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3> 
                        
                    </h3> 
                    <p>STO Data </p>
                </div>
                <div class="icon">
                    <i class="glyphicon glyphicon-earphone"></i>
                </div>
                <a href="<?php echo base_url('tabelsto'); ?>" class="small-box-footer">More Detail <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
                    
                    
                    
                    
                    
    </div>
             </div></div></div>
    
    
    
    
    
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box'>  
                <div class='box-header with-border'>
                    
<!--                 <h3 class='box-title'><?php echo anchor('dashboard/create/','<i class="glyphicon glyphicon-plus"></i>Tambah Data',array('class'=>'btn btn-primary btn-sm'));?></h3>-->
                
                 <h3 align class='box-title'><?php echo anchor(site_url('dashboard/excel'),'<i class="fa fa-file-excel-o"></i> Download Excel',array('class'=>'btn btn-primary btn-sm'));?></h3>

<!--                 <h3 class='box-title'><?php echo anchor('map', '<i class="glyphicon glyphicon-globe"></i> Buka Peta', array('class' => 'btn btn-primary btn-sm','target'=>'_blank')); ?></h3>-->

                <div style="float:right">
                <form action="<?php echo site_url('dashboard'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('dashboard'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>   
                        </span>
                    </div>
                </form>
            </div>    
                        
                </div>
                <div class='box-body table-responsive'>
                    <table class="table table-bordered table-striped" id="mytable">
                        <thead>
                            <tr>
                <th width="30px">No</th>
                                <th>Nama Customer</th>
                                <th>No HP</th>
                                <th>Alamat</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th >Update Date</th>
                                <th>Action</th>
                                
                            </tr>
                             </thead>
                        <tbody>
                            <?php
            foreach ($dashboard_data as $dashboard)
            {
                ?>
                <tr>
            <td width="80px"><?php echo ++$start ?></td>
            <td><?php echo $dashboard->nama_cust ?></td>
            <td><?php echo $dashboard->no_hp ?></td>
            <td><?php echo $dashboard->alamat ?></td>
            <td><?php echo $dashboard->latitude ?></td>
            <td><?php echo $dashboard->longitude ?></td>
                    <td width="140px">Coming Soon</td>
                    
            <td style="text-align:center" width="100px">
            <?php 
            echo anchor(site_url('pegawai/dashboard/read/'.$dashboard->id),'<i class="glyphicon glyphicon-globe"> Detail</i>',array('data-toggle'=>'tooltip','title'=>'Detail','class'=>'btn btn-info btn-sm')); 
            echo '  ';
//                    echo anchor(site_url('dashboard/read/'.$dashboard->id),'<i class="fa fa-eye"></i>',array('target' => '_blank','data-toggle'=>'tooltip','title'=>'Detail','class'=>'btn btn-info btn-sm')); 
//          echo '  '; 
            ?>
            </td>
              </tr>
                <?php
            }
            ?>
                        </tbody>
                    </table>
                    <br>
                <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary" >Total Record : <?php echo $total_rows ?></a>
            </div>

            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>      
                                  
                </div>
<head>   
</head>  
<body>
</body>
            </div>    
            </div>
            </div>
    </div>
            </section>
    