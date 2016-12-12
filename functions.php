<?php
/**
 * Functions
 *
 * @package WordPress
 * @subpackage Sparkler
 * @since Sparkler 1.0
 */

/**
 * Add custom permalinks
 */
function sparkler_faq_permalinks($post_link, $id = 0) {
    $post = get_post($id);
	
    if (is_wp_error($post) || 'faq' != $post->post_type || empty($post->post_name))
        return $post_link;
		
    // Get taxonomy
    $terms = get_the_terms($post->ID, 'faq-category');
	
    if (is_wp_error($terms) || !$terms) {
        $tax = 'uncategorized';
    } else {
        $tax_obj = array_pop($terms);
        $tax = $tax_obj->slug;
    }
	
	// Add taxonomy to permalink
    return home_url(user_trailingslashit("faq/$tax/$post->post_name"));
}
//add_filter('post_type_link', 'sparkler_faq_permalinks', 10, 2);

/**
 * Custom rewrites
 */

// Add custom rules
function custom_rewrite_rules($rules) {
	$newrules = array(
		'^about/areas-we-serve/heating-service-in-([A-Za-z0-9-]+)$' => 'index.php?page_id=504&state=$matches[1]',
		'^about/areas-we-serve/([A-Za-z0-9-]+)/heating-service-in-([A-Za-z0-9-]+)$' => 'index.php?page_id=537&state=$matches[1]&county=$matches[2]',
		'^about/areas-we-serve/([A-Za-z0-9-]+)/([A-Za-z0-9-]+)/heating-service-in-([A-Za-z0-9-]+)$' => 'index.php?page_id=533&state=$matches[1]&county=$matches[2]&city=$matches[3]',
		
		'^faq/([^/]+)/([^/]+)/?' => 'index.php?post_type=faq&faq-category=$matches[1]&faq=$matches[2]', // 1/2 Page structure; post is in taxonomy directory; post type rewrite is "faq"
		'^faq/([^/]+)/?' => 'index.php?faq-category=$matches[1]', // 2/2 Taxonomy rewrite is also "faq"
		
		'^about-us/meet-our-team/department/([^/]+)/?' => 'index.php?department=$matches[1]', // 1/2 Post structure; post is in root; taxonomy rewrite is "about-us/meet-our-team/department"
		'^about-us/meet-our-team/([^/]+)/?' => 'index.php?post_type=team-member&team-member=$matches[1]', // 2/2 Post type rewrite is "about-us/meet-our-team"
	);
	return $newrules + $rules;
}
//add_filter('rewrite_rules_array', 'custom_rewrite_rules');

// Register custom querystring variables
function custom_query_vars($vars) {
    array_push($vars, 'state', 'county', 'city');
    return $vars;
}
//add_filter('query_vars', 'custom_query_vars');

/**
 * Remove comments from attachment pages
 */
function remove_attachment_comments($open, $post_id) {
    $post = get_post($post_id);
    if ($post->post_type == 'attachment') {
        return false;
    }
    return $open;
}
add_filter('comments_open', 'remove_attachment_comments', 10, 2);

/**
 * Filter spam submissions in Gravity Forms
 *
 * @uses function has_spam()
 * @uses function remove_form_entry()
 */
