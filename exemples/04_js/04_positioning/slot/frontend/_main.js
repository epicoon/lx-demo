var box = new lx.ActiveBox({
	geom: [10, 10, 40, 40]
}).border();
var body = box->body;

body.slot({
	cols: 3,
	rows: 2,
	k: 1.5,
	count: 5,

	step: '10px',
	padding: '20px'
});
body.slots().call('border');

body.add(lx.Button, 5, {}, {postBuild: (elem, i)=> elem.text(i)});
