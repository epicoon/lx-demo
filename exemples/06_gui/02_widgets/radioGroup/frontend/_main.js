var b = new lx.RadioGroup({
	geom: [10, 10, 40, 40],

	labels: [
		'Fegwger ewfwefe',
		'Gergreg fewew',
		'Frwrhrjty asfsetrerthrts',
		'Ggewgew qwdqd'
	],

	defaultValue: 1
}).border();

console.log( b.value() );

b.on('change', (e, newValue, oldValue)=> console.log(newValue, oldValue) );