function filter_spam($form) {
	
	// Create form array
	$forms[0]['form_id'] = '1';
	$forms[0]['notif_id'] = 'xxxxxxxxxxxxx';
	$forms[0]['field_name'] = 'input_xxx';
	
	$forms[1]['form_id'] = '2';
	$forms[1]['notif_id'] = 'xxxxxxxxxxxxx';
	$forms[1]['field_name'] = 'input_xxx';
	
	foreach ($forms as $f) {
		
		// Set form variables
		$form_id = $f['form_id'];
		$notif_id = $f['notif_id'];
		$field_name = $f['field_name'];
		
		// Only filter if form being submitted is in form array
		if ($form['id'] == $form_id) {
			
			// Get POST data
			$comments = $_POST[$field_name];
			
			// If spam keywords exist, change recipient and remove database entry
			if ($comments && has_spam($comments)) {
				
				// Change recipient
				$form['notifications'][$notif_id]['to'] = 'admin.email@yourwebsite.com';
				$form['notifications'][$notif_id]['bcc'] = '';
				
				// If Estimate form, send full message
				/*if ($form['id'] == '3') {
					$form['notifications'][$notif_id]['message'] = '{all_fields}';
				}*/
				
				// Remove entry
				add_action('gform_after_submission', 'remove_form_entry');	
			}
		}
	}
	return $form;
}
//add_filter('gform_pre_submission_filter', 'filter_spam');

/**
 * Check for spam keywords
 */
function has_spam($data) {
	// TODO: Add spaces to search, e.g., differentiate 'rank' from 'crank'
	//$spam_list = array('google', 'rank', 'ranking', 'search', 'searching', 'engine', 'engines', 'website', 'web site', 'position', 'positioning', 'seo');
	$spam_list = array('google', 'rank', 'search', 'engine', 'website', 'web site', 'position', 'seo');
	
	foreach ($spam_list as $spam) {
		if (stripos($data, $spam) !== false) {
			return true;
			break;
		}
	}
}

/**
 * Remove Gravity Form entry after submission
 */
function remove_form_entry($entry) {
    GFAPI::delete_entry($entry['id']);
}

/**
 * Duplicate Gravity Form entries to estimates table
 *
 * @uses function has_spam()
 */
function gform_duplicate_entry($entry, $form) {
    global $wpdb;
	
	// Set timezone
	$timezone = new DateTimeZone('America/New_York');
	$datetime = new DateTime(null, $timezone);
	
	// Get entry data
	$date        = $datetime->format('Y-m-d H:i:s');
	$firstname   = $entry['1'];
	$lastname    = $entry['7'];
	$email       = $entry['2'];
	$homephone   = $entry['8'];
	$description = $entry['4'];
	
	// If no spam keywords exist, make database entry
	if ($description && !has_spam($description)) {
		
		$sql = "INSERT INTO estimate (id, date, medium, keyword, firstname, lastname, email, city, state, homephone, alternatephone, workphone, cellphone, address, zip, timecall, type, description, referrer, other, newsletter, estimatetype, preferredmethod, coupon, rep_claim_email, rep_claim_time, rep_claim_resp_time, rep_set_email, rep_set_time, rep_set_resp_time, rep_set_status, rep_set_reason) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)";
		
		$wpdb->query($wpdb->prepare($sql, '', $date, '', '', $firstname, $lastname, $email, '', '', $homephone, '', '', '', '', '', '', '', $description, '', '', '', '', '', '', '', '', '', '', '', '', '', ''));
	}
}
//add_action('gform_after_submission_3', 'gform_duplicate_entry', 10, 2);

/**
 * Populate hidden fields in Gravity Forms
 */
function gform_populate_va_medium($form) {
    global $va_medium;
	return $va_medium;
}
//add_filter('gform_field_value_va_medium', 'gform_populate_va_medium');

/**
 * Send emails as plain text in Gravity Forms
 *
 * Must replace {all_fields} with individual labels and merge tags
 * Must disable auto formatting
 */
function gform_change_notification_format($notification, $form, $entry) {
	
	// Only change format for plain text notifications
	if ($notification['name'] == 'Plain Text') {
	
		// Change notification format to text from the default html
		$notification['message_format'] = 'text';
	}
    return $notification;
}
//add_filter('gform_notification', 'gform_change_notification_format', 10, 3);

/**
 * Add option for US state abbreviations in Gravity Forms
 */
