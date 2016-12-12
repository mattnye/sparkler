<?php
/**
 * Footer
 *
 * @package WordPress
 * @subpackage Sparkler
 * @since Sparkler 1.0
 */
?>
                    </div><!--inner-->
                </div><!--wrap-->
            </div><!--body-->
            
            <footer id="footer">
                <div class="wrap">
                    <div class="inner clear">
                        
                        <ul class="inline-list centered-list">
                            <li>Lorem ipsum</li>
                            <li>Dolor sit amet</li>
                            <li>Consectetur adipisicing</li>
                            <li>Elit sed do</li>
                            <li>Eiusmod tempor</li>
                        </ul>
                        <div class="clear"></div>
                        
                        <?php
                        // Display Bottom nav
                        if (has_nav_menu('bottom')) : ?>
                        
                        <nav id="botnav">
                            <?php
                            $args = array(
                                'theme_location' => 'bottom',
                                'container_class' => 'menu',
                                'menu_class' => 'inline-list',
                            );
                            wp_nav_menu($args); ?>
                            
                        </nav>
                        <?php endif; ?>
                        
                        <?php
			// Display schema
                        include('inc/schema.php'); ?>
                        
                        <p class="small-text alignleft clearleft">&copy; <?php echo date('Y'); ?> <?php echo get_option('theme_options_name'); ?></p>
                        <p class="small-text alignleft">Proudly powered by <a href="http://wordpress.org/" target="_blank"<?php if (!is_front_page()) echo ' rel="nofollow"'; ?>>WordPress</a></p>
                        
                    </div><!--inner-->
                </div><!--wrap-->
            </footer><!--footer-->
            
        </div><!--inner-wrap-->
    </div><!--outer-wrap-->
    
    <a href="#" class="fixed-button top-scroll"><span class="icon icon-chevron-up2"></span></a>
    
    <?php wp_footer(); ?>
</body>
</html>