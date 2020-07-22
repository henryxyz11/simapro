<section class='content-header'>
    <h1>
        Telkom
        <small>Data join Table</small>
    </h1>
    
</section>        
<section class='content'>
    
    
    
    <div class='row'>
        <div class='col-xs-12'>   
            <div class="box box-info">
                <div class='box-header with-border'>
                    <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
                    <h3 class='box-title'><?php echo anchor('dashboard/create/', '<i class="glyphicon glyphicon-plus"></i>Tambah Data', array('class' => 'btn btn-primary btn-sm')); ?></h3>
                        <h3 class='box-title'><?php echo anchor(site_url('dashboard/excel'), ' <i class="fa fa-file-excel-o"></i> Download Excel', 'class="btn btn-primary btn-sm"'); ?></h3>
                            <h3 class='box-title'><?php echo anchor('map/', '<i class="glyphicon glyphicon-globe"></i> Buka Peta', array('class' => 'btn btn-primary btn-sm')); ?></h3>
                </div><!-- /.box-header -->
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
                                <th>ODP Name</th>
                                <th>Distance</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $start = 0;
                            foreach ($dashboard_data as $dashboard) {
                                ?>
                                <tr>
                                    <td><?php echo ++$start ?></td>
                                    <td><?php echo $dashboard->nama_cust ?></td>
                                    <td><?php echo $dashboard->no_hp ?></td>
                                    <td><?php echo $dashboard->alamat ?></td>
                                    <td><?php echo $dashboard->latitude ?></td>
                                    <td><?php echo $dashboard->longitude ?></td>
                                    <td>Coming soon</td>
                                    <td></td>
                                      <td style="text-align:center" width="100px">
                                        <?php 
			echo anchor(site_url('dashboard/read/'.$dashboard->id),'<i class="glyphicon glyphicon-globe"></i>',array('data-toggle'=>'tooltip','title'=>'detail','class'=>'btn btn-info btn-sm')); 
			echo '  '; 
			echo anchor(site_url('dashboard/read/'.$dashboard->id),'<i class="fa fa-pencil-square-o"></i>',array('data-toggle'=>'tooltip','title'=>'edit','class'=>'btn btn-info btn-sm')); 
			echo '  '; 
			 
			?>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>					
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#mytable").dataTable();
    });
</script>
