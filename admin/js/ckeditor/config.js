/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

/*
CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
};
*/


/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For complete reference see:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config
    config.extraPlugins = 'tliyoutube';
    config.allowedContent = true;

	// The toolbar groups arrangement, optimized for two toolbar rows.
	config.toolbarGroups = [
		{ name: 'styles' },
		{ name: 'colors' },
		{ name: 'links' },
		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
        '/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'insert'},
  		{ name: 'tools' },
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing',     groups: [ 'find'] }, /* , 'selection', 'spellchecker'  */
		/* { name: 'forms' }, */
		{ name: 'others' }
	];

	// Remove some buttons provided by the standard plugins, which are
	// not needed in the Standard(s) toolbar.
	config.removeButtons = 'Subscript,Superscript,CreateDiv,Language,Flash,Smiley,Iframe';

	// Set the most common block elements.
	config.format_tags = 'p;h1;h2;h3;pre';

	// Simplify the dialog windows.
	config.removeDialogTabs = 'image:advanced;link:advanced';
};

/*

CKEDITOR.plugins.addExternal('audio', 'plugins/audio/', 'plugin.js');
CKEDITOR.editorConfig = function( config )
{
    // Declare the additional plugin
	config.extraPlugins = 'audio,youtube';

    // Add the button to toolbar
	config.toolbar = [
	['Styles','Format','Font','FontSize','TextColor','BGColor', '-','Image'],
    { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ], },
	['links', 'Maximize', 'Source'],
    '/',
	['Bold','Italic','Underline','Strike','-','Subscript','Superscript','-','fmath_formula'],
	['Table','HorizontalRule'],
	['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
    ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
    ['Audio', 'Flash', 'Youtube']
    ]
};
*/