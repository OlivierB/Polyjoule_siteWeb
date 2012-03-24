 
(function() {
	tinymce.create('tinymce.plugins.IBrowserPlugin', {
		init : function(ed, url) {
			// Register commands
			ed.addCommand('mceIBrowser', function() {
				// Internal image object like a flash placeholder
				if (ed.dom.getAttrib(ed.selection.getNode(), 'class').indexOf('mceItem') != -1)
					return;
 
				ed.windowManager.open({
					file : url + '/ibrowser.php',
					//width : 480 + parseInt(ed.getLang('ibrowser.delta_width', 0)),
					//height : 385 + parseInt(ed.getLang('ibrowser.delta_height', 0)),
					width : 700 ,
					height : 500 ,
					inline : 1
				}, {
					plugin_url : url
				});
			});
 
			// Register buttons
			ed.addButton('ibrowser', {
				title : 'Ajouter une image',
				cmd : 'mceIBrowser',
				image :  url + '/images/ibrowser.gif'
			});
 
			// Add a node change handler, selects the button in the UI when a image is selected
			ed.onNodeChange.add(function(ed, cm, n) {
				cm.setActive('ibrowser', n.nodeName == 'IMG');
			});
 
		},
 
		createControl : function(n, cm) {
			return null;
		},
 
 
		getInfo : function() {
			return {
				longname : 'IBrowser pour tinyMCE 3',
				author : 'D. Ghysels',
				authorurl : '',
				infourl : '',
				version : tinymce.majorVersion + "." + tinymce.minorVersion
			};
		}
	});
 
	// Register plugin
	tinymce.PluginManager.add('ibrowser', tinymce.plugins.IBrowserPlugin);
})();