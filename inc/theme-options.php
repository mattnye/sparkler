<?php
/**
 * Theme Options
 *
 * @package WordPress
 * @subpackage Sparkler
 * @since Sparkler 1.0
 */

/**
 * Add Theme Options to admin menu
 */
function register_theme_options() {
	add_submenu_page(
		'themes.php',
		'Theme Options',
		'Theme Options',
		'manage_categories',
		'new-theme-options',
		'callback_theme_options'
	);
}
add_action('admin_menu', 'register_theme_options');

/**
 * Display page content
 */
function callback_theme_options() {
	if (isset($_POST['update'])) {
		
		// Remove magic quotes
		$_POST = array_map('stripslashes_deep', $_POST);
		
		// Set variables from post
		$org_type = esc_attr($_POST['org-type']);
		$name     = esc_attr($_POST['name']);
		$url      = esc_attr($_POST['url']);
		$addr     = esc_attr($_POST['addr']);
		$po       = esc_attr($_POST['po']);
		$city     = esc_attr($_POST['city']);
		$state    = esc_attr($_POST['state']);
		$zip      = esc_attr($_POST['zip']);
		$country  = esc_attr($_POST['country']);
		$tel      = esc_attr($_POST['tel']);
		$fax      = esc_attr($_POST['fax']);
		$email    = esc_attr($_POST['email']);
		$hours    = esc_attr($_POST['hours']);
		$map      = esc_attr($_POST['map']);
		
		$org_type2 = esc_attr($_POST['org-type2']);
		$name2     = esc_attr($_POST['name2']);
		$url2      = esc_attr($_POST['url2']);
		$addr2     = esc_attr($_POST['addr2']);
		$po2       = esc_attr($_POST['po2']);
		$city2     = esc_attr($_POST['city2']);
		$state2    = esc_attr($_POST['state2']);
		$zip2      = esc_attr($_POST['zip2']);
		$country2  = esc_attr($_POST['country2']);
		$tel2      = esc_attr($_POST['tel2']);
		$fax2      = esc_attr($_POST['fax2']);
		$email2    = esc_attr($_POST['email2']);
		$hours2    = esc_attr($_POST['hours2']);
		$map2      = esc_attr($_POST['map2']);
		
		$org_type3 = esc_attr($_POST['org-type3']);
		$name3     = esc_attr($_POST['name3']);
		$url3      = esc_attr($_POST['url3']);
		$addr3     = esc_attr($_POST['addr3']);
		$po3       = esc_attr($_POST['po3']);
		$city3     = esc_attr($_POST['city3']);
		$state3    = esc_attr($_POST['state3']);
		$zip3      = esc_attr($_POST['zip3']);
		$country3  = esc_attr($_POST['country3']);
		$tel3      = esc_attr($_POST['tel3']);
		$fax3      = esc_attr($_POST['fax3']);
		$email3    = esc_attr($_POST['email3']);
		$hours3    = esc_attr($_POST['hours3']);
		$map3      = esc_attr($_POST['map3']);
		
		$logo_src = esc_attr($_POST['logo-src']);
		$logo_alt = esc_attr($_POST['logo-alt']);
		$global1  = $_POST['global1'];
		$global2  = $_POST['global2'];
		$global3  = $_POST['global3'];
		
		$facebook   = esc_attr($_POST['facebook']);
		$twitter    = esc_attr($_POST['twitter']);
		$googleplus = esc_attr($_POST['googleplus']);
		$youtube    = esc_attr($_POST['youtube']);
		$linkedin   = esc_attr($_POST['linkedin']);
		$pinterest  = esc_attr($_POST['pinterest']);
		$tumblr     = esc_attr($_POST['tumblr']);
		$rss        = esc_attr($_POST['rss']);
		
		$slide_one_caption = $_POST['slide_one_caption'];
		$slide1_style = esc_attr($_POST['slide1-style']);
		$slide1_link  = esc_attr($_POST['slide1-link']);
		$slide1_src   = esc_attr($_POST['slide1-src']);
		$slide1_alt   = esc_attr($_POST['slide1-alt']);
		
		$slide_two_caption = $_POST['slide_two_caption'];
		$slide2_style = esc_attr($_POST['slide2-style']);
		$slide2_link  = esc_attr($_POST['slide2-link']);
		$slide2_src   = esc_attr($_POST['slide2-src']);
		$slide2_alt   = esc_attr($_POST['slide2-alt']);
		
		$slide_three_caption = $_POST['slide_three_caption'];
		$slide3_style = esc_attr($_POST['slide3-style']);
		$slide3_link  = esc_attr($_POST['slide3-link']);
		$slide3_src   = esc_attr($_POST['slide3-src']);
		$slide3_alt   = esc_attr($_POST['slide3-alt']);
		
		$slide_four_caption = $_POST['slide_four_caption'];
		$slide4_style = esc_attr($_POST['slide4-style']);
		$slide4_link  = esc_attr($_POST['slide4-link']);
		$slide4_src   = esc_attr($_POST['slide4-src']);
		$slide4_alt   = esc_attr($_POST['slide4-alt']);
		
		$slide_five_caption = $_POST['slide_five_caption'];
		$slide5_style = esc_attr($_POST['slide5-style']);
		$slide5_link  = esc_attr($_POST['slide5-link']);
		$slide5_src   = esc_attr($_POST['slide5-src']);
		$slide5_alt   = esc_attr($_POST['slide5-alt']);
		
		$footer = $_POST['footer'];
		
		// Save options
		update_option('theme_options_org_type', $org_type);
		update_option('theme_options_name', $name);
		update_option('theme_options_url', $url);
		update_option('theme_options_addr', $addr);
		update_option('theme_options_po', $po);
		update_option('theme_options_city', $city);
		update_option('theme_options_state', $state);
		update_option('theme_options_zip', $zip);
		update_option('theme_options_country', $country);
		update_option('theme_options_tel', $tel);
		update_option('theme_options_fax', $fax);
		update_option('theme_options_email', $email);
		update_option('theme_options_hours', $hours);
		update_option('theme_options_map', $map);
		
		update_option('theme_options_org_type2', $org_type2);
		update_option('theme_options_name2', $name2);
		update_option('theme_options_url2', $url2);
		update_option('theme_options_addr2', $addr2);
		update_option('theme_options_po2', $po2);
		update_option('theme_options_city2', $city2);
		update_option('theme_options_state2', $state2);
		update_option('theme_options_zip2', $zip2);
		update_option('theme_options_country2', $country2);
		update_option('theme_options_tel2', $tel2);
		update_option('theme_options_fax2', $fax2);
		update_option('theme_options_email2', $email2);
		update_option('theme_options_hours2', $hours2);
		update_option('theme_options_map2', $map2);
		
		update_option('theme_options_org_type3', $org_type3);
		update_option('theme_options_name3', $name3);
		update_option('theme_options_url3', $url3);
		update_option('theme_options_addr3', $addr3);
		update_option('theme_options_po3', $po3);
		update_option('theme_options_city3', $city3);
		update_option('theme_options_state3', $state3);
		update_option('theme_options_zip3', $zip3);
		update_option('theme_options_country3', $country3);
		update_option('theme_options_tel3', $tel3);
		update_option('theme_options_fax3', $fax3);
		update_option('theme_options_email3', $email3);
		update_option('theme_options_hours3', $hours3);
		update_option('theme_options_map3', $map3);
		
		update_option('theme_options_logo_src', $logo_src);
		update_option('theme_options_logo_alt', $logo_alt);
		update_option('theme_options_global1', $global1);
		update_option('theme_options_global2', $global2);
		update_option('theme_options_global3', $global3);
		
		update_option('theme_options_facebook', $facebook);
		update_option('theme_options_twitter', $twitter);
		update_option('theme_options_googleplus', $googleplus);
		update_option('theme_options_youtube', $youtube);
		update_option('theme_options_linkedin', $linkedin);
		update_option('theme_options_pinterest', $pinterest);
		update_option('theme_options_tumblr', $tumblr);
		update_option('theme_options_rss', $rss);
		
		update_option('theme_options_slide_one_caption', $slide_one_caption);
		update_option('theme_options_slide1_style', $slide1_style);
		update_option('theme_options_slide1_link', $slide1_link);
		update_option('theme_options_slide1_src', $slide1_src);
		update_option('theme_options_slide1_alt', $slide1_alt);
				
		update_option('theme_options_slide_two_caption', $slide_two_caption);
		update_option('theme_options_slide2_style', $slide2_style);
		update_option('theme_options_slide2_link', $slide2_link);
		update_option('theme_options_slide2_src', $slide2_src);
		update_option('theme_options_slide2_alt', $slide2_alt);
				
		update_option('theme_options_slide_three_caption', $slide_three_caption);
		update_option('theme_options_slide3_style', $slide3_style);
		update_option('theme_options_slide3_link', $slide3_link);
		update_option('theme_options_slide3_src', $slide3_src);
		update_option('theme_options_slide3_alt', $slide3_alt);
				
		update_option('theme_options_slide_four_caption', $slide_four_caption);
		update_option('theme_options_slide4_style', $slide4_style);
		update_option('theme_options_slide4_link', $slide4_link);
		update_option('theme_options_slide4_src', $slide4_src);
		update_option('theme_options_slide4_alt', $slide4_alt);
				
		update_option('theme_options_slide_five_caption', $slide_five_caption);
		update_option('theme_options_slide5_style', $slide5_style);
		update_option('theme_options_slide5_link', $slide5_link);
		update_option('theme_options_slide5_src', $slide5_src);
		update_option('theme_options_slide5_alt', $slide5_alt);
		
		update_option('theme_options_footer', $footer);
				
		// Display message
		echo '<div id="message" class="updated"><p><strong>Settings saved.</strong></p></div>';
		
	} else {
		
		// Set variables from database
		$org_type = get_option('theme_options_org_type');
		$name     = get_option('theme_options_name');
		$url      = get_option('theme_options_url');
		$addr     = get_option('theme_options_addr');
		$po       = get_option('theme_options_po');
		$city     = get_option('theme_options_city');
		$state    = get_option('theme_options_state');
		$zip      = get_option('theme_options_zip');
		$country  = get_option('theme_options_country');
		$tel      = get_option('theme_options_tel');
		$fax      = get_option('theme_options_fax');
		$email    = get_option('theme_options_email');
		$hours    = get_option('theme_options_hours');
		$map      = get_option('theme_options_map');
		
		$org_type2 = get_option('theme_options_org_type2');
		$name2     = get_option('theme_options_name2');
		$url2      = get_option('theme_options_url2');
		$addr2     = get_option('theme_options_addr2');
		$po2       = get_option('theme_options_po2');
		$city2     = get_option('theme_options_city2');
		$state2    = get_option('theme_options_state2');
		$zip2      = get_option('theme_options_zip2');
		$country2  = get_option('theme_options_country2');
		$tel2      = get_option('theme_options_tel2');
		$fax2      = get_option('theme_options_fax2');
		$email2    = get_option('theme_options_email2');
		$hours2    = get_option('theme_options_hours2');
		$map2      = get_option('theme_options_map2');
		
		$org_type3 = get_option('theme_options_org_type3');
		$name3     = get_option('theme_options_name3');
		$url3      = get_option('theme_options_url3');
		$addr3     = get_option('theme_options_addr3');
		$po3       = get_option('theme_options_po3');
		$city3     = get_option('theme_options_city3');
		$state3    = get_option('theme_options_state3');
		$zip3      = get_option('theme_options_zip3');
		$country3  = get_option('theme_options_country3');
		$tel3      = get_option('theme_options_tel3');
		$fax3      = get_option('theme_options_fax3');
		$email3    = get_option('theme_options_email3');
		$hours3    = get_option('theme_options_hours3');
		$map3      = get_option('theme_options_map3');
		
		$logo_src = get_option('theme_options_logo_src');
		$logo_alt = get_option('theme_options_logo_alt');
		$global1 = get_option('theme_options_global1');
		$global2 = get_option('theme_options_global2');
		$global3 = get_option('theme_options_global3');
		
		$facebook   = get_option('theme_options_facebook');
		$twitter    = get_option('theme_options_twitter');
		$googleplus = get_option('theme_options_googleplus');
		$youtube    = get_option('theme_options_youtube');
		$linkedin   = get_option('theme_options_linkedin');
		$pinterest  = get_option('theme_options_pinterest');
		$tumblr     = get_option('theme_options_tumblr');
		$rss        = get_option('theme_options_rss');
		
		$slide_one_caption = get_option('theme_options_slide_one_caption');
		$slide1_style = get_option('theme_options_slide1_style');
		$slide1_link  = get_option('theme_options_slide1_link');
		$slide1_src   = get_option('theme_options_slide1_src');
		$slide1_alt   = get_option('theme_options_slide1_alt');
				
		$slide_two_caption = get_option('theme_options_slide_two_caption');
		$slide2_style = get_option('theme_options_slide2_style');
		$slide2_link  = get_option('theme_options_slide2_link');
		$slide2_src   = get_option('theme_options_slide2_src');
		$slide2_alt   = get_option('theme_options_slide2_alt');
				
		$slide_three_caption = get_option('theme_options_slide_three_caption');
		$slide3_style = get_option('theme_options_slide3_style');
		$slide3_link  = get_option('theme_options_slide3_link');
		$slide3_src   = get_option('theme_options_slide3_src');
		$slide3_alt   = get_option('theme_options_slide3_alt');
				
		$slide_four_caption = get_option('theme_options_slide_four_caption');
		$slide4_style = get_option('theme_options_slide4_style');
		$slide4_link  = get_option('theme_options_slide4_link');
		$slide4_src   = get_option('theme_options_slide4_src');
		$slide4_alt   = get_option('theme_options_slide4_alt');
				
		$slide_five_caption = get_option('theme_options_slide_five_caption');
		$slide5_style = get_option('theme_options_slide5_style');
		$slide5_link  = get_option('theme_options_slide5_link');
		$slide5_src   = get_option('theme_options_slide5_src');
		$slide5_alt   = get_option('theme_options_slide5_alt');
		
		$footer = get_option('theme_options_footer');
	}
?>
    <div class="wrap">
		<?php screen_icon(); ?>
        <h2>Theme Options</h2>
        <?php settings_errors(); ?>
        
        <form action="" method="post">
            <h3>Contact Information</h3>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">
                        <label for="org-type">Type of Organziation:</label>
                    </th>
                    <td>
                        <select id="org-type" name="org-type">
                            <option value="Organization"<?php if ($org_type == 'Organization') echo ' selected="selected"'; ?>>General</option>
                            <option value="Corporation"<?php if ($org_type == 'Corporation') echo ' selected="selected"'; ?>>Corporation</option>
                            <option value="EducationalOrganization"<?php if ($org_type == 'EducationalOrganization') echo ' selected="selected"'; ?>>School</option>
                            <option value="GovernmentOrganization"<?php if ($org_type == 'GovernmentOrganization') echo ' selected="selected"'; ?>>Government</option>
                            <option value="LocalBusiness"<?php if ($org_type == 'LocalBusiness') echo ' selected="selected"'; ?>>Local Business</option>
                            <option value="NGO"<?php if ($org_type == 'NGO') echo ' selected="selected"'; ?>>NGO</option>
                            <option value="PerformingGroup"<?php if ($org_type == 'PerformingGroup') echo ' selected="selected"'; ?>>Performing Group</option>
                            <option value="SportsTeam"<?php if ($org_type == 'SportsTeam') echo ' selected="selected"'; ?>>Sports Team</option>
                        </select>
                    </td>
                    <td>
                        <select id="org-type2" name="org-type2">
                            <option value="Organization"<?php if ($org_type2 == 'Organization') echo ' selected="selected"'; ?>>General</option>
                            <option value="Corporation"<?php if ($org_type2 == 'Corporation') echo ' selected="selected"'; ?>>Corporation</option>
                            <option value="EducationalOrganization"<?php if ($org_type2 == 'EducationalOrganization') echo ' selected="selected"'; ?>>School</option>
                            <option value="GovernmentOrganization"<?php if ($org_type2 == 'GovernmentOrganization') echo ' selected="selected"'; ?>>Government</option>
                            <option value="LocalBusiness"<?php if ($org_type2 == 'LocalBusiness') echo ' selected="selected"'; ?>>Local Business</option>
                            <option value="NGO"<?php if ($org_type2 == 'NGO') echo ' selected="selected"'; ?>>NGO</option>
                            <option value="PerformingGroup"<?php if ($org_type2 == 'PerformingGroup') echo ' selected="selected"'; ?>>Performing Group</option>
                            <option value="SportsTeam"<?php if ($org_type2 == 'SportsTeam') echo ' selected="selected"'; ?>>Sports Team</option>
                        </select>
                    </td>
                    <td>
                        <select id="org-type3" name="org-type3">
                            <option value="Organization"<?php if ($org_type3 == 'Organization') echo ' selected="selected"'; ?>>General</option>
                            <option value="Corporation"<?php if ($org_type3 == 'Corporation') echo ' selected="selected"'; ?>>Corporation</option>
                            <option value="EducationalOrganization"<?php if ($org_type3 == 'EducationalOrganization') echo ' selected="selected"'; ?>>School</option>
                            <option value="GovernmentOrganization"<?php if ($org_type3 == 'GovernmentOrganization') echo ' selected="selected"'; ?>>Government</option>
                            <option value="LocalBusiness"<?php if ($org_type3 == 'LocalBusiness') echo ' selected="selected"'; ?>>Local Business</option>
                            <option value="NGO"<?php if ($org_type3 == 'NGO') echo ' selected="selected"'; ?>>NGO</option>
                            <option value="PerformingGroup"<?php if ($org_type3 == 'PerformingGroup') echo ' selected="selected"'; ?>>Performing Group</option>
                            <option value="SportsTeam"<?php if ($org_type3 == 'SportsTeam') echo ' selected="selected"'; ?>>Sports Team</option>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="name">Name:</label>
                    </th>
                    <td>
                        <input type="text" id="name" name="name" size="30" value="<?php echo $name; ?>" />
                    </td>
                    <td>
                        <input type="text" id="name2" name="name2" size="30" value="<?php echo $name2; ?>" />
                    </td>
                    <td>
                        <input type="text" id="name3" name="name3" size="30" value="<?php echo $name3; ?>" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="url">URL:</label>
                    </th>
                    <td>
                        <input type="text" id="url" name="url" size="30" value="<?php echo $url; ?>" />
                    </td>
                    <td>
                        <input type="text" id="url2" name="url2" size="30" value="<?php echo $url2; ?>" />
                    </td>
                    <td>
                        <input type="text" id="url3" name="url3" size="30" value="<?php echo $url3; ?>" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="addr">Street Address:</label>
                    </th>
                    <td>
                        <input type="text" id="addr" name="addr" value="<?php echo $addr; ?>" />
                    </td>
                    <td>
                        <input type="text" id="addr2" name="addr2" value="<?php echo $addr2; ?>" />
                    </td>
                    <td>
                        <input type="text" id="addr3" name="addr3" value="<?php echo $addr3; ?>" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="po">PO Box:</label>
                    </th>
                    <td>
                        <input type="text" id="po" name="po" size="10" value="<?php echo $po; ?>" />
                    </td>
                    <td>
                        <input type="text" id="po2" name="po2" size="10" value="<?php echo $po2; ?>" />
                    </td>
                    <td>
                        <input type="text" id="po3" name="po3" size="10" value="<?php echo $po3; ?>" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="city">City:</label>
                    </th>
                    <td>
                        <input type="text" id="city" name="city" value="<?php echo $city; ?>" />
                    </td>
                    <td>
                        <input type="text" id="city2" name="city2" value="<?php echo $city2; ?>" />
                    </td>
                    <td>
                        <input type="text" id="city3" name="city3" value="<?php echo $city3; ?>" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="state">State/Region:</label>
                    </th>
                    <td>
                        <input type="text" id="state" name="state" value="<?php echo $state; ?>" />
                    </td>
                    <td>
                        <input type="text" id="state2" name="state2" value="<?php echo $state2; ?>" />
                    </td>
                    <td>
                        <input type="text" id="state3" name="state3" value="<?php echo $state3; ?>" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="zip">Postal Code:</label>
                    </th>
                    <td>
                        <input type="text" id="zip" name="zip" size="10" value="<?php echo $zip; ?>" />
                    </td>
                    <td>
                        <input type="text" id="zip2" name="zip2" size="10" value="<?php echo $zip2; ?>" />
                    </td>
                    <td>
                        <input type="text" id="zip3" name="zip3" size="10" value="<?php echo $zip3; ?>" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="country">Country:</label>
                    </th>
                    <td>
                        <input type="text" id="country" name="country" value="<?php echo $country; ?>" />
                    </td>
                    <td>
                        <input type="text" id="country2" name="country2" value="<?php echo $country2; ?>" />
                    </td>
                    <td>
                        <input type="text" id="country3" name="country3" value="<?php echo $country3; ?>" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="tel">Phone Number:</label>
                    </th>
                    <td>
                        <input type="text" id="tel" name="tel" size="15" value="<?php echo $tel; ?>" />
                    </td>
                    <td>
                        <input type="text" id="tel2" name="tel2" size="15" value="<?php echo $tel2; ?>" />
                    </td>
                    <td>
                        <input type="text" id="tel3" name="tel3" size="15" value="<?php echo $tel3; ?>" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="fax">Fax Number:</label>
                    </th>
                    <td>
                        <input type="text" id="fax" name="fax" size="15" value="<?php echo $fax; ?>" />
                    </td>
                    <td>
                        <input type="text" id="fax2" name="fax2" size="15" value="<?php echo $fax2; ?>" />
                    </td>
                    <td>
                        <input type="text" id="fax3" name="fax3" size="15" value="<?php echo $fax3; ?>" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="email">Email Address:</label>
                    </th>
                    <td>
                        <input type="text" id="email" name="email" size="30" value="<?php echo $email; ?>" />
                    </td>
                    <td>
                        <input type="text" id="email2" name="email2" size="30" value="<?php echo $email2; ?>" />
                    </td>
                    <td>
                        <input type="text" id="email3" name="email3" size="30" value="<?php echo $email3; ?>" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="hours">Hours:</label>
                    </th>
                    <td>
                        <textarea id="hours" name="hours" cols="28" rows="5"><?php echo $hours; ?></textarea>
                    </td>
                    <td>
                        <textarea id="hours2" name="hours2" cols="28" rows="5"><?php echo $hours2; ?></textarea>
                    </td>
                    <td>
                        <textarea id="hours3" name="hours3" cols="28" rows="5"><?php echo $hours3; ?></textarea>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="map">Google Map:</label>
                    </th>
                    <td>
                        <textarea id="map" name="map" cols="28" rows="5"><?php echo $map; ?></textarea>
                    </td>
                    <td>
                        <textarea id="map2" name="map2" cols="28" rows="5"><?php echo $map2; ?></textarea>
                    </td>
                    <td>
                        <textarea id="map3" name="map3" cols="28" rows="5"><?php echo $map3; ?></textarea>
                    </td>
                </tr>
            </table>
            
            <?php submit_button(); ?>
            
            <hr />
            
            <h3>Global</h3>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">
                        <label for="logo-src">Logo:</label>
                    </th>
                    <td>
                        <input type="text" id="logo-src" name="logo-src" class="src" value="<?php echo $logo_src; ?>" />
                        <input type="hidden" id="logo-alt" name="logo-alt" class="alt" value="<?php echo $logo_alt; ?>" />
                        <input type="button" id="logo-btn" class="upload-button button" value="Add Image" />
                        <a href="#" class="upload-reset">Remove</a>
                    </td>
                </tr>
                <?php if (!empty($logo_src)) : ?>
                <tr valign="top">
                    <td>&nbsp;</td>
                    <td><img src="<?php echo $logo_src; ?>" alt="<?php echo $logo_alt; ?>" /></td>
                </tr>
                <?php endif; ?>
                <tr valign="top">
                    <th scope="row">
                        <label for="global1">Global Area 1:</label>
                    </th>
                    <td>
                        <?php
                        // Display editor
						$args = array(
							'media_buttons' => true,
						);
						wp_editor($global1, 'global1', $args); ?>
                        
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="global2">Global Area 2:</label>
                    </th>
                    <td>
                        <?php
                        // Display editor
						$args = array(
							'media_buttons' => true,
						);
						wp_editor($global2, 'global2', $args); ?>
                        
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="global3">Global Area 3:</label>
                    </th>
                    <td>
                        <?php
                        // Display editor
						$args = array(
							'media_buttons' => true,
						);
						wp_editor($global3, 'global3', $args); ?>
                        
                    </td>
                </tr>
            </table>
            
            <?php submit_button(); ?>
            
            <hr />
            
            <h3>Social Media</h3>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">
                        <label for="facebook">Facebook URL:</label>
                    </th>
                    <td>
                        <input type="text" id="facebook" name="facebook" size="50" value="<?php echo $facebook; ?>" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="twitter">Twitter URL:</label>
                    </th>
                    <td>
                        <input type="text" id="twitter" name="twitter" size="50" value="<?php echo $twitter; ?>" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="googleplus">Google+ URL:</label>
                    </th>
                    <td>
                        <input type="text" id="googleplus" name="googleplus" size="50" value="<?php echo $googleplus; ?>" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="youtube">YouTube URL:</label>
                    </th>
                    <td>
                        <input type="text" id="youtube" name="youtube" size="50" value="<?php echo $youtube; ?>" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="linkedin">LinkedIn URL:</label>
                    </th>
                    <td>
                        <input type="text" id="linkedin" name="linkedin" size="50" value="<?php echo $linkedin; ?>" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="pinterest">Pinterest URL:</label>
                    </th>
                    <td>
                        <input type="text" id="pinterest" name="pinterest" size="50" value="<?php echo $pinterest; ?>" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="tumblr">Tumblr URL:</label>
                    </th>
                    <td>
                        <input type="text" id="tumblr" name="tumblr" size="50" value="<?php echo $tumblr; ?>" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="rss">RSS URL:</label>
                    </th>
                    <td>
                        <input type="text" id="rss" name="rss" size="50" value="<?php echo $rss; ?>" />
                    </td>
                </tr>
            </table>
            
            <?php submit_button(); ?>
            
            <hr />
            
            <h3>Slideshow</h3>
            <p>Slideshow images must have a <strong>minimum width of 1600px</strong> and it is recommended that each have the same height.</p>
            
            <h4>Slide 1</h4>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">
                        <label for="slide_one_caption">Caption:</label>
                    </th>
                    <td>
                        <?php
                        // Display editor
						$args = array(
							'media_buttons' => true,
						);
						wp_editor($slide_one_caption, 'slide_one_caption', $args);
						?>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="slide1-style">Caption Style:</label>
                    </th>
                    <td>
                        <select id="slide1-style" name="slide1-style">
                            <option value="style1"<?php if ($slide1_style == 'style1') echo ' selected="selected"'; ?>>Style 1</option>
                            <option value="style2"<?php if ($slide1_style == 'style2') echo ' selected="selected"'; ?>>Style 2</option>
                            <option value="style3"<?php if ($slide1_style == 'style3') echo ' selected="selected"'; ?>>Style 3</option>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="slide1-link">Link:</label>
                    </th>
                    <td>
                        <input type="text" id="slide1-link" name="slide1-link" size="50" value="<?php echo $slide1_link; ?>" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="slide1-src">Image:</label>
                    </th>
                    <td>
                        <input type="text" id="slide1-src" name="slide1-src" size="50" class="src" value="<?php echo $slide1_src; ?>" />
                        <input type="hidden" id="slide1-alt" name="slide1-alt" class="alt" value="<?php echo $slide1_alt; ?>" />
                        <input type="button" id="slide1-btn" class="upload-button button" value="Add Image" />
                        <a href="#" class="upload-reset">Remove</a>
                    </td>
                </tr>
                <?php if (!empty($slide1_src)) : ?>
                <tr valign="top">
                    <td>&nbsp;</td>
                    <td><img src="<?php echo $slide1_src; ?>" width="724" alt="<?php echo $slide1_alt; ?>" /></td>
                </tr>
                <?php endif; ?>
            </table>
            
            <hr />
            
            <h4>Slide 2</h4>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">
                        <label for="slide_two_caption">Caption:</label>
                    </th>
                    <td>
                        <?php
                        // Display editor
						$args = array(
							'media_buttons' => true,
						);
						wp_editor($slide_two_caption, 'slide_two_caption', $args);
						?>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="slide2-style">Caption Style:</label>
                    </th>
                    <td>
                        <select id="slide2-style" name="slide2-style">
                            <option value="style1"<?php if ($slide2_style == 'style1') echo ' selected="selected"'; ?>>Style 1</option>
                            <option value="style2"<?php if ($slide2_style == 'style2') echo ' selected="selected"'; ?>>Style 2</option>
                            <option value="style3"<?php if ($slide2_style == 'style3') echo ' selected="selected"'; ?>>Style 3</option>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="slide2-link">Link:</label>
                    </th>
                    <td>
                        <input type="text" id="slide2-link" name="slide2-link" size="50" value="<?php echo $slide2_link; ?>" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="slide2-src">Image:</label>
                    </th>
                    <td>
                        <input type="text" id="slide2-src" name="slide2-src" size="50" class="src" value="<?php echo $slide2_src; ?>" />
                        <input type="hidden" id="slide2-alt" name="slide2-alt" class="alt" value="<?php echo $slide2_alt; ?>" />
                        <input type="button" id="slide2-btn" class="upload-button button" value="Add Image" />
                        <a href="#" class="upload-reset">Remove</a>
                    </td>
                </tr>
                <?php if (!empty($slide2_src)) : ?>
                <tr valign="top">
                    <td>&nbsp;</td>
                    <td><img src="<?php echo $slide2_src; ?>" width="724" alt="<?php echo $slide2_alt; ?>" /></td>
                </tr>
                <?php endif; ?>
            </table>
            
            <hr />
            
            <h4>Slide 3</h4>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">
                        <label for="slide_three_caption">Caption:</label>
                    </th>
                    <td>
                        <?php
                        // Display editor
						$args = array(
							'media_buttons' => true,
						);
						wp_editor($slide_three_caption, 'slide_three_caption', $args);
						?>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="slide3-style">Caption Style:</label>
                    </th>
                    <td>
                        <select id="slide3-style" name="slide3-style">
                            <option value="style1"<?php if ($slide3_style == 'style1') echo ' selected="selected"'; ?>>Style 1</option>
                            <option value="style2"<?php if ($slide3_style == 'style2') echo ' selected="selected"'; ?>>Style 2</option>
                            <option value="style3"<?php if ($slide3_style == 'style3') echo ' selected="selected"'; ?>>Style 3</option>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="slide3-link">Link:</label>
                    </th>
                    <td>
                        <input type="text" id="slide3-link" name="slide3-link" size="50" value="<?php echo $slide3_link; ?>" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="slide3-src">Image:</label>
                    </th>
                    <td>
                        <input type="text" id="slide3-src" name="slide3-src" size="50" class="src" value="<?php echo $slide3_src; ?>" />
                        <input type="hidden" id="slide3-alt" name="slide3-alt" class="alt" value="<?php echo $slide3_alt; ?>" />
                        <input type="button" id="slide3-btn" class="upload-button button" value="Add Image" />
                        <a href="#" class="upload-reset">Remove</a>
                    </td>
                </tr>
                <?php if (!empty($slide3_src)) : ?>
                <tr valign="top">
                    <td>&nbsp;</td>
                    <td><img src="<?php echo $slide3_src; ?>" width="724" alt="<?php echo $slide3_alt; ?>" /></td>
                </tr>
                <?php endif; ?>
            </table>
            
            <hr />
            
            <h4>Slide 4</h4>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">
                        <label for="slide_four_caption">Caption:</label>
                    </th>
                    <td>
                        <?php
                        // Display editor
						$args = array(
							'media_buttons' => true,
						);
						wp_editor($slide_four_caption, 'slide_four_caption', $args);
						?>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="slide4-style">Caption Style:</label>
                    </th>
                    <td>
                        <select id="slide4-style" name="slide4-style">
                            <option value="style1"<?php if ($slide4_style == 'style1') echo ' selected="selected"'; ?>>Style 1</option>
                            <option value="style2"<?php if ($slide4_style == 'style2') echo ' selected="selected"'; ?>>Style 2</option>
                            <option value="style3"<?php if ($slide4_style == 'style3') echo ' selected="selected"'; ?>>Style 3</option>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="slide4-link">Link:</label>
                    </th>
                    <td>
                        <input type="text" id="slide4-link" name="slide4-link" size="50" value="<?php echo $slide4_link; ?>" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="slide4-src">Image:</label>
                    </th>
                    <td>
                        <input type="text" id="slide4-src" name="slide4-src" size="50" class="src" value="<?php echo $slide4_src; ?>" />
                        <input type="hidden" id="slide4-alt" name="slide4-alt" class="alt" value="<?php echo $slide4_alt; ?>" />
                        <input type="button" id="slide4-btn" class="upload-button button" value="Add Image" />
                        <a href="#" class="upload-reset">Remove</a>
                    </td>
                </tr>
                <?php if (!empty($slide4_src)) : ?>
                <tr valign="top">
                    <td>&nbsp;</td>
                    <td><img src="<?php echo $slide4_src; ?>" width="724" alt="<?php echo $slide4_alt; ?>" /></td>
                </tr>
                <?php endif; ?>
            </table>
            
            <hr />
            
            <h4>Slide 5</h4>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">
                        <label for="slide_five_caption">Caption:</label>
                    </th>
                    <td>
                        <?php
                        // Display editor
						$args = array(
							'media_buttons' => true,
						);
						wp_editor($slide_five_caption, 'slide_five_caption', $args);
						?>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="slide5-style">Caption Style:</label>
                    </th>
                    <td>
                        <select id="slide5-style" name="slide5-style">
                            <option value="style1"<?php if ($slide5_style == 'style1') echo ' selected="selected"'; ?>>Style 1</option>
                            <option value="style2"<?php if ($slide5_style == 'style2') echo ' selected="selected"'; ?>>Style 2</option>
                            <option value="style3"<?php if ($slide5_style == 'style3') echo ' selected="selected"'; ?>>Style 3</option>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="slide5-link">Link:</label>
                    </th>
                    <td>
                        <input type="text" id="slide5-link" name="slide5-link" size="50" value="<?php echo $slide5_link; ?>" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="slide5-src">Image:</label>
                    </th>
                    <td>
                        <input type="text" id="slide5-src" name="slide5-src" size="50" class="src" value="<?php echo $slide5_src; ?>" />
                        <input type="hidden" id="slide5-alt" name="slide5-alt" class="alt" value="<?php echo $slide5_alt; ?>" />
                        <input type="button" id="slide5-btn" class="upload-button button" value="Add Image" />
                        <a href="#" class="upload-reset">Remove</a>
                    </td>
                </tr>
                <?php if (!empty($slide5_src)) : ?>
                <tr valign="top">
                    <td>&nbsp;</td>
                    <td><img src="<?php echo $slide5_src; ?>" width="724" alt="<?php echo $slide5_alt; ?>" /></td>
                </tr>
                <?php endif; ?>
            </table>
            
            <?php submit_button(); ?>
            
            <hr />
            
            <h3>Footer</h3>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">
                        <label for="footer">Content:</label>
                    </th>
                    <td>
                        <?php
                        // Display editor
						$args = array(
							'media_buttons' => true,
						);
						wp_editor($footer, 'footer', $args); ?>
                        
                    </td>
                </tr>
            </table>
            
            <?php submit_button(); ?>
            
            <input type="hidden" name="update" value="1" />
        </form>
    </div>
<?php
}

?>