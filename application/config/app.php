<?php

# BASIC

$config["app_name"] = "app";
$config["app_version"] = "1.0";

$config['base_url'] = 'http://localhost/standby/oxt_template/';

$config["default_timezone"] = "Africa/Douala";

# DATABASE

$config['database'] = "openxtech";
$config['host'] = "localhost";
$config['password'] = "HelloWorld";
$config['username'] = "oxt";



# SECURITY AND ENCRYPTION

$config["encryption_key"] = "";

$config["recaptcha-site-key"] = "";
$config["recaptcha-private-key"] = "";


# SESSION

$config['sess_cookie_name'] = 'ci_session';
$config['sess_expiration'] = 7200;
$config['sess_time_to_update'] = 300;



# EMAIL

$config['protocol'] = 'sendmail';
$config['mailpath'] = '/usr/sbin/sendmail';
$config['charset'] = 'utf-8';
$config['wordwrap'] = TRUE;
$config['priority'] = 1;
$config['mailtype'] = "html";