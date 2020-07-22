<?php
set_time_limit(0);
function get_alpro($lat,$long){
	$url="https://starclick.telkom.co.id/noss_prod/data/newoss_get_alpro.php"; 
	$postinfo = "lat=$lat&lng=$long&product=MAX SPEED 10M&productlist=MAX SPEED 10M";

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

$mysql_conn = mysql_connect("localhost","root","");
if(!$mysql_conn) {
  echo "An error occurred.3\n";
  exit;
}else{
mysql_select_db("alpro");
}

$query = mysql_query("SELECT * FROM coba WHERE (longitude <> 0 AND latitude <> 0 AND longitude <> '' AND latitude <> '')");

while ($res = mysql_fetch_array($query)) {
	$long = $res['longitude'];
	$id = $res['id'];
	$lat = $res['latitude'];
	$odp =  get_alpro($lat,$long);
	if($odp->success){
		$odp_list = "";
		$jml =0;
		foreach ($odp->odp as $odp) {
			$odp_list .= $odp->networkLocation."\n";
			$jml++;
		}
		mysql_query("UPDATE data_dp SET gponable = 'YES',odp = '$odp_list',jumlah_odp='$jml' WHERE id='$id'");
	}else{
		mysql_query("UPDATE data_dp SET gponable = 'NO' WHERE id='$id'");
	}
	sleep(5);
}