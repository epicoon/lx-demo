#lx:use lx.ActiveBox;

var ab = new lx.ActiveBox({
	geom: [5, 5, 90, 40]
}).border();

ab.grid({
	indent: '10px',
	rows: 5
});

ab.begin();

new lx.Rect({
	size: [1, 1],
	style: {backgroundColor: 'green'}
});
new lx.Rect({
	size: [2, 2],
	style: {backgroundColor: 'blue'}
});


new lx.Rect({
	geom: [3, 3, 6, 2],
	style: {backgroundColor: 'red'}
});

ab.end();
