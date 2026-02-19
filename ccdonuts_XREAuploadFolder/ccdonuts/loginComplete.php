<!-- ログイン画面作成にはセッションスタートが必須！ヘッダーの前に設置する。 -->
<?php session_start(); ?>
<!-- 各ページのタイトルを記録しつつ、ヘッダーPHPを参照 -->
<?php    
$pageTitle = 'ログイン完了';
require 'includes/header.php';
?>
    <!-- トップページ部分 -->
    <main>
        <section class="linkBlock">
            <p class="pankuzu"><a href="index.php">TOP</a> > <a href="login.php">ログイン</a> > ログイン完了</p>
            <?php
            //ログインしたかを検出する文章
            if (isset($_SESSION['customers'])) {
                $userName = $_SESSION['customers']['name'];
            } else {
                $userName = 'ゲスト';
            }
            echo            '<p class="welcomeBlock">ようこそ、',$userName,'様</p>';
            ?>
        </section>
<?php 
//まずログインを判定するスクリプトを作成する。
//データベース名はcustomers DBアクセスのIDはccStaffでPWはccDonuts
//セッションを作成して、ユーザーデータを入れていく。
//unset関数を用いてすでにログインしていた場合はログアウトさせる
unset($_SESSION['customers']);
//DBの情報を秘匿するため別ファイルを経由して接続する。
require_once('connectDb.php');
//prepareメソッドでcustomersのmailとpasswordを選択教科書のログインページみて作成したもの
$sql=$pdo->prepare('select * from customers where mail=? and password=?');
//executeメソッドで送られてきたmailとpasswordと一致部分を検索する。
$sql->execute([$_REQUEST['mail'], $_REQUEST['password']]);
//foreachメソッドで検索して一致した行の結果をキーと組にして配列に入れる。
//foreach ($sql as $row) {$_SESSION['customers']=$row;}でも代用可能とのこと
//fetchによる代用もある→要復習
foreach ($sql as $row) {
    $_SESSION['customers']=[
    'id'=> $row['id'], 
    'name' => $row['name'],
    'furigana'=>$row['furigana'],
    'postcode_a'=>$row['postcode_a'],
    'postcode_b'=>$row['postcode_b'],
    'address'=> $row['address'],
    'mail'=>$row['mail'],
    'password'=>$row['password']];
}
// ログイン完了後のメッセージ
if(isset($_SESSION['customers'])) {
    echo    '<section class="inputBlock">';
    echo        '<p class="titleHead">ログイン完了</p>';
    echo        '<div class="loginBlock compBlock">';
    echo            '<p class="loginText compTxt">ログインが完了しました。</p>';
    echo            '<p class="loginText compTxt">いらっしゃいませ、<span class="userName">', $_SESSION['customers']['name'], '</span>様。</p>';
    echo            '<p class="loginText compTxt">引き続きお楽しみください。</p>';
    echo        '</div>';
}   else {
    echo    '<section class="inputBlock">';
    echo        '<div class="loginBlock compBlock">';
    echo            '<p class="loginText compTxt">ログイン名またはパスワードが違います。</p>';
    echo        '</div>';
}
echo            '<p class="pageLink"><a href="purchaseCheck.php">購入確認ページへすすむ</a></p>';
echo            '<p class="pageLink"><a href="index.php">TOPページへもどる</a></p>';
echo        '</section>';
// echo '<pre>';
// var_dump($_SESSION['customers']);
// echo '</pre>';
?>
    </main>
    <!-- フッターPHPを参照する。 -->
<?php require 'includes/footer.php'; ?>