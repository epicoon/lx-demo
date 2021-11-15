#lx:use lx.ActiveBox;

// Окошко с кодом
var codeBox = new lx.ActiveBox({
    key: 'code',
    header: headerText + ': code',
    adhesive: true,
    geom: true,
    width: 50
});
codeBox.border();
codeBox.fill('white');

// Окошко с визуализацией
var demo = new lx.ActiveBox({
    key: 'demo',
    header: headerText + ': demo',
    adhesive: true,
    geom:true,
    left: 50
});
demo.border();
demo.fill('white');

var dir = new lx.Directory(Plugin.path);
var file = dir.find('_main.js');
var code = file.get();

code = localizate(code);
codeBox.setPlugin('lx/tools:codeRedactor', {
    text: code,
    lang: 'js'
});

Plugin.beforeRun(()=> {
    lx.WidgetHelper.autoParent = Plugin->demo->body;
});

//TODO примерно старая логика локализации. Вопрос для сервиса открытый
function localizate(code) {
    var langs = ['en', 'ru'];

    var lang = 'ru';
    langs.remove(lang);

    var result = code;
    var reg = new RegExp('\\t*?\\/\\*<' + lang + '>\\*\\/\\n', 'g');
    result = result.replace(reg, '');
    var reg = new RegExp('\\t*?\\/\\*<\\/' + lang + '>\\*\\/\\n', 'g');
    result = result.replace(reg, '');

    langs.forEach(l=>{
        var reg = new RegExp('\\t*?\\/\\*<' + l + '>\\*\\/\\n[\\w\\W]*?\\/\\*<\\/' + l + '>\\*\\/\\n', 'g');
        result = result.replace(reg, '');
    });

    return result;
}
