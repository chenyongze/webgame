<?PHP //-*-coding: utf-8;-*-

require (VENDORS_PATH .'swift'.DS. 'Swift.php');
require (VENDORS_PATH .'swift'.DS.'Swift'.DS.'Connection'.DS. 'SMTP.php');

// 创建smtp连接
$smtp = new Swift_Connection_SMTP('smtp.qq.com', 25);
// 设置邮箱账号
$smtp->setUsername('@qq.com');
// 设置邮箱登陆密码
$smtp->setPassword('@@');

$swift = new Swift($smtp);