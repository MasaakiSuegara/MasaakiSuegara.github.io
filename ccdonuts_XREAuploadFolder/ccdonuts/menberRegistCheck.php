<!-- ログイン画面作成にはセッションスタートが必須！ヘッダーの前に設置する。 -->
<?php session_start(); ?>
<!-- 各ページのタイトルを記録しつつ、ヘッダーPHPを参照 -->
<?php    
$pageTitle = '会員登録確認';
require 'includes/header.php';
?>
    <!-- トップページ部分 -->
    <main>
        <section class="linkBlock">
            <p class="pankuzu"><a href="index.php">TOP</a> > <a href="login.php">ログイン</a> > <a href="menberRegist.php">会員登録</a> > 登録確認 </p>
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
        // 入力画面から受け取った情報をいったん変数にして、わかりやすくする。
        $name=$_REQUEST['name'];
        $furigana=$_REQUEST['furigana'];
        $postcode_a=$_REQUEST['postcode_a'];
        $postcode_b=$_REQUEST['postcode_b'];
        $postcode=$postcode_a.'-'.$postcode_b;
        $address=$_REQUEST['address'];
        $mail=$_REQUEST['mail'];
        $mailCheck=$_REQUEST['mailCheck'];
        $password=$_REQUEST['password'];
        $passwordCheck=$_REQUEST['passwordCheck'];
        //エラーチェック。初期はエラーでif文すべて通過したときのみ登録確認を出す。
        $errorCheck='erroer';
        // 正規表現を用いたエラーチェックエラーの場合はエラー内容を表示する。
        //余裕があればほかの項目のチェックも作る。

        //空欄確認入力規則がないものは空白を確認
        if($name!='' && $furigana!='' && $address!='' ) {
                $errorCheck='true';
        }   else {
                $errorCheck='error';
        }
        //メールアドレス確認正規表現で@を確認
        if (preg_match('/^[a-zA-Z0-9]{1,}@[a-zA-Z0-9]{1,}$/',$mail)&& $mail == $mailCheck){
            // echo '<p class="registError">メールアドレスは問題ありません。</p>';
            $errorCheck='true';
        }   else { 
                echo '<p class="registError">メールアドレスもしくは確認用メールアドレスが間違っています。もう一度やり直してください</p>';
                $errorCheck='error';
        }
        //郵便番号確認正規表現で3桁と4桁を確認する。
        if (preg_match('/^[0-9]{3}-[0-9]{4}$/',$postcode)){
            // echo '<p class="registError">郵便番号は問題ありません。</p>';
            $errorCheck='true';
        }   else { 
                echo '<p class="registError">郵便番号が間違っています。もう一度やり直してください</p>';
                $errorCheck='error';
        }
        //パスワード確認8文字以上20文字以下で正規表現で確認
        if(preg_match('/^[a-zA-Z0-9]{8,20}$/',$password) && $password == $passwordCheck){
                    // echo '<p class="registError">パスワードは問題ありません。</p>';
                    $errorCheck='true';
        }   else {
                echo '<p class="registError">パスワード又は確認用パスワードが間違っています。もう一度やり直してください</p>';
                $errorCheck='error';
        }
    //すべて入力されているときに登録ボタンを出すようにする。
        if($errorCheck =='true' ){
        echo    '<section class="inputBlock">';
        echo        '<p class="titleHead">入力確認</p>';
        echo        '<form action="menberRegistComplete.php" method="post" class="registBlock" id="menberRegist">';
        echo            '<p class="registText">お名前</p>';
        echo            '<input type="text" name="name" class="registCheck" readonly value=',$name ,'>';
        echo            '<p class="registText">お名前(フリガナ)</p>';
        echo            '<input type="text" name="furigana" class="registCheck" readonly value=',$furigana ,'>';
        echo            '<p class="registText">郵便番号</p>';
        echo            '<div class="abrowPost">';
        echo            '<input type="text" name="postcode_a" class="registCheck postcode_a" readonly value=',$postcode_a ,'>';
        echo            '<input type="text" name="postcode_b" class="registCheck postcode_b" readonly value=',$postcode_b ,'>';
        echo            '</div>';
        echo            '<p class="registText">住所</p>';
        echo            '<input type="text" name="address" class="registCheck" readonly value=',$address ,'>';
        echo            '<p class="registText">メールアドレス</p>';
        echo            '<input type="text" name="mail" class="registCheck" readonly value=',$mail ,'>';
        echo            '<p class="registText">メールアドレス(確認用)</p>';
        echo            '<input type="text" name="mailCheck" class="registCheck" readonly value=',$mailCheck ,'>';
        echo            '<p class="registText">パスワード</p>';
        echo            '<input type="password" name="password" class="registCheck" readonly value=',$password ,'>';
        echo            '<p class="registText">パスワード確認用</p>';
        echo            '<input type="password" name="passwordCheck" class="registCheck" readonly value=',$passwordCheck ,'>';
        echo            '<input type="submit" value="登録する" class="registEnter" id="enterRegist">';
        // 入力戻るボタンJAVASCRIPTで内容をactonを変えるよう指示する必要があるのでいったん保留。
        // echo            '<input type="submit" value="入力画面に戻る" class="returnPress" id="returnRegist">';
        echo        '</form>';
        echo    '</section>';
        }   else {
        // 入力エラーがあるときは次に進ませないように戻るボタン
                echo '<p class="registError">入力エラー又は空欄があります。もう一度やり直してください</p>';
                echo '<p class="returnPress"><a href="menberRegist.php">入力画面に戻る。</a></p>';
        }
        ?>
    </main>
    <!-- フッターPHPを参照する。 -->
<?php require 'includes/footer.php'; ?>