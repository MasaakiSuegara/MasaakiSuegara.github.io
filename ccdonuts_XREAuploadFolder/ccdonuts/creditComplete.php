<!-- ログイン画面作成にはセッションスタートが必須！ヘッダーの前に設置する。 -->
<?php session_start(); ?>
<!-- 各ページのタイトルを記録しつつ、ヘッダーPHPを参照 -->
<?php    
$pageTitle = 'クレジット登録完了';
require 'includes/header.php';
?>
<?php
$name= $_REQUEST['name'];
$creditNumber=$_REQUEST['creditNumber'];
$creditCompany= $_REQUEST['creditCompany'];
$vpMonth=$_REQUEST['vpMonth'];
$vpYear=$_REQUEST['vpYear'];
//セキュリティコードはDBに載せない。
//DB登録のコマンドを記載する。
//DBにアクセスするするためのIDとパスワード。DB名はccdonuts、IDはccStaff,PWはccDonuts
require_once('connectDb.php');
//次に、DBにクレジットカードの情報を入れ込むコマンド。DBの名前はcreditDataとする
$sql=$pdo->prepare('insert into creditData values(null,?,?,?,?,?,?)');
$sql->execute([$_SESSION['customers']['id'],$name,$creditNumber,$creditCompany,$vpMonth,$vpYear]);
?>
    <!-- トップページ部分 -->
    <main>
        <section class="linkBlock">
            <p class="pankuzu"><a href="index.php">TOP</a> > <a href="itemList.php">カード登録完了</a></p>
            <?php
            //ログインしたかを検出する文章
            if (isset($_SESSION['customers'])) {
                $userName = $_SESSION['customers']['name'];
            } else {
                $userName = 'ゲスト';
            }
echo        '<p class="welcomeBlock">ようこそ、',$userName,'様</p>';
            ?>
        </section>
        <section class="inputBlock">
            
            <p class="titleHead">カード情報登録完了</p>
            <div class="loginBlock compBlock">
                <p class="loginText compTxt">支払い情報登録が完了しました。</p>
                <p class="loginText compTxt">続けて購入確認ページへお進みください。</p>
            </div>
            <p class="pageLink"><a href="purchaseCheck.php">購入確認ページへすすむ</a></p>
        </section>
    </main>
    <!-- フッターPHPを参照する。 -->
<?php require 'includes/footer.php'; ?>