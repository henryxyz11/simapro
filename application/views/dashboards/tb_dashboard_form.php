
<section class='content-header'>
    <h1>
        DP
        <small>Edit Data ODP</small>
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
                        <form action="<?php echo $action; ?>" method="post">
                            <div class='box-body'>
                                
                                
                                <form action="<?php echo $action; ?>" method="post"><div class='box-body'>
	    <div class='form-group'>Nama Customer <?php echo form_error('name') ?>
            <input type="text" class="form-control" name="name" id="name" placeholder="Nama Customer" value="<?php echo $nama_cust; ?>" />
        </div>
	    <div class='form-group'>No HP <?php echo form_error('description') ?>
            <input type="text" class="form-control" name="description" id="description" placeholder="No Handphone" value="<?php echo $no_hp; ?>" />
        <div class='form-group'>Alamat <?php echo form_error('name') ?>
            <input type="text" class="form-control" name="name" id="name" placeholder="Alamat" value="<?php echo $alamat; ?>" />
        </div>
            <div class='form-group'>Latitude <?php echo form_error('name') ?>
            <input type="text" class="form-control" name="name" id="name" placeholder="Latitude" value="<?php echo $lat; ?>" />
        </div>
            <div class='form-group'>Longitude <?php echo form_error('name') ?>
            <input type="text" class="form-control" name="name" id="name" placeholder="Longitude" value="<?php echo $long; ?>" />
        </div>
                                 
                                     </div></div>
                                </form>                               
                            </div>
                            <div class='box-footer'>
                                <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
                                <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                                <a href="<?php echo site_url('dashboard') ?>" class="btn btn-default">Cancel</a>
                            </div>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</section><!-- /.content -->