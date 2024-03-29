<?php
/**
 * Template Name: Inhaltsseite mit Navi
 *
 * @package WordPress
 * @subpackage FAU
 * @since FAU 1.0
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

	<?php get_template_part('hero', 'small'); ?>

	<div id="content">
		<div class="container">

			<div class="row">
			
				<div class="span4 span-sm-4">
					<?php 
						if (function_exists('get_field') && get_field('menu-level')) {
							$offset = get_field('menu-level');
						} else	{
							$offset = 2;
						}
					
						$parent_page = get_top_parent_page_id($id, $offset);
						$parent = get_page($parent_page);
					?>
					<h2 class="small menu-header">
						<a href="<?php echo get_permalink($parent->ID); ?>"><?php echo $parent->post_title; ?></a>
					</h2>
					<ul id="subnav">
					<?php wp_list_pages("child_of=$parent_page&title_li="); ?>
					</ul>
				</div>
				
				<div class="span8 span-sm-8">
					 <?php if (function_exists('get_field')) { ?>
					<h2><?php the_field('headline'); ?></h2>
					 <?php } 
					    if(function_exists('get_field') && get_field('abstract') != ''): ?>
						<h3 class="abstract"><?php the_field('abstract'); ?></h3>
					<?php endif; ?>
					
					<?php get_template_part('sidebar', 'inline'); ?>

					<?php the_content(); ?>
				</div>
				
			</div>
		</div>
	</div>
	
	
<?php endwhile; ?>

<?php get_footer(); ?>