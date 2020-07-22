
<section class='content-header'>
<h1>
		Customer
		<small>Daftar Customer</small>
	</h1>
</section>
<section class='content'>
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box'>  
                

                <div class='box-header with-border'>   
                 <h3 class='box-title'><?php echo anchor('pegawai/tabelpelanggan/create/','<i class="glyphicon glyphicon-plus"></i>Tambah Data',array('class'=>'btn btn-primary btn-sm'));?></h3>  
                 <h3 align class='box-title'><?php echo anchor(site_url('tabelpelanggan/excel'),'<i class="fa fa-file-excel-o"></i> Download Excel',array('class'=>'btn btn-primary btn-sm'));?></h3>
                    <h3 align class ='box-title'><a class="btn btn-success btn-sm add" href="<?=site_url('tabelpelanggan/import')?>"><i class ='fa fa-file-excel-o'> Import Data</i></a></h3>
                <div style="float:right">
                <form action="<?php echo site_url('pegawai/tabelpelanggan/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('pegawai/tabelpelanggan'); ?>" class="btn btn-default">Reset</a>
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
								<th>No</th>
		<th>Nama Customer</th>
		<th>No Hp</th>
		<th>Alamat</th>
		<th>Latitude</th>
        <th>Longitude</th>
		<th>Action</th>
													</tr>
                            </thead>
	    <tbody>
                            <?php
            foreach ($tabelpelanggan_data as $tabelpelanggan)
            {
                ?>
                <tr>
			<td width="20px"><?php echo ++$start ?></td>
			<td><?php echo $tabelpelanggan->nama_cust ?></td>
			<td><?php echo $tabelpelanggan->no_hp ?></td>
			<td><?php echo $tabelpelanggan->alamat ?></td>
			<td><?php echo $tabelpelanggan->latitude ?></td>
			<td><?php echo $tabelpelanggan->longitude ?></td>
			<td style="text-align:center" width="140px">
			<?php 
			echo anchor(site_url('pegawai/tabelpelanggan/read/'.$tabelpelanggan->id),'<i class="fa fa-eye"></i>',array('target' => '_blank','data-toggle'=>'tooltip','title'=>'Detail','class'=>'btn btn-info btn-sm')); 
			echo '  '; 
			// echo anchor(site_url('tabelpelanggan/read/'.$tabelpelanggan->id),'<i class="fa fa-eye"></i>',array('data-toggle'=>'tooltip','title'=>'detail','class'=>'btn btn-info btn-sm')); 
			// echo '  '; 
			echo anchor(site_url('pegawai/tabelpelanggan/update/'.$tabelpelanggan->id),'<i class="fa fa-pencil-square-o"></i>',array('data-toggle'=>'tooltip','title'=>'Edit','class'=>'btn btn-info btn-sm')); 
			echo '  '; 
			echo anchor(site_url('pegawai/tabelpelanggan/delete/'.$tabelpelanggan->id),'<i class="fa fa-trash-o"></i>','data-toggle="tooltip" title="Delete" class="btn btn-info btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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
            
            
            </div>    
            </div>
            </div>
    </div>
            </section>       
	
