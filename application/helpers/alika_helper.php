<?php

defined('BASEPATH') or exit('No direct script access allowed');

// function is_logged_in()
// {
//     $ci = get_instance();
//     if (!$ci->session->userdata('nip')) {
//         redirect('welcome');
//     }
// }

function base_uri()
{
    // $base_uri = 'http://10.10.1.76/v2021/api/';
    $base_uri = 'http://localhost:8888/x-alika/api/';
    return $base_uri;
}

function auth()
{
    $auth = ['admin', 'alika-1234'];
    return $auth;
}
