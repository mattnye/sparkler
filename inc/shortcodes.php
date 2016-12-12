<?php
/**
 * Shortcodes
 *
 * @package WordPress
 * @subpackage Sparkler
 * @since Sparkler 1.0
 */

/**
 * Override native shortcodes
 */

/* Gallery
   ============================================================================ */
function gallery_handler($attr) {
	$post = get_post();

	static $instance = 0;
	$instance++;

	if ( ! empty( $attr['ids'] ) ) {
		// 'ids' is explicitly ordered, unless you specify otherwise.
		if ( empty( $attr['orderby'] ) )
			$attr['orderby'] = 'post__in';
		$attr['include'] = $attr['ids'];
	}

	// Allow plugins/themes to override the default gallery template.
	$output = apply_filters('post_gallery', '', $attr);
	if ( $output != '' )
		return $output;

	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( !$attr['orderby'] )
			unset( $attr['orderby'] );
	}

	extract(shortcode_atts(array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post ? $post->ID : 0,
		'itemtag'    => 'ul',
		'icontag'    => 'li',
		'captiontag' => 'li',
		'columns'    => 3,
		'size'       => 'thumbnail',
		'include'    => '',
		'exclude'    => '',
		'link'       => '',
		'class'      => '',
	), $attr, 'gallery'));

	$id = intval($id);
	if ( 'RAND' == $order )
		$orderby = 'none';

	if ( !empty($include) ) {
		$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( !empty($exclude) ) {
		$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	} else {
		$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	}

	if ( empty($attachments) )
		return '';

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $att_id => $attachment )
			$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
		return $output;
	}

	$itemtag = tag_escape($itemtag);
	$captiontag = tag_escape($captiontag);
	$icontag = tag_escape($icontag);
	$valid_tags = wp_kses_allowed_html( 'post' );
	if ( ! isset( $valid_tags[ $itemtag ] ) )
		$itemtag = 'ul';
	if ( ! isset( $valid_tags[ $captiontag ] ) )
		$captiontag = 'li';
	if ( ! isset( $valid_tags[ $icontag ] ) )
		$icontag = 'li';

	$columns = intval($columns);
	$itemwidth = $columns > 0 ? floor(100/$columns) : 100;
	$float = is_rtl() ? 'right' : 'left';

	$selector = "gallery-{$instance}";

	$gallery_style = $gallery_div = '';
	if ( apply_filters( 'use_default_gallery_style', true ) )
		$gallery_style = "";
	$size_class = sanitize_html_class( $size );
	$gallery_div = "<div id='$selector' class='gallery gallery-id-{$id} gallery-type-image gallery-col{$columns} gallery-size-{$size_class} clear";
	if (!empty($class)) $gallery_div .= " ".$class;
	$gallery_div .= "'>";
	$output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );

	$i = 0;
	foreach ($attachments as $id => $attachment) {
		
		// Get media file link
		if (!empty($link) && 'file' === $link) {
			$image_thumb = wp_get_attachment_image($id, $size, false);
			$image_large = wp_get_attachment_image_src($id, 'extra-large');
			
			// Insert FancyBox gallery group attribute
			$image_output = '<a data-fancybox-group="'.$selector.'" href="'.$image_large[0].'">'.$image_thumb.'</a>';
			
		// Get image only
		} elseif (!empty($link) && 'none' === $link) {
			$image_output = wp_get_attachment_image($id, $size, false);
			
		// Get attachment page link
		} else {
			$image_output = wp_get_attachment_link($id, $size, true, false);
		}
		
		// Get image metadata
		$image_meta = wp_get_attachment_metadata($id);
		
		// Get orientation
		$orientation = '';
		if (isset($image_meta['height'], $image_meta['width']))
			$orientation = ($image_meta['height'] > $image_meta['width']) ? 'portrait' : 'landscape';
			
		// Set output
		$output .= "<{$itemtag} class='gallery-item'>";
		$output .= "
			<{$icontag} class='gallery-icon {$orientation}'>
				$image_output
			</{$icontag}>";
		if ( $captiontag && trim($attachment->post_excerpt) ) {
			$output .= "
				<{$captiontag} class='gallery-caption'>
					<div class='gallery-inner'>
						" . wptexturize($attachment->post_excerpt) . "
					</div>
				</{$captiontag}>";
		}
		$output .= "</{$itemtag}>";
		//if ( $columns > 0 && ++$i % $columns == 0 )
			//$output .= '<br style="clear: both" />';
	}
	$output .= "</div>\n";

	return $output;
}
add_shortcode('gallery', 'gallery_handler');

