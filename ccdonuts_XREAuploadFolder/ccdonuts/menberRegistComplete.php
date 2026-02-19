<!-- ログイン画面作成にはセッションスタートが必須！ヘッダーの前に設置する。 -->
<?php session_start(); ?>
<!-- 各ページのタイトルを記録しつつ、ヘッダーPHPを参照 -->
<?php    
$pageTitle = '会員登録完了';
require 'includes/header.php';
?>
    <!-- トップページ部分 -->
    <main>
        <section class="linkBlock">
            <p class="pankuzu"><a href="index.php">TOP</a> > <a href="login.php">ログイン</a> > <a href="menberRegist.php">会員登録</a> > 登録完了</p>
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
        $name=$_REQUEST['name'];
        $furigana=$_REQUEST['furigana'];
        $postcode_a=$_REQUEST['postcode_a'];
        $postcode_b=$_REQUEST['postcode_b'];
        $postcode=$postcode_a.'-'.$postcode_b;
        $address=$_REQUEST['address'];
        $mail=$_REQUEST['mail'];
        $password=$_REQUEST['password'];
        //登録するのは名前、フリガナ、郵便番号、住所、メールアドレス、パスワードの6つ
        //DBの情報を秘匿するため別ファイルを経由して接続する。
        require_once('connectDb.php');
        $sql=$pdo->prepare('insert into customers values(null,?,?,?,?,?,?,?)');
        $sql->execute([$name,$furigana,$postcode_a,$postcode_b,$address,$mail,$password]);
        echo        '<section class="inputBlock">';
        echo            '<p class="titleHead">会員登録完了</p>';
        echo            '<div class="loginBlock compBlock">';
        echo                '<p class="loginText compTxt"><span class="userName">',$name,'</span>様、会員登録が完了しました。</p>';
        echo                '<p class="loginText compTxt">ログインページへお進みください。</p>';
        echo            '</div>';
        echo            '<p class="pageLink"><a href="creditRegist.php">クレジットカード登録へすすむ</a></p>';
        echo            '<p class="pageLink"><a href="purchase.php">購入確認ページへすすむ</a></p>';
        echo        '</section>';
        ?>
    </main>
    <!-- フッターPHPを参照する。 -->
<?php require 'includes/footer.php'; ?>