<!-- ログイン画面作成にはセッションスタートが必須！ヘッダーの前に設置する。 -->
<?php session_start(); ?>
<!-- 各ページのタイトルを記録しつつ、ヘッダーPHPを参照 -->
<?php    
$pageTitle = '会員登録';
require 'includes/header.php';
?>
    <!-- トップページ部分 -->
    <main>
        <section class="linkBlock">
            <p class="pankuzu"><a href="index.php">TOP</a> > <a href="login.php">ログイン</a> > 会員登録</p>
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
        <!-- このページは通常の入力フォームとして作成 -->
         
        <section class="inputBlock">
            <p class="bigCaution"><span class="emphasis">▲注意！▲</span>このサイトは学習用の疑似サイトです。個人情報を入れないでください。</p>
            <p class="titleHead">会員登録</p>
            <form action="menberRegistCheck.php" method="post" class="registBlock">
                <p class="registText">お名前<span class="deficit">(必須)</span></p>
                <input type="text" name="name" class="registInput">
                <p class="registText">お名前(フリガナ)<span class="deficit">(必須)</span></p>
                <input type="text" name="furigana" class="registInput">
                <p class="registText">郵便番号(左3桁、右4桁)<span class="deficit">(必須)</span></p>
                <div class="postBlock">
                    <input type="text" name="postcode_a" class="postInput_a">
                    <input type="text" name="postcode_b" class="postInput_b">
                </div>
                <p class="registText">住所<span class="deficit">(必須)</span></p>
                <input type="text" name="address" class="registInput">
                <p class="registText">メールアドレス(~@~)<span class="deficit">(必須)</span></p>
                <input type="text" name="mail" class="registInput">
                <p class="registText">メールアドレス(~@~)(確認用)<span class="deficit">(必須)</span></p>
                <input type="text" name="mailCheck" class="registInput">
                <p class="registText">パスワード<span class="deficit">(必須)</span></p>
                <p class="cation"><span class="deficit">半角英数字8文字以上20文字以内で入力してください。※記号の使用はできません</span></p>
                <input type="password" name="password" class="registInput">
                <p class="registText">パスワード確認用<span class="deficit">(必須)</span></p>
                <input type="password" name="passwordCheck" class="registInput">
                <input type="submit" value="入力確認する。" class="registEnter">
            </form>
        </section>
    </main>
    <!-- フッターPHPを参照する。 -->
<?php require 'includes/footer.php'; ?>