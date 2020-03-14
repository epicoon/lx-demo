#lx:use lx.ActiveBox;

var ab = new lx.ActiveBox({
	geom: [10, 5, 80, 40]
});
ab.border();
ab.overflow('auto');

var stream = ab.add(lx.Box);
stream.stream({ indent: '10px' });
stream.begin();

new lx.Box({
	height: '100px',
	text: '100px'
}).border();

new lx.Box({
	height: '40px',
	text: '40px'
}).border();

stream.end();

//------------------------------------------------------------------
// Еще один пример потока
var ab = new lx.ActiveBox({
	geom: [10, 50, 80, 40],
	header: 'Stream'
}).border();
ab.fill('green');

ab.streamProportional()
ab.begin();

new lx.Box({
	height: '50%',
	text: 'Height is allways 50%'
}).border();

new lx.Box({text: 'Height is 1/3 of unused streams height'}).border();
new lx.Box({text: 'Height is 1/3 of unused streams height'}).border();
new lx.Box({text: 'Height is 1/3 of unused streams height'}).border();

new lx.Box({
	height: '30px',
	text: 'Height is allways 30px'
}).border();

ab.end();
