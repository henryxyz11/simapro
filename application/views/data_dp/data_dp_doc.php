<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>Data_dp List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Witel</th>
		<th>Kandatel</th>
		<th>Devicesto</th>
		<th>Sto</th>
		<th>Device Id</th>
		<th>Device Name</th>
		<th>Latitude</th>
		<th>Longitude</th>
		
            </tr><?php
            foreach ($data_dp_data as $data_dp)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $data_dp->witel ?></td>
		      <td><?php echo $data_dp->kandatel ?></td>
		      <td><?php echo $data_dp->devicesto ?></td>
		      <td><?php echo $data_dp->sto ?></td>
		      <td><?php echo $data_dp->device_id ?></td>
		      <td><?php echo $data_dp->device_name ?></td>
		      <td><?php echo $data_dp->latitude ?></td>
		      <td><?php echo $data_dp->longitude ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>