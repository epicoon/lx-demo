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

b.on('change', e=> console.log(b.value(), e.changedIndex, e.currentValues) );
