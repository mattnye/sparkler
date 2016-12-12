(function() {

	// Button style 1
    tinymce.create('tinymce.plugins.button1', {
        init : function(ed, url) {
            ed.addButton('button1', {
                title : 'Button Style 1',
                image : url+'/img/button1.png',
                onclick : function() {
					
					// If content selected, wrap content
					if (ed.selection.getContent()) {
						ed.selection.setContent('[button link="URL" external="no" style="1"]' + ed.selection.getContent() + '[/button]');
					
					// Else, insert placeholder content
					} else {
						ed.selection.setContent('[button link="URL" external="no" style="1"]Button content[/button]');
					}
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('button1', tinymce.plugins.button1);
	
	// Button style 2
    tinymce.create('tinymce.plugins.button2', {
        init : function(ed, url) {
            ed.addButton('button2', {
                title : 'Button Style 2',
                image : url+'/img/button2.png',
                onclick : function() {
					
					// If content selected, wrap content
					if (ed.selection.getContent()) {
						ed.selection.setContent('[button link="URL" external="no" style="2"]' + ed.selection.getContent() + '[/button]');
					
					// Else, insert placeholder content
					} else {
						ed.selection.setContent('[button link="URL" external="no" style="2"]Button content[/button]');
					}
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('button2', tinymce.plugins.button2);
	
	// Box style 1
    tinymce.create('tinymce.plugins.box1', {
        init : function(ed, url) {
            ed.addButton('box1', {
                title : 'Box Style 1',
                image : url+'/img/box1.png',
                onclick : function() {
					
					// If content selected, wrap content
					if (ed.selection.getContent()) {
						ed.selection.setContent('[box title="Box title" style="1"]<br /><br />' + ed.selection.getContent() + '<br /><br />[/box]');
					
					// Else, insert placeholder content
					} else {
						ed.selection.setContent('[box title="Box title" style="1"]<br /><br />Box content<br /><br />[/box]');
					}
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('box1', tinymce.plugins.box1);
	
	// Box style 2
    tinymce.create('tinymce.plugins.box2', {
        init : function(ed, url) {
            ed.addButton('box2', {
                title : 'Box Style 2',
                image : url+'/img/box2.png',
                onclick : function() {
					
					// If content selected, wrap content
					if (ed.selection.getContent()) {
						ed.selection.setContent('[box title="Box title" style="2"]<br /><br />' + ed.selection.getContent() + '<br /><br />[/box]');
					
					// Else, insert placeholder content
					} else {
						ed.selection.setContent('[box title="Box title" style="2"]<br /><br />Box content<br /><br />[/box]');
					}
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('box2', tinymce.plugins.box2);
	
	// Ribbon
    tinymce.create('tinymce.plugins.ribbon', {
        init : function(ed, url) {
            ed.addButton('ribbon', {
                title : 'Ribbon',
                image : url+'/img/ribbon.png',
                onclick : function() {
					
					// If content selected, wrap content
					if (ed.selection.getContent()) {
						ed.selection.setContent('[ribbon]<br /><br />' + ed.selection.getContent() + '<br /><br />[/ribbon]');
					
					// Else, insert placeholder content
					} else {
						ed.selection.setContent('[ribbon]<br /><br />Ribbon content<br /><br />[/ribbon]');
					}
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('ribbon', tinymce.plugins.ribbon);
	
	// Tabs
    tinymce.create('tinymce.plugins.tabs', {
        init : function(ed, url) {
            ed.addButton('tabs', {
                title : 'Tabs',
                image : url+'/img/tabs.png',
                onclick : function() {
					
					// If content selected, wrap content
					if (ed.selection.getContent()) {
						ed.selection.setContent('[tabs]<br />[tab title="Tab title"]<br /><br />' + ed.selection.getContent() + '<br /><br />[/tab]<br /><br />[tab title="Tab title"]<br /><br />Tab content<br /><br />[/tab]<br /><br />[tab title="Tab title"]<br /><br />Tab content<br /><br />[/tab]<br />[/tabs]');
					
					// Else, insert placeholder content
					} else {
						ed.selection.setContent('[tabs]<br />[tab title="Tab title"]<br /><br />Tab content<br /><br />[/tab]<br /><br />[tab title="Tab title"]<br /><br />Tab content<br /><br />[/tab]<br /><br />[tab title="Tab title"]<br /><br />Tab content<br /><br />[/tab]<br />[/tabs]');
					}
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('tabs', tinymce.plugins.tabs);
	
	// Accordion
    tinymce.create('tinymce.plugins.accordion', {
        init : function(ed, url) {
            ed.addButton('accordion', {
                title : 'Accordion',
                image : url+'/img/accordion.png',
                onclick : function() {
					
					// If content selected, wrap content
					if (ed.selection.getContent()) {
						ed.selection.setContent('[accordion]<br />[pane title="Pane title" open="yes"]<br /><br />' + ed.selection.getContent() + '<br /><br />[/pane]<br /><br />[pane title="Pane title"]<br /><br />Pane content<br /><br />[/pane]<br /><br />[pane title="Pane title"]<br /><br />Pane content<br /><br />[/pane]<br />[/accordion]');
					
					// Else, insert placeholder content
					} else {
						ed.selection.setContent('[accordion]<br />[pane title="Pane title" open="yes"]<br /><br />Pane content<br /><br />[/pane]<br /><br />[pane title="Pane title"]<br /><br />Pane content<br /><br />[/pane]<br /><br />[pane title="Pane title"]<br /><br />Pane content<br /><br />[/pane]<br />[/accordion]');
					}
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('accordion', tinymce.plugins.accordion);
	
	// Divider
    tinymce.create('tinymce.plugins.divider', {
        init : function(ed, url) {
            ed.addButton('divider', {
                title : 'Divider',
                image : url+'/img/divider.png',
                onclick : function() {
					ed.selection.setContent('[divider]');
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('divider', tinymce.plugins.divider);
	
	// Icon
    tinymce.create('tinymce.plugins.icon', {
        init : function(ed, url) {
            ed.addButton('icon', {
                title : 'Icon',
                image : url+'/img/icon.png',
                onclick : function() {
					
					// If content selected, wrap content
					if (ed.selection.getContent()) {
						ed.selection.setContent('[icon shape="flash2" format="inline" after="no"]' + ed.selection.getContent() + '[/icon]');
					
					// Else, insert placeholder content
					} else {
						ed.selection.setContent('[icon shape="flash2" format="solo"][/icon]');
					}
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('icon', tinymce.plugins.icon);
	
	// 2 columns
    tinymce.create('tinymce.plugins.column2', {
        init : function(ed, url) {
            ed.addButton('column2', {
                title : '2 Columns',
                image : url+'/img/column2.png',
                onclick : function() {
					
					// If content selected, wrap content
					if (ed.selection.getContent()) {
						ed.selection.setContent('[column2]<br /><br />' + ed.selection.getContent() + '<br /><br />[/column2]<br /><br />[column2 last="yes"]<br /><br />Column content<br /><br />[/column2]');
					
					// Else, insert placeholder content
					} else {
						ed.selection.setContent('[column2]<br /><br />Column content<br /><br />[/column2]<br /><br />[column2 last="yes"]<br /><br />Column content<br /><br />[/column2]');
					}
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('column2', tinymce.plugins.column2);
	
	// 3 columns
    tinymce.create('tinymce.plugins.column3', {
        init : function(ed, url) {
            ed.addButton('column3', {
                title : '3 Columns',
                image : url+'/img/column3.png',
                onclick : function() {
					
					// If content selected, wrap content
					if (ed.selection.getContent()) {
						ed.selection.setContent('[column3]<br /><br />' + ed.selection.getContent() + '<br /><br />[/column3]<br /><br />[column3]<br /><br />Column content<br /><br />[/column3]<br /><br />[column3 last="yes"]<br /><br />Column content<br /><br />[/column3]');
					
					// Else, insert placeholder content
					} else {
						ed.selection.setContent('[column3]<br /><br />Column content<br /><br />[/column3]<br /><br />[column3]<br /><br />Column content<br /><br />[/column3]<br /><br />[column3 last="yes"]<br /><br />Column content<br /><br />[/column3]');
					}
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('column3', tinymce.plugins.column3);
	
	// 4 columns
    tinymce.create('tinymce.plugins.column4', {
        init : function(ed, url) {
            ed.addButton('column4', {
                title : '4 Columns',
                image : url+'/img/column4.png',
                onclick : function() {
					
					// If content selected, wrap content
					if (ed.selection.getContent()) {
						ed.selection.setContent('[column4]<br /><br />' + ed.selection.getContent() + '<br /><br />[/column4]<br /><br />[column4]<br /><br />Column content<br /><br />[/column4]<br /><br />[column4]<br /><br />Column content<br /><br />[/column4]<br /><br />[column4 last="yes"]<br /><br />Column content<br /><br />[/column4]');
					
					// Else, insert placeholder content
					} else {
						ed.selection.setContent('[column4]<br /><br />Column content<br /><br />[/column4]<br /><br />[column4]<br /><br />Column content<br /><br />[/column4]<br /><br />[column4]<br /><br />Column content<br /><br />[/column4]<br /><br />[column4 last="yes"]<br /><br />Column content<br /><br />[/column4]');
					}
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('column4', tinymce.plugins.column4);
})();