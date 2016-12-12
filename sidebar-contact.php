<?php
/**
 * Contact sidebar
 *
 * @package WordPress
 * @subpackage Sparkler
 * @since Sparkler 1.0
 */
?>
                        <aside id="sidebar" class="grid4 last">
                            <div class="inner">
                            
                                <?php
								/**
								 * Display location 1
								 */
								
                                // Get theme options data
                                $name    = get_option('theme_options_name');
                                $addr    = get_option('theme_options_addr');
                                $po      = get_option('theme_options_po');
                                $city    = get_option('theme_options_city');
                                $state   = get_option('theme_options_state');
                                $zip     = get_option('theme_options_zip');
                                $country = get_option('theme_options_country');
                                
                                $tel   = get_option('theme_options_tel');
                                $fax   = get_option('theme_options_fax');
                                $email = get_option('theme_options_email');
                                $hours = nl2br(get_option('theme_options_hours'));
                                $map   = get_option('theme_options_map');
                                
                                if (!empty($map)) : ?>
                                
                                    <div class="map map-inline">
                                        <?php echo html_entity_decode($map); ?>
                                    </div><!--map-->
                                <?php
                                endif;
                                
                                if (!empty($addr) ||
                                    !empty($tel) ||
                                    !empty($fax) ||
                                    !empty($email) ||
                                    !empty($hours)) : ?>
                                    
                                    <h3><?php echo $name; ?></h3>
                                    <ul>
                                    <?php if (!empty($addr)) : ?>
                                    
                                        <li class="icon icon-location-pin"><?php
                                            echo $addr;
                                            if (!empty($po)) echo '<br />PO Box '.$po;
                                            if (!empty($city)) echo '<br />'.$city;
                                            if (!empty($state)) echo ', '.$state;
                                            if (!empty($zip)) echo ' '.$zip;
                                            if (!empty($country)) echo '<br />'.$country;
                                        ?></li>
                                    <?php endif; ?>
                                    <?php if (!empty($tel)) : ?>
                                    
                                        <li class="icon icon-phone6"><?php echo '<a class="tel-link" href="tel:+'.$tel.'">'.$tel.'</a>'; ?></li>
                                    <?php endif; ?>
                                    <?php if (!empty($fax)) : ?>
                                    
                                        <li class="icon icon-print2"><?php echo $fax; ?></li>
                                    <?php endif; ?>
                                    <?php if (!empty($email)) : ?>
                                    
                                        <li class="icon icon-mail5"><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></li>
                                    <?php endif; ?>
                                    <?php if (!empty($hours)) : ?>
                                    
                                        <li class="icon icon-clock3"><?php echo $hours; ?></li>
                                    <?php endif; ?>
                                    
                                    </ul>
                                <?php endif; ?>
                                
                                <?php
								/**
								 * Display location 2
								 */
                                
								// Get theme options data
                                $name2    = get_option('theme_options_name2');
                                $addr2    = get_option('theme_options_addr2');
                                $po2      = get_option('theme_options_po2');
                                $city2    = get_option('theme_options_city2');
                                $state2   = get_option('theme_options_state2');
                                $zip2     = get_option('theme_options_zip2');
                                $country2 = get_option('theme_options_country2');
                                
                                $tel2   = get_option('theme_options_tel2');
                                $fax2   = get_option('theme_options_fax2');
                                $email2 = get_option('theme_options_email2');
                                $hours2 = nl2br(get_option('theme_options_hours2'));
                                $map2   = get_option('theme_options_map2');
                                
                                if (!empty($map2)) : ?>
                                
                                    <div class="map">
                                        <?php echo html_entity_decode($map2); ?>
                                    </div><!--map-->
                                <?php
                                endif;
                                
                                if (!empty($addr2) ||
                                    !empty($tel2) ||
                                    !empty($fax2) ||
                                    !empty($email2) ||
                                    !empty($hours2)) : ?>
                                    
                                    <h3><?php echo $name2; ?></h3>
                                    <ul>
                                    <?php if (!empty($addr2)) : ?>
                                    
                                        <li class="icon icon-location-pin"><?php
                                            echo $addr2;
                                            if (!empty($po2)) echo '<br />PO Box '.$po2;
                                            if (!empty($city2)) echo '<br />'.$city2;
                                            if (!empty($state2)) echo ', '.$state2;
                                            if (!empty($zip2)) echo ' '.$zip2;
                                            if (!empty($country2)) echo '<br />'.$country2;
                                        ?></li>
                                    <?php endif; ?>
                                    <?php if (!empty($tel2)) : ?>
                                    
                                        <li class="icon icon-phone6"><?php echo '<a class="tel-link" href="tel:+'.$tel2.'">'.$tel2.'</a>'; ?></li>
                                    <?php endif; ?>
                                    <?php if (!empty($fax2)) : ?>
                                    
                                        <li class="icon icon-print2"><?php echo $fax2; ?></li>
                                    <?php endif; ?>
                                    <?php if (!empty($email2)) : ?>
                                    
                                        <li class="icon icon-mail5"><a href="mailto:<?php echo $email2; ?>"><?php echo $email2; ?></a></li>
                                    <?php endif; ?>
                                    <?php if (!empty($hours2)) : ?>
                                    
                                        <li class="icon icon-clock3"><?php echo $hours2; ?></li>
                                    <?php endif; ?>
                                    
                                    </ul>
                                <?php endif; ?>
                                
                            </div><!--inner-->
                        </aside><!--sidebar-->
