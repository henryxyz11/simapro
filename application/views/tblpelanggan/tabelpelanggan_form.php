<section class='content-header'>
	<h1>
		Customer
		<small>Daftar Customer</small>
	</h1>
</section>        
<section class='content'>
    <div class='row'>
        <!-- left column -->
        <div class='col-md-12'>
            <!-- general form elements -->
            <div class='box box-primary'>
                <div class='box-header'>
                <div class='col-md-5'>
        <form action="<?php echo $action; ?>" method="post"><div class='box-body'>
	    <div class="form-group">
            <label for="varchar">Nama Cust <?php echo form_error('nama_cust') ?></label>
            <input type="text" class="form-control" name="nama_cust" id="nama_cust" placeholder="Nama Cust" value="<?php echo $nama_cust; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">No Hp <?php echo form_error('no_hp') ?></label>
            <input type="text" class="form-control" name="no_hp" id="no_hp" placeholder="No Hp" value="<?php echo $no_hp; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Alamat <?php echo form_error('alamat') ?></label>
            <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" value="<?php echo $alamat; ?>" />
        </div>
	    <div class="form-group">
            <label for="decimal">Latitude <?php echo form_error('latitude') ?></label>
            <input type="text" class="form-control" name="latitude" id="latitude" placeholder="Latitude" value="<?php echo $latitude; ?>" />
        </div>
	    <div class="form-group">
            <label for="decimal">Longitude <?php echo form_error('longitude') ?></label>
            <input type="text" class="form-control" name="longitude" id="longitude" placeholder="Longitude" value="<?php echo $longitude; ?>" />
        </div>
        </div><div class='box-footer'>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('pegawai/tabelpelanggan') ?>" class="btn btn-default">Cancel</a>
	 </div>
            </form>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div>
</section><!-- /.content -->