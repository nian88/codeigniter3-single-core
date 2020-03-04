<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function _pe($var ="") {
  print_r($var);
  exit();
}
function dd($var ="") {
  var_dump($var);
  die();
}
function _lastQuery($var ="") {
  $ci =& get_instance();
  print_r($ci->db->last_query());
  exit();
}
function _post($var ="") {
  $ci =& get_instance();
  print_r($ci->input->post());
  exit();
}
function _get($var ="") {
  $ci =& get_instance();
  print_r($ci->input->get());
  exit();
}
function _pjson($var ="") {
    $ci =& get_instance();
    $getData= $ci->output
          ->set_content_type('application/json')
          ->set_output(json_encode($var))->_display();
        exit();
  }
function _loadView($data ="") {
    $ci =& get_instance();
    $ci->load->view('../../layouts/index',$data);
  }
