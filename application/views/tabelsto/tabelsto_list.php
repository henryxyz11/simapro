<section class='content-header'>
<h1>
		STO
		<small>Daftar Data STO</small>
	</h1>
</section>

    <section class='content'>
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box'>  
                

                <div class='box-header with-border'>   
                 <h3 class='box-title'><?php echo anchor('tabelsto/create/','<i class="glyphicon glyphicon-plus"></i>Tambah Data',array('class'=>'btn btn-primary btn-sm'));?></h3>  
                 <h3 align class='box-title'><?php echo anchor(site_url('tabelsto/excel'),'<i class="fa fa-file-excel-o"></i> Download Excel',array('class'=>'btn btn-primary btn-sm'));?></h3>
                <div style="float:right">
                <form action="<?php echo site_url('tabelsto/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('tabelsto'); ?>" class="btn btn-default">Reset</a>
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
                                <th>Witel</th>
                                <th>Datel</th>
                                <th>Sto</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>Alamat</th>
                                <th>Action</th>
                            </tr>
                            </thead>
	    <tbody>
            <?php
            foreach ($tabelsto_data as $tabelsto)
            {
                ?>
                <tr>
            <td width="80px"><?php echo ++$start ?></td>
            <td><?php echo $tabelsto->witel ?></td>
            <td><?php echo $tabelsto->datel ?></td>
            <td><?php echo $tabelsto->sto ?></td>
            <td><?php echo $tabelsto->latitude ?></td>
            <td><?php echo $tabelsto->longitude ?></td>
            <td><?php echo $tabelsto->alamat ?></td>
            <td style="text-align:center" width="200px">
                <?php 
			echo anchor(site_url('tabelsto/read/'.$tabelsto->id),'<i class="fa fa-eye"></i>',array('target' => '_blank','data-toggle'=>'tooltip','title'=>'Detail','class'=>'btn btn-info btn-sm')); 
			echo '  '; 
			echo anchor(site_url('tabelsto/update/'.$tabelsto->id),'<i class="fa fa-pencil-square-o"></i>',array('data-toggle'=>'tooltip','title'=>'Edit','class'=>'btn btn-info btn-sm')); 
			echo '  '; 
			echo anchor(site_url('tabelsto/delete/'.$tabelsto->id),'<i class="fa fa-trash-o"></i>','data-toggle="tooltip" title="Delete" class="btn btn-info btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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
    


