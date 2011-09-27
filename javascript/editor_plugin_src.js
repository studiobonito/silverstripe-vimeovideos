/**
 * Description of VimeoShortcodePlugin
 *
 * @version		1.0
 * @license		Simplified BSD License
 * @author      Tom Densham <tom.densham at studiobonito.co.uk>
 * @copyright   Studio Bonito Ltd.
 */

/**
 * VimeoShortcodePlugin Plugin
 */
(function() {
	tinymce.create('tinymce.plugins.VimeoShortcodePlugin', {
		init : function(ed, url) {
			var t = this;

			t.editor = ed;
			
			ed.addCommand('vmscInsertShortcode', function() {
				var str = '[Vimeo id= width= height=]Description[/Vimeo]';

				ed.execCommand('mceInsertContent', false, str);
			});

			// Register buttons
			ed.addButton('vmsc', {
				title : 'Insert Vimeo Shortcode',
				image : 'vimeovideos/images/vimeo.png',
				cmd : 'vmscInsertShortcode'
			});
		},

		getInfo : function() {
			return {
				longname : 'Vimeo Shortcode',
				author : 'Studio Bonito Ltd',
				authorurl : 'http://studiobonito.co.uk',
				infourl : 'http://studiobonito.co.uk',
				version : '1.0'
			};
		}
	});

	// Register plugin
	tinymce.PluginManager.add('vmsc', tinymce.plugins.VimeoShortcodePlugin);
})();