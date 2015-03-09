/* 段階的に色を変えるプログラム */

// コンストラクタ
function setRGB(t, c, n){

	this.targetColor = t;							// 目標の色
	this.currentColor = c;							// 現在の色
	this.N = n;								// ボタンの数(目的に合わせた数)
	this.targetRGB = getRGB(this.targetColor);				// 目標の色の情報
	this.currentRGB = getRGB(this.currentColor);				// 現在の色の情報
	this.aocRGB = aocColor(this.targetRGB, this.currentRGB, this.N);	// 各色に対する変化量の情報
	this.currentR = this.currentRGB[0];					// 赤情報
	this.currentG = this.currentRGB[1];					// 緑情報
	this.currentB = this.currentRGB[2];					// 青情報
	this.count = 0;								// カウント
	this.flag = true;							// 色をセット(コンストラクタを設定)するとtrue
}

// 色を変化させて返す(文字列を返す)
setRGB.prototype.colorChange = function(){

	// コンストラクタが設定されていなければ真っ黒を返す
	if(!(this.flag)){
		return "#000000";
	}

	// カウントがN未満であれば色を変化させる
	if(this.count < this.N){
		this.currentR = this.currentR + this.aocRGB[0];
		this.currentG = this.currentG + this.aocRGB[2];
		this.currentB = this.currentB + this.aocRGB[4];
		this.count++;

		// カウントがN以上になれば余りの変化量を加算する
		if(this.count >= this.N){
			this.currentR = this.currentR + this.aocRGB[1];
			this.currentG = this.currentG + this.aocRGB[3];
			this.currentB = this.currentB + this.aocRGB[5];
		}
	}

	// それぞれの色要素がマイナスになったら0にする
	if(this.currentR < 0){
		this.currentR = 0;
	}
	if(this.currentG < 0){
		this.currentG = 0;
	}
	if(this.currentB < 0){
		this.currentB = 0;
	}

	return digitCheck(this.currentR, this.currentG, this.currentB);		// "#"付き16進数に変換して返す
};

// 色要素を洗い出して返す(中身が整数の配列を返す)
function getRGB(color){

	var rgb = [];
	rgb.push(color.slice(1, -4));	// 赤
	rgb.push(color.slice(3, -2));	// 緑
	rgb.push(color.slice(-2));	// 青

	rgb[0] = parseInt(rgb[0], 16);	// 16進数を10進数に変換
	rgb[1] = parseInt(rgb[1], 16);
	rgb[2] = parseInt(rgb[2], 16);

	return rgb;
}

// 色の変化量を返す(aoc…amount of change ,中身が整数の配列を返す)
function aocColor(targetRGB, subjectRGB, n){

	// 赤要素
	var r = targetRGB[0] - subjectRGB[0];	// 目標の色と現在の色の差を求める	例：目(100) － 現(75) ＝ 差(25)
	var r1 = Math.floor(r / n);		// 変化量を求める			例：差(25) ÷ ボタンの数(16) ＝ 変(1)
	var r2 = r % n;				// 余りの変化量を求める			例：差(25) ％ ボタンの数(16) ＝ 余(9)

	// 緑要素
	var g = targetRGB[1] - subjectRGB[1];
	var g1 = Math.floor(g / n);
	var g2 = g % n;

	// 青要素
	var b = targetRGB[2] - subjectRGB[2];
	var b1 = Math.floor(b / n);
	var b2 = b % n;

	var resultRGB = [r1, r2, g1, g2, b1, b2];	// 全ての色要素の変化量(とその余り)

	return resultRGB;
}

// 桁数を調整して色("#"付き16進数)を返す(文字列を返す)
function digitCheck(n1, n2, n3){

	var number = [n1, n2, n3];
	var result = "";

	for(var i = 0; i < 3; i++){
		if(number[i] < 16){
			result = result + "0" + (number[i]).toString(16);
		}else{
			result = result + (number[i]).toString(16);
		}
	}

	return "#" + result;
}