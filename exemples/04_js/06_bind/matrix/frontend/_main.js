// Класс модели данных
class Test extends lx.BindableModel {
	#lx:schema name, num;

	constructor(name='rr', num=1) {
		super();
		this.name = name;
		this.num = num;
	}
}

//-------------------------------------------------------------
// Генерим модели данных для матричного связывания
var c = new lx.Collection(
	new Test(1, 'one'),
	new Test(1, 'two'),
	new Test(1, 'three')
);

// Кнопка, добавляющая новую модель в колллекцию
new lx.Button({
	geom: [10, 4, 20, 4],
	text: 'Add',
	click: function() {
		c.add(new Test(Math.floor(Math.random() * 10 + 1) , 'four'));
	}
});

// ПЕРВЫЙ виджет, который будет связан по типу матрицы с коллекцией моделей
var frame = new lx.Box({
	geom: [10, 12, 80, 40],
	stream: true
}).border();

// Описываем правила работы матрицы
frame.matrix({
	// Коллекция, с которой связываем матрицу
	items: c,
	// Тип элемента матрицы
	itemBox: [lx.Form, {
		grid: {indent:'10px'},
		style: {border: ''}
	}],
	// Внутреннее наполнение элемента матрицы
	itemRender: function(itemBox) {
		itemBox.fields({
			name: [lx.Input, {width: 3}],
			num: [lx.Input, {width: 3}]
		});

		// Кнопка, удаляющая модель из коллекции
		new lx.Box({
			width: 1,
			style: {fill: 'red'},
			click: function() { c.removeAt(this.parent.index); }
		});
	}
});

// ВТОРОЙ виджет, который будет связан по типу матрицы с коллекцией моделей
var frame2 = new lx.Box({
	geom: [10, 56, 80, 40],
	stream: true
}).border();

// Описываем правила работы матрицы
frame2.matrix({
	// Коллекция, с которой связываем матрицу
	items: c,
	// Тип элемента матрицы
	itemBox: [lx.Form, {
		grid: {indent:'10px'},
		style: {border: ''}
	}],
	// Внутреннее наполнение элемента матрицы
	itemRender: function(itemBox) {
		itemBox.fields({
			name: [lx.Input, {width: 3}],
			num: [lx.Input, {width: 3}]
		});

		// Кнопка, удаляющая модель из коллекции
		new lx.Box({
			width: 1,
			style: {fill: 'red'},
			click: function() { c.removeAt(this.parent.index); }
		});
	}
});
