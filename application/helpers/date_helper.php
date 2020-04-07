<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
function _tglIndo($tgl){
  $arrBulan=array("","Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agu","Sep","Okt","Nov","Des");
  $tanggal  = date("d",strtotime($tgl));
  $bulan  = $arrBulan[date("n",strtotime($tgl))];
  $tahun  = date("Y",strtotime($tgl));
  return $tanggal ." ".$bulan." ".$tahun;
}
function _tglEng($tgl){
  // 17-11-2018
  $tgl=explode("-", $tgl);
  $tanggal = $tgl[0];
  $bulan = $tgl[1];
  $tahun = $tgl[2];
  return $tahun.'-'.$bulan.'-'.$tanggal;
}
function _tglInd($tgl){
  $tgl=explode("-", $tgl);
  $tanggal = $tgl[2];
  $bulan = $tgl[1];
  $tahun = $tgl[0];
  return $tanggal.'-'.$bulan.'-'.$tahun;
}
function _getDayOfWeek($tgl){
  $arrHari=array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
  if ($tgl=="") {
    return "";
  }
  return $arrHari[$tgl];
}
