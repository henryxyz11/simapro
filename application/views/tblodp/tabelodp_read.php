
<section class='content-header'>
	<h1>
		TB_ODP
		<small>Daftar ODP</small>
	</h1>

</section>   
<section class='content'>
          <div class='row'>
            <div class='col-xs-12'>
              <div class='box box-primary'>
                <div class='box-header'>
                <h3 class='box-title'> Detail DP</h3>
        <table class="table table-bordered">
	    <tr><td>Regional</td><td><?php echo $reg; ?></td></tr>
	    <tr><td>Witel</td><td><?php echo $witel; ?></td></tr>
            <tr><td>Sto</td><td><?php echo $sto; ?></td></tr>
            <tr><td>PD Name</td><td><?php echo $pd_name; ?></td></tr>
            <tr><td>ODP Name</td><td><?php echo $odp_name; ?></td></tr>
            <tr><td>ODP Index</td><td><?php echo $odp_index; ?></td></tr>
            <tr><td>F Coor</td><td><?php echo $f_coor; ?></td></tr>
            <tr><td>F LOC</td><td><?php echo $f_loc; ?></td></tr>
            <tr><td>F OLT</td><td><?php echo $f_olt; ?></td></tr>
            <tr><td>Latitude</td><td><?php echo $latitude; ?></td></tr>
            <tr><td>Longitude</td><td><?php echo $longitude; ?></td></tr>
            <tr><td>IS AVAIL</td><td><?php echo $is_avail; ?></td></tr>
            <tr><td>IS BLOCKING</td><td><?php echo $is_blocking; ?></td></tr>
            <tr><td>IS Other</td><td><?php echo $is_other; ?></td></tr>
            <tr><td>IS Reserve</td><td><?php echo $is_reserve; ?></td></tr>
            <tr><td>IS Service</td><td><?php echo $is_service; ?></td></tr>
            <tr><td>IS Total</td><td><?php echo $is_total; ?></td></tr>
            <tr><td>Update date</td><td><?php echo $updatedate; ?></td></tr>
            
	</table>
        <div class='box-footer'>
        <a href="<?php echo site_url('pegawai/tabelodp') ?>" class="btn btn-primary">Back</a>
        </div>
        </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->