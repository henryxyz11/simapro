<section class='content-header'>
	<h1>
		TB_Tabel Pelanggan
		<small>Daftar Customer</small>
	</h1>
	
</section>   
<section class='content'>
          <div class='row'>
            <div class='col-xs-12'>
              <div class='box box-primary'>
                <div class='box-header'>
                <h3 class='box-title'> Detail Customer</h3>
        <table class="table table-bordered">    
        <tr><td width>Nama Cust</td><td width=700px> <?php echo $nama_cust; ?>    </td></tr>
	    <tr><td>No Hp</td><td width=700px> <?php echo $no_hp; ?> </td></tr>
	    <tr><td>Alamat</td><td width=700px> <?php echo $alamat; ?> </td></tr>
	    <tr><td>Latitude</td><td width=700px> <?php echo $latitude; ?> </td></tr>
	    <tr><td>Longitude</td><td width=700px> <?php echo $longitude; ?> </td></tr>
            
            
	</table>
         <div class='box-footer'>
        <!-- <a input type="button" value="Close Tab" onclick="self.close() "class="btn btn-primary">Back</a> -->
        <a href="<?php echo site_url('tabelpelanggan') ?>" class="btn btn-primary">Back</a>
        </div>
        </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
