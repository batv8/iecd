<?php 
/**
 * @package 	WordPress
 * @subpackage 	Cleanora
 * @version		1.0.0
 * 
 * Footer Template
 * Created by CMSMasters
 * 
 */


$cmsmasters_option = cleanora_get_global_options();
?>
<div class="footer <?php echo 'cmsmasters_color_scheme_' . $cmsmasters_option['cleanora' . '_footer_scheme'] . ($cmsmasters_option['cleanora' . '_footer_type'] == 'default' ? ' cmsmasters_footer_default' : ' cmsmasters_footer_small'); ?>">
	<div class="footer_inner">
		<?php 
		if (
			$cmsmasters_option['cleanora' . '_footer_type'] == 'default' && 
			$cmsmasters_option['cleanora' . '_footer_logo']
		) {
			cleanora_footer_logo($cmsmasters_option);
		}
		
		
		if (
			has_nav_menu('footer') && 
			(
				(
					$cmsmasters_option['cleanora' . '_footer_type'] == 'default' && 
					$cmsmasters_option['cleanora' . '_footer_nav']
				) || (
					$cmsmasters_option['cleanora' . '_footer_type'] == 'small' && 
					$cmsmasters_option['cleanora' . '_footer_additional_content'] == 'nav'
				)
			)
		) {
			echo '<div class="footer_nav_wrap">' . 
				'<nav>';
				
				
				wp_nav_menu(array( 
					'theme_location' => 'footer', 
					'menu_id' => 'footer_nav', 
					'menu_class' => 'footer_nav' 
				));
				
				
				echo '</nav>' . 
			'</div>';
		}
		
		
		if (
			(
				$cmsmasters_option['cleanora' . '_footer_type'] == 'default' && 
				$cmsmasters_option['cleanora' . '_footer_html'] !== ''
			) || (
				$cmsmasters_option['cleanora' . '_footer_type'] == 'small' && 
				$cmsmasters_option['cleanora' . '_footer_additional_content'] == 'text' && 
				$cmsmasters_option['cleanora' . '_footer_html'] !== ''
			)
		) {
			echo '<div class="footer_custom_html_wrap">' . 
				'<div class="footer_custom_html">' . 
					do_shortcode(wp_kses(stripslashes($cmsmasters_option['cleanora' . '_footer_html']), 'post')) . 
				'</div>' . 
			'</div>';
		}
		
		
		if (
			isset($cmsmasters_option['cleanora' . '_social_icons']) && 
			(
				(
					$cmsmasters_option['cleanora' . '_footer_type'] == 'default' && 
					$cmsmasters_option['cleanora' . '_footer_social']
				) || (
					$cmsmasters_option['cleanora' . '_footer_type'] == 'small' && 
					$cmsmasters_option['cleanora' . '_footer_additional_content'] == 'social'
				)
			)
		) {
			cleanora_social_icons();
		}
		?>
		<span class="footer_copyright copyright">
			<?php 
			if (function_exists('the_privacy_policy_link')) {
				the_privacy_policy_link('', ' / ');
			}
			
			echo esc_html(stripslashes($cmsmasters_option['cleanora' . '_footer_copyright']));
			?>
		</span>
	</div>
</div>