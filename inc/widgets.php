<?php
/**
 * Widgets
 *
 * @package WordPress
 * @subpackage Sparkler
 * @since Sparkler 1.0
 */

/**
 * Social Media widget class
 */
class Widget_Social extends WP_Widget {

	/**
	 * Register
	 */
	public function __construct() {
		parent::__construct(
	 		'social',
			'Social Media',
			array(
				'description' => __('Add icons linked to your social media platforms. Add URLs on Theme Options screen.', 'sparkler'),
			)
		);
	}

	/**
	 * Frontend
	 */
	public function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$shape = $instance['shape'];
		$color = $instance['color'];
		
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
		
		// Display widget
		echo $before_widget;
		if (!empty($title)) echo '<h3>'.$title.'</h3>';
		echo '<ul class="social-'.$shape.'">';
		if (!empty($facebook))   echo '<li><a class="icon icon-facebook" href="'.$facebook.'" title="Facebook" target="_blank"'.$style_attr.'>Facebook</a></li>';
		if (!empty($twitter))    echo '<li><a class="icon icon-twitter" href="'.$twitter.'" title="Twitter" target="_blank"'.$style_attr.'>Twitter</a></li>';
		if (!empty($googleplus)) echo '<li><a class="icon icon-google-plus" href="'.$googleplus.'" title="Google+" target="_blank"'.$style_attr.'>Google+</a></li>';
		if (!empty($youtube))    echo '<li><a class="icon icon-youtube3" href="'.$youtube.'" title="YouTube" target="_blank"'.$style_attr.'>YouTube</a></li>';
		if (!empty($linkedin))   echo '<li><a class="icon icon-linkedin" href="'.$linkedin.'" title="LinkedIn" target="_blank"'.$style_attr.'>LinkedIn</a></li>';
		if (!empty($pinterest))  echo '<li><a class="icon icon-pinterest3" href="'.$pinterest.'" title="Pinterest" target="_blank"'.$style_attr.'>Pinterest</a></li>';
		if (!empty($tumblr))     echo '<li><a class="icon icon-tumblr" href="'.$tumblr.'" title="Tumblr" target="_blank"'.$style_attr.'>Tumblr</a></li>';
		if (!empty($rss))        echo '<li><a class="icon icon-rss" href="'.$rss.'" title="RSS" target="_blank"'.$style_attr.'>RSS</a></li>';
		echo '</ul>';
		echo $after_widget;
	}

	/**
	 * Sanitize
	 */
	public function update($new_instance, $old_instance) {
		$instance = array();
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['color'] = strip_tags($new_instance['color']);

		// Shape default
		if (in_array($new_instance['shape'], array('square', 'rounded', 'circle'))) {
			$instance['shape'] = $new_instance['shape'];
		} else {
			$instance['shape'] = 'square';
		}
		
		return $instance;
	}

	/**
	 * Backend
	 */
	public function form($instance) {
		$title = esc_attr($instance['title']);
		$color = esc_attr($instance['color']);
?>
		<p>
		    <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
		    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
		    <label for="<?php echo $this->get_field_id('color'); ?>"><?php _e('Background Color:'); ?></label>
		    <input class="widefat" id="<?php echo $this->get_field_id('color'); ?>" name="<?php echo $this->get_field_name('color'); ?>" type="text" value="<?php echo esc_attr($color); ?>" placeholder="000000" maxlength="6" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('shape'); ?>"><?php _e('Shape:'); ?></label>
            <select name="<?php echo $this->get_field_name('shape'); ?>" id="<?php echo $this->get_field_id('shape'); ?>" class="widefat">
                <option value="square"<?php selected($instance['shape'], 'square'); ?>><?php _e('Square'); ?></option>
                <option value="rounded"<?php selected($instance['shape'], 'rounded'); ?>><?php _e('Rounded'); ?></option>
                <option value="circle"<?php selected($instance['shape'], 'circle'); ?>><?php _e('Circle'); ?></option>
            </select>
		</p>
<?php 
	}
}

/**
 * Button widget class
 */
class Widget_Button extends WP_Widget {

	/**
	 * Register
	 */
	public function __construct() {
		parent::__construct(
	 		'btn',
			'Button',
			array(
				'description' => __('Use this widget to call attention to specific areas of your site.', 'sparkler'),
			)
		);
	}

	/**
	 * Frontend
	 */
	public function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$des   = $instance['des'];
		$targ  = $instance['targ'];
		$link  = $instance['link'];
		$style = $instance['style'];

		echo $before_widget;
		echo '<a href="'.$link.'" class="btn '.$style.'"';
		if ($targ == 'yes') echo ' target="_blank"';
		echo '>';
		if (!empty($title)) echo '<h2>'.$title.' <span class="icon icon-after icon-chevron-right2"></span></h2>';
		if (!empty($des))   echo '<p>'.$des.'</p>';
		echo '</a>';
		echo $after_widget;
	}

	/**
	 * Sanitize
	 */
	public function update($new_instance, $old_instance) {
		$instance = array();
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['des']   = strip_tags($new_instance['des']);
		$instance['link']  = strip_tags($new_instance['link']);
		
		// Target default
		if (in_array($new_instance['targ'], array('no', 'yes'))) {
			$instance['targ'] = $new_instance['targ'];
		} else {
			$instance['targ'] = 'no';
		}
		
		// Style default
		if (in_array($new_instance['style'], array('style1', 'style2'))) {
			$instance['style'] = $new_instance['style'];
		} else {
			$instance['style'] = 'style1';
		}

		return $instance;
	}

	/**
	 * Backend
	 */
	public function form($instance) {
		$title = (isset($instance['title'])) ? $instance['title'] : __('Title', 'text_domain');
		$des   = (isset($instance['des'])) ? $instance['des'] : __('Description', 'text_domain');
		$link  = esc_attr($instance['link']);
?>
		<p>
		    <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
		    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('des'); ?>"><?php _e('Description:'); ?></label> 
		    <input class="widefat" id="<?php echo $this->get_field_id('des'); ?>" name="<?php echo $this->get_field_name('des'); ?>" type="text" value="<?php echo esc_attr($des); ?>" />
		</p>
        <p>
            <label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Link:'); ?></label> 
		    <input class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo esc_attr($link); ?>" />
		</p>
        <p>
            <label for="<?php echo $this->get_field_id('targ'); ?>"><?php _e('Open page in a new window?'); ?></label>
            <select name="<?php echo $this->get_field_name('targ'); ?>" id="<?php echo $this->get_field_id('targ'); ?>" class="widefat">
                <option value="no"<?php selected($instance['targ'], 'no'); ?>><?php _e('No'); ?></option>
                <option value="yes"<?php selected($instance['targ'], 'yes'); ?>><?php _e('Yes'); ?></option>
            </select>
		</p>
        <p>
            <label for="<?php echo $this->get_field_id('style'); ?>"><?php _e('Style:'); ?></label>
            <select name="<?php echo $this->get_field_name('style'); ?>" id="<?php echo $this->get_field_id('style'); ?>" class="widefat">
                <option value="style1"<?php selected($instance['style'], 'style1'); ?>><?php _e('Style 1'); ?></option>
                <option value="style2"<?php selected($instance['style'], 'style2'); ?>><?php _e('Style 2'); ?></option>
            </select>
		</p>
<?php
	}
}

?>