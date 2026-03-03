

<?php 
//echo 'おみくじのサーバー側の処理ページ';
//echo  '<br>';

$omikuziList = ["大吉","中吉","中吉","超吉","超吉","吉","小吉","小吉","小吉","末吉","末吉","凶","大凶","超吉"];

$result = array_rand($omikuziList,1);
$fortune = $omikuziList[$result];

$pdo=new PDO('mysql:host=localhost;dbname=omikuzi;charset=utf8', 
	'kannushi', 'matikane');
$sql= $pdo->prepare('select * from product where luck= ? ');
$sql->execute([$fortune]);
$fortuneTelling = $sql->fetch(PDO::FETCH_ASSOC);


header('Content-Type: application/json');
file_put_contents('omikuzi-SQL.json', json_encode($fortuneTelling, JSON_UNESCAPED_UNICODE ));
echo json_encode($fortuneTelling, JSON_UNESCAPED_UNICODE );
?>