jQuery(document).ready(function(){
	
	// Upload media
	jQuery('.upload-button').live('click', function(event){
		
		event.preventDefault();
		var el = jQuery(this);
		
		// Create media frame
		var frame = wp.media.frames.frame = wp.media({
			title: 'Add Image',
			button: {
				text: 'Insert',
			},
			library: {
				type: 'image',
			},
			multiple: false,
		});
		
		// Create reference to inputs
		var src = el.siblings('.src');
		var alt = el.siblings('.alt');
		
		// When an image is selected, run a callback
		frame.on('select', function(){
			
			// If multiple is true, get first selected image from uploader
			var attachment = frame.state().get('selection').first().toJSON();
			
			// Insert attachment attributes into DOM
			jQuery(src).val(attachment.url);
			jQuery(alt).val(attachment.alt);
		});
		
		// Open the modal
		frame.open();
	});
	
	// Reset single fields
	jQuery('.upload-reset').click(function(){
		jQuery(this).siblings('.src').val('');
		return false;
	});
});