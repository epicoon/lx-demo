#lx:use lx.Form;
#lx:use lx.Button;
#lx:use lx.Input;

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
// Генерим модели данных для агрегационного связывания
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


// Виджет, который будет связан по типу агрегатора с коллекцией моделей
var w = new lx.Box({
	grid: {indent:'10px'},
	geom: [40, 4, 50, 4]
}).border();
w.begin();
new lx.Input({field: 'name', width: 3});
new lx.Input({field: 'num', width: 3});
w.end();

// Связываем коллекцию и виджет
w.agregator(c);


// Виджет, который сделаем матрицей для визуализации коллекции
var frame2 = new lx.Box({
	geom: [10, 12, 80, 45],
	stream: true
}).border();
// Описываем правила работы матрицы
frame2.matrix({
	// Коллекция, с которой связываем матрицу
	items: c,
	// Тип элемента матрицы
	itemBox: [lx.Form, {
		grid: {indent:'10px'}
	}],
	// Внутреннее наполнение элемента матрицы
	itemRender: function(itemBox) {
		itemBox.border();

		itemBox.fields({
			name: [lx.Input, {width: 3}],
			num: [lx.Input, {width: 3}]
		});

		// Кнопка, удаляющая модель из коллекции
		new lx.Box({
			width: 1,
			style: {backgroundColor: 'red'},
			click: function() { c.removeAt(this.parent.index); }
		});
	}
});
