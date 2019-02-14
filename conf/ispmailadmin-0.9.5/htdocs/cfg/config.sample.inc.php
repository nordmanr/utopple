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
define('IMA_CFG_DB_HOST',     '127.0.0.1');
define('IMA_CFG_DB_PORT',     '3306');
define('IMA_CFG_DB_USER',     'mysql_user');
define('IMA_CFG_DB_PASSWORD', 'mysql_pass');
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
// define('IMA_CFG_LOGIN', IMA_LOGINTYPE_ADM);  
// define('IMA_CFG_LOGIN', IMA_LOGINTYPE_ADMAUTO);  
/**
** Define the administrator's name and password.
**
**/
define('IMA_CFG_ADM_USER',  'admin_user');     // admin username
define('IMA_CFG_ADM_PASS',  'admin_Pass');     // admin password

?>