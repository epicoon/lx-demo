/**
 * @var lx.Plugin Plugin
 * @var lx.Snippet Snippet
 */

const demo = Plugin->demoBox->body;
demo.on('scroll', function() {
	lx.Cookie.set('y-scroll', Math.round(this.getScrollPos().y));
});

Plugin.registerActiveRequest('sheet', '', function(res) {
	if (!res) {
		Plugin->demoBox.setHeaderText('Error');
		return;
	}

	Plugin->demoBox.setHeaderText('Demo');
	Plugin->demoBox->body.setPlugin(res, {}, function() {
		var y = lx.Cookie.get('y-scroll');
		if (y !== undefined) demo.scrollTo({y});
	});
});

// Настройка меню-навигатора
const MainMenu = Plugin->MainMenu;
const TreeBox = MainMenu->>tree;
TreeBox.setLeaf(function(leaf) {
	var data = leaf.node.data,
		title = lx.isString(data.title) ? data.title : data.title['ru'/*Module.params.l10n.lang*/];
	leaf->label.text(title);

	//!!! подсветить пустые заголовки, по которым еще нет содержимого
	if (leaf.node.nodes.lxEmpty() && !data.url && !data.to) leaf->label.fill('red');

	if (data.url) leaf->label.click(()=> {
		Plugin->demoBox.setHeaderText('Loading...');
		Plugin.activeRequest('sheet', {caption: data.url});
	});
	else if (data.to) leaf->label.click(()=> window.open(data.to));
	else leaf->label.click(function() { this~>open.trigger('click'); });
});
TreeBox.setData(lx.Tree.uCreateFromObject(#lx:load(tree), 'items'));
// Чтобы открытые ветви дерева не забывались при перезагрузке страницы
TreeBox.setStateMemoryKey('treeState');

// Синхронизация ширины коробки для дерева и актив бокса
MainMenu.on('resize', function() {
	TreeBox->move.left( this.width('px') - 25 + 'px' );
	TreeBox->move.trigger('move');
});
MainMenu.trigger('resize');



lx.onKeydown('a', function() {
});
