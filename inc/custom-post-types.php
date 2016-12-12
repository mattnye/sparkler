<?php
/**
 * Custom Post Types
 *
 * @package WordPress
 * @subpackage Sparkler
 * @since Sparkler 1.0
 */

/* ============================================================================
   Table
   ============================================================================ */

/**
 * Add Table custom post type
 */
function cpt_table() {
	$labels = array(
		'name'               => _x('Tables', 'post type general name'),
		'singular_name'      => _x('Table', 'post type singular name'),
		'add_new'            => _x('Add New', 'table'),
		'add_new_item'       => __('Add New Table'),
		'edit_item'          => __('Edit Table'),
		'new_item'           => __('New Table'),
		'all_items'          => __('All Tables'),
		'view_item'          => __('View Table'),
		'search_items'       => __('Search Tables'),
		'not_found'          => __('No tables found'),
		'not_found_in_trash' => __('No tables found in the Trash'),
		'parent_item_colon'  => '',
		'menu_name'          => 'Tables',
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds our tables and table specific data',
		'public'        => true,
		'menu_position' => 20,
		'menu_icon'     => 'dashicons-align-none',
		'supports'      => array('title', 'editor', 'thumbnail', 'revisions'),
		'has_archive'   => true,
		'rewrite'       => array('slug' => 'conference-tables', 'with_front' => false),
	);
	register_post_type('pm_table', $args);
}
add_action('init', 'cpt_table');

/**
 * Add Table custom taxonomies
 */
function taxonomies_table() {
	
	// Table Categories
	$labels = array(
		'name'              => _x('Table Categories', 'taxonomy general name'),
		'singular_name'     => _x('Table Category', 'taxonomy singular name'),
		'search_items'      => __('Search Table Categories'),
		'all_items'         => __('All Table Categories'),
		'parent_item'       => __('Parent Table Category'),
		'parent_item_colon' => __('Parent Table Category:'),
		'edit_item'         => __('Edit Table Category'), 
		'update_item'       => __('Update Table Category'),
		'add_new_item'      => __('Add New Table Category'),
		'new_item_name'     => __('New Table Category'),
		'menu_name'         => __('Table Categories'),
	);
	$args = array(
		'labels'            => $labels,
		'show_admin_column' => true,
		'hierarchical'      => true,
		'rewrite'           => array('slug' => 'conference-tables/category', 'with_front' => false),
	);
	register_taxonomy('pm_table_category', 'pm_table', $args);	
}
add_action('init', 'taxonomies_table', 0);

/**
 * Add Table custom meta boxes
 */

/* Table Details
   ============================================================================ */
function box_table_details() {
    add_meta_box(
        'box_table_details',
        'Table Details',
        'callback_table_details',
        'pm_table',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'box_table_details');

// Display box content
function callback_table_details($post) {
	
	// Add nonce
	wp_nonce_field('callback_table_details', 'callback_table_details_nonce');
	
	// Get existing values
	$table_price  = get_post_meta($post->ID, 'table_price', true);
	$table_width  = get_post_meta($post->ID, 'table_width', true);
	$table_height = get_post_meta($post->ID, 'table_height', true);
	$table_finish = get_post_meta($post->ID, 'table_finish', true);
	$table_edge   = get_post_meta($post->ID, 'table_edge', true);
	$table_base   = get_post_meta($post->ID, 'table_base', true);
	$table_ports  = get_post_meta($post->ID, 'table_ports', true);
	
	// Display inputs
	echo '<p>';
	echo '<label for="table_price">Price:</label>';
	echo '<input type="text" id="table_price" name="table_price" class="widefat" value="'.esc_attr($table_price).'" />';
	echo '</p>';
	
	echo '<p>';
	echo '<label for="table_width">Width:</label>';
	echo '<input type="text" id="table_width" name="table_width" class="widefat" value="'.esc_attr($table_width).'" />';
	echo '</p>';
	
	echo '<p>';
	echo '<label for="table_height">Height:</label>';
	echo '<input type="text" id="table_height" name="table_height" class="widefat" value="'.esc_attr($table_height).'" />';
	echo '</p>';
	
	echo '<p>';
	echo '<label for="table_finish">Finish:</label>';
	echo '<input type="text" id="table_finish" name="table_finish" class="widefat" value="'.esc_attr($table_finish).'" />';
	echo '</p>';
	
	echo '<p>';
	echo '<label for="table_edge">Edge Style:</label>';
	echo '<input type="text" id="table_edge" name="table_edge" class="widefat" value="'.esc_attr($table_edge).'" />';
	echo '</p>';
	
	echo '<p>';
	echo '<label for="table_base">Base Type:</label>';
	echo '<input type="text" id="table_base" name="table_base" class="widefat" value="'.esc_attr($table_base).'" />';
	echo '</p>';
	
	echo '<p>';
	echo '<label for="table_ports">Data Ports:</label>';
	echo '<input type="text" id="table_ports" name="table_ports" class="widefat" value="'.esc_attr($table_ports).'" />';
	echo '</p>';
}

// Save data
function box_table_details_save($post_id) {

	// Don't autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
		return;
	
	// Check nonce
	if (!wp_verify_nonce($_POST['callback_table_details_nonce'], 'callback_table_details'))
		return;
	
	// Check permissions
	if ('page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id))
		return;
	} else {
		if (!current_user_can('edit_post', $post_id))
		return;
	}

	// Sanitize input
	$table_price  = sanitize_text_field($_POST['table_price']);
	$table_width  = sanitize_text_field($_POST['table_width']);
	$table_height = sanitize_text_field($_POST['table_height']);
	$table_finish = sanitize_text_field($_POST['table_finish']);
	$table_edge   = sanitize_text_field($_POST['table_edge']);
	$table_base   = sanitize_text_field($_POST['table_base']);
	$table_ports  = sanitize_text_field($_POST['table_ports']);
		
	// Update database
	update_post_meta($post_id, 'table_price', $table_price);
	update_post_meta($post_id, 'table_width', $table_width);
	update_post_meta($post_id, 'table_height', $table_height);
	update_post_meta($post_id, 'table_finish', $table_finish);
	update_post_meta($post_id, 'table_edge', $table_edge);
	update_post_meta($post_id, 'table_base', $table_base);
	update_post_meta($post_id, 'table_ports', $table_ports);
}
add_action('save_post', 'box_table_details_save');

?>