/**
 * Add hidden shortcodes
 */

/* Phone number
   ============================================================================ */
function phone_handler() {
	$tel = get_option('theme_options_tel');
	$output = '<a class="tel-link" href="tel:+'.$tel.'">'.$tel.'</a>';
	
	return $output;
}
add_shortcode('phone', 'phone_handler');

/* Email
   ============================================================================ */
function email_handler($atts) {
	extract(shortcode_atts(array(
		'subject' => '',
		'text' => '',
	), $atts));
	
	$email = get_option('theme_options_email');
	
	// Set output
	$output = '<a href="mailto:'.$email;
	if (!empty($subject)) $output .= '?subject='.$subject;
	$output .= '">';
	$output .= (!empty($text)) ? $text : $email;
	$output .= '</a>';
	
	return $output;
}
add_shortcode('email', 'email_handler');

/* Video
   ============================================================================ */
function video_handler($atts, $content = null) {
	extract(shortcode_atts(array(
		'class' => '',
	), $atts));
	
	// Set output
	$output = '<div class="video-wrap';
	if (!empty($class)) $output .= ' '.$class;
	$output .= '">'.do_shortcode($content).'</div>';
	
	return $output;
}
add_shortcode('video', 'video_handler');

/* Comments
   ============================================================================ */
function ob_comments() {
    ob_start();
    comments_template();
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}
function comments_handler() {
	return ob_comments();
}
add_shortcode('comments', 'comments_handler');

/**
 * Grid
 *
 * @attr int     $n     Grid number
 * @attr boolean $last  'yes' adds 'last' class
 * @attr string  $class Adds additional classes
 */
function grid_handler($atts, $content = null) {
	extract(shortcode_atts(array(
		'n' => '12',
		'last' => 'no',
		'class' => '',
	), $atts));
	
	// Set output
	$output  = '<div class="grid'.$n;
	if ($last == 'yes') $output .= ' last';
	if (!empty($class)) $output .= ' '.$class;
	$output .= '">'."\n";
	$output .= '    '.do_shortcode($content)."\n";
	$output .= '</div><!--grid'.$n.'-->';
	if ($last == 'yes') $output .= "\n".'<div class="clear"></div>';
	
	return $output;
}
add_shortcode('grid', 'grid_handler');

/**
 * Flexbox
 *
 * @attr int     $col 
 * @attr int     $style 
 * @attr boolean $flush 'yes' removes child padding
 * @attr string  $class Adds additional classes
 */
function flex_handler($atts, $content = null) {
	extract(shortcode_atts(array(
		'col' => '3',
		'style' => '1',
		'flush' => 'no',
		'class' => '',
	), $atts));
	
	// Set output
	$output  = '<div class="flex flex-col'.$col.' flex-style'.$style;
	if ($flush == 'yes') $output .= ' flex-flush';
	if (!empty($class)) $output .= ' '.$class;
	$output .= '">'."\n";
	$output .= '    '.do_shortcode($content)."\n";
	$output .= '</div><!--flex-->';
	
	return $output;
}
add_shortcode('flex', 'flex_handler');

/**
 * Flexbox Item
 *
 * @attr string $link  Adds anchor container and link
 * @attr string $class Adds additional classes
 */
