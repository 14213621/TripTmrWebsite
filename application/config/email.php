<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config['protocol'] = 'smtp';
$config['smtp_host'] = 'ssl://smtp.googlemail.com';
$config['smtp_user'] = 'triptmr@gmail.com'; // Email
$config['smtp_pass'] = 'c123456789'; // Password
$config['smtp_port'] = 465;
$config['smtp_timeout'] = 30;
$config['charset'] = 'utf-8';
$config['crlf'] = "\r\n";
$config['newline'] = "\r\n";
$config['wordwrap'] = TRUE;
$config['mailtype'] = 'html';