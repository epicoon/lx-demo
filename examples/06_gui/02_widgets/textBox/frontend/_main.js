var ab = new lx.ActiveBox({
	geom: [10, 10, 40, 40],
	header: 'Text'
}).border();

var t = new lx.TextBox({
	parent: ab->body,
	text: 'rgrgrg wefwe wregregre ewfqwfqewf'
});

ab->body.align(lx.CENTER, lx.MIDDLE);
t.ellipsis();
