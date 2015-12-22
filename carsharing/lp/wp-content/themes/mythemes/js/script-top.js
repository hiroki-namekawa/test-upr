// JavaScript Document

jQuery(function($) {
var postfix = '_o';
$('#layout a img.over').not('[src*="'+ postfix +'."]').each(function() {
var img = $(this);
var src = img.attr('src');
var src_on = src.substr(0, src.lastIndexOf('.'))
+ postfix
+ src.substring(src.lastIndexOf('.'));
$('<img>').attr('src', src_on);
img.hover(function() {
img.attr('src', src_on);
}, function() {
img.attr('src', src);
});
});
});