function flex_item_handler($atts, $content = null) {
	extract(shortcode_atts(array(
		'link' => 'no',
		'class' => '',
	), $atts));
	
	// Set output
	$output  = '<div class="flex-item';
	if (!empty($class)) $output .= ' '.$class;
	$output .= '">'."\n";
	if (!empty($link)) $output .= '    <a href="'.$link.'">';
	$output .= '        '.do_shortcode($content)."\n";
	if (!empty($link)) $output .= '    </a>';
	$output .= '</div><!--flex-item-->';
	
	return $output;
}
add_shortcode('flex_item', 'flex_item_handler');

/**
 * Flexbox Gallery
 *
 * @attr int     $col 
 * @attr int     $style 
 * @attr string  $class Adds additional classes
 */
function flex_gallery_handler($atts, $content = null) {
	extract(shortcode_atts(array(
		'col' => '3',
		'style' => '1',
		'class' => '',
	), $atts));
	
	// Set output
	$output  = '<div class="flex-gallery flex-gallery-col'.$col.' flex-gallery-style'.$style;
	if (!empty($class)) $output .= ' '.$class;
	$output .= '">'."\n";
	$output .= '    '.do_shortcode($content)."\n";
	$output .= '</div><!--flex-gallery-->';
	
	return $output;
}
add_shortcode('flex_gallery', 'flex_gallery_handler');

/**
 * Flexbox Gallery Item
 *
 * @attr string $link  Adds anchor container and link
 * @attr string $class Adds additional classes
 */
function flex_gallery_item_handler($atts, $content = null) {
	extract(shortcode_atts(array(
		'link' => 'no',
		'class' => '',
	), $atts));
	
	// Set output
	$output  = '<div class="flex-gallery-item';
	if (!empty($class)) $output .= ' '.$class;
	$output .= '">'."\n";
	if (!empty($link)) $output .= '    <a href="'.$link.'">';
	$output .= '        '.do_shortcode($content)."\n";
	if (!empty($link)) $output .= '    </a>';
	$output .= '</div><!--flex-gallery-item-->';
	
	return $output;
}
add_shortcode('flex_gallery_item', 'flex_gallery_item_handler');

/**
 * Flexbox Gallery Caption
 *
 * @attr string $class Adds additional classes
 */
function flex_gallery_caption_handler($atts, $content = null) {
	extract(shortcode_atts(array(
		'class' => '',
	), $atts));
	
	// Set output
	$output  = '<div class="flex-gallery-caption';
	if (!empty($class)) $output .= ' '.$class;
	$output .= '">'."\n";
	$output .= '    <div class="flex-gallery-inner">';
	$output .= '        '.do_shortcode($content)."\n";
	$output .= '    </div><!--flex-gallery-inner-->';
	$output .= '</div><!--flex-gallery-caption-->';
	
	return $output;
}
add_shortcode('flex_gallery_caption', 'flex_gallery_caption_handler');

/* Map
   ============================================================================ */
