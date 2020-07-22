
<section class='content-header'>
<h1>
		User
		<small>Daftar User</small>
	</h1>
</section>
<section class='content'>
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box'>  
                

                <div class='box-header with-border'>   
                 <h3 class='box-title'><?php echo anchor('tabeluser/create/','<i class="glyphicon glyphicon-plus"></i>Tambah Data',array('class'=>'btn btn-primary btn-sm'));?></h3>  
            
                <div style="float:right">
                <form action="<?php echo site_url('tabeluser/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('tabeluser'); ?>" class="btn btn-default">Reset</a>
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
		<th>Nama User</th>
		<th>Username</th>
		<th>Password</th>
		<th>Email</th>
        <th>Level</th>
		<th>Action</th>
													</tr>
                            </thead>
	    <tbody>
                            <?php
            foreach ($tabeluser_data as $tabeluser)
            {
                ?>
                <tr>
			<td width="20px"><?php echo ++$start ?></td>
			<td><?php echo $tabeluser->nama ?></td>
			<td><?php echo $tabeluser->username ?></td>
			<td><?php echo $tabeluser->password ?></td>
			<td><?php echo $tabeluser->email ?></td>
			<td><?php echo $tabeluser->level ?></td>
			<td style="text-align:center" width="140px">
			<?php 
			echo anchor(site_url('tabeluser/read/'.$tabeluser->id),'<i class="fa fa-eye"></i>',array('target' => '_blank','data-toggle'=>'tooltip','title'=>'Detail','class'=>'btn btn-info btn-sm')); 
			echo '  '; 
			// echo anchor(site_url('tabelpelanggan/read/'.$tabelpelanggan->id),'<i class="fa fa-eye"></i>',array('data-toggle'=>'tooltip','title'=>'detail','class'=>'btn btn-info btn-sm')); 
			// echo '  '; 
			echo anchor(site_url('tabeluser/update/'.$tabeluser->id),'<i class="fa fa-pencil-square-o"></i>',array('data-toggle'=>'tooltip','title'=>'Edit','class'=>'btn btn-info btn-sm')); 
			echo '  '; 
			echo anchor(site_url('tabeluser/delete/'.$tabeluser->id),'<i class="fa fa-trash-o"></i>','data-toggle="tooltip" title="Delete" class="btn btn-info btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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
	
