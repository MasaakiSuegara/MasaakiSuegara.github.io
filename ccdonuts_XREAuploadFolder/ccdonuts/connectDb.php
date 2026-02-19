<?php
 require_once('../connectDbData.php'); 
$pdo =new PDO(ACCESSDB, DBID, DBPW);

//このファイルは、データベースへアクセスするコードのみ記述する。
//各ページはこのファイルへrequire_onceさせる事
//DBにアクセスする情報は別ファイルにて保管する。

//各ページは、require_once('connectDb.php');の記述に置き換えること。
?>

