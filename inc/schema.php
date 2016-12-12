<?php
/**
 * Schema markup
 *
 * @package WordPress
 * @subpackage Sparkler
 * @since Sparkler 1.0
 */
?>
						<?php
                        // Get theme options data
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
                        
                        if (!empty($addr)) : ?>
                        
                        <div class="schema" itemscope itemtype="http://schema.org/<?php echo $org_type; ?>">
                            <?php
                            if (!empty($name)) :
                                if (!empty($url)) echo '<a itemprop="url" href="'.$url.'">'; ?>
                                
                                <h3><span itemprop="name"><?php echo $name; ?></span></h3>
                            <?php
                                if (!empty($url)) echo '</a>';
                            endif; ?>
                            
                            <p>
                                <span itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                                    <span itemprop="streetAddress"><?php echo $addr; ?></span>
                                    <?php if (!empty($po)) echo '<br />PO Box <span itemprop="postOfficeBoxNumber">'.$po.'</span>'; ?>
                                    
                                    <?php
                                    if (!empty($city)) echo '<br /><span itemprop="addressLocality">'.$city.'</span>';
                                    if (!empty($state)) echo ', <span itemprop="addressRegion">'.$state.'</span>';
                                    if (!empty($zip)) echo ' <span itemprop="postalCode">'.$zip.'</span>'; ?>
                                    
                                    <?php if (!empty($country)) echo '<br /><span itemprop="addressCountry">'.$country.'</span>'; ?>
                                    
                                </span>
                                <?php if (!empty($tel)) echo '<br /><span itemprop="telephone"><a class="tel-link" href="tel:+'.$tel.'">'.$tel.'</a></span>'; ?>
                                
                            </p>
                        </div><!--schema-->
                        <?php endif; ?>
