'use strict';


//  経験値の取得
// まず、変数の取得
let getExp =0;
let getLv = 1;
let currentLv = document.getElementById('currentLv');
let currentClass = document.getElementById('currentClass');
let currentExp = document.getElementById('currentExp');
let expGauge = document.getElementById('expGauge');
let maxLv = document.getElementById('maxLv');
let resetLv = document.getElementById('resetLv');
let playerLv = document.getElementById('playerLv');
let playerHp = document.getElementById('playerHp');
let playerMaxHp = document.getElementById('playerMaxHp');
let playerGauge =  document.getElementById('playerGauge');
let enemyHp = document.getElementById('enemyHp');
let enemyMaxHp = document.getElementById('enemyMaxHp');
let enemyGauge = document.getElementById('enemyGauge');
let playerChara = document.getElementById('player');
let enemyChara = document.getElementById('enemy');
// 経験値が記載されたspanタグを全部クラス選択で取得して配列化
// [80,80,100,80,80,80,100]のようになる
const cardExpList = document.querySelectorAll('.cardExp');
// 開閉のため、開閉箇所のラベルを選択
const cardLabels=document.querySelectorAll('.cardLabel');
// バトル中の判定
let battleContinue = false;
// バトル回数の判定(リセット押すと増える)
let battleCount = 1;


// レベルアップと経験値蓄積の関数
function lvClassUp() {
    let nowLv = 1;
    let nowClass = "未経験";
    let maxHp =30; 
    let image ="images/character_shakaijin_man_01_gray_black.svg";
    if (getExp >= 600 ) {
        nowLv = 5;
        nowClass = "習熟";
        maxHp = 100;
        image = "images/character_mahotsukai_02_black.svg";
    } else if (getExp >= 400 ) {
        nowLv = 4;
        nowClass = "中級";
        maxHp = 70;
    } else if (getExp >= 240 ) {
        nowLv = 3;
        nowClass = "基礎習得";
        maxHp = 50;
    } else if (getExp >= 80 ) {
        nowLv = 2;
        nowClass = "勉強開始";
        maxHp = 40;
    } else if (getExp < 80 ) {
        nowLv = 1;
        nowClass = "未経験";
        maxHp = 30;
    };
    currentLv.textContent = nowLv;
    playerLv.textContent = nowLv;
    currentClass.textContent = nowClass ;
    playerHp.textContent =  maxHp ;
    playerMaxHp.textContent = maxHp;
    playerChara.src = image;
    
};


// ここから開閉処理と初回開閉時にExpを加算する式になる。
cardLabels.forEach(function(label,index) {
    label.onclick= function() {
        const openClose = label.nextElementSibling;
        openClose.classList.toggle('show');
        // ▼マークの入れ替え
        const triangle = label.querySelector('.triMark');
        if (openClose.classList.contains('show')) {
            triangle.textContent = "▲";
        }  else {
            triangle.textContent = "▼";
        };
        if (!label.classList.contains('clear')){        
        getExp = getExp + parseInt(cardExpList[index].textContent)
        label.classList.add('clear');
        cardExpList[index].classList.add('gettedExp')
        currentExp.textContent=getExp;
        expGauge.style.width = (getExp / 600 * 100) + '%';
        };
        lvClassUp() ;
    };
 });
cardLabels.forEach(function(label, index) {
    console.log(index);
});

// レベルマックス機能（ゲームを見せる用)
// マックス＋すべて消費する。
maxLv.onclick =function() {
    getExp = 600;
    currentExp.textContent= getExp;
    expGauge.style.width = '100%';
    lvClassUp() ;
    cardLabels.forEach(function(label,index){
    label.classList.add('clear');
    cardExpList[index].classList.add('gettedExp')
})
};
// lvリセット機能レベルと色を戻す
resetLv.onclick = function() {
    getExp = 0;
    currentExp.textContent= getExp;
    expGauge.style.width = '0%';
    lvClassUp() ;
    cardLabels.forEach(function(label,index){
    const openClose = label.nextElementSibling;
    openClose.classList.remove('show');
    label.classList.remove('clear');
    cardExpList[index].classList.remove('gettedExp')
    const triangle = label.querySelector('.triMark');
    triangle.textContent = "▼";
})
};


// バトル本体。もろもろのスクリプトの最後に配置する
let count = 1;
let playerAttack = 1;

function  attackLv() {
    let kougeki = 1;
    if (currentLv.textContent === "5") {
        kougeki = 28;
    } else if (currentLv.textContent === "4") {
        // 大体５０％くらいの勝率になるよう値を調整
        kougeki = 13;
    } else if (currentLv.textContent === "3") {
        kougeki = 9;
    } else if (currentLv.textContent === "2") {
        kougeki = 4;
    } else if (currentLv.textContent === "1") {
        kougeki = 1;
    }
    playerAttack = kougeki;
}

