
var el = new lx.ActiveBox({
	geom: [10, 5, 80, 40],
	header: 'rgrgrg',
	body: lx.Form
});
el.border();
el->header.fill('grey').style('color', 'white');

var form = el->body;
form.grid({
	sizeBehavior: lx.GridPositioningStrategy.SIZE_BEHAVIOR_PROPORTIONAL
});

form.fill('white');

var config = {labelSize: '100px'};
form.labeledFields({
	login: ['Login',    lx.Input, config],
	pass:  ['Password', lx.Input, config],
	rem:   [lx.Checkbox, 'Remember',    {width: 4}],
	my:    [lx.Checkbox, 'My computer', {width: 4}],
	opa:   [lx.Checkbox, 'Some else',   {width: 4}],
});

form.fields({
	radio: [lx.RadioGroup, {
		labels: [
			'Guest',
			'User',
			'Admin'
		],
		left: 1,
		size: [5, 3]
	}],
	radio2: [lx.RadioGroup, {
		labels: [
			'Fuck everithing',
			'Kill them all',
			'Do nothing'
		],
		size: [5, 3]
	}]
});

new lx.RequestButton({
	parent: form,
	left: 3,
	width: 6,
	text: 'Submit',
	style: {backgroundColor: 'gray', color: 'white'}
});


