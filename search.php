<?php
// --------------------------------------------------------------------------
// File name   : test_coreseek.php
// Description : coreseek中文全文检索系统测试程序
// Requirement : PHP5 (http://www.php.net)
//
// Copyright(C), HonestQiao, 2011, All Rights Reserved.
//
// Author: HonestQiao (honestqiao@gmail.com)
//
// 最新使用文档，请查看：http://www.coreseek.cn/products/products-install/
//
// --------------------------------------------------------------------------
require "sphinxapi.php";
$k  = $_GET['k'];
$cl = new SphinxClient();
$cl->SetServer('127.0.0.1', 9312);
$cl->SetConnectTimeout(3);
$cl->SetArrayResult(true);
$cl->SetMatchMode(SPH_MATCH_ANY);
$res = $cl->Query($k, "*");
$pdo = new PDO("mysql:host=localhost;dbname=study", 'root', '');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<ul>
	<?php foreach ($res['matches'] as $v) {
    ?>
	<li>
		<a href=""><?php

    $sql  = "select title from tedu_category where id={$v['id']}";
    $pdoS = $pdo->query($sql);
    $arr  = $pdoS->fetch(PDO::FETCH_ASSOC);

    echo $arr['title'];?></a></li>
	<?php
}?>
</ul>
</body>
</html>
