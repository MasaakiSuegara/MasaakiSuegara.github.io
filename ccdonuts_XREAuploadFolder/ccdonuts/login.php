<!-- ログイン画面作成にはセッションスタートが必須！ヘッダーの前に設置する。 -->
<?php session_start(); ?>
<!-- 各ページのタイトルを記録しつつ、ヘッダーPHPを参照 -->
<?php    
$pageTitle = 'ログイン画面';
require 'includes/header.php';
?>
    <!-- トップページ部分 -->
    <main>
        <section class="linkBlock">
            <p class="pankuzu"><a href="index.php">TOP</a> > <a href="login.php">ログイン</a></p>
        </section>
        <section class="inputBlock">   
            <p class="titleHead">ログイン</p>
            <form action="loginComplete.php" class="loginBlock" method="post">
                <p class="loginText">メールアドレス</p>
                <input type="text" name="mail" class="loginInput">
                <p class="loginText">パスワード</p>
                <input type="password" name="password" class="loginInput">
                <input type="submit" value="ログインする" class="loginEnter">
            </form>
            <p class="cBuyLetter"><a href="menberRegist.php">会員登録はこちら</a></p>
        </section>
    </main>
    <!-- フッターPHPを参照する。 -->
<?php require 'includes/footer.php'; ?>