function gform_us_state_abbrev($address_types, $form_id) {
	
	$address_types['us_state_abbrev'] = array(
		'label' => 'US State Abbreviated',
		'country' => 'United States',
		'zip_label' => 'ZIP Code',
		'states' => array(
			'' => '',
			'AL' => 'Alabama',
			'AK' => 'Alaska',
			'AZ' => 'Arizona',
			'AR' => 'Arkansas',
			'CA' => 'California',
			'CO' => 'Colorado',
			'CT' => 'Connecticut',
			'DE' => 'Delaware',
			'DC' => 'District Of Columbia',
			'FL' => 'Florida',
			'GA' => 'Georgia',
			'HI' => 'Hawaii',
			'ID' => 'Idaho',
			'IL' => 'Illinois',
			'IN' => 'Indiana',
			'IA' => 'Iowa',
			'KS' => 'Kansas',
			'KY' => 'Kentucky',
			'LA' => 'Louisiana',
			'ME' => 'Maine',
			'MD' => 'Maryland',
			'MA' => 'Massachusetts',
			'MI' => 'Michigan',
			'MN' => 'Minnesota',
			'MS' => 'Mississippi',
			'MO' => 'Missouri',
			'MT' => 'Montana',
			'NE' => 'Nebraska',
			'NV' => 'Nevada',
			'NH' => 'New Hampshire',
			'NJ' => 'New Jersey',
			'NM' => 'New Mexico',
			'NY' => 'New York',
			'NC' => 'North Carolina',
			'ND' => 'North Dakota',
			'OH' => 'Ohio',
			'OK' => 'Oklahoma',
			'OR' => 'Oregon',
			'PA' => 'Pennsylvania',
			'RI' => 'Rhode Island',
			'SC' => 'South Carolina',
			'SD' => 'South Dakota',
			'TN' => 'Tennessee',
			'TX' => 'Texas',
			'UT' => 'Utah',
			'VT' => 'Vermont',
			'VA' => 'Virginia',
			'WA' => 'Washington',
			'WV' => 'West Virginia',
			'WI' => 'Wisconsin',
			'WY' => 'Wyoming',
			'AS' => 'American Samoa',
			'GU' => 'Guam',
			'MP' => 'Northern Mariana Islands',
			'PR' => 'Puerto Rico',
			'UM' => 'United States Minor Outlying Islands',
			'VI' => 'Virgin Islands',
			'AA' => 'Armed Forces Americas',
			'AP' => 'Armed Forces Pacific',
			'AE' => 'Armed Forces Others',
		)
	);
	return $address_types;
}
//add_filter('gform_address_types', 'gform_us_state_abbrev', 10, 2);

/**
 * Add attachments to Gravity Forms user notification email
 */
function change_user_notification_attachments($notification, $form, $entry) {
	
    if ($notification['name'] == 'Admin Notification') {
		
        $fileupload_fields = GFCommon::get_fields_by_type($form, array('fileupload'));
		
        if (!is_array($fileupload_fields))
            return $notification;
			
        $attachments = array();
        $upload_root = RGFormsModel::get_upload_root();
        
		foreach ($fileupload_fields as $field) {
            
			$url = $entry[$field['id']];
            $attachment = preg_replace('|^(.*?)/gravity_forms/|', $upload_root, $url);
            
			if ($attachment)
                $attachments[] = $attachment;
        }
        $notification['attachments'] = $attachments;
    }
    return $notification;
}
add_filter('gform_notification', 'change_user_notification_attachments', 10, 3);

/**
 * Get attachment id from URL
 */
