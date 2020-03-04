<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    function showResponse($response= array())
    {
        $msgApi = (array)json_decode(STATUSAPI);
        $response['code'] = (!isset($response['code']))?99:$response['code'];
        $response['msg'] =  $msgApi[$response['code']];
        _pJson($response);
    }