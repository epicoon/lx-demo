const demo = Module->demoBox->body;
demo.on('scroll', function() {
	lx.Cookie.set('y-scroll', Math.round(this.scrollPos().y));
});

Module.registerActiveRequest('sheet', function(res) {
	if (!res) {
		Module->demoBox->header.text('Error');
		return;
	}

	Module->demoBox->header.text('Demo');
	Module->demoBox->body.injectModule(res, function() {
		var y = lx.Cookie.get('y-scroll');
		if (y !== undefined) demo.scrollTo({y});
	});
});

// Настройка меню-навигатора
const MainMenu = Module->MainMenu;
const TreeBox = MainMenu->>tree;
TreeBox.setLeaf(function(leaf) {
	var data = leaf.node.data,
		title = data.title.isString ? data.title : data.title[Module.params.l10n.lang];
	leaf->label.text(title);

	//!!! подсветить пустые заголовки, по которым еще нет содержимого
	if (leaf.node.nodes.lxEmpty && !data.url && !data.to) leaf->label.fill('red');

	if (data.url) leaf->label.click(()=> {
		Module->demoBox->header.text('Loading...');
		Module.activeRequest('sheet', {caption: data.url});
	});
	else if (data.to) leaf->label.click(()=> window.open(data.to));
	else leaf->label.click(function() { this~>open.trigger('click'); });
});
TreeBox.setData(lx.Tree.create(#lx:load tree, 'items'));
// Чтобы открытые ветви дерева не забывались при перезагрузке страницы
TreeBox.setStateMemoryKey('treeState');



lx.keydown('a', function() {
});
