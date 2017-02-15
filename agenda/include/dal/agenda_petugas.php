<?php
$dalTableagenda_petugas = array();
$dalTableagenda_petugas["id_user"] = array("type"=>3,"varname"=>"id_user");
$dalTableagenda_petugas["Username"] = array("type"=>200,"varname"=>"Username");
$dalTableagenda_petugas["Passw"] = array("type"=>200,"varname"=>"Passw");
$dalTableagenda_petugas["Nama_Lengkap"] = array("type"=>200,"varname"=>"Nama_Lengkap");
$dalTableagenda_petugas["Instansi"] = array("type"=>200,"varname"=>"Instansi");
$dalTableagenda_petugas["NIP"] = array("type"=>200,"varname"=>"NIP");
$dalTableagenda_petugas["Alamat_Kantor"] = array("type"=>200,"varname"=>"Alamat_Kantor");
$dalTableagenda_petugas["Telp_Kantor"] = array("type"=>200,"varname"=>"Telp_Kantor");
$dalTableagenda_petugas["Telp_HP"] = array("type"=>200,"varname"=>"Telp_HP");
	$dalTableagenda_petugas["id_user"]["key"]=true;
$dal_info["agenda_petugas"]=&$dalTableagenda_petugas;

?>