function get_attachment_id($attachment_url = '') {
	
	global $wpdb;
	$attachment_id = false;
	
	// If there is no url, return
	if ('' == $attachment_url)
		return;
		
	// Get upload directory path
	$upload_dir_paths = wp_upload_dir();
	
	// Make sure upload path base directory exists in attachment URL, to verify media library image
	if (false !== strpos($attachment_url, $upload_dir_paths['baseurl'])) {
		
		// If URL of auto-generated thumbnail, get URL of original image
		$attachment_url = preg_replace('/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url);
		
		// Remove upload path base directory from attachment URL
		$attachment_url = str_replace($upload_dir_paths['baseurl'].'/', '', $attachment_url);
		
		// Run query to get attachment ID from modified attachment URL
		$attachment_id = $wpdb->get_var($wpdb->prepare("SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url));
		
	}
	return $attachment_id;
}

/**
 * Filter search results
 */
function search_filter($query) {
	if ($query->is_search && $query->is_main_query()) {
		//$query->set('post__not_in', array(9999)); // Exclude specific pages
		$query->set('post_type', 'post'); // Exclude all pages
		//$query->set('post_type', array('post', 'page')); // Exclude custom post types
	}
	return $query;
}
add_filter('pre_get_posts', 'search_filter');

/**
 * Enable HTTP Strict Transport Security (HSTS)
 */
function sparkler_hsts() {
    header('Strict-Transport-Security: max-age=10886400');
}
//add_action('send_headers', 'sparkler_hsts');

/**
 * Clean head
 */
remove_action('wp_head', 'feed_links_extra', 3); // Links to the extra feeds, e.g., category feeds
remove_action('wp_head', 'feed_links', 2); // Links to the general post and comment feeds
remove_action('wp_head', 'rsd_link'); // Link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Link to the Windows Live Writer manifest file
remove_action('wp_head', 'wp_generator'); // WP version

/**
 * Clean content
 */
function clean_content($content){
    $array = array (
        '<div class="no-review-box"></div>' => '', // Social Review Engine
    );
    $content = strtr($content, $array);
    
	return $content;
}
//add_filter('the_content', 'clean_content');

/**
 * Clean images
 *
 * Removes p tags around images
 */
function clean_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
add_filter('the_content', 'clean_images');

/**
 * Remove inline caption width
 */
function fixed_img_caption_shortcode($attr, $content = null) {
	// New-style shortcode with the caption inside the shortcode with the link and image tags
	if ( ! isset( $attr['caption'] ) ) {
		if ( preg_match( '#((?:<a [^>]+>\s*)?<img [^>]+>(?:\s*</a>)?)(.*)#is', $content, $matches ) ) {
			$content = $matches[1];
			$attr['caption'] = trim( $matches[2] );
		}
	}

	// Allow plugins/themes to override the default caption template
	$output = apply_filters('img_caption_shortcode', '', $attr, $content);
	if ( $output != '' )
		return $output;

	extract(shortcode_atts(array(
		'id'	=> '',
		'align'	=> 'alignnone',
		'width'	=> '',
		'caption' => ''
	), $attr));

	if ( 1 > (int) $width || empty($caption) )
		return $content;

	if ( $id ) $id = 'id="' . esc_attr($id) . '" ';

	return '<div ' . $id . 'class="wp-caption ' . esc_attr($align) . '">'
	. do_shortcode( $content ) . '<p class="wp-caption-text">' . $caption . '</p></div>';
}
add_shortcode('wp_caption', 'fixed_img_caption_shortcode');
add_shortcode('caption', 'fixed_img_caption_shortcode');

/**
 * Add support for custom page excerpts
 */
function add_page_excerpt() {
	add_post_type_support('page', 'excerpt');
}
add_action('init', 'add_page_excerpt');

/**
 * Tree conditional
 */
function is_tree($pid) {
    global $post;
	$anc = get_post_ancestors($post->ID);
	
	// If current page
    if (is_page($pid)) {
		return true;
	
	// If descendant
	} elseif ($anc) {
		foreach ($anc as $ancestor) {
			if (is_page() && $ancestor == $pid) return true;
		}
	} else {
		return false;
	}
}

/**
 * Remove protected/private from title
 */
function the_title_trim($title) {
	$title = attribute_escape($title);
	$find = array(
		'#Protected:#',
		'#Private:#'
	);
	$replace = array(
		'', // What to replace "Protected:" with
		'' // What to replace "Private:" with
	);
	$title = preg_replace($find, $replace, $title);
	
	return $title;
}
add_filter('the_title', 'the_title_trim');

/**
 * Breadcrumb
 */
function the_breadcrumb() {  
	$showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
	$home = 'Home'; // text for the 'Home' link
	$showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
	$before = '<span class="current">'; // tag before the current crumb
	$after = '</span>'; // tag after the current crumb
	
	global $post;
	$homeLink = get_bloginfo('url');
  
	if (is_home() || is_front_page()) {
	
		if ($showOnHome == 1) echo '<nav id="breadcrumb"><a href="' . $homeLink . '">' . $home . '</a></nav>';
	
	} else {
	
		echo '<nav id="breadcrumb">'."\n";
		echo '    <ul class="breadcrumb">'."\n";
		//echo '        <li><a href="' . $homeLink . '">' . $home . '</a></li>';

		if ( is_category() ) {
			$thisCat = get_category(get_query_var('cat'), false);
			if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE);
			echo '<li>'.$before . 'Archive by category "' . single_cat_title('', false) . '"' . $after.'</li>';
		
		} elseif ( is_search() ) {
			echo '<li>'.$before . 'Search results for "' . get_search_query() . '"' . $after.'</li>';
		
		} elseif ( is_day() ) {
			echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li>';
			echo '<li><a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a></li>';
			echo '<li>'.$before . get_the_time('d') . $after.'</li>';
		
		} elseif ( is_month() ) {
			echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li>';
			echo '<li>'.$before . get_the_time('F') . $after.'</li>';
		
		} elseif ( is_year() ) {
			echo '<li>'.$before . get_the_time('Y') . $after.'</li>';
		
		} elseif ( is_single() && !is_attachment() ) {
			if ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				echo '<li><a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a></li>';
				if ($showCurrent == 1) echo '<li>'.$before . get_the_title() . $after.'</li>';
			} else {
				$cat = get_the_category(); $cat = $cat[0];
				$cats = get_category_parents($cat, TRUE);
				if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats); // TODO: Remove delimiter
				echo $cats;
				if ($showCurrent == 1) echo '<li>'.$before . get_the_title() . $after.'</li>';
			}
		
		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
			$post_type = get_post_type_object(get_post_type());
			echo '<li>'.$before . $post_type->labels->singular_name . $after.'</li>';
		
		} elseif ( is_attachment() ) {
			$parent = get_post($post->post_parent);
			$cat = get_the_category($parent->ID); $cat = $cat[0];
			echo get_category_parents($cat, TRUE);
			echo '<li><a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a></li>';
			if ($showCurrent == 1) echo '<li>'.$before . get_the_title() . $after.'</li>';
		
		} elseif ( is_page() && !$post->post_parent ) {
			if ($showCurrent == 1) echo '<li>'.$before . get_the_title() . $after.'</li>';
		
		} elseif ( is_page() && $post->post_parent ) {
			$parent_id = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
				$page = get_page($parent_id);
				$breadcrumbs[] = '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
				$parent_id = $page->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			for ($i=0; $i<count($breadcrumbs); $i++) {
				echo $breadcrumbs[$i];
			}
			if ($showCurrent == 1) echo '<li>'.$before . get_the_title() . $after.'</li>';
		
		} elseif ( is_tag() ) {
			echo '<li>'.$before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after.'</li>';
		
		} elseif ( is_author() ) {
			global $author;
			$userdata = get_userdata($author);
			echo '<li>'.$before . 'Articles posted by ' . $userdata->display_name . $after.'</li>';
		
		} elseif ( is_404() ) {
			echo '<li>'.$before . 'Error 404' . $after.'</li>';
		}
		
		if ( get_query_var('paged') ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
			echo __('Page') . ' ' . get_query_var('paged');
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
		}
		echo '    </ul>'."\n";
		echo '</nav>'."\n";
	}
}

