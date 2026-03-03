'use strict';

// ============================================================
// タブ切り替え
// クリックされたボタンとパネルにactiveクラスをつける
// ============================================================
function switchTab(name, btn) {
    // 全パネルとボタンからactiveを外す
    document.querySelectorAll('.tab-panel').forEach(function(p) {
        p.classList.remove('active');
    });
    document.querySelectorAll('.tab-btn').forEach(function(b) {
        b.classList.remove('active');
    });
    // クリックされたものだけactiveをつける
    document.getElementById('tab-' + name).classList.add('active');
    btn.classList.add('active');
}

// ============================================================
// 進数変換
// parseInt(文字列, 元の進数) で10進数に変換
// (数値).toString(変換先の進数) で文字列に変換
// ============================================================
function convertBase() {
    const input    = document.getElementById('baseInput').value.trim();
    const fromBase = parseInt(document.getElementById('fromBase').value);
    const errorEl  = document.getElementById('baseError');
    errorEl.textContent = '';

    // まず一度10進数に変換してから、それぞれの進数に変換する
    const decimal = parseInt(input, fromBase);

    // NaN = 変換できなかった（不正な文字が含まれている）
    if (isNaN(decimal) || decimal < 0) {
        errorEl.textContent = '入力が不正です。選択した進数に合った数値を入力してください。';
        ['res2', 'res8', 'res10', 'res16'].forEach(function(id) {
            document.getElementById(id).textContent = '—';
        });
        return;
    }

    document.getElementById('res2').textContent  = decimal.toString(2);
    document.getElementById('res8').textContent  = decimal.toString(8);
    document.getElementById('res10').textContent = decimal.toString(10);
    document.getElementById('res16').textContent = decimal.toString(16).toUpperCase(); // 16進数は大文字
}

// Enterキーでも変換できるようにする
document.getElementById('baseInput').addEventListener('keydown', function(e) {
    if (e.key === 'Enter') convertBase();
});

// ============================================================
// 素数判定
// 2からその数の√まで割り切れるものがなければ素数
// √までで十分な理由：それ以上の因数は必ずペアが√以下に存在する
// ============================================================
function isPrime(n) {
    if (n < 2) return false;
    if (n === 2) return true;       // 2は素数
    if (n % 2 === 0) return false;  // 2以外の偶数は素数じゃない
    // 奇数だけチェック（i += 2）することで処理を半分に減らす
    for (let i = 3; i <= Math.sqrt(n); i += 2) {
        if (n % i === 0) return false;
    }
    return true;
}

function checkPrime() {
    const n  = parseInt(document.getElementById('primeInput').value);
    const el = document.getElementById('primeVerdict');

    if (isNaN(n) || n < 1) {
        el.innerHTML = '<div class="prime-verdict not-prime">1以上の整数を入力してください</div>';
        return;
    }

    if (isPrime(n)) {
        el.innerHTML = `<div class="prime-verdict is-prime">${n} は素数です ✓</div>`;
    } else {
        // 素数じゃない場合は最小の因数も表示する
        let smallestFactor = n;
        for (let i = 2; i <= Math.sqrt(n); i++) {
            if (n % i === 0) { smallestFactor = i; break; }
        }
        el.innerHTML = `<div class="prime-verdict not-prime">${n} は素数ではありません　最小の因数: ${smallestFactor}</div>`;
    }
}
// エンターキー押したときの機能
document.getElementById('primeInput').addEventListener('keydown', function(e) {
    if (e.key === 'Enter') checkPrime();
});

// 指定した数以下の素数を全部列挙する
function listPrimes() {
    const limit   = parseInt(document.getElementById('primeListInput').value);
    const valueEl = document.getElementById('primeListValue');

    if (isNaN(limit) || limit < 2 || limit > 1000) {
        valueEl.textContent = '2〜1000の範囲で入力してください';
        return;
    }

    const primes = [];
    for (let i = 2; i <= limit; i++) {
        if (isPrime(i)) primes.push(i);
    }
    valueEl.textContent = primes.join('  ') + `　（${primes.length}個）`;
}

// ============================================================
// 因数分解
// 2から順番に割り続けて、割り切れた数を配列に記録していく
// 例：12 → 12÷2=6 → 6÷2=3 → 3÷3=1 → [2, 2, 3]
// ============================================================
function factorize(n) {
    const factors = [];
    let current = n;
    for (let i = 2; i <= current; i++) {
        // 同じ数で割り切れる間はwhileでループする
        while (current % i === 0) {
            factors.push(i);
            current = current / i;
        }
    }
    return factors;
}

