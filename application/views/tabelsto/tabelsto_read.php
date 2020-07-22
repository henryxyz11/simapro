
<section class='content-header'>
    <h1>
        TB_STO
        <small>Daftar STO</small>
    </h1>

</section>   
<section class='content'>
          <div class='row'>
            <div class='col-xs-12'>
              <div class='box box-primary'>
                <div class='box-header'>
                <h3 class='box-title'> Detail STO </h3>
        <table class="table table-bordered">
        <tr><td>Witel</td><td><?php echo $witel; ?></td></tr>
        <tr><td>Datel</td><td><?php echo $datel; ?></td></tr>
        <tr><td>Sto</td><td><?php echo $sto; ?></td></tr>
        <tr><td>Latitude</td><td><?php echo $latitude; ?></td></tr>
        <tr><td>Longitude</td><td><?php echo $longitude; ?></td></tr>
        <tr><td>Alamat</td><td><?php echo $alamat; ?></td></tr>
    </table>
        <div class='box-footer'>
        <a href="<?php echo site_url('tabelsto') ?>" class="btn btn-primary">Back</a>
        </div>
        <table id="ref" class="table table-hover table-condensed table-striped table-responsive" style="font-size: 14px">
                <th>Nama STO</th>
                <th>Alamat STO</th>
                <th>Koordinat STO</th>
                <th>Type STO</th>
                <th>MerK</th>
                <th>Port Idle</th>
                <th>Port Used</th>
        </table>
         <div >
        <a href="<?php echo site_url('dashboard') ?>" class="btn btn-danger">Back</a>
        <button class="btn btn-primary" title="Click to show/hide content" type="button" onclick="if(document.getElementById('peta1') .style.display=='none') {document.getElementById('peta1') .style.display=''}else{document.getElementById('peta1') .style.display='none'}">Peta</button>
        </div>
        </div>
        <!-- /.box-body -->
        <div>
                    <br>
                    
                    <div id="peta1" style="display:none">
                        <div class='box-header'>
                    <h3 class='box-title'>Peta Distribusi Data</h3>
                    <br> 
                    <head>
    <?php echo $map_one['js']; ?>
</head>  
            <body>
<?php echo $map_one['html']; ?>
  <!-- TODO 1: Create a place to put the map in the HTML -->

<br>
</body>
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->