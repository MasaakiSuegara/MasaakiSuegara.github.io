<!-- ログイン画面作成にはセッションスタートが必須！ヘッダーの前に設置する。 -->
<?php session_start(); ?>
<!-- 各ページのタイトルを記録しつつ、ヘッダーPHPを参照 -->
<?php    
$pageTitle = 'カード情報登録';
require 'includes/header.php';
?>
    <!-- トップページ部分 -->
    <main>
        <section class="linkBlock">
            <p class="pankuzu"><a href="index.php">TOP</a> > <a href="cartList.php">カート</a> > カード情報登録</p>
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
        <section class="inputBlock">
            <p class="bigCaution">◆注意！◆このサイトは学習用の疑似サイトです。個人情報を入れないでください。</p>
            <p class="titleHead">カード情報登録</p>
            <form action="creditRegistCheck.php"  method="post" class="registBlock">
                <p class="registText">お名前<span class="deficit">(必須)</span></p>
                <input type="text" name="name" class="registInput">
                <p class="registText">カード番号<span class="deficit">(必須)</span></p>
                <p class="caution">※疑似サイトのため本当の番号を登録しないようにしてください。※</p>
                <input type="number" name="creditNumber" class="registInput">
                <p class="registText">カード会社<span class="deficit">(必須)</span></p>
                <div class="creditRadio">
                    <label class="cRadio"><input type="radio" name="creditCompany" value="JCB" checked="checked">JCB</label>
                    <label class="cRadio"><input type="radio" name="creditCompany" value="VISA">VISA</label>
                    <label class="cRadio"><input type="radio" name="creditCompany" value="Mastercard">Mastercard</label>
                </div>
                <p class="registText">有効期間<span class="deficit">(必須)</span></p>
                <div class="vpBlock">
                    <label><input type="number" name="vpMonth" class="vpInput vpMonth">月</label>
                    <label><input type="number" name="vpYear" class="vpInput vpYear">年</label>
                </div>
                <p class="registText">セキュリティコード<span class="deficit">(必須)</span></p>
                <input type="number" name="securityCode" class="registInput">
                <input type="submit" value="入力確認する" class="registEnter">
            </form>
        </section>
    </main>
    <!-- フッターPHPを参照する。 -->
<?php require 'includes/footer.php'; ?>