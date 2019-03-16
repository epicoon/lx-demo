
var el = new lx.Box({
	geom: [10, 10, 40, 40],
	image: 'cosm1.jpg'
}).border();
el->image.adapt();
el.align(lx.CENTER, lx.MIDDLE);

// то же самое
var el = new lx.Box({
	geom: [50, 50, 40, 40],
}).border();
var i = new lx.Image({
	parent: el,
	filename: 'cosm2.jpg'
});
i.adapt();
el.align(lx.CENTER, lx.MIDDLE);



