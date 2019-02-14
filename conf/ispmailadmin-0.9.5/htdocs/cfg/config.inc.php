<?php
/**
**
**
** @package    ISPmail_Admin
** @author     Ole Jungclaussen
** @version    0.9.0
**/

/**
** Database access
**
**/
define('IMA_CFG_DB_HOST',     'localhost');
define('IMA_CFG_DB_PORT',     '3306');
define('IMA_CFG_DB_USER',     'mailadmin');
define('IMA_CFG_DB_PASSWORD', 'nGyCrhUuvQFW3A6FpP6S');
define('IMA_CFG_DB_DATABASE', 'mailserver');
/**
** Pasword hashes
** Enable only *one* of the following
**/
// define('IMA_CFG_USE_SHA256_HASHES', true);
// define('IMA_CFG_USE_MD5_HASHES', true);
/**
** access control: uncomment the type you want to use.
**
**/
// define('IMA_CFG_LOGIN', IMA_LOGINTYPE_ACCOUNT);  
define('IMA_CFG_LOGIN', IMA_LOGINTYPE_ADM);  
// define('IMA_CFG_LOGIN', IMA_LOGINTYPE_ADMAUTO);  
/**
** Define the administrator's name and password.
**
**/
define('IMA_CFG_ADM_USER',  'mailadmin');     // admin username
define('IMA_CFG_ADM_PASS',  'nGyCrhUuvQFW3A6FpP6S');     // admin password

?>
