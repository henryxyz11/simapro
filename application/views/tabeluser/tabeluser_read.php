<section class='content-header'>
	<h1>
		TB_Tabel User
		<small>Daftar User</small>
	</h1>
	
</section>   
<section class='content'>
          <div class='row'>
            <div class='col-xs-12'>
              <div class='box box-primary'>
                <div class='box-header'>
                <h3 class='box-title'> Detail User</h3>
        <table class="table table-bordered">    
        <tr><td width>Nama User</td><td width=700px> <?php echo $nama; ?>    </td></tr>
	    <tr><td>Username</td><td width=700px> <?php echo $username; ?> </td></tr>
	    <tr><td>Password</td><td width=700px> <?php echo $password; ?> </td></tr>
	    <tr><td>Email</td><td width=700px> <?php echo $email; ?> </td></tr>
	    <tr><td>Level</td><td width=700px> <?php echo $level; ?> </td></tr>
            
            
	</table>
         <div class='box-footer'>
        <!-- <a input type="button" value="Close Tab" onclick="self.close() "class="btn btn-primary">Back</a> -->
        <a href="<?php echo site_url('tabeluser') ?>" class="btn btn-primary">Back</a>
        </div>
        </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