function doFactorize() {
    const n       = parseInt(document.getElementById('factorInput').value);
    const display = document.getElementById('factorDisplay');

    if (isNaN(n) || n < 2) {
        display.innerHTML = '<p class="err">2以上の整数を入力してください</p>';
        return;
    }
    renderFactors(n, display);
}

document.getElementById('factorInput').addEventListener('keydown', function(e) {
    if (e.key === 'Enter') doFactorize();
});

// 因数分解の結果をHTMLに描画する
function renderFactors(n, container) {
    const factors = factorize(n);

    // 同じ因数をまとめて指数表記にする
    // 例：[2, 2, 3] → { 2: 2, 3: 1 }
    const countMap = {};
    factors.forEach(function(f) {
        countMap[f] = (countMap[f] || 0) + 1;
    });

    // 表示用の式を作る（例：2² × 3）
    const parts = Object.entries(countMap).map(function([base, exp]) {
        return exp > 1 ? `${base}<sup>${exp}</sup>` : `${base}`;
    });

    const equationHTML = `<span class="num">${n}</span> = ` + parts.join(' × ');

    // 素因数をバッジとして1つずつ表示（アニメーション付き）
    const badges = factors.map(function(f, i) {
        return `<span class="prime-badge" style="animation-delay:${i * 0.06}s">${f}</span>`;
    }).join('');

    container.innerHTML = `
        <div class="factor-equation">${equationHTML}</div>
        <div style="font-family:var(--mono);font-size:0.75rem;color:var(--dim);margin-bottom:8px;">素因数（重複あり）</div>
        <div class="prime-badges">${badges}</div>
        <div style="margin-top:14px;font-family:var(--mono);font-size:0.8rem;color:var(--dim);">
            素因数の種類: ${Object.keys(countMap).join(', ')} ／
            ${isPrime(n) ? '<span style="color:var(--accent)">この数は素数です</span>' : '合成数'}
        </div>
    `;
}

// ============================================================
// ランダム因数分解ゲーム
// ============================================================
let currentGameNumber = null;

function generateRandom() {
    // 2〜999のランダムな整数を生成
    currentGameNumber = Math.floor(Math.random() * 998) + 2;

    const numEl  = document.getElementById('gameNumber');
    const ansEl  = document.getElementById('gameAnswer');
    const hintEl = document.getElementById('gameHint');

    // グリッチアニメーション
    // 一度クラスを外してvoid offsetWidthで描画を強制リセットしてからつける
    numEl.classList.remove('revealing');
    void numEl.offsetWidth;
    numEl.classList.add('revealing');
    numEl.textContent = currentGameNumber;

    ansEl.className   = 'game-answer';
    ansEl.textContent = 'この数を因数分解してみよう！';

    // 最小の因数をヒントとして表示する
    hintEl.textContent = isPrime(currentGameNumber)
        ? 'ヒント：この数は素数かもしれない...'
        : `ヒント：最小の因数は ${getSmallestFactor(currentGameNumber)}`;
}

// 最小の因数を返す（素数なら自分自身を返す）
function getSmallestFactor(n) {
    for (let i = 2; i <= Math.sqrt(n); i++) {
        if (n % i === 0) return i;
    }
    return n;
}

function revealAnswer() {
    if (currentGameNumber === null) {
        document.getElementById('gameAnswer').textContent = 'まず「ランダム生成」を押してください';
        return;
    }

    const factors  = factorize(currentGameNumber);
    const countMap = {};
    factors.forEach(function(f) { countMap[f] = (countMap[f] || 0) + 1; });

    const parts = Object.entries(countMap).map(function([base, exp]) {
        return exp > 1 ? `${base}^${exp}` : `${base}`;
    });

    const ansEl  = document.getElementById('gameAnswer');
    const hintEl = document.getElementById('gameHint');

    ansEl.className = 'game-answer show';

    if (isPrime(currentGameNumber)) {
        ansEl.textContent = `${currentGameNumber} は素数！分解できない`;
    } else {
        ansEl.textContent = `${currentGameNumber} = ${parts.join(' × ')}`;
    }

    hintEl.textContent = `素因数（全部）: ${factors.join(', ')}`;
}