let playerHpValue = parseInt(document.getElementById('playerHp').textContent);
let enemyHpValue = parseInt(document.getElementById('enemyHp').textContent);
let message  = document.getElementById('messageWindow');
// バトル作り始め。まずはオート完全修了
function battle(){
    // 現在のバトル開始＝リセット
    playerHpValue = parseInt(document.getElementById('playerHp').textContent);
    enemyHpValue = parseInt(document.getElementById('enemyHp').textContent);

    console.log ('作者はHP' +playerHpValue);
    while (playerHpValue > 0 && enemyHpValue  > 0 ) {
        message.textContent += count + 'ターン目開始' + '\n'
        attackLv();
        const pAttack = Math.floor(Math.random()*(playerAttack )) + playerAttack ;
        enemyHpValue -=  pAttack ;
        message.textContent += '作者は' + pAttack + 'のダメージを与えた。' + '\n';
        // 敵のHP削り切ったときHPを０にして戦闘修了
        if(enemyHpValue <= 0 ){
            enemyHpValue = 0;
            message.textContent += '敵の残りHP' + enemyHpValue + '\n';
            break;
        };
        message.textContent += '敵の残りHP' + enemyHpValue + '\n';
        console.log ('作者は'+ pAttack + 'のダメージを与えた');
        const eAttack = Math.floor(Math.random()*(10 )) + 10 ;
        playerHpValue -=  eAttack ;
        message.textContent += '敵は' + eAttack + 'のダメージを与えた。' + '\n';
        // プレイヤーのHP削り切ったときHPを０にして戦闘修了
        if(playerHpValue <= 0 ){
            playerHpValue = 0;
            message.textContent += '作者の残りHP' + playerHpValue + '\n';
            break;
        };
        message.textContent += '作者の残りHP' + playerHpValue + '\n';
        count += 1;
        };
        // 上記までwhileの処理
        // 戦闘終了後、HPを判定
        document.getElementById('playerHp').textContent =playerHpValue;
        document.getElementById('enemyHp').textContent =enemyHpValue;
        // HPゲージの調整
        playerGauge.style.width = (playerHpValue / playerMaxHp.textContent * 100) + '%';
        enemyGauge.style.width = (enemyHpValue / enemyMaxHp.textContent* 100) + '%';


        if (enemyHpValue <= 0){
        message.textContent += '作者はプログラムを作る事が出来た！';
        enemyChara.src = "images/window_01.svg";
        }  else if (enemyHpValue <= 30 && enemyHpValue > 0) {
        message.textContent += '努力の成果は出せたがまだ足りない';
        enemyChara.src = "images/floppy_blue.svg";
        playerChara.classList.add('defeatPose');
        } else if (playerHpValue <= 0) {
        message.textContent += '作者は躓いてしまった。レベルを上げましょう';
        playerChara.classList.add('defeatPose');
        } 
};
// ボタンを押したら戦闘開始
document.getElementById('battleStart').onclick = function() {
    message.textContent = '戦闘開始！\n';
    battle();
};
 function reset()  {
    //.defeatposeを検知して取り除く まだできてない
    // レベル参照を元にHPとレベル再セット
    lvClassUp();
    // HPは固定なので100
    playerHpValue = parseInt(document.getElementById('playerHp').textContent);
    enemyHpValue = parseInt(document.getElementById('enemyMaxHp').textContent);
    document.getElementById('enemyHp').textContent =enemyHpValue;
    playerChara.classList.remove('defeatPose')
    enemyChara.src = "images/pc_desktop.svg";
    battleCount += 1;
    message.textContent = battleCount + '回目の挑戦';
    count = 1;
    battleContinue = false;
    playerGauge.style.width = 100 + '%';
    enemyGauge.style.width = 100+ '%';

};
document.getElementById('battleReset').onclick = reset ;
// ターン制バトルの開始
function battleTurn() {
    if (battleContinue === false ){
    message.textContent += count + 'ターン目を開始します。' + '\n';
    playerHpValue = parseInt(document.getElementById('playerHp').textContent);
    enemyHpValue = parseInt(document.getElementById('enemyMaxHp').textContent);
    document.getElementById('enemyHp').textContent =enemyHpValue; 
    // バトル判定ON
    battleContinue = true;
    } else if (battleContinue === "end") {
                message.textContent += '戦闘は終わっています。' + '\n'
        return;
    } else if (!battleContinue === true ){
        message.textContent += 'エラーです。' + '\n'
        return;
    };
    attackLv()
    count += 1;
    message.textContent += count + 'ターン目を開始します。' + '\n';
    const pAttack = Math.floor(Math.random()*(playerAttack )) + playerAttack ;
    enemyHpValue -=  pAttack ;
    message.textContent += '作者は' + pAttack + 'のダメージを与えた。' + '\n';
    document.getElementById('enemyHp').textContent =enemyHpValue;
    enemyGauge.style.width = (enemyHpValue / enemyMaxHp.textContent* 100) + '%';




    // 敵のHP削り切ったときHPを０にして戦闘修了
    if(enemyHpValue <= 0 ){
        enemyHpValue = 0;
        document.getElementById('enemyHp').textContent =enemyHpValue;
        message.textContent += '敵の残りHP' + enemyHpValue + '\n';
        message.textContent += '作者はプログラムを作る事が出来た！' + '\n';
        enemyChara.src = "images/window_01.svg";
        enemyGauge.style.width = (enemyHpValue / enemyMaxHp.textContent* 100) + '%';
        battleContinue = "end";
        return;
    };
    message.textContent += '敵の残りHP' + enemyHpValue + '\n';
    const eAttack = Math.floor(Math.random()*(10 )) + 10 ;
    playerHpValue -=  eAttack ;
    message.textContent += '敵は' + eAttack + 'のダメージを与えた。'+ '\n';
    document.getElementById('playerHp').textContent =playerHpValue;
    playerGauge.style.width = (playerHpValue / playerMaxHp.textContent * 100) + '%';

    if(playerHpValue <= 0 ){
    playerHpValue = 0;
    document.getElementById('playerHp').textContent =playerHpValue;
    message.textContent += '作者の残りHP' + playerHpValue + '\n';
    message.textContent += '作者は躓いてしまった。レベルを上げましょう'+ '\n';
    playerGauge.style.width = (playerHpValue / playerMaxHp.textContent * 100) + '%';
    playerChara.classList.add('defeatPose');
    battleContinue = "end";
    return;
    };
};
document.getElementById('turnStart').onclick =battleTurn;

