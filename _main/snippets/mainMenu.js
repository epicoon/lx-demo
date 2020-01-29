/**
 * @var lx.Application App
 * @var lx.Plugin Plugin
 * @var lx.Snippet Snippet
 */

#lx:use lx.TreeBox;

Snippet.widget.streamProportional({indent: '5px'});

(new lx.Box({height:'25px', text:'Content'})).align(lx.CENTER, lx.MIDDLE);
new lx.TreeBox({key:'tree', labelWidth:270});
