<?PHP //-*-coding: utf-8;-*-
$config_db = array();
$config_db['master']['dbhost'] = '127.0.0.1';
$config_db['master']['username'] = 'root';
$config_db['master']['password'] = '654321';
$config_db['master']['dbname'] = 'jdcms';
$config_db['master']['charset'] = 'utf8';
$config_db['master']['pconnect'] = true;

$config_db['slave']['dbhost'] = 'localhost';
$config_db['slave']['username'] = 'root';
$config_db['slave']['password'] = '654321';
$config_db['slave']['dbname'] = 'jdcms';
$config_db['slave']['charset'] = 'utf8';
$config_db['slave']['pconnect'] = true;

$cache_server = array('127.0.0.1'=>11211);
// $memcached = new memcached($cache_server);
?>
