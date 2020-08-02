(function() {
	tinymce.PluginManager.add( 'wt_shortcodes_mce_button', function( editor, url ) {
		editor.addButton( 'wt_shortcodes_mce_button', {
			title: 'WellThemes Shortcodes',
			type: 'menubutton',
			icon: 'icon wt-shortcodes-icon',
			menu: [

				/** Message Boxes Start **/
				{
				text: 'Message Boxes',
				menu: [

						/* Doc */
						{
							text: 'Doc',
							onclick: function() {
								editor.insertContent( '[box style="doc"] Content goes here... [/box]<br /><br />');
							}
						},

						/* Download */
						{
							text: 'Download',
							onclick: function() {
								editor.insertContent( '[box style="download"] Content goes here... [/box]<br /><br />');
							}
						},

						/* Error */
						{
							text: 'Error',
							onclick: function() {
								editor.insertContent( '[box style="error"] Content goes here... [/box]<br /><br />');
							}
						},
						
						/* Help */
						{
							text: 'Help',
							onclick: function() {
								editor.insertContent( '[box style="help"] Content goes here... [/box]<br /><br />');
							}
						},
						
						/* Info */
						{
							text: 'Info',
							onclick: function() {
								editor.insertContent( '[box style="info"] Content goes here... [/box]<br /><br />');
							}
						},
						
						/* Media */
						{
							text: 'Media',
							onclick: function() {
								editor.insertContent( '[box style="media"] Content goes here... [/box]<br /><br />');
							}
						},
						
						/* New */
						{
							text: 'New',
							onclick: function() {
								editor.insertContent( '[box style="new"] Content goes here... [/box]<br /><br />');
							}
						},
						
						/* Note */
						{
							text: 'Note',
							onclick: function() {
								editor.insertContent( '[box style="note"] Content goes here... [/box]<br /><br />');
							}
						},
						
						/* Success */
						{
							text: 'Success',
							onclick: function() {
								editor.insertContent( '[box style="success"] Content goes here... [/box]<br /><br />');
							}
						},
						
						/* Warning */
						{
							text: 'Warning',
							onclick: function() {
								editor.insertContent( '[box style="warning"] Content goes here... [/box]<br /><br />');
							}
						},

					]
				}, // End Message Boxes section
				
				/** Buttons Start **/
				{
				text: 'Buttons',
				menu: [

						/* Default */
						{
							text: 'Default',
							onclick: function() {
								editor.insertContent( '[button url="#" size="small" style="default"] Button text... [/button]');
							}
						},

						/* Black */
						{
							text: 'Black',
							onclick: function() {
								editor.insertContent( '[button url="#" size="small" style="black"] Button text... [/button]');
							}
						},
						
						/* Blue */
						{
							text: 'Blue',
							onclick: function() {
								editor.insertContent( '[button url="#" size="small" style="blue"] Button text... [/button]');
							}
						},
						
						/* Brown */
						{
							text: 'Brown',
							onclick: function() {
								editor.insertContent( '[button url="#" size="small" style="brown"] Button text... [/button]');
							}
						},
						
						/* Coral */
						{
							text: 'Coral',
							onclick: function() {
								editor.insertContent( '[button url="#" size="small" style="coral"] Button text... [/button]');
							}
						},
						
						/* Dark Brown */
						{
							text: 'Dark Brown',
							onclick: function() {
								editor.insertContent( '[button url="#" size="small" style="dark-brown"] Button text... [/button]');
							}
						},
						
						/* Dark Green */
						{
							text: 'Dark Green',
							onclick: function() {
								editor.insertContent( '[button url="#" size="small" style="dark-green"] Button text... [/button]');
							}
						},
						
						/* Green */
						{
							text: 'Green',
							onclick: function() {
								editor.insertContent( '[button url="#" size="small" style="green"] Button text... [/button]');
							}
						},
						
						/* Magenta */
						{
							text: 'Magenta',
							onclick: function() {
								editor.insertContent( '[button url="#" size="small" style="magenta"] Button text... [/button]');
							}
						},
						
						/* Maroon */
						{
							text: 'Maroon',
							onclick: function() {
								editor.insertContent( '[button url="#" size="small" style="maroon"] Button text... [/button]');
							}
						},
						
						/* Orange */
						{
							text: 'Orange',
							onclick: function() {
								editor.insertContent( '[button url="#" size="small" style="orange"] Button text... [/button]');
							}
						},
						
						/* Pink */
						{
							text: 'Pink',
							onclick: function() {
								editor.insertContent( '[button url="#" size="small" style="pink"] Button text... [/button]');
							}
						},
						
						/* Purple */
						{
							text: 'Purple',
							onclick: function() {
								editor.insertContent( '[button url="#" size="small" style="purple"] Button text... [/button]');
							}
						},
						
						/* Red */
						{
							text: 'Red',
							onclick: function() {
								editor.insertContent( '[button url="#" size="small" style="red"] Button text... [/button]');
							}
						},
						
						/* Royal Blue */
						{
							text: 'Royal Blue',
							onclick: function() {
								editor.insertContent( '[button url="#" size="small" style="royal-blue"] Button text... [/button]');
							}
						},
						
						/* Sienna */
						{
							text: 'Sienna',
							onclick: function() {
								editor.insertContent( '[button url="#" size="small" style="sienna"] Button text... [/button]');
							}
						},
						
						/* Silver */
						{
							text: 'Silver',
							onclick: function() {
								editor.insertContent( '[button url="#" size="small" style="silver"] Button text... [/button]');
							}
						},
						
						/* Sky Blue */
						{
							text: 'Sky Blue',
							onclick: function() {
								editor.insertContent( '[button url="#" size="small" style="sky-blue"] Button text... [/button]');
							}
						},
						
						/* Teal */
						{
							text: 'Teal',
							onclick: function() {
								editor.insertContent( '[button url="#" size="small" style="teal"] Button text... [/button]');
							}
						},
						
						/* Yellow */
						{
							text: 'Yellow',
							onclick: function() {
								editor.insertContent( '[button url="#" size="small" style="yellow"] Button text... [/button]');
							}
						},
						
					]
				}, // End Buttons section
				
				/** Highlight **/
				{
				text: 'Highlight',
				menu: [

						/* Default */
						{
							text: 'Default',
							onclick: function() {
								editor.insertContent( '[highlight style="default"] Content goes here... [/highlight]');
							}
						},
						
						/* Alice Blue */
						{
							text: 'Alice Blue',
							onclick: function() {
								editor.insertContent( '[highlight style="alice-blue"] Content goes here... [/highlight]');
							}
						},
						
						/* Beige */
						{
							text: 'Beige',
							onclick: function() {
								editor.insertContent( '[highlight style="beige"] Content goes here... [/highlight]');
							}
						},
						
						/* Buff */
						{
							text: 'Buff',
							onclick: function() {
								editor.insertContent( '[highlight style="buff"] Content goes here... [/highlight]');
							}
						},
						
						/* Bubbles */
						{
							text: 'Bubbles',
							onclick: function() {
								editor.insertContent( '[highlight style="bubbles"] Content goes here... [/highlight]');
							}
						},
						
						/* Cream */
						{
							text: 'Cream',
							onclick: function() {
								editor.insertContent( '[highlight style="cream"] Content goes here... [/highlight]');
							}
						},
						
						/* Cyan */
						{
							text: 'Cyan',
							onclick: function() {
								editor.insertContent( '[highlight style="cyan"] Content goes here... [/highlight]');
							}
						},
						
						/* Magenta */
						{
							text: 'Magenta',
							onclick: function() {
								editor.insertContent( '[highlight style="magenta"] Content goes here... [/highlight]');
							}
						},
						
						/* Misty Rose */
						{
							text: 'Misty Rose',
							onclick: function() {
								editor.insertContent( '[highlight style="misty-rose"] Content goes here... [/highlight]');
							}
						},
						
						/* Pearl */
						{
							text: 'Pearl',
							onclick: function() {
								editor.insertContent( '[highlight style="pearl"] Content goes here... [/highlight]');
							}
						},
						
						/* Peach */
						{
							text: 'Peach',
							onclick: function() {
								editor.insertContent( '[highlight style="peach"] Content goes here... [/highlight]');
							}
						},
						
						/* Pear Green */
						{
							text: 'Pear Green',
							onclick: function() {
								editor.insertContent( '[highlight style="pear-green"] Content goes here... [/highlight]');
							}
						},
						
						/* Pink */
						{
							text: 'Pink',
							onclick: function() {
								editor.insertContent( '[highlight style="pink"] Content goes here... [/highlight]');
							}
						},
						
						/* Platinum */
						{
							text: 'Platinum',
							onclick: function() {
								editor.insertContent( '[highlight style="platinum"] Content goes here... [/highlight]');
							}
						},
						
						/* Salmon */
						{
							text: 'Salmon',
							onclick: function() {
								editor.insertContent( '[highlight style="salmon"] Content goes here... [/highlight]');
							}
						},
						
						/* Seashell */
						{
							text: 'Seashell',
							onclick: function() {
								editor.insertContent( '[highlight style="seashell"] Content goes here... [/highlight]');
							}
						},
						
						/* Smoke */
						{
							text: 'Smoke',
							onclick: function() {
								editor.insertContent( '[highlight style="smoke"] Content goes here... [/highlight]');
							}
						},
						
						/* Yellow */
						{
							text: 'Yellow',
							onclick: function() {
								editor.insertContent( '[highlight style="yellow"] Content goes here... [/highlight]');
							}
						},
						
						/* Vanilla */
						{
							text: 'Vanilla',
							onclick: function() {
								editor.insertContent( '[highlight style="vanilla"] Content goes here... [/highlight]');
							}
						},
						
						/* Wheat */
						{
							text: 'Wheat',
							onclick: function() {
								editor.insertContent( '[highlight style="Wheat"] Content goes here... [/highlight]');
							}
						},					

					]
				}, // End highlight section
				
				/** Lists **/
				{
				text: 'Lists',
				menu: [

						/* Arrow List */
						{
							text: 'Arrow List',
							onclick: function() {
								editor.insertContent( '[list style="arrow"]<br />&nbsp;&nbsp;&nbsp;&nbsp;[list_item]&nbsp;Item 1...&nbsp;[/list_item]<br />&nbsp;&nbsp;&nbsp;&nbsp;[list_item]&nbsp;Item 2...&nbsp;[/list_item]<br />[/list]<br /><br />');
							}
						},
						
						/* Circle List */
						{
							text: 'Circle List',
							onclick: function() {
								editor.insertContent( '[list style="circle"]<br />&nbsp;&nbsp;&nbsp;&nbsp;[list_item]&nbsp;Item 1...&nbsp;[/list_item]<br />&nbsp;&nbsp;&nbsp;&nbsp;[list_item]&nbsp;Item 2...&nbsp;[/list_item]<br />[/list]<br /><br />');
							}
						},
						
						/* Square List */
						{
							text: 'Square List',
							onclick: function() {
								editor.insertContent( '[list style="square"]<br />&nbsp;&nbsp;&nbsp;&nbsp;[list_item]&nbsp;Item 1...&nbsp;[/list_item]<br />&nbsp;&nbsp;&nbsp;&nbsp;[list_item]&nbsp;Item 2...&nbsp;[/list_item]<br />[/list]<br /><br />');
							}
						},
						
						/* Star List */
						{
							text: 'Star List',
							onclick: function() {
								editor.insertContent( '[list style="star"]<br />&nbsp;&nbsp;&nbsp;&nbsp;[list_item]&nbsp;Item 1...&nbsp;[/list_item]<br />&nbsp;&nbsp;&nbsp;&nbsp;[list_item]&nbsp;Item 2...&nbsp;[/list_item]<br />[/list]<br /><br />');
							}
						},
						
						/* Diamond List */
						{
							text: 'Diamond List',
							onclick: function() {
								editor.insertContent( '[list style="diamond"]<br />&nbsp;&nbsp;&nbsp;&nbsp;[list_item]&nbsp;Item 1...&nbsp;[/list_item]<br />&nbsp;&nbsp;&nbsp;&nbsp;[list_item]&nbsp;Item 2...&nbsp;[/list_item]<br />[/list]<br /><br />');
							}
						},
												
						/* Pencil List */
						{
							text: 'Pencil List',
							onclick: function() {
								editor.insertContent( '[list style="pencil"]<br />&nbsp;&nbsp;&nbsp;&nbsp;[list_item]&nbsp;Item 1...&nbsp;[/list_item]<br />&nbsp;&nbsp;&nbsp;&nbsp;[list_item]&nbsp;Item 2...&nbsp;[/list_item]<br />[/list]<br /><br />');
							}
						},
						
						/* Check List */
						{
							text: 'Check List',
							onclick: function() {
								editor.insertContent( '[list style="check"]<br />&nbsp;&nbsp;&nbsp;&nbsp;[list_item]&nbsp;Item 1...&nbsp;[/list_item]<br />&nbsp;&nbsp;&nbsp;&nbsp;[list_item]&nbsp;Item 2...&nbsp;[/list_item]<br />[/list]<br /><br />');
							}
						},
						
						/* Check Green List */
						{
							text: 'Check Green List',
							onclick: function() {
								editor.insertContent( '[list style="check-green"]<br />&nbsp;&nbsp;&nbsp;&nbsp;[list_item]&nbsp;Item 1...&nbsp;[/list_item]<br />&nbsp;&nbsp;&nbsp;&nbsp;[list_item]&nbsp;Item 2...&nbsp;[/list_item]<br />[/list]<br /><br />');
							}
						},
						
						/* Plus List */
						{
							text: 'Plus List',
							onclick: function() {
								editor.insertContent( '[list style="plus"]<br />&nbsp;&nbsp;&nbsp;&nbsp;[list_item]&nbsp;Item 1...&nbsp;[/list_item]<br />&nbsp;&nbsp;&nbsp;&nbsp;[list_item]&nbsp;Item 2...&nbsp;[/list_item]<br />[/list]<br /><br />');
							}
						},
						
						/* Plus Green List */
						{
							text: 'Plus Green List',
							onclick: function() {
								editor.insertContent( '[list style="plus-green"]<br />&nbsp;&nbsp;&nbsp;&nbsp;[list_item]&nbsp;Item 1...&nbsp;[/list_item]<br />&nbsp;&nbsp;&nbsp;&nbsp;[list_item]&nbsp;Item 2...&nbsp;[/list_item]<br />[/list]<br /><br />');
							}
						},
						
						/* Minus List */
						{
							text: 'Minus List',
							onclick: function() {
								editor.insertContent( '[list style="minus"]<br />&nbsp;&nbsp;&nbsp;&nbsp;[list_item]&nbsp;Item 1...&nbsp;[/list_item]<br />&nbsp;&nbsp;&nbsp;&nbsp;[list_item]&nbsp;Item 2...&nbsp;[/list_item]<br />[/list]<br /><br />');
							}
						},
						
						/* Minus Red List */
						{
							text: 'Minus Red List',
							onclick: function() {
								editor.insertContent( '[list style="minus-red"]<br />&nbsp;&nbsp;&nbsp;&nbsp;[list_item]&nbsp;Item 1...&nbsp;[/list_item]<br />&nbsp;&nbsp;&nbsp;&nbsp;[list_item]&nbsp;Item 2...&nbsp;[/list_item]<br />[/list]<br /><br />');
							}
						},
						
						/* Doc List */
						{
							text: 'doc List',
							onclick: function() {
								editor.insertContent( '[list style="doc"]<br />&nbsp;&nbsp;&nbsp;&nbsp;[list_item]&nbsp;Item 1...&nbsp;[/list_item]<br />&nbsp;&nbsp;&nbsp;&nbsp;[list_item]&nbsp;Item 2...&nbsp;[/list_item]<br />[/list]<br /><br />');
							}
						},
						
						/* Info List */
						{
							text: 'Info List',
							onclick: function() {
								editor.insertContent( '[list style="info"]<br />&nbsp;&nbsp;&nbsp;&nbsp;[list_item]&nbsp;Item 1...&nbsp;[/list_item]<br />&nbsp;&nbsp;&nbsp;&nbsp;[list_item]&nbsp;Item 2...&nbsp;[/list_item]<br />[/list]<br /><br />');
							}
						},
						
						/* Error List */
						{
							text: 'Error List',
							onclick: function() {
								editor.insertContent( '[list style="error"]<br />&nbsp;&nbsp;&nbsp;&nbsp;[list_item]&nbsp;Item 1...&nbsp;[/list_item]<br />&nbsp;&nbsp;&nbsp;&nbsp;[list_item]&nbsp;Item 2...&nbsp;[/list_item]<br />[/list]<br /><br />');
							}
						},
						
						/* Warning List */
						{
							text: 'Warning List',
							onclick: function() {
								editor.insertContent( '[list style="warning"]<br />&nbsp;&nbsp;&nbsp;&nbsp;[list_item]&nbsp;Item 1...&nbsp;[/list_item]<br />&nbsp;&nbsp;&nbsp;&nbsp;[list_item]&nbsp;Item 2...&nbsp;[/list_item]<br />[/list]<br /><br />');
							}
						},
						
						/* Delete List */
						{
							text: 'Delete List',
							onclick: function() {
								editor.insertContent( '[list style="delete"]<br />&nbsp;&nbsp;&nbsp;&nbsp;[list_item]&nbsp;Item 1...&nbsp;[/list_item]<br />&nbsp;&nbsp;&nbsp;&nbsp;[list_item]&nbsp;Item 2...&nbsp;[/list_item]<br />[/list]<br /><br />');
							}
						},
					]
				}, // End lists section
				
				/** Social **/
				{
				text: 'Social',
				menu: [

						/* Facebook */
						{
							text: 'Facebook',
							onclick: function() {
								editor.insertContent( '[facebook]');
							}
						},
						
						/* Goole+ */
						{
							text: 'Goole+',
							onclick: function() {
								editor.insertContent( '[gplus]');
							}
						},
						
						/* Twitter */
						{
							text: 'Twitter',
							onclick: function() {
								editor.insertContent( '[twitter]');
							}
						},
						
						/* LinkedIn */
						{
							text: 'LinkedIn',
							onclick: function() {
								editor.insertContent( '[linkedin]');
							}
						},
						
						/* StumbleUpon */
						{
							text: 'StumbleUpon',
							onclick: function() {
								editor.insertContent( '[stumbleupon]');
							}
						},
						
						/* Digg */
						{
							text: 'Digg',
							onclick: function() {
								editor.insertContent( '[digg]');
							}
						},

					]
				}, // End social section
				
				/** Videos **/
				{
				text: 'Videos',
				menu: [

						/* Youtube */
						{
							text: 'Youtube',
							onclick: function() {
								editor.insertContent( '[video type="youtube" id="Bag1gUxuU0g" width="500" height="300"  /]<br /><br />');
							}
						},
						
						/* Vimeo */
						{
							text: 'Vimeo',
							onclick: function() {
								editor.insertContent( '[video type="vimeo" id="33716408" width="500" height="300" /]<br /><br />');
							}
						},

						

					]
				}, // End videos section
				
				/** Dropcaps **/
				{
				text: 'Dropcaps',
				menu: [

						/* Default */
						{
							text: 'Default',
							onclick: function() {
								editor.insertContent( '[dropcap style="default"]A[/dropcap]');
							}
						},
						
						/* Circle */
						{
							text: 'Circle',
							onclick: function() {
								editor.insertContent( '[dropcap style="circle"]A[/dropcap]');
							}
						},
						
						/* Square */
						{
							text: 'Square',
							onclick: function() {
								editor.insertContent( '[dropcap style="square"]A[/dropcap]');
							}
						},
						
						/* Round */
						{
							text: 'Round',
							onclick: function() {
								editor.insertContent( '[dropcap style="round"]A[/dropcap]');
							}
						},

					]
				}, // End dropcaps section
				
				/** Lightbox **/
				{
				text: 'Lightbox',
				menu: [

						/* Lightbox Image */
						{
							text: 'Lightbox Image',
							onclick: function() {
								editor.insertContent( '[lightbox_image src="" bigimage="" title="Image"]<br>');
							}
						},

					]
				}, // End lightbox section

			]
		});
	});
})();