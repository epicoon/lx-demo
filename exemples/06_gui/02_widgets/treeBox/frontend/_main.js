var tree = new lx.Tree('a', 'b', 'c', 'a/a', 'a/b', 'a/c', 'b/a', 'b/b', 'c/a', 'a/a/a');

var t = new lx.TreeBox({
	geom: [10, 10, 80, 60],
	data: tree,
	add: lx.TreeBox.ALLOWED_ADDING,
	leaf: function(leaf) {
		leaf->label.text( leaf.node.key );
		leaf.createAddButton();
		leaf.createDelButton();
	}
}).border();
