<?php
/**
 * Blog sidebar
 *
 * @package WordPress
 * @subpackage Sparkler
 * @since Sparkler 1.0
 */
?>
                        <aside id="sidebar" class="grid4 last">
                            <div class="inner">
                            
							<?php if (!dynamic_sidebar('sidebar-2')) : ?>
                            
                                <aside id="archives" class="widget">
                                    <h3 class="widget-title"><?php _e('Archives', 'sparkler'); ?></h3>
                                    <ul>
                                        <?php wp_get_archives(array('type' => 'monthly')); ?>
                                    </ul>
                                </aside>
                                                                    
                                <aside id="meta" class="widget">
                                    <h3 class="widget-title"><?php _e('Meta', 'sparkler'); ?></h3>
                                    <ul>
                                        <?php wp_register(); ?>
                                        <li><?php wp_loginout(); ?></li>
                                        <?php wp_meta(); ?>
                                    </ul>
                                </aside>
                                
                            <?php endif; ?>
                            
                            </div><!--inner-->
                        </aside><!--sidebar-->
