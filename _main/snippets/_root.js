/**
 * @var lx.Application App
 * @var lx.Plugin Plugin
 * @var lx.Snippet Snippet
 */

#lx:use lx.ActiveBox;

Plugin.title = 'Demo';

var menu = new lx.ActiveBox({
    key: 'MainMenu',
    adhesive: true,
    header: 'Main menu',
    geom: true,
    width: 20
});
menu.border();
menu.setSnippet('mainMenu');

var demo = new lx.ActiveBox({
    key: 'demoBox',
    header: 'Article',
    adhesive: true,
    left: 20
});
demo.border();
demo.fill('white');
