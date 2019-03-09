<?php
/**
 * @package 	WordPress
 * @subpackage 	Cleanora
 * @version		1.0.0
 * 
 * Post Default Template
 * Created by CMSMasters
 * 
 */


$cmsmasters_post_metadata = !is_home() ? explode(',', $cmsmasters_metadata) : array();


$date = (in_array('date', $cmsmasters_post_metadata) || is_home()) ? true : false;
$categories = (get_the_category() && (in_array('categories', $cmsmasters_post_metadata) || is_home())) ? true : false;
$author = (in_array('author', $cmsmasters_post_metadata) || is_home()) ? true : false;
$comments = (comments_open() && (in_array('comments', $cmsmasters_post_metadata) || is_home())) ? true : false;
$likes = (in_array('likes', $cmsmasters_post_metadata) || (is_home() && CMSMASTERS_CONTENT_COMPOSER)) ? true : false;
$more = (in_array('more', $cmsmasters_post_metadata) || is_home()) ? true : false;


$cmsmasters_post_format = get_post_format();

$cmsmasters_post_image_link = get_post_meta(get_the_ID(), 'cmsmasters_post_image_link', true);
$cmsmasters_post_images = explode(',', str_replace(' ', '', str_replace('img_', '', get_post_meta(get_the_ID(), 'cmsmasters_post_images', true))));
$cmsmasters_post_video_type = get_post_meta(get_the_ID(), 'cmsmasters_post_video_type', true);
$cmsmasters_post_video_link = get_post_meta(get_the_ID(), 'cmsmasters_post_video_link', true);
$cmsmasters_post_video_links = get_post_meta(get_the_ID(), 'cmsmasters_post_video_links', true);

?>
<!-- Start Post Default Article  -->
<article id="post-<?php the_ID(); ?>" <?php post_class('cmsmasters_post_default'); ?>>
	<div class="cmsmasters_post_cont_wrap">
		<?php
		if ($cmsmasters_post_format == 'image') {
			cleanora_post_type_image(get_the_ID(), $cmsmasters_post_image_link);
		} elseif ($cmsmasters_post_format == 'gallery') {
			cleanora_post_type_slider(get_the_ID(), $cmsmasters_post_images, 'post-thumbnail');
		} elseif ($cmsmasters_post_format == '' && !post_password_required() && has_post_thumbnail()) {
			cleanora_thumb(get_the_ID(), 'post-thumbnail', true, false, false, false, false, true, false);
		} elseif ($cmsmasters_post_format == 'video') {
			echo '<div class="cmsmasters_post_video_wrap">';
				cleanora_post_type_video(get_the_ID(), $cmsmasters_post_video_type, $cmsmasters_post_video_link, $cmsmasters_post_video_links);
			echo '</div>';
		}
		
		
		echo '<div class="cmsmasters_post_cont' . 
		((
			($cmsmasters_post_format == 'gallery' && (sizeof($cmsmasters_post_images) > 1 || (sizeof($cmsmasters_post_images) == 1 && $cmsmasters_post_images[0] != '') || has_post_thumbnail())) || 
			($cmsmasters_post_format == 'video' && !post_password_required() && (($cmsmasters_post_video_type == 'selfhosted' && !empty($cmsmasters_post_video_links) && sizeof($cmsmasters_post_video_links) > 0) || ($cmsmasters_post_video_type == 'embedded' && $cmsmasters_post_video_link != '') || has_post_thumbnail())) || 
			($cmsmasters_post_format == '' && !post_password_required() && has_post_thumbnail()) || 
			($cmsmasters_post_format == 'image' && !post_password_required() && ($cmsmasters_post_image_link != '' || has_post_thumbnail()))
		) ? ' enable_image' : '') . '">';
			
			if ($categories || $author) {
				echo '<footer class="cmsmasters_post_footer entry-meta">';
					
					$categories ? cleanora_get_post_category(get_the_ID(), 'category', 'page') : '';	
					$author ? cleanora_get_post_author('page') : '';
					
				echo '</footer>';
			}
			
			
			cleanora_post_heading(get_the_ID(), 'h3'); 

			if ($date) {
				echo '<div class="cmsmasters_post_cont_info entry-meta">';
					
					$date ? cleanora_get_post_date('page', 'default') : '';
					
				echo '</div>';
			}
			
			
			if ($cmsmasters_post_format == 'audio') {
				$cmsmasters_post_audio_links = get_post_meta(get_the_ID(), 'cmsmasters_post_audio_links', true);
				
				cleanora_post_type_audio($cmsmasters_post_audio_links);
			}
			
			
			cleanora_post_exc_cont(50);

			
			if ($comments || $likes) {
				echo '<div class="cmsmasters_post_meta_info">';
					
					$likes ? cleanora_get_post_likes('page') : '';
					
					$comments ? cleanora_get_post_comments('page') : '';
					
				echo '</div>';
			}			
			
			$more ? cleanora_post_more(get_the_ID()) : '';
		?>
		</div>
	</div>
</article>
<!-- Finish Post Default Article  -->

