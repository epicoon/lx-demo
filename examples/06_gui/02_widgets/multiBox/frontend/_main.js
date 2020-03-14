var mb = new lx.MultiBox({
	geom: [10, 10, 80, 40],

	marks: [
		'erer',
		'rthrt'
	],

	animation: true

}).border();


new lx.Rect({
	geom: [10, 10, 40, 40],
	parent: mb.sheet(0)
}).fill('green');

new lx.Rect({
	geom: [40, 40, 40, 40],
	parent: mb.sheet(1)
}).fill('green');
