
var el = new lx.Box({
	geom: [5, 10, 40, 40]
}).fill('green');

lx.Box.construct(2, {
	parent: el,
	key: 'pic',
	size: ['40px', '40px']
}).call('border').callRepeat('fill', ['red', 'blue']);

el.text('efefe wfwef trrtbr');

//TODO - упростил работу с выравниваниями, надо тут актуализировать

// el.align({
// 	horizontal: lx.RIGHT,
// 	vertical: lx.BOTTOM,
// 	subject: [el->pic, 'text'],  // необязательно указывать в данном случае, т.к. перечислены все потомки - это поведение по умолчанию
// 	step: '3%',
// 	paddingX: '5%',
// 	paddingY: '5%',
// 	direction: lx.VERTICAL
// });