if (!function_exists('sparkler_setup')) :
/**
 * Theme setup
 */
function sparkler_setup() {
	
	// Translation
	load_theme_textdomain('sparkler', get_template_directory().'/languages');
	
	// Load external files
	require(get_template_directory().'/inc/theme-options.php');
	require(get_template_directory().'/inc/shortcodes.php');
	require(get_template_directory().'/inc/widgets.php');
	//require(get_template_directory().'/inc/custom-post-types.php');
	
	// Add theme support
	add_theme_support('post-thumbnails');
	add_theme_support('automatic-feed-links');
	
	// Register navs
	register_nav_menu('main', __('Main Menu', 'sparkler'));
	//register_nav_menu('top', __('Top Menu', 'sparkler'));
	register_nav_menu('bottom', __('Bottom Menu', 'sparkler'));
	//register_nav_menu('footer', __('Footer Menu', 'sparkler'));
	
	// Set default featured image size
	set_post_thumbnail_size(320, 320, true);
	
	// Set default image sizes
	update_option('thumbnail_size_w', 320);
	update_option('thumbnail_size_h', 320);
	update_option('thumbnail_crop', 1);
	
	update_option('medium_size_w', 640);
	update_option('medium_size_h', 640);
	
	update_option('large_size_w', 768);
	update_option('large_size_h', 768);
	
	// Add custom image sizes
	add_image_size('small', 480, 480);
	add_image_size('small-square', 480, 480, 1);
	add_image_size('medium-square', 640, 640, 1);
	add_image_size('large-square', 768, 768, 1);
	add_image_size('extra-large', 1200, 1200);
}
endif;

