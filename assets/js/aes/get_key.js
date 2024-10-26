const keys = {
	token: null,
	get_key: null,

	set_key: function (key) {
		this.token = key;
		this.get_key = key.slice(50, 100);
	}
}

function get_hashed(encrypt) {
	return CryptoJSAesJson.decrypt(encrypt, keys.get_key);
	// return CryptoJSAesJson.decrypt(encrypt, 'U2FsdGVkX19yS+ZVR8L/wiq3IigfSgJUtCvgor4yUv4=');
}
