var b = new lx.ActiveBox({
	geom: [5, 10, 40, 40],
	header: 'Wadafuck',
	body: [ lx.Table, {
		cols: 5,
		rows: 4,
		rowHeight: '40px',
		// indents: {
		// 	step: '5px',
		// 	padding: '10px'
		// },
		interactive: true
	}]
});
b.border();
var tab = b->body;
tab.row(0).height(2);
tab.rows().forEach((r)=> r.cell(0).width(2));
// tab.insertRows(2, 2);
// tab.setRowCount(2);
// tab.delRows(1, 2);
// tab.addRows(3);
// tab.setRowHeight('25px');
// tab.rows(1, 2).forEach(child=>child.height('10px'));

var t2 = new lx.Table({
	geom: [55, 10, 40, 40],
	rows: 5,
	cols: 3
});
t2.interactive();
