
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
	    
	   
        
            
            
            <div class='form-group'>ODP <?php echo form_error('odp') ?>
            <input type="text" class="form-control" name="name" id="name" placeholder="ODP" value="<?php echo $odp; ?>" />
        </div>
                                 
                                     </div>
                                </form>                               
                            </div>
                            <div class='box-footer'>
<!--                                <input type="hidden" name="id" value="<?php echo $id; ?>" /> -->
                                <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                                <a href="<?php echo site_url('dashboard/read') ?>" class="btn btn-default">Cancel</a>
                            </div>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</section><!-- /.content -->





