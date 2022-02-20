#lx:use lx.Button;

// 1. Добавление элемента явным указанием родителя в конфиге
var parentBox = new lx.Box({ geom: [5, 5, 40, 10], text: 'parent box 1' }).border();
var childBox = new lx.Box({
	parent: parentBox,
	geom: [10, 50, 80, 40],
	text: 'child box 1',
	style: {backgroundColor: 'green'}
})

// 2. Добавление элемента через метод Box::add()
var parentBox = new lx.Box({ geom: [5, 20, 40, 10], text: 'parent box 2' }).border();
parentBox.add(lx.Box, {
	parent: parentBox,
	geom: [10, 50, 80, 40],
	text: 'child box 2',
	style: {backgroundColor: 'green'}
});

// 3. Массовое добавление элементов через метод Box::add()
var parentBox = new lx.Box({ geom: [5, 35, 40, 10], text: 'parent box 3' }).border();
parentBox.add(lx.Box, 3, {
	geom: [10, 50, 10, 40],
	style: {backgroundColor: 'green'}
}, {
	postBuild: function(elem, i) {
		elem.text(i);
		elem.left(10 + 20 * i + '%');
	}
});

// 4. Добавление элемента в середину указанием before (или after) в конфиге
var parentBox = new lx.Box({
	geom: [5, 50, 40, 10],
	stream:{direction:lx.HORIZONTAL}
}).border();
parentBox.add(lx.Box, 3, {
	width: '20%'
}, {
	postBuild: (elem, i)=> {
		elem.border();
		elem.text(i);
	}
});

// При нажатии на эту кнопку произойдет вставка элемента перед
// элементом с индексом 1
var but = new lx.Button({
	geom: [50, 50, 20, 10],
	text: 'click me',
	click: function() {
		new lx.Box({
			width: '30%',
			before: parentBox.child(1),
			text: 'before 1',
			style: {backgroundColor: 'green'},
			// При нажатии на сам элемент всё вернется как было
			click: function() { but.show(); this.del(); }
		});
		this.hide();
	}
});

