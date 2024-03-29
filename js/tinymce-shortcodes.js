(function() {

    tinymce.PluginManager.add('faurteshortcodes', function( editor )
    {

		editor.addMenuItem('shortcode_person', {
			text: 'Person einfügen',
			context: 'tools',
			onclick: function() {
				editor.insertContent('[person slug="" showlink="0" extended="0" /]');
			}
		});
		
		editor.addMenuItem('shortcode_persons', {
			text: 'Personengalerie einfügen',
			context: 'tools',
			onclick: function() {
				editor.insertContent('[persons category="" showlink="0" extended="0" /]');
			}
		});
		
		editor.addMenuItem('shortcode_synonym', {
			text: 'Synonym einfügen',
			context: 'tools',
			onclick: function() {
				editor.insertContent('[synonym slug="" /]');
			}
		});
		
		editor.addMenuItem('shortcode_glossary', {
			text: 'Glossar einfügen',
			context: 'tools',
			onclick: function() {
				editor.insertContent('[glossary category="" /]');
			}
		});
		
		editor.addMenuItem('shortcode_downloads', {
			text: 'Downloads einfügen',
			context: 'tools',
			onclick: function() {
				editor.insertContent('[downloads category="" /]');
			}
		});
		
		editor.addMenuItem('shortcode_organigram', {
			text: 'Organigramm einfügen',
			context: 'tools',
			onclick: function() {
				editor.insertContent('[organigram menu="" /]');
			}
		});
		
		editor.addMenuItem('shortcode_assistant', {
			text: 'Assistenten einfügen',
			context: 'tools',
			onclick: function() {
				editor.insertContent('[assistant id="" /]');
			}
		});
		
		editor.addMenuItem('shortcode_accordion', {
			text: 'Accordion einfügen',
			context: 'tools',
			onclick: function() {
				editor.insertContent('[collapsibles]<br>[collapse title="Name" color=""]<br>Hier der Text<br>[/collapse]<br>[collapse title="Name" color=""]<br>Hier der Text<br>[/collapse]<br>[/collapsibles]');
			}
		});

    });
})();