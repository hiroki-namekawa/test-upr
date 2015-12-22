Event.observe(window, 'load', function() {
	var form = $('inputform');
	if (form == null) return;
	var elems = Form.getElements(form);
	elems.each(function(el) {
		if (el.tagName == 'TEXTAREA') {
			el.onfocus = resizeTextarea;
		}
	});
});
function resizeTextarea()
{
	var min_rows = this.rows;
	var max_rows = min_rows * 3;
	var resize = function() {
		var match = this.value.match(/\r\n?|\n/g);
		var lines = match == null ? 1 : match.length + 2;
		this.rows = Math.max(min_rows, Math.min(lines, max_rows));
	};
	this.onfocus = resize;
	this.onkeyup = resize;
	this.onmouseup = resize;
}
function mailer(to, subject, body)
{
	to = 'znvygb;' + to;
	to = to.replace(/\*/, '@');
	to = to.replace(/\:/, '.');
	to = to.replace(/\;/, ':');
	to = to.rot13();
	if (typeof subject == 'string') {
		to += '?subject=' + subject + '&';
	}
	if (typeof body == 'string') {
		to += 'body=' + body + '&';
	}
	if (confirm('メールを作成しますか？')) {
		location.href = to;
	}
}
String.prototype.rot13 = function() {
	return this.replace(/[a-z]/ig, function(c) {
		var n;
		return String.fromCharCode((n = c.charCodeAt(0) + 13) > (c <= 'Z' ? 90 : 122) ? n - 26 : n);
	});
};
