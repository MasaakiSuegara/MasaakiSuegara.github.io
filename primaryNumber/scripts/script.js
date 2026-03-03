'use strict';

// 基数変換についての箇所
// まず数値を入力して種類を選別する。
// 次に、一度10進数になおして各進数にする→進数変換を変にIFの多重構造にしないため。
let message  = document.getElementById('messageWindow');
function convertBaseNumber () {
    const baseInput = document.getElementById('baseInput').value;
    const fromBase = document.getElementById('fromBase').value;
    const decimal = parseInt(baseInput, fromBase);
    const baseMessage  = document.getElementById('baseMessage');


    baseMessage.textContent = '';
    // ここ要確認する場所
    if (isNaN(decimal) || decimal < 0) {
        baseMessage.textContent = '入力が不正です。選択した進数に合った数値を入力してください。';
        ['base2',  'base10', 'base16'].forEach(function(id) {
            document.getElementById(id).textContent = '—';
        });
        return;
    }
    document.getElementById('base2').textContent  = decimal.toString(2);
    document.getElementById('base10').textContent = decimal.toString(10);
    document.getElementById('base16').textContent = decimal.toString(16).toUpperCase(); // 16進数は大文字
}

let baseConvert = document.getElementById('baseConvert');

baseConvert.onclick = convertBaseNumber;
// 素数の検出と素数であるかの判定その１
// １以下と２と偶数をはじく
function primeOneTwo(num) {
// 1以下の数は素数ではないマイナス含む
    if (num<2) return false;
// 2は素数である。
    if(num === 2) return true ;
// 素数は己のみ割れる＝2で割れる偶数は削れる。
    if(num %2 === 0 ) return false ;    
// 約数の組み合わせ（36なら6×6)が最大になるのはルート、ルート以上の検査は飛ばす。
    for ( let i = 3; i <= Math.sqrt(num); i += 2) {
        if ( num % i === 0 ) return false ;
    }
    return true;
};


function convertPrimeNumber() {
    // 入力された値の値属性を抽出
    const num  = parseInt(document.getElementById('primeInput').value);
    let limitNum  = parseInt(document.getElementById('primeMax').value);
// 不正な入力の時エラー吐く前に返す
    if (isNaN(num) || num < 1) {
    message.textContent += '\n' + '1以上の整数を入力してください' ;
    return;
    }
    if (primeOneTwo(num)) {
    message.textContent += '\n' + num + 'は素数です。' ;
    } else  {
        // 素数じゃない場合は最小の因数も表示する
        let smallestFactor = num;
        for (let i = 2; i <= Math.sqrt(num); i++) {
            if (num % i === 0) { smallestFactor = i; break; }
        }
     message.textContent += '\n' + num + 'は素数ではありません。最小の因数は' + smallestFactor + 'です。';
    }

    
// 素数の一覧を出す。
    const primeList = [];
    for(let i = 2 ; i <= num; i++) {
        if(primeOneTwo(i))primeList.push(i);
    }

    // 表示用の配列を作る
    let displayPrimeList = primeList.slice();
    const primeOrder = document.getElementById('primeOrder').value;
    let orderText = '';
    if (primeOrder === 'desc') {
        orderText = '大きい順に';
    } else {
        orderText = '小さい順に';
    }
    // 表示順の切り替え
    if (primeOrder === 'desc') {
        displayPrimeList.reverse();
    }

    // 表示件数を制限
    displayPrimeList = displayPrimeList.slice(0, limitNum);

    message.textContent += '\n' + num + '以下の素数は' + primeList.length + '個';
    message.textContent += '\n' + '表示中の素数（' + displayPrimeList.length + '個）で' + orderText;
    message.textContent += '\n' + displayPrimeList.join('  ');
};


// 素数の検出のブロック
let primeConvert = document.getElementById('primeConvert');
primeConvert.onclick = convertPrimeNumber