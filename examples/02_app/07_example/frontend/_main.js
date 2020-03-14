
Module->>tree.setLeaf(function(leaf) {
	var data = leaf.node.data,
		title = data.title;
	leaf->label.text(title);

	if (leaf.node.keys.len) {
		leaf.click(function() { this->open.trigger('click'); });
	} else if (data.key) {
		leaf.click(()=> {
			^Resp.loadFile(data.key).then((result)=> {
				let redactor = Module->>redactor;
				redactor.lang = result.ext;
				redactor.setText(result.code);
			});
		});
	}
});

Module->>tree.setData(lx.Tree.create(#lx:load structure, 'items'));
