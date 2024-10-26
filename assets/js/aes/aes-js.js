/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  */
/*  AES implementation in JavaScript                     (c) Chris Veness 2005-2014 / MIT Licence */
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  */

/* jshint node:true */

/* global define */
'use strict';


/**
 * AES (Rijndael cipher) encryption routines,
 *
 * Reference implementation of FIPS-197 http://csrc.nist.gov/publications/fips/fips197/fips-197.pdf.
 *
 * @namespace
 */
var Aes = {};


/**
 * AES Cipher function: encrypt 'input' state with Rijndael algorithm [§5.1];
 *   applies Nr rounds (10/12/14) using key schedule w for 'add round key' stage.
 *
 * @param   {number[]}   input - 16-byte (128-bit) input state array.
 * @param   {number[][]} w - Key schedule as 2D byte-array (Nr+1 x Nb bytes).
 * @returns {number[]}   Encrypted output state array.
 */
Aes.cipher = funw) {
	var Nb = 4; // block   size (in words): no of columns in state (fixed at 4 for AES)
	var Nr = w.length / Nb - 1; // no of rounds: 10/12/14 for 128/192/256-bit keys






	var state = [
		[],
		[],
		[],
		[]
	]; // initialise 4xNb byte-array 'state' with input [§3.4]
	for (var i = 0; i < 4 * Nb; i++) state[i % 4][Math.floor(i / 4)] = input[i];

	state = Aes.addRoundKey(state, w, 0, Nb);

	for (var round = 1; round < Nr; round++) {
		state = Aes.subBytes(state, Nb);
		state = Aes.shiftRows(state, Nb);
		state = Aes.mixColumns(state, Nb);
		state = Aes.addRoundKey(state, w, round, Nb);
	}

	state = Aes.subBytes(state, Nb);
	state = Aes.shiftRows(state, Nb);
	state = Aes.addRoundKey(state, w, Nr, Nb);

	var output = new Array(4 * Nb); // convert state to 1-d array before returning [§3.4]
	for (var i = 0; i < 4 * Nb; i++) output[i] = state[i % 4][Math.floor(i / 4)];

	return output;
};


/**
 * Perform key e generate a key schedule from a cipher key [§5.2].
 *  
 * @param   {number[]y - Cipher key as 16/24/32-byte array.
 * @returns {number[][]} Expanded key schedule as 2D byte-array (Nr+1 x Nb bytes).
 */
Aes.keyExpansion = function (key) {
	var Nb = 4; // block size (in words): no of columns in state (fixed at 4 for AES)
	var Nk = key.length / 4; // key length (in words): 4/6/8 for 128/192/256-bit keys
	var Nr = Nk + 6;
	/ /
	no of rounds: 10 / 12 / 14
	for 128 / 192 / 256 - bit keys

	var w = new Array(Nb * (Nr + 1));
	var temp = new Array(4);

	// initialise first Nk words of expanded key with cipher key
	for (var i = 0; i < Nk; i++) {
		var r = [key[4 * i], key[4 * i + 1], key[4 * i + 2], key[4 * i + 3]];
		w[i] = r;
	}

	// expand the key into the remainder of the schedule
	for (var i = Nk; i < (Nb * (Nr + 1)); i++) {
		w[i] = new Array(4);
		for (var t = 0; t < 4; t++) temp[t] = w[i - 1][t];
		// each Nk'th word has ext r a transformation
		if (i % Nk == 0) {
			temp = Aes.subWord(Aes.rotWord(temp));
			for (var t = 0; t < 4; t++) temp[t] ^= Aes.rCon[i / Nk][t];
		}
		// 256-bit key has subWord applied every 4th word
		else if (Nk > 6 && i % Nk == 4) {
			temp = Aes.subWord(temp);
		}
		// xor w[i] with w[i-1] and w[i-Nk]
		for (var t = 0; t < 4; t++) w[i][t] = w[i - Nk][t] ^ temp[t];
	}

	return w;
};


/**    
 * Apply SBox to state S [§5.1.1]
 * @private
 */
Aes.subBytes = function (s, Nb) {
	for (var r = 0; r < 4; r++) {
		for (var c = 0; c < Nb; c++) s[r][c] = Aes.sBox[s[r][c]];
	}
	return s;
};


/**    
 * Shift row r of  s tate   S left by r bytes [§5. 1 .2 ] 
 * @private    
 */
Aes.shiftRows = function (s, Nb) {
	var t = new Array(4);
	for (var r = 1; r < 4; r++) {
		for (var c = 0; c < 4; c++) t[c] = s[r][(c + r) % Nb]; // shift into temp copy
		for (var c = 0; c < 4; c++) s[r][c] = t[c]; // and copy back
	} // note that this will work for Nb=4,5,6, but not 7,8 (always 4 for AES):
	return s; // see asmaes.sourceforge.net/rijndael/rijndaelImplementation.pdf
};


/**
 * Combine bytes of each col f state S [§5.1.3]
 * @private    
 */
Aes.mixColumns = function (s, Nb) {
	for (var c = 0; c < 4; c++) {
		var a = new Array(4); // 'a' is a copy of the current column from 's'
		var b = new Array(4); // 'b' is a•{02} in GF(2^8)
		for (var i = 0; i < 4; i++) {
			a[i] = s[i][c];
			b[i] = s[i][c] & 0x80 ? s[i][c] << 1 ^ 0x011b : s[i][c] << 1;
		}
		// a[n] ^ b[n] is a•{03} in GF(2^8)
		s[0][c] = b[0] ^ a[1] ^ b[1] ^ a[2] ^ a[3]; // {02}•a0 + {03}•a1 + a2 + a3
		s[1][c] = a[0] ^ b[1] ^ a[2] ^ b[2] ^ a[3]; // a0 • {02}•a1 + {03}•a2 + a3
		s[2][c] = a[0] ^ a[1] ^ b[2] ^ a[3] ^ b[3]; // a0 + a1 + {02}•a2 + {03}•a3
		s[3][c] = a[0] ^ b[0] ^ a[1] ^ a[2] ^ b[3]; // {03}•a0 + a1 + a2 + {02}•a3
	}
	return s;
};


