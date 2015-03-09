/* �i�K�I�ɐF��ς���v���O���� */

// �R���X�g���N�^
function setRGB(t, c, n){

	this.targetColor = t;							// �ڕW�̐F
	this.currentColor = c;							// ���݂̐F
	this.N = n;								// �{�^���̐�(�ړI�ɍ��킹����)
	this.targetRGB = getRGB(this.targetColor);				// �ڕW�̐F�̏��
	this.currentRGB = getRGB(this.currentColor);				// ���݂̐F�̏��
	this.aocRGB = aocColor(this.targetRGB, this.currentRGB, this.N);	// �e�F�ɑ΂���ω��ʂ̏��
	this.currentR = this.currentRGB[0];					// �ԏ��
	this.currentG = this.currentRGB[1];					// �Ώ��
	this.currentB = this.currentRGB[2];					// ���
	this.count = 0;								// �J�E���g
	this.flag = true;							// �F���Z�b�g(�R���X�g���N�^��ݒ�)�����true
}

// �F��ω������ĕԂ�(�������Ԃ�)
setRGB.prototype.colorChange = function(){

	// �R���X�g���N�^���ݒ肳��Ă��Ȃ���ΐ^������Ԃ�
	if(!(this.flag)){
		return "#000000";
	}

	// �J�E���g��N�����ł���ΐF��ω�������
	if(this.count < this.N){
		this.currentR = this.currentR + this.aocRGB[0];
		this.currentG = this.currentG + this.aocRGB[2];
		this.currentB = this.currentB + this.aocRGB[4];
		this.count++;

		// �J�E���g��N�ȏ�ɂȂ�Η]��̕ω��ʂ����Z����
		if(this.count >= this.N){
			this.currentR = this.currentR + this.aocRGB[1];
			this.currentG = this.currentG + this.aocRGB[3];
			this.currentB = this.currentB + this.aocRGB[5];
		}
	}

	// ���ꂼ��̐F�v�f���}�C�i�X�ɂȂ�����0�ɂ���
	if(this.currentR < 0){
		this.currentR = 0;
	}
	if(this.currentG < 0){
		this.currentG = 0;
	}
	if(this.currentB < 0){
		this.currentB = 0;
	}

	return digitCheck(this.currentR, this.currentG, this.currentB);		// "#"�t��16�i���ɕϊ����ĕԂ�
};

// �F�v�f��􂢏o���ĕԂ�(���g�������̔z���Ԃ�)
function getRGB(color){

	var rgb = [];
	rgb.push(color.slice(1, -4));	// ��
	rgb.push(color.slice(3, -2));	// ��
	rgb.push(color.slice(-2));	// ��

	rgb[0] = parseInt(rgb[0], 16);	// 16�i����10�i���ɕϊ�
	rgb[1] = parseInt(rgb[1], 16);
	rgb[2] = parseInt(rgb[2], 16);

	return rgb;
}

// �F�̕ω��ʂ�Ԃ�(aoc�camount of change ,���g�������̔z���Ԃ�)
function aocColor(targetRGB, subjectRGB, n){

	// �ԗv�f
	var r = targetRGB[0] - subjectRGB[0];	// �ڕW�̐F�ƌ��݂̐F�̍������߂�	��F��(100) �| ��(75) �� ��(25)
	var r1 = Math.floor(r / n);		// �ω��ʂ����߂�			��F��(25) �� �{�^���̐�(16) �� ��(1)
	var r2 = r % n;				// �]��̕ω��ʂ����߂�			��F��(25) �� �{�^���̐�(16) �� �](9)

	// �Ηv�f
	var g = targetRGB[1] - subjectRGB[1];
	var g1 = Math.floor(g / n);
	var g2 = g % n;

	// �v�f
	var b = targetRGB[2] - subjectRGB[2];
	var b1 = Math.floor(b / n);
	var b2 = b % n;

	var resultRGB = [r1, r2, g1, g2, b1, b2];	// �S�Ă̐F�v�f�̕ω���(�Ƃ��̗]��)

	return resultRGB;
}

// �����𒲐����ĐF("#"�t��16�i��)��Ԃ�(�������Ԃ�)
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