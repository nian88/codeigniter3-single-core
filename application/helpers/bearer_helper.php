<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
   function getAuth() {
   		$key = "";
        $ci =& get_instance();
        $server =$ci->input->server(array('HTTP_USER_AGENT', 'HTTP_AUTHORIZATION'));
        if ($server['HTTP_USER_AGENT']!=="") {
        	echo "Anda Tidak Punya Hak Untuk Mengakses Halaman Ini";
        	return false;
        }
        if (getBearerToken()!==$key) {
        	echo "Anda Tidak Punya Hak Untuk Mengakses Halaman Ini";
        	return false;
        }
        return true;
   }
   function getTokenForm()
   {
    $ci =& get_instance();
    $nada = "<input type='hidden' name='".$ci->security->get_csrf_token_name()."' value='".$ci->security->get_csrf_hash()."'>";
    echo $nada;
   }

    /**
 * Get header Authorization
 * */
function getAuthorizationHeader(){
        $headers = null;
        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        }
        else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            //print_r($requestHeaders);
            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }
        return $headers;
    }
function getBearerToken() {
    $headers = getAuthorizationHeader();
    // HEADER: Get the access token from the header
    if (!empty($headers)) {
        if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
            return $matches[1];
        }
    }
    return null;
}