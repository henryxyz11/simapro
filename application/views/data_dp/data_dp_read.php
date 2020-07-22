<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Data_dp Read</h2>
        <table class="table">
	    <tr><td>Witel</td><td><?php echo $witel; ?></td></tr>
	    <tr><td>Kandatel</td><td><?php echo $kandatel; ?></td></tr>
	    <tr><td>Devicesto</td><td><?php echo $devicesto; ?></td></tr>
	    <tr><td>Sto</td><td><?php echo $sto; ?></td></tr>
	    <tr><td>Device Id</td><td><?php echo $device_id; ?></td></tr>
	    <tr><td>Device Name</td><td><?php echo $device_name; ?></td></tr>
	    <tr><td>Latitude</td><td><?php echo $latitude; ?></td></tr>
	    <tr><td>Longitude</td><td><?php echo $longitude; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('data_dp') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>