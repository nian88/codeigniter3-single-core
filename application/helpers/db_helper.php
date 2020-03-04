<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
	Helper DB
	Azhar NIAN -Niandev-
	05-10-2018
*/

function getBackup($download=true,$tables=array(),$ignore=array(),$insert=true) {
    $ci =& get_instance();
	$tanggal=date('Ymd-His');
	$namaFile=$tanggal . '.sql';

	$prefs = array(
        'tables'        => $tables,   // Array of tables to backup.
        'ignore'        => $ignore,   // List of tables to omit from the backup
        'format'        => 'txt',     // gzip, zip, txt
        'filename'      => $namaFile, // File name - NEEDED ONLY WITH ZIP FILES
        'add_drop'      => TRUE,      // Whether to add DROP TABLE statements to backup file
        'add_insert'    => $insert,      // Whether to add INSERT data to backup file
        'newline'       => "\n"       // Newline character used in backup file
	);


	$ci->load->dbutil();
	$backup=$ci->dbutil->backup($prefs);
	
	if ($download==true) {
		$ci->load->helper('download');
		force_download($namaFile, $backup);
	}else{
		$ci->load->helper('file');


		if (!is_dir('backupdb')) {
		    mkdir('./backupdb' , 0777, TRUE);

		}
		write_file('backupdb/'.$namaFile, $backup);
	}

}
function getRestore($filename)    
{               
    $ci =& get_instance();
	$isi_file = file_get_contents('backupdb/' .$filename ); //PANGGIL FILE YANG TERUPLOAD
	$string_query = rtrim( $isi_file, "\n;" );
	$array_query = explode(";", $string_query);   //JALANKAN QUERY MERESTORE KEDATABASE
	foreach($array_query as $query)
	{
		$ci->db->query($query);
	}
}