function map_handler($atts, $content = null) {
	extract(shortcode_atts(array(
		'address' => '',
		'format' => '',
		'class' => '',
	), $atts));
	
	// Enqueue scripts
	wp_enqueue_script('google-maps-api', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyCEQCDOhKaJcwewWw_NU9Znku6FE2d26Ks', array('jquery'), null, true);
	wp_enqueue_script('google-maps-init', get_template_directory_uri().'/js/google-maps.js', array('google-maps-api'), null, true);
	
	// Set output
	if ($format == 'ribbon') {
		$output .= '                        </div><!--entry-content-->'."\n";
		$output .= '                    </article>'."\n";
		$output .= '                </section>'."\n";
		$output .= '            </div><!--inner-->'."\n";
		$output .= '        </div><!--wrap-->'."\n";
	}
	$output .= '        <div class="map';
	if (!empty($format)) $output .= ' map-'.$format;
	if (!empty($class)) $output .= ' '.$class;
	$output .= '">'."\n";
	$output .= '            <div id="map-canvas"';
	if (!empty($address)) $output .= ' data-address="'.$address.'"';
	$output .= '></div>'."\n";
	if (!empty($content)) $output .= '            <div class="map-caption">'.do_shortcode($content).'</div><!--map-caption-->'."\n";
	$output .= '        </div><!--map-->'."\n";
	
	if ($format == 'ribbon') {
		$output .= '        <div class="wrap">'."\n";
		$output .= '            <div class="inner clear">'."\n";
		$output .= '                <section class="body grid12">'."\n";
		$output .= '                    <article>'."\n";
		$output .= '                        <div class="entry-content">'."\n";
	}
	return $output;
}
add_shortcode('map', 'map_handler');

/**
 * Social
 *
 * @attr string $shape 'square', 'rounded', or 'circle'
 * @attr string $color Hex code (no #) adds inline background color
 * @attr string $class Adds additional classes
 */
function social_handler($atts) {
	extract(shortcode_atts(array(
		'shape' => 'square',
		'color' => '',
		'class' => '',
	), $atts));
	
	// Get URLs from Theme Options
	$facebook   = get_option('theme_options_facebook');
	$twitter    = get_option('theme_options_twitter');
	$googleplus = get_option('theme_options_googleplus');
	$youtube    = get_option('theme_options_youtube');
	$linkedin   = get_option('theme_options_linkedin');
	$pinterest  = get_option('theme_options_pinterest');
	$tumblr     = get_option('theme_options_tumblr');
	$rss        = get_option('theme_options_rss');
	
	// If color set, create display variable
	if (!empty($color))
		$style_attr = ' style="background:#'.$color.';"';
	
	// Set output
	$output .= '<aside class="widget widget_social">';
	$output .= '<ul class="social-'.$shape;
	if (!empty($class)) $output .= ' '.$class;
	$output .= '">';
	if (!empty($facebook))   $output .= '<li><a class="icon icon-facebook" href="'.$facebook.'" title="Facebook" target="_blank"'.$style_attr.'>Facebook</a></li>';
	if (!empty($twitter))    $output .= '<li><a class="icon icon-twitter" href="'.$twitter.'" title="Twitter" target="_blank"'.$style_attr.'>Twitter</a></li>';
	if (!empty($googleplus)) $output .= '<li><a class="icon icon-google-plus" href="'.$googleplus.'" title="Google+" target="_blank"'.$style_attr.'>Google+</a></li>';
	if (!empty($youtube))    $output .= '<li><a class="icon icon-youtube3" href="'.$youtube.'" title="YouTube" target="_blank"'.$style_attr.'>YouTube</a></li>';
	if (!empty($linkedin))   $output .= '<li><a class="icon icon-linkedin" href="'.$linkedin.'" title="LinkedIn" target="_blank"'.$style_attr.'>LinkedIn</a></li>';
	if (!empty($pinterest))  $output .= '<li><a class="icon icon-pinterest3" href="'.$pinterest.'" title="Pinterest" target="_blank"'.$style_attr.'>Pinterest</a></li>';
	if (!empty($tumblr))     $output .= '<li><a class="icon icon-tumblr" href="'.$tumblr.'" title="Tumblr" target="_blank"'.$style_attr.'>Tumblr</a></li>';
	if (!empty($rss))        $output .= '<li><a class="icon icon-rss" href="'.$rss.'" title="RSS" target="_blank"'.$style_attr.'>RSS</a></li>';
	$output .= '</ul>';
	$output .= '</aside>';
	
	return $output;
}
add_shortcode('social', 'social_handler');

/**
 * Nav
 *
 * @attr string $location Theme location
 * @attr string $class    Adds additional classes
 */
function nav_handler($atts) {
	extract(shortcode_atts(array(
		'location' => '',
		'class' => '',
	), $atts));
	
	// Set output
	if (has_nav_menu($location)) {
		
		$output .= '<nav id="'.$location.'nav">';
		
		$args = array(
			'echo' => false,
			'theme_location' => $location,
			'container_class' => 'menu',
			'menu_class' => $class,
		);
		$output .= wp_nav_menu($args);
		
		$output .= '</nav>';
	}
	
	return $output;
}
add_shortcode('nav', 'nav_handler');

/**
 * Subnav
 *
 * @attr string $class Adds additional classes
 */
function subnav_handler($atts) {
	extract(shortcode_atts(array(
		'depth' => 0,
		'class' => '',
	), $atts));
	
	// Get post data
	$post = get_post();
	
	// Get first ancestor
	$ancestor = array_reverse(get_post_ancestors($post->ID));
	
	// If top-level, use post ID instead
	$root = ($ancestor) ? $ancestor[0] : $post->ID;
	
	// Get children
	$children = get_pages('child_of='.$post->ID);
	
	// If page has children or parent, display subnav
	if ($children || $post->post_parent) {
		
		// Set output
		$output .= '<nav id="subnav" class="widget';
		if (!empty($class)) $output .= ' '.$class;
		$output .= '">'."\n";
		$output .= '    <h3>'.get_the_title($root).'</h3>'."\n";
		$output .= '    <ul>'."\n";
		
		$args = array(
			'echo' => false,
			'title_li' => '',
			'sort_column' => 'menu_order, post_name',
			'child_of' => $root,
			'depth' => $depth,
		);
		$output .= wp_list_pages($args);
		
		$output .= '    </ul>'."\n";
		$output .= '</nav><!--subnav-->';
	}
	
	return $output;
}
add_shortcode('subnav', 'subnav_handler');

/**
 * Global Areas
 *
 * @attr id     $int
 * @attr string $class Adds additional classes
 */
function global_handler($atts) {
	extract(shortcode_atts(array(
		'id' => '',
		'class' => '',
	), $atts));
	
	// Get data from Theme Options
	$global = get_option('theme_options_global'.$id);
	
	if (!empty($global)) {
		
		// Set output
		$output .= apply_filters('the_content', $global);
	}
	
	return $output;
}
add_shortcode('global', 'global_handler');

/**
 * Add user shortcodes
 */

/**
 * Button
 *
 * @attr int    $style 
 * @attr string $link     Adds anchor container and link
 * @attr string $external 'yes' adds target="_blank"
 * @attr string $class    Adds additional classes
 */
function button_handler($atts, $content = null) {
	extract(shortcode_atts(array(
		'style'    => '1',
		'link'     => '',
		'external' => 'no',
		'class' => '',
	), $atts));
	
	// Open container
	if (!empty($link)) {
		$output .= '<a href="'.$link.'"';
		if ($external == 'yes') $output .= ' target="_blank"';
	} else {
		$output .= '<div';
	}
	
	// Set output
	$output .= ' class="btn btn-arrow';
	$output .= ' style'.$style;
	if (!empty($class)) $output .= ' '.$class;
	$output .= '">'.do_shortcode($content).'<span class="icon icon-after icon-chevron-right2"></span>';
	
	// Close container
	if (!empty($link)) {
		$output .= '</a>';
	} else {
		$output .= '</div>';
	}
	
	return $output;
}
add_shortcode('button', 'button_handler');

/**
 * Box
 *
 * @attr int    $style 
 * @attr string $link  Adds anchor container and link
 * @attr string $class Adds additional classes
 */
function box_handler($atts, $content = null) {
	extract(shortcode_atts(array(
		'style' => '1',
		'link' => '',
		'class' => '',
	), $atts));
	
	// Open container
	if (!empty($link)) {
		$output .= '<a href="'.$link.'" class="a-wrap box';
	} else {
		$output .= '<div class="box';
	}
	$output .= ' style'.$style;
	if (!empty($class)) $output .= ' '.$class;
	$output .= '">'."\n";
	$output .= '    '.do_shortcode($content)."\n";
	
	// Close container
	if (!empty($link)) {
		$output .= '</a><!--box-->';
	} else {
		$output .= '</div><!--box-->';
	}
	
	return $output;
}
add_shortcode('box', 'box_handler');

/**
 * Ribbon
 *
 * @attr int     $style   
 * @attr boolean $flush   'no' adds child wrap/inner
 * @attr boolean $stretch 'yes' adds stretch class (content cannot be flush to edge)
 *                        'no' closes/opens parent containers (cannot be used first, last, or next to another ribbon)
 * @attr string  $link    Adds anchor container and link
 * @attr string  $class   Adds additional classes
 * @attr string  $id      Adds ID
 *
 * @example flush no, stretch yes = Default, stretched ribbon with child wrap/inner
 * @example flush yes, stretch no = Closes/opens parent containers, no child wrap/inner
 * @example flush no, stretch no = Closes/opens parent containers, adds child wrap/inner
 * @example flush yes, stretch yes = Do not use: All content disappears off page
 */
function ribbon_handler($atts, $content = null) {
	extract(shortcode_atts(array(
		'style' => '1',
		'flush' => 'no',
		'stretch' => 'yes',
		'link' => '',
		'class' => '',
		'id' => '',
	), $atts));
	
	// Close parent containers
	if ($stretch != 'yes') {
		$output  = '                        </div><!--entry-content-->'."\n";
		$output .= '                    </article>'."\n";
		$output .= '                </section>'."\n";
		$output .= '            </div><!--inner-->'."\n";
		$output .= '        </div><!--wrap-->'."\n";
	}
	
	// Open container
	if (!empty($link)) {
		$output .= '        <a href="'.$link.'" class="a-wrap ribbon';
	} else {
		$output .= '        <div class="ribbon';
	}
	$output .= ' ribbon-style'.$style;
	if ($stretch == 'yes') $output .= ' ribbon-stretch';
	if (!empty($class)) $output .= ' '.$class;
	$output .= '"';
	if (!empty($id)) $output .= ' id="'.$id.'"';
	$output .= '>'."\n";
	if ($flush == 'no') $output .= '            <div class="wrap">'."\n";
	if ($flush == 'no') $output .= '                <div class="inner clear">'."\n";
	$output .= '                    '.do_shortcode($content)."\n";
	if ($flush == 'no') $output .= '                </div><!--inner-->'."\n";
	if ($flush == 'no') $output .= '            </div><!--wrap-->'."\n";
	
	// Close container
	if (!empty($link)) {
		$output .= '        </a><!--ribbon-->'."\n";
	} else {
		$output .= '        </div><!--ribbon-->'."\n";
	}
	
	// Reopen parent containers
	if ($stretch != 'yes') {
		$output .= '        <div class="wrap">'."\n";
		$output .= '            <div class="inner clear">'."\n";
		$output .= '                <section class="body grid12">'."\n";
		$output .= '                    <article>'."\n";
		$output .= '                        <div class="entry-content">'."\n";
	}
	
	return $output;
}
add_shortcode('ribbon', 'ribbon_handler');

/* Tabs
   ============================================================================ */
function tabs_handler($atts, $content) {
	$GLOBALS['tab_count'] = 0;
	do_shortcode($content);
	
	// Set output
	if (is_array($GLOBALS['tabs'])) {
		foreach ($GLOBALS['tabs'] as $key => $tab) {
			
			// Set first tab to current
			$class = ($key == 0) ? ' class="current"' : '';
			
			// Create content arrays
			$tabs[]  = '<li><a href="#"'.$class.'>'.$tab['title'].'</a></li>';
			$panes[] = '<div>'.$tab['content'].'</div>';
		}
		$output  = '<div class="tabs">'."\n";
		$output .= '    <nav>'."\n";
		$output .= '        <ul>'."\n";
		$output .= implode("\n", $tabs)."\n";
		$output .= '        </ul>'."\n";
		$output .= '    </nav>'."\n";
		$output .= implode("\n", $panes)."\n";
		$output .= '</div><!--tabs-->';
	}
	return $output;
}
add_shortcode('tabs', 'tabs_handler');

function tab_handler($atts, $content) {
	extract(shortcode_atts(array(
		'title' => ''
	), $atts));

	// Set output
	$x = $GLOBALS['tab_count'];
	$GLOBALS['tabs'][$x] = array(
		'title' => $title,
		'content' => do_shortcode($content)
	);
	$GLOBALS['tab_count']++;
}
add_shortcode('tab', 'tab_handler');

/* Accordion
   ============================================================================ */
function accordion_handler($atts, $content) {
	
	// Resets
	$GLOBALS['pane_count'] = 0;
	unset($GLOBALS['panes']);
	
	// Get pane content
	do_shortcode($content);
	
	// Set output
	if (is_array($GLOBALS['panes'])) {
		foreach ($GLOBALS['panes'] as $key => $pane) {
			
			// Set classes
			$class_a = ($pane['open'] == 'yes') ? ' class="current icon icon-minus6"' : ' class="icon icon-plus5"';
			$class_div = ($pane['open'] == 'yes') ? ' class="open"' : '';
			
			// Create content array
			$panes[$key]  = '<h3><a href="#"'.$class_a.'>'.$pane['title'].'</a></h3>'."\n";
			$panes[$key] .= '<div'.$class_div.'>'.$pane['content'].'</div>';
		}
		$output  = '<div class="accordion">'."\n";
		$output .= implode("\n", $panes)."\n";
		$output .= '</div><!--accordion-->';
	}
	return $output;
}
add_shortcode('accordion', 'accordion_handler');

function pane_handler($atts, $content) {
	extract(shortcode_atts(array(
		'title' => '&nbsp;',
		'open' => '',
	), $atts));
	
	// Set output
	$x = $GLOBALS['pane_count'];
	$GLOBALS['panes'][$x] = array(
		'title' => $title,
		'open' => $open,
		'content' => do_shortcode($content)
	);
	$GLOBALS['pane_count']++;
}
add_shortcode('pane', 'pane_handler');

/* Divider
   ============================================================================ */
function divider_handler($atts) {
	extract(shortcode_atts(array(
		'class' => '',
	), $atts));
	
	// Set output
	$output = '<hr';
	if (!empty($class)) $output .= ' class="'.$class.'"';
	$output .= ' />';
	
	return $output;
}
add_shortcode('divider', 'divider_handler');

/**
 * Icon
 *
 * @attr string  $shape  See Shortcodes page for shapes
 * @attr string  $format 'solo' Adds icon wrap container
 *                       'inline' Adds inline class
 * @attr int     $style  Adds style class to solo format
 * @attr boolean $after  'yes' places icon after content
 * @attr string  $class  Adds additional classes
 */
function icon_handler($atts, $content = null) {
	extract(shortcode_atts(array(
		'shape' => 'flash2',
		'format' => '',
		'style' => '1',
		'after' => '',
		'class' => '',
	), $atts));
	
	// Open container
	if ($format == 'solo') {
		$output .= '<div class="icon-wrap';
		$output .= ' icon-style'.$style;
		if (!empty($class)) $output .= ' '.$class;
		$output .= '">';
	} else {
		$output .= '<p>';
	}
	
	// Show content before icon
	if ($after == 'yes' && $format != 'solo') $output .= do_shortcode($content);
	
	// Icon
	$output .= '<span class="icon icon-'.$shape;
	if ($format == 'inline') $output .= ' icon-inline';
	if ($after == 'yes') $output .= ' icon-after';
	if (!empty($class) && $format !='solo') $output .= ' '.$class;
	$output .= '"></span>';
	
	// Show content after icon
	if ($after != 'yes' && $format != 'solo') $output .= do_shortcode($content);
	
	// Close container
	if ($format == 'solo') {
		$output .= '</div>';
	} else {
		$output .= '</p>';
	}
	
	return $output;
}
add_shortcode('icon', 'icon_handler');

/* 2 columns
   ============================================================================ */
function column2_handler($atts, $content = null) {
	extract(shortcode_atts(array(
		'last'  => 'no',
		'class' => '',
	), $atts));
	
	// Set output
	$output  = '<div class="grid6';
	if ($last == 'yes') $output .= ' last';
	if (!empty($class)) $output .= ' '.$class;
	$output .= '">'."\n";
	$output .= '    '.do_shortcode($content)."\n";
	$output .= '</div><!--grid6-->';
	if ($last == 'yes') $output .= "\n".'<div class="clear"></div>';
	
	return $output;
}
add_shortcode('column2', 'column2_handler');

/* 3 columns
   ============================================================================ */
function column3_handler($atts, $content = null) {
	extract(shortcode_atts(array(
		'last'  => 'no',
		'class' => '',
	), $atts));
	
	// Set output
	$output  = '<div class="grid4';
	if ($last == 'yes') $output .= ' last';
	if (!empty($class)) $output .= ' '.$class;
	$output .= '">'."\n";
	$output .= '    '.do_shortcode($content)."\n";
	$output .= '</div><!--grid4-->';
	if ($last == 'yes') $output .= "\n".'<div class="clear"></div>';
	
	return $output;
}
add_shortcode('column3', 'column3_handler');

/* 4 columns
   ============================================================================ */
function column4_handler($atts, $content = null) {
	extract(shortcode_atts(array(
		'last' => 'no',
		'class' => '',
	), $atts));
	
	// Set output
	$output  = '<div class="grid3';
	if ($last == 'yes') $output .= ' last';
	if (!empty($class)) $output .= ' '.$class;
	$output .= '">'."\n";
	$output .= '    '.do_shortcode($content)."\n";
	$output .= '</div><!--grid3-->';
	if ($last == 'yes') $output .= "\n".'<div class="clear"></div>';
	
	return $output;
}
add_shortcode('column4', 'column4_handler');

/**
 * Add shortcodes to TinyMCE
 */
function add_button() {
	if (current_user_can('edit_posts') && current_user_can('edit_pages')) {
		add_filter('mce_external_plugins', 'add_plugin');
		add_filter('mce_buttons_3', 'register_button');
	}
}
add_action('init', 'add_button');

// Register buttons
function register_button($buttons) {
	array_push($buttons, 'button1,button2,box1,box2,ribbon,tabs,accordion,divider,icon,column2,column3,column4');
	
	return $buttons;
}

// Register TinyMCE plugin
function add_plugin($plugin_array) {
	$plugin_array['button1']   = get_bloginfo('template_url').'/js/tinymce.js';
	$plugin_array['button2']   = get_bloginfo('template_url').'/js/tinymce.js';
	$plugin_array['box1']      = get_bloginfo('template_url').'/js/tinymce.js';
	$plugin_array['box2']      = get_bloginfo('template_url').'/js/tinymce.js';
	$plugin_array['ribbon']    = get_bloginfo('template_url').'/js/tinymce.js';
	$plugin_array['tabs']      = get_bloginfo('template_url').'/js/tinymce.js';
	$plugin_array['accordion'] = get_bloginfo('template_url').'/js/tinymce.js';
	$plugin_array['divider']   = get_bloginfo('template_url').'/js/tinymce.js';
	$plugin_array['icon']      = get_bloginfo('template_url').'/js/tinymce.js';
	$plugin_array['column2']   = get_bloginfo('template_url').'/js/tinymce.js';
	$plugin_array['column3']   = get_bloginfo('template_url').'/js/tinymce.js';
	$plugin_array['column4']   = get_bloginfo('template_url').'/js/tinymce.js';
	
	return $plugin_array;
}

/**
 * Clean shortcodes
 */
function clean_shortcodes($content){
    $array = array (
        '<p>[' => '[',
        ']</p>' => ']',
        ']<br />' => ']'
    );
    $content = strtr($content, $array);
    
	return $content;
}
add_filter('the_content', 'clean_shortcodes');

/**
 * Process shortcodes in widgets
 */
add_filter('widget_text', 'do_shortcode');

?>