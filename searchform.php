<?php
/**
 * Search form markup
 *
 * @package WordPress
 * @subpackage Sparkler
 * @since Sparkler 1.0
 */
?>
<form action="<?php echo esc_url(home_url('/')); ?>" method="get" class="form-search">
    <div class="rel icon icon-magnifying-glass">
        <input type="text" id="s" name="s" placeholder="Search" />
        <input type="submit" value="<?php esc_attr_e('Search', 'sparkler'); ?>" />
    </div><!--rel-->
</form>
