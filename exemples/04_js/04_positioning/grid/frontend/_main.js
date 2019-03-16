var ab = new lx.ActiveBox({
	geom: [5, 5, 40, 40]
}).border();

ab->body.grid({
	// sizeBehavior: lx.GridPositioningStrategy.SIZE_BEHAVIOR_PROPORTIONAL
	sizeBehavior: lx.GridPositioningStrategy.SIZE_BEHAVIOR_PROPORTIONAL_CONST,
	indent: '10px',
	rows: 5
}).begin();

var w = 6;
new lx.Rect({
	width: w,
	style: {fill: 'green'}
});
new lx.Rect({
	width: w,
	style: {fill: 'green'}
});


new lx.Rect({
	left: 3,
	width: w,
	style: {fill: 'green'}
});

ab->body.end();