add_action('after_setup_theme', 'sparkler_setup');

/**
 * Add custom image sizes to Media Library
 */
function sparkler_custom_image_sizes($sizes) {
	return array_merge($sizes, array(
		'small' => __('Small'),
		'small-square' => __('Small Square'),
		'medium-square' => __('Medium Square'),
		'large-square' => __('Large Square'),
		'extra-large' => __('Extra Large'),
	));
}
add_filter('image_size_names_choose', 'sparkler_custom_image_sizes');

/**
 * Load scripts and styles
 */
function sparkler_scripts() {
	
	// Styles
	wp_register_style('jquery-ui', '//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css', null, null, 'all');
	wp_enqueue_style('jquery-ui');
	
	//wp_register_style('google-fonts', '//fonts.googleapis.com/css?family=Lato:400,400italic,900,900italic|Roboto:400,400italic,700,700italic', null, null, 'all');
	//wp_enqueue_style('google-fonts');
	
	wp_register_style('style', get_template_directory_uri().'/style.css', null, null, 'all');
	wp_enqueue_style('style');
	
	// Scripts
	wp_register_script('modernizr', get_template_directory_uri().'/js/modernizr.js', null, null, false);
	wp_enqueue_script('modernizr');
	
	wp_deregister_script('jquery');
	wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js', null, null, true);
	wp_enqueue_script('jquery');
	
	wp_register_script('jquery-ui', '//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js', array('jquery'), null, true);
	wp_enqueue_script('jquery-ui');
	
	wp_register_script('enquire', get_template_directory_uri().'/js/enquire.js', array('jquery'), null, true);
	wp_enqueue_script('enquire');
	
	wp_register_script('flexslider', get_template_directory_uri().'/js/flexslider.js', array('jquery'), null, true);
	wp_enqueue_script('flexslider');
	
	//wp_register_script('isotope', get_template_directory_uri().'/js/isotope.js', array('jquery'), null, true);
	//wp_enqueue_script('isotope');
	
	wp_register_script('fancybox', get_template_directory_uri().'/js/fancybox.js', array('jquery'), null, true);
	wp_enqueue_script('fancybox');
	
	wp_register_script('fancybox-thumbs', get_template_directory_uri().'/js/fancybox-thumbs.js', array('jquery', 'fancybox'), null, true);
	wp_enqueue_script('fancybox-thumbs');
	
	wp_register_script('various', get_template_directory_uri().'/js/various.js', array('jquery', 'enquire', 'flexslider', 'fancybox', 'fancybox-thumbs'), null, true);
	wp_enqueue_script('various');
}
add_action('wp_enqueue_scripts', 'sparkler_scripts');

