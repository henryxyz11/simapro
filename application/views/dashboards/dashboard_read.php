



<?php
//set_time_limit(0);


function get_odp_pelanggan($lat,$long){

    
    $url="https://starclick.telkom.co.id/noss_prod/data/newoss_get_alpro.php";
    $postinfo = "lat=$lat&lng=$long&product=MAX SPEED 10M&productlist=MAX SPEED 10M&Radiuses=Radius 500M";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_NOBODY, false);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_USERAGENT,
        "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.7.12) Gecko/20050915 Firefox/1.0.7");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);

    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postinfo);
    $res = curl_exec($ch);
    return json_decode($res);
    
}
    

function distance($lat1, $long1, $lat2, $long2, $unit) {

  $theta = $long1 - $long2;
  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
  $dist = acos($dist);
  $dist = rad2deg($dist);
  $miles = $dist * 60 * 1.1515 ;
  $unit = strtoupper($unit);

  if ($unit == "K") {
    return ($miles * 1.609344);
  } else if ($unit == "N") {
      return ($miles * 0.8684);
    } else {
        return $miles;
      }
}


?>
<section class='content-header'>
	<h1>
		Data
		<small>Daftar ODP Pelanggan</small>
	</h1>

</section>   
<section class='content'>
          <div class='row'>
            <div class='col-xs-12'>
              <div class='box box-primary'>
                <div class='box-header'>
                   <div class='box-body table-responsive'> 
                    
                    
                <h3 class='box-title'> Detail ODP</h3>
        <table class="table table-bordered table-striped" id="mytable">
            <br><br>
                
        <tr><td width>Nama Cust</td><td width=700px> <?php echo $nama_cust; ?>    </td></tr>
	    <tr><td>No Hp</td><td width=700px> <?php echo $no_hp; ?> </td></tr>
	    <tr><td>Alamat</td><td width=700px> <?php echo $alamat; ?> </td></tr>
	    <tr><td>Latitude</td><td width=700px> <?php echo $latitude; ?> </td></tr>
	    <tr><td>Longitude</td><td width=700px> <?php echo $longitude; ?> </td></tr>
            
            
            
            
	</table>
                <br>
                    <h3 class='box-title'>ODP By Starclick</h3>
                       <br><br>
                    <table class="table table-bordered table-striped" id="mytable">
                        <th>Device ID</th>
                <th>PD Name</th>
                <th>ODP NAME</th>
                <th>Technology</th>
                <th>STO</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Distance</th>
                <th>District</th>
                <th>City</th>
                <th>Street Name</th>
                    <?php
                $get = get_odp_pelanggan($latitude,$longitude);
                if ($get->success) {
                    foreach ($get->odp as $odp) {
                        $dis = distance($latitude,$longitude,$odp->latitude,$odp->longitude,"K");
                        $meters = $dis * 1000;
                        echo "<tr>";
                        echo "<td>$odp->deviceID</td>";
                        echo "<td>$odp->hostName</td>";
                        echo "<td>$odp->networkLocation</td>";
                        echo "<td>$odp->technology</td>";
                        echo "<td>$odp->stoCode</td>";
                        echo "<td>$odp->latitude</td>";
                        echo "<td>$odp->longitude</td>";
                        echo "<td>".number_format($meters, 2, '.', '')." M</td>";
                        echo "<td>$odp->district</td>";
                        echo "<td>$odp->city</td>";
                        echo "<td>$odp->streetName</td>";
                        echo "</tr>";
                    }
                }else{
                    echo "<tr rowspan=\"10\"><td>Tidak ditemukan ODP disekitar radius</td></tr>";
                }
                ?>
                    
                    </table> 
   
                    
                  <br>  
                    
        <h1 class='box-title'>ODP By Local</h1>
        
                       <table class="table table-bordered table-striped" id="mytable">
                        <th>Device ID</th>
                <th>PD Name</th>
                <th>ODP NAME</th>
                <th>Technology</th>
                <th>STO</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Distance</th>
                <th>District</th>
                <th>City</th>
                <th>Street Name</th>
                    <?php
                $get = get_odp_pelanggan($latitude,$longitude);
                if ($get->success) {
                    foreach ($get->odp as $odp) {
                        $dis = distance($latitude,$longitude,$odp->latitude,$odp->longitude,"K");
                        $meters = $dis * 1000;
                        echo "<tr>";
                        echo "<td>$odp->deviceID</td>";
                        echo "<td>$odp->hostName</td>";
                        echo "<td>$odp->networkLocation</td>";
                        echo "<td>$odp->technology</td>";
                        echo "<td>$odp->stoCode</td>";
                        echo "<td>$odp->latitude</td>";
                        echo "<td>$odp->longitude</td>";
                        echo "<td>".number_format($meters, 2, '.', '')." M</td>";
                        echo "<td>$odp->district</td>";
                        echo "<td>$odp->city</td>";
                        echo "<td>$odp->streetName</td>";
                        echo "</tr>";
                    }
                }else{
                    echo "<tr rowspan=\"10\"><td>Tidak ditemukan ODP disekitar radius</td></tr>";
                }
                ?>
                    
                    </table>
                       
                       
                       
                       
                    </div>
                    
                    
                
        <div class='box-footer'>
        <a href="<?php echo site_url('pegawai/dashboard') ?>" class="btn btn-primary">Back</a>
        <button class="btn btn-info" title="Click to show/hide content" type="button" onclick="if(document.getElementById('spoiler') .style.display=='none') {document.getElementById('spoiler') .style.display=''}else{document.getElementById('spoiler') .style.display='none'}">Peta ODP Local</button>
        <button class="btn btn-success" title="Click to show/hide content" type="button" onclick="if(document.getElementById('spoiler') .style.display=='none') {document.getElementById('spoiler') .style.display=''}else{document.getElementById('spoiler') .style.display='none'}">Peta ODP Starclick</button>    
          </div>  
        </div>
            <div>
                    <br>
                    
                    <div id="spoiler" style="display:none">
                        <div class='box-header'>
                    <h3 class='box-title'>Peta Distribusi Data</h3>
                    <br> 
                    <head>
    <?php echo $map1['js']; ?>
</head>  
            <body>
               <div>
                
               </div>
<?php echo $map1['html']; ?>
  <!-- TODO 1: Create a place to put the map in the HTML -->

<br>
</body>
                    </div> 

        
                    
                  </div>    
                  </div>
        <!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
       


