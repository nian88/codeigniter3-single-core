<?php
function nada()
{
	// load_config();
}
function load_config()
{
	$CI =& get_instance();
	
	//Memuat konfigurasi dari database kefalam konfigurasi global CI
	$nada = $CI->db->from('app_config')->order_by("key", "asc")->get();

	foreach($nada->result() as $app_config)
	{
		$CI->config->set_item($app_config->key,$app_config->value);
	}
	
	//Set konfigurasi timezone CI dengan konfigurasi dari database
	if ($CI->config->item('timezone'))
	{
		date_default_timezone_set($CI->config->item('timezone'));
	}

}
function load_menu()
{
	$CI =& get_instance();
	
	//Memuat konfigurasi dari database kefalam konfigurasi global CI
	$nada = $CI->db->from('permission')->where(array("description"=>"menu header"))->get();
	$CI->session->set_userdata("Menu",$nada->result());
	// foreach($nada->result() as $app_menu)
	// {
	// 	$CI->config->set_item($app_config->key,$app_config->value);
	// }
	
	// //Set konfigurasi timezone CI dengan konfigurasi dari database
	// if ($CI->config->item('timezone'))
	// {
	// 	date_default_timezone_set($CI->config->item('timezone'));
	// }	
}

/* End of file load_config.php */
/* Location: ./application/hooks/load_config.php */