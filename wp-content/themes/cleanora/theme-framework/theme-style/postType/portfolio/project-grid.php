<?php
/**
 * @package 	WordPress
 * @subpackage 	Cleanora
 * @version		1.0.0
 * 
 * Project Grid Template
 * Created by CMSMasters
 * 
 */


$cmsmasters_project_metadata = explode(',', $cmsmasters_pj_metadata);


$title = (in_array('title', $cmsmasters_project_metadata)) ? true : false;
$excerpt = (in_array('excerpt', $cmsmasters_project_metadata) && cleanora_project_check_exc_cont()) ? true : false;
$categories = (get_the_terms(get_the_ID(), 'pj-categs') && (in_array('categories', $cmsmasters_project_metadata))) ? true : false;
$comments = (comments_open() && (in_array('comments', $cmsmasters_project_metadata))) ? true : false;
$likes = (in_array('likes', $cmsmasters_project_metadata)) ? true : false;
$rollover = in_array('rollover', $cmsmasters_project_metadata) ? true : false;
$more = (in_array('more', $cmsmasters_project_metadata)) ? true : false;
$author = (in_array('author', $cmsmasters_project_metadata)) ? true : false;

$cmsmasters_project_link_url = get_post_meta(get_the_ID(), 'cmsmasters_project_link_url', true);

$cmsmasters_project_link_redirect = get_post_meta(get_the_ID(), 'cmsmasters_project_link_redirect', true);

$cmsmasters_project_link_target = get_post_meta(get_the_ID(), 'cmsmasters_project_link_target', true);


$project_thumb_size = (($cmsmasters_pj_layout_mode == 'masonry') ? 'cmsmasters-project-masonry-thumb' : 'cmsmasters-project-thumb');

$project_thumb_high = (($cmsmasters_pj_layout_mode == 'masonry') ? true : false);


$project_sort_categs = get_the_terms(0, 'pj-categs');

$project_categs = '';

if ($project_sort_categs != '') {
	foreach ($project_sort_categs as $project_sort_categ) {
		$project_categs .= ' ' . $project_sort_categ->slug;
	}
	
	
	$project_categs = ltrim($project_categs, ' ');
}


$cmsmasters_post_format = get_post_format();

?>
<!-- Start Project Grid Article  -->
<article id="post-<?php the_ID(); ?>" <?php post_class('cmsmasters_project_grid'); echo (($project_categs != '') ? ' data-category="' . esc_attr($project_categs) . '"' : '') ?>>
	<div class="project_outer">
	<?php 

		if ($rollover) {
			echo '<div class="cmsmasters_project_images_wrap cmsmasters_rollover_img">';
		} else {
			echo '<div class="cmsmasters_project_images_wrap">';
		}		
			
			cleanora_thumb_rollover(get_the_ID(), $project_thumb_size, false, $rollover, false, false, false, false, false, $project_thumb_high, true, $cmsmasters_project_link_redirect, $cmsmasters_project_link_url, $cmsmasters_project_link_target);	

				$more ? cleanora_project_more(get_the_ID()) : '';
				
			
		echo '</div>';
		
		
		if ($title || $categories || $excerpt || $likes || $comments || $author) {
			echo '<div class="project_inner">';
				
				$title ? cleanora_project_heading(get_the_ID(), 'h2', $cmsmasters_project_link_redirect, $cmsmasters_project_link_url, $cmsmasters_project_link_target) : '';
			
				$excerpt ? cleanora_project_exc_cont() : '';			
				

				if ($categories || $author) {
					echo '<div class="cmsmasters_project_cont_info entry-meta">';

						$author ? cleanora_get_project_author() : '';
						$categories ? cleanora_get_project_category(get_the_ID(), 'pj-categs', 'page') : '';
						
					echo '</div>';
				}
				
				if ($comments || $likes) {
					echo '<footer class="cmsmasters_project_footer entry-meta">';
						
						$likes ? cleanora_get_project_likes('page') : '';
						
						$comments ? cleanora_get_project_comments('page') : '';
						
					echo '</footer>';
				}
				
			echo '</div>';
		}
		
		
		if (!$title) {
			echo '<div class="dn">';
				cleanora_project_heading(get_the_ID(), 'h6');
			echo '</div>';
		}
		
		echo '<span class="dn meta-date">' . get_the_time('YmdHis') . '</span>';
	?>
	</div>
</article>
<!-- Finish Project Grid Article  -->

