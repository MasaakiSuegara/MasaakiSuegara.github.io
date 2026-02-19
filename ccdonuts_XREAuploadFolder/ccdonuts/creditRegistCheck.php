<!-- ログイン画面作成にはセッションスタートが必須！ヘッダーの前に設置する。 -->
<?php session_start(); ?>
<!-- 各ページのタイトルを記録しつつ、ヘッダーPHPを参照 -->
<?php    
$pageTitle = 'クレジット登録確認';
require 'includes/header.php';
?>
<!-- クレジット登録画面からの情報を一度変数に置き換える -->
<?php
$name= $_REQUEST['name'];
$creditNumber=$_REQUEST['creditNumber'];
$creditCompany= $_REQUEST['creditCompany'];
$vpMonth=$_REQUEST['vpMonth'];
$vpYear=$_REQUEST['vpYear'];
$securityCode= $_REQUEST['securityCode'];
//正規表現を用いて各クレジットカードの表現が正しいか確認する。
//正規表現は　if preg_match(条件){trueの処理}ekse{falseの処理}
//クレジット番号は14~16の桁数
if(preg_match('/^[0-9]{14,16}$/',$creditNumber)){
    
    $errorCheck='true';
}   else {
    echo '<p class="registError">カード登録番号が不正です。やりなおしてください。</p>';
    $errorCheck='error';
}
//クレジット会社は記入されているかを確認する
if(empty($creditCompany)) {
    echo '<p class="registError">クレジット会社が不正です。やりなおしてください。</p>';
    $errorCheck='error';
}
if(preg_match('/^[0-9]{2}$/',$vpYear) && preg_match('/^[0-9]{1,2}$/',$vpMonth)){
    $errorCheck='true';
}   else {
echo    '<p class="registError">使用期限が不正です。やりなおしてください。</p>';
    $errorCheck='error';
}
?>
    <main>
<?php
    //ログインしたかを検出する文章
    if (isset($_SESSION['customers'])) {
        $userName = $_SESSION['customers']['name'];
    } else {
        $userName = 'ゲスト';
    }
echo        '<section class="linkBlock">';
echo            '<p class="pankuzu"><a href="index.php">TOP</a> > <a href="purchase.php">購入確認</a> > 情報確認 </p>';
echo            '<p class="welcomeBlock">ようこそ、',$userName,'様</p>';
echo        '</section>';
echo        '<section class="inputBlock">';
echo            '<p class="titleHead">入力情報確認</p>';
echo            '<form action="creditComplete.php" method="post" class="registBlock">';
echo                '<p class="registText">お名前</p>';
echo                '<input type="text" name="name" class="registCheck" readonly value="',$name,'">';
echo                '<p class="registText">カード番号</p>';
echo                '<input type="text" name="creditNumber" class="registCheck" readonly value="',$creditNumber,'">';
echo                '<p class="registText">カード会社</p>';
echo                '<input type="text" name="creditCompany" class="registCheck" readonly value="',$creditCompany,'">';
echo                '<p class="registText">有効期限</p>';
// <!-- figmaファイルになるようにCSSかPHP出力時に調整必要 -->
echo                '<input type="text" name="vpMonth" class="registCheck" readonly value="',$vpMonth,'月">';
echo                '<input type="text" name="vpYear" class="registCheck" readonly value="',$vpYear,'年">';
echo                '<p class="registText">セキュリティコード</p>';
echo                '<input type="text" name="securityCode" class="registCheck" readonly value="',$securityCode,'">';
echo                '<input type="submit" value="登録する" class="registEnter" id="enterRegist">';
echo            '</form>';
echo        '</section>';
?>
    </main>
    <!-- フッターPHPを参照する。 -->
<?php require 'includes/footer.php'; ?>