/**
 * Load scripts and styles on all Admin pages
 */
function sparkler_admin_scripts() {
	wp_enqueue_media();
	wp_register_script('custom-upload', get_template_directory_uri().'/js/media-uploader.js', array('jquery'));
	wp_enqueue_script('custom-upload');
}
add_action('admin_enqueue_scripts', 'sparkler_admin_scripts');

/**
 * Edit user roles
 */
function sparkler_edit_roles() {
	
	// Remove all access to Theme and Plugin editor screens
	define('DISALLOW_FILE_EDIT', true);
	
	// Editor
	$editor = get_role('editor');
	$editor->add_cap('edit_theme_options'); // Appearance
	$editor->add_cap('gravityforms_view_entries'); // Gravity Forms view entries
	$editor->add_cap('gravityforms_export_entries'); // Gravity Forms export entries
}
add_action('init', 'sparkler_edit_roles');

/**
 * Edit admin menu
 */
function sparkler_edit_admin_menu() {
	
	// Remove link to CSS editor
	// TODO: Page can still be accessed directly
	remove_submenu_page('themes.php', 'editcss');
}
add_action('admin_menu', 'sparkler_edit_admin_menu', 999);

/**
 * Reorder admin menu
 */
function sparkler_reorder_admin_menu($order) {
    if (!$order) return true;
	
    return array(
        'index.php', // Dashboard
        'separator1', // First separator
        'edit.php?post_type=page', // Pages
		'edit.php', // Posts
        'edit-comments.php', // Comments
		'upload.php', // Media
        'separator2', // Second separator
        'themes.php', // Appearance
        'plugins.php', // Plugins
        'users.php', // Users
        'tools.php', // Tools
        'options-general.php', // Settings
        'separator-last', // Last separator
    );
}
add_filter('custom_menu_order', 'sparkler_reorder_admin_menu');
add_filter('menu_order', 'sparkler_reorder_admin_menu');

/**
 * Custom login logo, link, and title
 */
function custom_login_logo() { ?>
    <style type="text/css">
        .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/svg/logo-for-light.svg) !important;
            background-size: contain !important;
            width: 94px !important;
            height: 94px !important;
            opacity: .37;
        }
    </style><?php
}
add_action('login_enqueue_scripts', 'custom_login_logo');

function custom_login_link() {
    return 'http://matthewjamesnye.com/';
}
add_filter('login_headerurl', 'custom_login_link');

function custom_login_title() {
    return 'Matt Nye';
}
add_filter('login_headertitle', 'custom_login_title');

/**
 * Set post excerpt length
 */
function sparkler_excerpt_length($length) {
	return 40;
}
add_filter('excerpt_length', 'sparkler_excerpt_length');

/**
 * Replaces the "[...]" appended to automatically generated excerpts
 */
function sparkler_auto_excerpt_more($more) {
	return ' &hellip;';
}
add_filter('excerpt_more', 'sparkler_auto_excerpt_more');

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function sparkler_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'sparkler_page_menu_args' );

/**
 * Register sidebars and widgetized areas
 *
 * @since Sparkler 1.0
 */
