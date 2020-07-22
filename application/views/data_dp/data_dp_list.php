<section class='content-header'>
<h1>
		DP OVERLAY
		<small>Daftar Data DP</small>
	</h1>
</section>

    <section class='content'>
    <div class='row'>
        <div class='col-xs-12'>
            <div class='box'>  
                

                <div class='box-header with-border'>   
                  
                 <h3 align class='box-title'><?php echo anchor(site_url('data_dp/excel_down'),'<i class="fa fa-file-excel-o"></i> Download Excel',array('class'=>'btn btn-primary btn-sm'));?></h3>
                    <h3 align class='box-title'><?php echo anchor(site_url('data_dp/excel'),'<i class="fa fa-file-excel-o"></i> Excel Down',array('class'=>'btn btn-primary btn-sm'));?></h3>
                <div style="float:right">
                <form action="<?php echo site_url('data_dp/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('data_dp'); ?>" class="btn btn-default">Reset</a>
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
		<th>Witel</th>
		<!--  <th>Kandatel</th> -->
		<!--  <th>Devicesto</th> -->
		<th>Sto</th>
		<!-- <th>Device Id</th> -->
		<th>Device Name</th>
		<th>Latitude</th>
        <th>Longitude</th>
        <th>ODP</th>                        
                                
		<!--  <th>Jumlah ODP</th> -->
		<th>Action</th>
                            </tr>
                            </thead>
	    <tbody>
            <?php
            foreach ($data_dp_data as $data_dp)
            {
                ?>
                <tr>
			<td width="80px" ><?php echo ++$start ?></td>
			<td><?php echo $data_dp->witel ?></td>
		  	<!-- <td><?php // echo $data_dp->kandatel ?></td> -->
			<!--  <td><?php //echo $data_dp->devicesto ?></td> -->
			<td><?php echo $data_dp->sto ?></td>
			<!-- <td><?php // echo $data_dp->device_id ?></td> -->
			<td><?php echo $data_dp->device_name ?></td>
			<td><?php echo $data_dp->latitude ?></td>
            <td><?php echo $data_dp->longitude ?></td>
            <td width="200px"><?php echo $data_dp->odp ?></td>        
			<!--  <td><?php //echo $data_dp->jumlah_odp ?></td> -->

			<td style="text-align:center" width="200px">
                                        <?php 
			echo anchor(site_url('data_dp/read/'.$data_dp->id),'<i class="fa fa-eye"> Details</i>',array('data-toggle'=>'tooltip','title'=>'Detail','class'=>'btn btn-info btn-sm')); 
			echo '  ';
//            echo anchor(site_url('data_dp/update/'.$data_dp->id),'<i class="fa fa-pencil-square-o"> Update</i>',array('data-toggle'=>'tooltip','title'=>'Edit','class'=>'btn btn-info btn-sm')); 
//			echo '  ';     
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
		        <?php  echo anchor(site_url('data_dp/updateODP'), ' Update' , 'class="btn btn-primary"'); ?>  
                <?php  echo anchor(site_url('data_dp/reset_flag'), ' Reset Flag' , 'class="btn btn-primary"'); ?>
                
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
    


