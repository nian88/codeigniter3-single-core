<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	function _md5($var ="") {
			return md5($var);
	}
	function ConLevelUser($user){
		$level = json_decode(LEVEL_ADMIN); 
		return $level[$user];
	}
	function ConHariIna($angka){
		$hari = json_decode(HARI_INA); 
		return $hari[$angka];
	}
	function ConHariEng($angka){
		$hari = json_decode(HARI_ENG); 
		return $hari[$angka];
	}
	function ConBulanEng($angka){
		$bln = json_decode(BULAN_ENG); 
		return $bln[$angka];
	}
	function ConBulanIna($angka){
		$bln = json_decode(BULAN_INA); 
		return $bln[$angka];
	}
	function ConJekel($angka=2){
		if ($angka==null ||$angka=="") {
			$angka = 2;
		}
		$jekel = array("Laki-laki", "Perempuan","");
		return $jekel[$angka];
	}
	function randomPassword() {
	    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
	    $pass = array(); //remember to declare $pass as an array
	    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	    for ($i = 0; $i < 8; $i++) {
	        $n = rand(0, $alphaLength);
	        $pass[] = $alphabet[$n];
	    }
	    return implode($pass); //turn the array into a string
	}
	function kirimemail($to="",$pass="")
	{
		$ci =& get_instance();
		$config = [
           'useragent' => 'Niandev',
           'protocol'  => 'smtp',
           'smtp_host' => 'ssl://smtp.googlemail.com',
           'smtp_user' => '',//Email User
           'smtp_pass' => '',//Password Email
           'smtp_port' => 465,
           'smtp_keepalive' => TRUE,
           'smtp_crypto' => 'SSL',
           'wordwrap'  => TRUE,
           'wrapchars' => 80,
           'mailtype'  => 'html',
           'charset'   => 'utf-8',
           'validate'  => TRUE,
           'crlf'      => "rn",
           'newline'   => "\n"
       ];

        $ci->load->library('email',$config);
        $ci->email->set_mailtype("html");
		$ci->email->from('no-replay@niandev.com', 'Official Niandev');
		$ci->email->to($to);
		$ci->email->subject('Reset Password');
		$ci->email->message('Hallo,<br />Permintaan reset password anda sudah kami proses, silahkan login kembali dengan menggunakan : <br />email : '.$to.' <br /> password : '.$pass.'<br /><br />Terimakasih<br /> KupasIN');
		if($ci->email->send()) {
			return 300;
		 }else{
		     return $ci->email->print_debugger();
			return 302;
		 }
	}
