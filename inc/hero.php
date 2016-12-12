<?php
/**
 * Hero markup
 *
 * @package WordPress
 * @subpackage Sparkler
 * @since Sparkler 1.0
 */
?>
			<?php
            $slide1_src = get_option('theme_options_slide1_src');
            $slide2_src = get_option('theme_options_slide2_src');
            $slide3_src = get_option('theme_options_slide3_src');
            $slide4_src = get_option('theme_options_slide4_src');
            $slide5_src = get_option('theme_options_slide5_src');
            
            if (!empty($slide1_src) ||
                !empty($slide2_src) ||
                !empty($slide3_src) ||
                !empty($slide4_src) ||
                !empty($slide5_src)) : ?>
            
            <div id="hero">
                <div class="flexslider">
                    <ul class="slides">
						<?php
						/**
						 * Slide 1
						 */
                        $slide_one_caption = get_option('theme_options_slide_one_caption');
						$slide1_link  = wp_make_link_relative(get_option('theme_options_slide1_link'));
                        $slide1_style = get_option('theme_options_slide1_style');
                        $slide1_alt   = get_option('theme_options_slide1_alt');
                        
                        if (!empty($slide1_src)) : ?>
                        
						<li>
                            <?php if (!empty($slide1_link)) echo '<a href="'.$slide1_link.'">'; ?>
                                
                                <img src="<?php echo $slide1_src; ?>" alt="<?php echo get_option('theme_options_slide1_alt'); ?>" />
                                
                                <?php
                                // Display caption
								if (!empty($slide_one_caption)) : ?>
								
                                <div class="wrap">
                                    <div class="flex-caption <?php echo $slide1_style; ?>">
                                        <?php echo apply_filters('the_content', $slide_one_caption); ?>
                                    </div><!--flex-caption-->
                                </div><!--wrap-->
                                <?php endif; ?>
                                
                            <?php if (!empty($slide1_link)) echo '</a>'; ?>
                            
                        </li>
						<?php
                        endif;
						
						/**
						 * Slide 2
						 */
                        $slide_two_caption = get_option('theme_options_slide_two_caption');
						$slide2_link  = wp_make_link_relative(get_option('theme_options_slide2_link'));
                        $slide2_style = get_option('theme_options_slide2_style');
                        $slide2_alt   = get_option('theme_options_slide2_alt');
                        
                        if (!empty($slide2_src)) : ?>
                        
						<li>
                            <?php if (!empty($slide2_link)) echo '<a href="'.$slide2_link.'">'; ?>
                                
                                <img src="<?php echo $slide2_src; ?>" alt="<?php echo get_option('theme_options_slide2_alt'); ?>" />
                                
                                <?php
                                // Display caption
								if (!empty($slide_two_caption)) : ?>
								
                                <div class="wrap">
                                    <div class="flex-caption <?php echo $slide2_style; ?>">
                                        <?php echo apply_filters('the_content', $slide_two_caption); ?>
                                    </div><!--flex-caption-->
                                </div><!--wrap-->
                                <?php endif; ?>
                                
                            <?php if (!empty($slide2_link)) echo '</a>'; ?>
                            
                        </li>
						<?php
                        endif;
						
						/**
						 * Slide 3
						 */
                        $slide_three_caption = get_option('theme_options_slide_three_caption');
                        $slide3_link  = wp_make_link_relative(get_option('theme_options_slide3_link'));
                        $slide3_style = get_option('theme_options_slide3_style');
                        $slide3_alt   = get_option('theme_options_slide3_alt');
                        
                        if (!empty($slide3_src)) : ?>
                        
						<li>
                            <?php if (!empty($slide3_link)) echo '<a href="'.$slide3_link.'">'; ?>
                                
                                <img src="<?php echo $slide3_src; ?>" alt="<?php echo get_option('theme_options_slide3_alt'); ?>" />
                                
                                <?php
                                // Display caption
								if (!empty($slide_three_caption)) : ?>
								
                                <div class="wrap">
                                    <div class="flex-caption <?php echo $slide3_style; ?>">
                                        <?php echo apply_filters('the_content', $slide_three_caption); ?>
                                    </div><!--flex-caption-->
                                </div><!--wrap-->
                                <?php endif; ?>
                                
                            <?php if (!empty($slide3_link)) echo '</a>'; ?>
                            
                        </li>
						<?php
                        endif;
						
						/**
						 * Slide 4
						 */
                        $slide_four_caption = get_option('theme_options_slide_four_caption');
                        $slide4_link  = wp_make_link_relative(get_option('theme_options_slide4_link'));
                        $slide4_style = get_option('theme_options_slide4_style');
                        $slide4_alt   = get_option('theme_options_slide4_alt');
                        
                        if (!empty($slide4_src)) : ?>
                        
						<li>
                            <?php if (!empty($slide4_link)) echo '<a href="'.$slide4_link.'">'; ?>
                                
                                <img src="<?php echo $slide4_src; ?>" alt="<?php echo get_option('theme_options_slide4_alt'); ?>" />
                                
                                <?php
                                // Display caption
								if (!empty($slide_four_caption)) : ?>
								
                                <div class="wrap">
                                    <div class="flex-caption <?php echo $slide4_style; ?>">
                                        <?php echo apply_filters('the_content', $slide_four_caption); ?>
                                    </div><!--flex-caption-->
                                </div><!--wrap-->
                                <?php endif; ?>
                                
                            <?php if (!empty($slide4_link)) echo '</a>'; ?>
                            
                        </li>
						<?php
                        endif;
						
						/**
						 * Slide 5
						 */
                        $slide_five_caption = get_option('theme_options_slide_five_caption');
                        $slide5_link  = wp_make_link_relative(get_option('theme_options_slide5_link'));
                        $slide5_style = get_option('theme_options_slide5_style');
                        $slide5_alt   = get_option('theme_options_slide5_alt');
                        
                        if (!empty($slide5_src)) : ?>
                        
						<li>
                            <?php if (!empty($slide5_link)) echo '<a href="'.$slide5_link.'">'; ?>
                                
                                <img src="<?php echo $slide5_src; ?>" alt="<?php echo get_option('theme_options_slide5_alt'); ?>" />
                                
                                <?php
                                // Display caption
								if (!empty($slide_five_caption)) : ?>
								
                                <div class="wrap">
                                    <div class="flex-caption <?php echo $slide5_style; ?>">
                                        <?php echo apply_filters('the_content', $slide_five_caption); ?>
                                    </div><!--flex-caption-->
                                </div><!--wrap-->
                                <?php endif; ?>
                                
                            <?php if (!empty($slide5_link)) echo '</a>'; ?>
                            
                        </li>
						<?php endif; ?>
                        
                    </ul>
                </div><!--flexslider-->
            </div><!--hero-->
            
            <?php endif; ?>
