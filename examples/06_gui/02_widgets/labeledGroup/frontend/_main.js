var arr = [
	{
		label: 'l0',
		action: function() { console.log('l0'); }
	},
	{
		label: 'l1',
		action: function() { console.log('l1'); }
	},
	{
		label: 'l2',
		action: function() { console.log('l2'); }
	},
	{
		label: 'l3',
		action: function() { console.log('l3'); }
	}
];


var b = new lx.LabeledGroup({
	geom: [10, 10, 80, 40],

	grid: {
		cols: 2,
		rowHeight: '100px',
	},

	unit: {
		widget: lx.Input,
		labelOrientation: lx.LEFT,
		labelSize: 30,
		labelAlign: [lx.RIGHT, lx.MIDDLE],
	},

	labels: arr.lxColumn('label')
}).border();

b.units().callRepeat('click', arr.lxColumn('action'));

b.widgets().forEach(a=>a.on('blur', ()=> console.log(a.value())));
b.labels().forEach(a=>a.style('color', 'red'));
