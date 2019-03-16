var ab = new lx.ActiveBox({
	geom: [10, 5, 80, 40]
});
ab.border();

ab->body.stream({ indent: '10px' });
ab->body.begin();

new lx.Box({
	height: '40%',
	text: 'Height is allways 40%'
}).border();

new lx.Box({
	height: '40px',
	text: 'Height is allways 40px'
}).border();

ab->body.end();

//------------------------------------------------------------------
// Еще один пример потока
var ab = new lx.ActiveBox({
	geom: [10, 50, 80, 40],
	header: 'Stream'
}).border();
ab->body.fill('green');

ab->body.streamProportional()
ab->body.begin();

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

ab->body.end();
