'use strict';
// ver2 バグ修正版
// オンクリックボタンで計算欄に数字・演算子を入れて＝で計算する

// ============================================================
// 【Step1】よく使うHTML要素を定数に入れておく
// document.getElementById('id名') でHTML要素を取得する
// 一回取得しておけば、何度も getElementById を書かなくていい
// ============================================================
const calcElement    = document.querySelectorAll('.cButton') // cButtonクラスの全ボタンをまとめて取得
const cWindow        = document.getElementById('cWindow')        // 表示ウィンドウ
const cResult        = document.getElementById('cResult')        // 計算結果欄
const firstNumber    = document.getElementById('firstNumber')    // 被乗数（左の数）
const secondOperator = document.getElementById('secondOperator') // 演算子
const thirdNumber    = document.getElementById('thirdNumber')    // 乗数（右の数）

// ============================================================
// 【Step2】状態管理フラグ
// ＝を押した後かどうか記憶しておく変数（letで後から変更できる）
// ============================================================
let hasCalculated = false;

// ============================================================
// 【Step3】計算処理の関数
// ★以前のコードで calculate() の呼び出しはあったが定義がなかった→追加
// parseFloat() で文字列を小数OK数値に変換してから計算する
// ============================================================
function calculate() {
    const num1 = parseFloat(firstNumber.value);    // 左の数を数値に変換
    const num2 = parseFloat(thirdNumber.value);    // 右の数を数値に変換
    const op   = secondOperator.value;             // 演算子を取得

    if (op === '+') return num1 + num2;
    if (op === '-') return num1 - num2;
    if (op === '*') return num1 * num2;
    if (op === '/') {
        if (num2 === 0) return '計算式のエラーです'; // ゼロ除算ガード
        return num1 / num2;
    }
    return null; // 演算子が不正なときは何もしない
}

// ============================================================
// 【Step4】ACボタン：全部リセット
// getElementById で id="allClear" のボタンに直接 onclick を設定
// ============================================================
document.getElementById('allClear').onclick = function() {
    cWindow.value        = '0';
    firstNumber.value    = '';
    secondOperator.value = '';
    thirdNumber.value    = '';
    cResult.value        = '';
    hasCalculated        = false;
};

// ============================================================
// 【Step5】Cボタン：1文字ずつ削除
// slice(0, -1) で文字列の末尾1文字を削る
// 右の数→演算子→左の数 の順で後ろから削る
// ============================================================
document.getElementById('oneClear').onclick = function() {
    if (thirdNumber.value !== '') {
        // 右の数があれば右を削る
        thirdNumber.value = thirdNumber.value.slice(0, -1);
        cWindow.value = thirdNumber.value || '0'; // 空になったら'0'に
    } else if (secondOperator.value !== '') {
        // 演算子があれば演算子を消す
        secondOperator.value = '';
        cWindow.value = firstNumber.value;
    } else if (firstNumber.value !== '') {
        // 左の数を削る
        firstNumber.value = firstNumber.value.slice(0, -1);
        cWindow.value = firstNumber.value || '0';
    }
};

// ============================================================
// 【Step6】＝ボタン：計算を実行
// ★Ecallクラスは cButton クラスを持っていない
//   なので forEach の対象外 → ここで別途 id で設定している
// ============================================================
document.getElementById('equal').onclick = function() {
    // 3つ全部そろっていないと計算しない
    if (firstNumber.value !== '' && secondOperator.value !== '' && thirdNumber.value !== '') {
        const result = calculate();
        if (result !== null) {
            cResult.value = String(result);  // 結果を右パネルに表示
            cWindow.value = String(result);  // 結果をウィンドウに表示
            hasCalculated = true;            // フラグを立てる→次の入力でリセットされる
        }
    }
};

// ============================================================
// 【Step7】数字・演算子ボタン共通処理（forEach）
// 教科書P226参考。cButtonクラスを持つ全ボタンにまとめて onclick を設定
// forEach の中の typeIn は最初「ボタン要素」、
// this.value で押されたボタンの value 属性の値（文字列）に上書きしている
// ============================================================
calcElement.forEach(function(typeIn) {
    typeIn.onclick = function() {
        typeIn = this.value; // ここから typeIn = ボタンのvalue（例："1","+"など）

        // ACとCは Step4・5 で設定済みなのでここでは何もしない
        if (typeIn === 'AC' || typeIn === 'C') return;

        // -------------------------------------------------------
        // ★修正点① ＝の後に数字を押したら新しい計算をスタート
        // hasCalculated フラグが立っているとき＝直前に＝を押した状態
        // -------------------------------------------------------
        if (hasCalculated && typeIn !== '+' && typeIn !== '-' && typeIn !== '*' && typeIn !== '/') {
            firstNumber.value    = typeIn;
            secondOperator.value = '';
            thirdNumber.value    = '';
            cResult.value        = '';
            cWindow.value        = typeIn;
            hasCalculated        = false;
            return;
        }

        // -------------------------------------------------------
        // 演算子ボタン（+ - * /）
        // ＝の後に演算子を押した場合は結果を引き継いで続けて計算できる
        // -------------------------------------------------------
        if (typeIn === '+' || typeIn === '-' || typeIn === '*' || typeIn === '/') {
            if (hasCalculated) {
                firstNumber.value = cResult.value; // 結果を左の数に引き継ぐ
                hasCalculated = false;
            }
            secondOperator.value = typeIn;
            return;
        }

        // -------------------------------------------------------
        // +/-ボタン：符号反転（正負を切り替える）
        // parseFloat して -1 をかけるだけ
        // -------------------------------------------------------
        if (typeIn === '+/-') {
            if (secondOperator.value === '' && firstNumber.value !== '') {
                firstNumber.value = String(parseFloat(firstNumber.value) * -1);
                cWindow.value = firstNumber.value;
            } else if (secondOperator.value !== '' && thirdNumber.value !== '') {
                thirdNumber.value = String(parseFloat(thirdNumber.value) * -1);
                cWindow.value = thirdNumber.value;
            }
            return;
        }

        // -------------------------------------------------------
        // 小数点ボタン
        // includes('.') で既に小数点があれば追加しない（1.2.3 を防ぐ）
        // -------------------------------------------------------
        if (typeIn === '.') {
            if (secondOperator.value === '') {
                if (!firstNumber.value.includes('.')) {
                    firstNumber.value += '.';
                    cWindow.value = firstNumber.value;
                }
            } else {
                if (!thirdNumber.value.includes('.')) {
                    thirdNumber.value += '.';
                    cWindow.value = thirdNumber.value;
                }
            }
            return;
        }

        // -------------------------------------------------------
        // 数字ボタン（0〜9）
        // 演算子があるかどうかで「左の数」「右の数」に振り分ける
        //
        // ★修正点② 先頭が '0' または空のときは上書き（'03'にならないよう）
        //   三項演算子: 条件 ? trueの値 : falseの値
        // -------------------------------------------------------
        if (secondOperator.value === '') {
            // 演算子なし → 左の数に入力
            firstNumber.value = (firstNumber.value === '0' || firstNumber.value === '')
                ? typeIn                          // 先頭が0→上書き
                : firstNumber.value + typeIn;     // それ以外→追記
            cWindow.value = firstNumber.value;
        } else {
            // 演算子あり → 右の数に入力
            thirdNumber.value += typeIn;
            cWindow.value = thirdNumber.value;
        }
    };
});

// メモリー機能は次のステップで追加予定