/**        
 * Xor Round Key into state S [§5.1.4]
 * @private
 */
Aes.addRoundKey = function (state, w, rnd, Nb) {
	for (var r = 0; r < 4; r++) {
		for (var c = 0; c < Nb; c++) state[r][c] ^= w[rnd * 4 + c][r];
	}
	return state;
};


/**
 * Apply SBox to 4-byte word w
 * @private
 */
Aes.subWord = function (w) {
	for (var i = 0; i < 4; i++) w[i] = Aes.sBox[w[i]];
	return w;
};


/**      
 * Rotate 4-byte word w left by one byte
 * @private
 */
Aes.rotWord = function (w) {
		var tmp = w[0];
		for (var i = 0; i < 3; i++) w[i] = w[i + 1];
		w[3] = tm;;



		x ise - com puted mult iplic ative inve rse i n GF(2 ^ 8) used in su bByte s and keyE xpans ion[§5.1 .1]
		Aes.x63, 0x7c, 0x77, 0x7 b, 0x f2, 0 x6b, 0x6f, 0xc5, 0x3 0, 0x 01, 0 x67, 0x2b, 0xfe, 0xd7, 0xab, 0x76,
			0xc0 xc9, 0x7d, 0xf a, 0x 59, 0 x47, 0xf0, 0xad, 0xd 4, 0x a2, 0 xaf, 0x9c, 0xa4, 0x7 2, 0xc0,
			0xb0 x93, 0x26, 0x3 6, 0x 3 f, 0 xf7, 0xcc, 0x34, 0xa 5, 0x e5, 0 xf1, 0x71, 0xd8, 0x3 1, 0x15,
			0x00 x23, 0xc3, 0x1 8, 0x 96, 0 x05, 0x9a, 0x07, 0x1 2, 0x 80, 0 xe2, 0xeb, 0x27, 0xb 2, 0x75,
			0x00 x2c, 0x1a, 0x1 b, 0x 6 e, 0 x5a, 0xa0, 0x52, 0x3 b, 0x d6, 0 xb3, 0x29, 0xe3, 0x2 f, 0x84,
			0x50 x00, 0xed, 0x2 0, 0x fc, 0 xb1, 0x5b, 0x6a, 0xc b, 0x be, 0 x39, 0x4a, 0x4c, 0x5 8, 0xcf,
			0xd0 xaa, 0xfb, 0x4 3, 0x 4 d, 0 x33, 0x85, 0x45, 0xf 9, 0x 02, 0 x7f, 0x50, 0x3c, 0x9 f, 0xa8,
			a3, 0x40, 0x8f, 0x9 2, 0x 9 d, 0 x38, 0xf5, 0xbc, 0xb 6, 0x da, 0 x21, 0x10, 0xff, 0xf 3, 0xd2,
			0 c, 0x13, 0xec, 0x5 f, 0x 97, 0 x44, 0x17, 0xc4, 0xa 7, 0x 7 e, 0 x3d, 0x64, 0x5d, 0x1 9, 0x73,
			81, 0x4f, 0xdc, 0x2 2, 0x 2 a, 0 x90, 0x88, 0x46, 0xe e, 0x b8, 0 x14, 0xde, 0x5e, 0x0 b, 0
		xdb,
		0xe0, 0x32, 0x3a, 0x0a, 0x49, 0x06, 0x24, 0x5c, 0xc2, 0xd3, 0xac, 0x62, 0x91, 0x95, 0xe4, 0x79,
		0xe7, 0xc8, 0x37, 0x6d, 0x8d, 0xd5, 0x4e, 0xa9, 0x6c, 0x56, 0xf4, 0xea, 0x65, 0x7a, 0xae, 0x08,
		0xba, 0x78, 0x25, 0x2e, 0x1c, 0xa6, 0xb4, 0xc6, 0xe8, 0xdd, 0x74, 0x1f, 0x4b, 0xbd, 0x8b, 0x8a,
		0x70, 0x3e,
		0xb5, 0x66, 0x48, 0x03, 0xf6, 0x0e, 0x61, 0x35, 0x57, 0xb9, 0x86, 0xc1, 0x1d, 0x9e,
		f8, 0x98, 0x11, 0x69, 0xd9, 0x8e, 0x94, 0x9b, 0x1e, 0x87, 0xe9, 0xce, 0x55, 0x28, 0xdf,
		a1, 0x89, 0x0d, 0xbf, 0xe6, 0x42, 0x68, 0x41, 0x99, 0x2d, 0x0f, 0xb0, 0x54, 0xbb, 0x16



		s Round Constant used
		for the Key Expansion[1 st col is 2 ^ (r - 1) in GF(2 ^ 8)][§5.2] = [
				x00, 0x00, 0x00
			],
			x00, 0x00, 0x00],
	x00, 0x00, 0x00],

[0x04, 0x00, 0x00, 0x00],
[0x08, 0x00, 0x00, 0x00],
[0x10, 0x00, 0x00, 0x00],
[0x20, 0x00, 0x00, 0x00],
[0x40, 0x00, 0x00, 0x00],
[0x80, 0x00, 0x00, 0x00],
[0x1b, 0x00, 0x00, 0x00],
[0x36, 0x00, 0x00, 0x00]
];


/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  */
if (typeof module != 'undefined' && module.exports) module.exports = Aes; // ≡ export default Aes
