/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	config.language = 'en';
	config.entities = false;
	config.selectMultiple = true; 
	// config.uiColor = '#AADC6E';
config.toolbar =
[
['Source'],
['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'],

['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
['Link','Unlink','Anchor'],['Maximize', 'ShowBlocks','-'],

['NumberedList','BulletedList','-','Outdent','Indent'],
['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
['BidiLtr', 'BidiRtl' ],

['Image','Youtube','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe'],
['Styles','Format','Font','FontSize'],
['TextColor','BGColor'],	['Bold','Italic','Underline','Strike','-','Subscript','Superscript','Remove'],

];
config.toolbar_basic =
[
['Source','-','Save','NewPage','Preview','-','Templates'],
['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'],
['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'],
'/',
['Bold','Italic','Underline','Strike','-','Subscript','Superscript','Remove'],
['NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv'],
['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
['BidiLtr', 'BidiRtl' ],
['Link','Unlink','Anchor'],
['Image','Youtube','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe'],
'/',
['Styles','Format','Font','FontSize'],
['TextColor','BGColor'],
['Maximize', 'ShowBlocks','-']
];

config.extraPlugins = 'youtube';


};
