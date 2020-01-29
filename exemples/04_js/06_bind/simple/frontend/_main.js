#lx:use lx.Form;
#lx:use lx.Input;
#lx:use lx.RadioGroup;
#lx:use lx.CheckboxGroup;

// Класс, используемый классом модели посредством композиции
class Sub {
	constructor() {
		this.x = 'xx';
		this.y = 'yy';
	}
}
// Класс модели данных
class Test extends lx.BindableModel {
	// Поля модели, доступные для связывания
	#lx:schema
		name,
		num,
		val,
		arr,
		// Экстра-поля для дочерних сущностей. Так же и элементы массивов можно и т.п.
		subX << sub.x,
		subY << sub.y;

	constructor(name='rr', num=1) {
		super();
		this.name = name;
		this.num = num;
		this.val = 0;
		this.arr = [];
		this.sub = new Sub();
	}
}

//-------------------------------------------------------------
// Модель для демонстрации простого связывания
var t = new Test();

// Первая форма
var f = new lx.Form({
	grid: {cols: 2, indent:'10px'},
	geom: [10, 5, 80, 40]
});
f.border();
f.fields({
	name : [ lx.Input, {width: 1} ],
	num  : [ lx.Input, {width: 1} ],
	subX : [ lx.Input, {width: 1} ],
	subY : [ lx.Input, {width: 1} ],
	val  : [ lx.RadioGroup, {size: [1, 3], labels: ['one', 'two', 'three']} ],
	arr  : [ lx.CheckboxGroup, {size: [1, 3], labels: ['one', 'two', 'three']} ]
});

// Вторая форма
var f2 = new lx.Form({
	grid: {cols: 2, indent:'10px'},
	geom: [10, 52.5, 80, 40]
});
f2.border();
f2.fields({
	name : [ lx.Input, {width: 1} ],
	num  : [ lx.Input, {width: 1} ],
	subX : [ lx.Input, {width: 1} ],
	subY : [ lx.Input, {width: 1} ],
	val  : [ lx.RadioGroup, {size: [1, 3], labels: ['one', 'two', 'three']} ],
	arr  : [ lx.CheckboxGroup, {size: [1, 3], labels: ['one', 'two', 'three']} ]
});

// Связывание
t.bind([f, f2]);
