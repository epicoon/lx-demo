
//==========================================================================
/*<ru>*/
// 1. Создание нового элемента
/*</ru>*/
/*<en>*/
// 1. New element creation
/*</en>*/
var box = new lx.Box({
	/*<ru>*/
	// Расположение элемента [лево, верх, ширина, высота] - по умолчанию в %
	/*</ru>*/
	/*<en>*/
	// Element position [left, top, width, height] - with % by default
	/*</en>*/
	geom: [5, 5, 30, 10],
	text: 'Sinlge bordered box'
})
// Обведем рамкой, чтобы его видно было
box.border();


//==========================================================================
// 2. Массовое создание элементов - требует явного указания родителя
// Возвращает коллекцию созданных элементов
lx.Box.construct(
	3,  // количество создаваемых элементов
	{  // конфиг, общий для создаваемых элементов
		top: 20,
		size: ['20px', '20px'],
		style: {backgroundColor: 'green'}
	},
	{  // возможность преобразовать конфиг до момента создания,
	   // и/или произвести действия с уже готовым элементом,
	   // обладая информацией о номере итерации цикла создания элементов
		preBuild: function(config, i) {
			// Функция получает конфиг, определенный выше, чтобы
			// модифицировать его для конкретного элемента
			config.text = i + 5;
			// После модификации его нужно вернуть (даже если
			// модификации не было - все равно надо вернуть,
			// но без модификации конфига какой смысл в этой функции?)
			return config;
		},
		postBuild: function(elem, i) {
			// Работаем с уже созданным элементом
			elem.left(i * 30 + 'px');
		}
	}
);
