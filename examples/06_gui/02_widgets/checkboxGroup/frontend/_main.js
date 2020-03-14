var b = new lx.CheckboxGroup({
	geom: [10, 10, 40, 40],

	labels: [
		'Fegwger ewfwefe',
		'Gergreg fewew',
		'Frwrhrjty asfsetrerthrts',
		'Ggewgew qwdqd'
	],

	defaultValue: [1, 3]
}).border();

console.log( b.value() );

b.on('change', (e, changedIndex, changedCurrentValue)=> console.log(b.value(), changedIndex, changedCurrentValue) );
