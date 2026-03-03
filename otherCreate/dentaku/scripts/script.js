'use strict';

// よく使う物は定数化しておく
        const calcElement = document.querySelectorAll('.cButton')
        const cWindow = document.getElementById('cWindow')
        const clear= document.querySelectorAll('.clear')
        const firstNumber = document.getElementById('firstNumber')
        const secondOperator = document.getElementById('secondOperator')
        const thirdNumber = document.getElementById('thirdNumber')
        const cResult = document.getElementById('cResult')
        const equal = document.getElementById('equal');
        let message  = document.getElementById('messageWindow');
        console.log(calcElement);
        console.log(clear);
        // 計算済みか否かを示すフラグ設定
        let hasCalculated = false;
        //計算する関数
        function calculate() {
            const num1 = parseFloat(firstNumber.value);
            const num2 = parseFloat(thirdNumber.value);
            const op = secondOperator.value;
            
            if (op === '+') {
                return num1 + num2;
            } else if (op === '-') {
                 return num1 - num2;
            } else if (op === '*') {
                 return num1 * num2;
            } else if (op === '/') {
                // ０の割り算の計算を防ぐ
                if (num2 === 0) return '計算式のエラーです。';
                return num1 / num2;
            }   else {
                return '計算式のエラーです。';
            }
        };
        // ＝ボタンのスクリプト（EcallクラスはcalcElementに含まれないので別途設定）
        document.getElementById('equal').onclick = function() {
            if (firstNumber.value !== '' && secondOperator.value !== '' && thirdNumber.value !== '') {
                const result = calculate();
                if (result !== null) {
                    cResult.value = String(result);
                    cWindow.value = String(result);
                    // 計算済みにちぇっく入れる。
                    hasCalculated = true;

                    // 計算機能のメモリーを入れる。
                    message.textContent +=  '\n' + firstNumber.value + ' ' + secondOperator.value + ' ' +  thirdNumber.value + ' = ' + String(result);
                }
            }
        };
        // 計算式作成部分　ボタン押されたときそれぞれの反応する。
        calcElement.forEach(function(typeIn) {
            typeIn.onclick = function() {
                typeIn = this.value;
                // オールクリアのスクリプト
                if (typeIn === 'AC') {
                    cWindow.value = '0';
                    firstNumber.value = '';
                    secondOperator.value = '';
                    thirdNumber.value = '';
                    cResult.value = '';
                    hasCalculated = false;
                    return;
                }
                // C(１文字キャンセル)のスクリプト
                if (typeIn === 'C') {
                    if (thirdNumber.value !== '') {
                        thirdNumber.value = thirdNumber.value.slice(0, -1);
                        cWindow.value = thirdNumber.value || '0';
                    } else if (secondOperator.value !== '') {
                        secondOperator.value = '';
                        cWindow.value = firstNumber.value;
                    } else if (firstNumber.value !== '') {
                        firstNumber.value = firstNumber.value.slice(0, -1);
                        cWindow.value = firstNumber.value || '0';
                    }
                    return;
                }
                // ＝の後に数字を押したら新しい計算を始める。直接おしたら０を入れる。
                // hasCalculated フラグ使う事で、計算結果をもとにさらに計算できるようにする。
                if (hasCalculated && typeIn !== '+' && typeIn !== '-' && typeIn !== '*' && typeIn !== '/') {
                    firstNumber.value = typeIn;
                    secondOperator.value = '';
                    thirdNumber.value = '';
                    cResult.value = '';
                    cWindow.value = typeIn;
                    hasCalculated = false;
                    return;
                }
                // 演算子ボタン
                if (typeIn === '+' || typeIn === '-' || typeIn === '*' || typeIn === '/') {
                    // ＝後に演算子を押したら結果を引き継いで続けて計算できる
                    if (hasCalculated) {
                        cWindow.value = cResult.value;
                        hasCalculated = false;
                    }
                    secondOperator.value = typeIn;
                    return;
                }
                // +/-ボタン（符号反転）
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
                // 小数点ボタン（重複して入らないようにする）
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
                // 数字ボタン：演算子の有無で左右に振り分け
                if (secondOperator.value === '') {
                    // 先頭の0を上書きする（03や066にならないよう修正）
                    firstNumber.value = (firstNumber.value === '0' || firstNumber.value === '') ? typeIn : firstNumber.value + typeIn;
                    cWindow.value = firstNumber.value;
                } else {
                    // 演算子あり → 右の数値に入力
                    thirdNumber.value += typeIn;
                    cWindow.value = thirdNumber.value;
                }
            };
        });
