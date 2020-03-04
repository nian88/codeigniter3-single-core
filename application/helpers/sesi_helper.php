<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function _islogin($flag=null)
{
  $ci =& get_instance();
  $level = (isset($ci->session->userdata('sesiLogin')->level))?$ci->session->userdata('sesiLogin')->level:null; ;
  if ($level==null) {
    if (strtolower($ci->uri->segment(1)) != "login") {
      redirect('login','refresh');
    }
  }else{
    if (strtolower($ci->uri->segment(1)) != "dashboard") {
      return false;
    }
  }
}