function sparkler_widgets_init() {
	
	register_widget('Widget_Button');
	register_widget('Widget_Social');
	
	register_sidebar(array(
		'name'          => __('Main Sidebar', 'sparkler'),
		'id'            => 'sidebar-1',
		'description'   => __('The sidebar that will appear on all Sidebar template pages.', 'sparkler'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => "</aside>",
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));
	
	register_sidebar(array(
		'name'          => __('Blog Sidebar', 'sparkler'),
		'id'            => 'sidebar-2',
		'description'   => __('The sidebar that will appear on your Blog.', 'sparkler'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => "</aside>",
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));
}
add_action('widgets_init', 'sparkler_widgets_init');

if ( ! function_exists( 'sparkler_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 */
function sparkler_content_nav( $nav_id ) {
	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $nav_id; ?>">
			<h3 class="assistive-text"><?php _e( 'Post navigation', 'sparkler' ); ?></h3>
			<div class="grid6">
			    <p><?php if (get_next_posts_link()) echo '<span class="icon icon-chevron-left2"></span>'; ?> <?php next_posts_link( __( 'Older entries', 'sparkler' ) ); ?></p>
            </div><!--grid-->
			<div class="grid6 last">
			    <p><?php previous_posts_link( __( 'Newer entries', 'sparkler' ) ); ?> <?php if (get_previous_posts_link()) echo '<span class="icon icon-after icon-chevron-right2"></span>'; ?></p>
            </div><!--grid-->
		</nav><!--<?php echo $nav_id; ?>-->
	<?php endif;
}
endif; // sparkler_content_nav

/**
 * Return the URL for the first link found in the post content.
 *
 * @since Sparkler 1.0
 * @return string|bool URL or false when no link is present.
 */
function sparkler_url_grabber() {
	if ( ! preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', get_the_content(), $matches ) )
		return false;

	return esc_url_raw( $matches[1] );
}

/**
 * Count the number of footer sidebars to enable dynamic classes for the footer
 */
function sparkler_footer_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'sidebar-3' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-4' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-5' ) )
		$count++;

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'one';
			break;
		case '2':
			$class = 'two';
			break;
		case '3':
			$class = 'three';
			break;
	}

	if ( $class )
		echo 'class="' . $class . '"';
}

if ( ! function_exists( 'sparkler_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own sparkler_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Sparkler 1.0
 */
function sparkler_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'sparkler' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'sparkler' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php
						$avatar_size = 84;
						//if ( '0' != $comment->comment_parent )
							//$avatar_size = 63;

						echo get_avatar( $comment, $avatar_size );

						/* translators: 1: comment author, 2: date and time */
						printf( __( '%1$s %2$s', 'sparkler' ),
							sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
							sprintf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( __( '%1$s at %2$s', 'sparkler' ), get_comment_date(), get_comment_time() )
							)
						);
					?>

					<?php edit_comment_link( __( 'Edit', 'sparkler' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .comment-author .vcard -->

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'sparkler' ); ?></em>
					<br />
				<?php endif; ?>

			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="comment-reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( '<span class="icon icon-inline icon-reply4"></span>Reply', 'sparkler' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for sparkler_comment()

if ( ! function_exists( 'sparkler_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 * Create your own sparkler_posted_on to override in a child theme
 *
 * @since Sparkler 1.0
 */
function sparkler_posted_on() {
	printf( __( '<span class="sep">Posted on </span><time class="entry-date" datetime="%3$s">%4$s</time>', 'sparkler' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'sparkler' ), get_the_author() ) ),
		get_the_author()
	);
}
endif;

/**
 * Adds two classes to the array of body classes.
 * The first is if the site has only had one author with published posts.
 * The second is if a singular post being displayed
 *
 * @since Sparkler 1.0
 */
function sparkler_body_classes( $classes ) {

	if ( function_exists( 'is_multi_author' ) && ! is_multi_author() )
		$classes[] = 'single-author';

	if ( is_singular() && ! is_home() && ! is_page_template( 'showcase.php' ) && ! is_page_template( 'sidebar-page.php' ) )
		$classes[] = 'singular';

	return $classes;
}
add_filter( 'body_class', 'sparkler_body_classes' );

?>