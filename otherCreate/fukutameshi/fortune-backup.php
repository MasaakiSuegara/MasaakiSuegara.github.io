<?php require '../header.php'; ?>

<?php 
echo 'おみくじのサーバー側の処理ページ';
echo  '<br>';

$omikuziList = ["大吉","中吉","中吉","吉","吉","吉","小吉","小吉","小吉","末吉","末吉","凶","大凶","超吉"];

$fortune = array_rand($omikuziList,1);
echo '数値は',' "',$fortune,'" ','です。';
echo  '<br>';
echo '運勢は', $omikuziList[$fortune] ,'です。';
file_put_contents('omikuzi.json', json_encode($omikuziList[$fortune], JSON_UNESCAPED_UNICODE ));
?>