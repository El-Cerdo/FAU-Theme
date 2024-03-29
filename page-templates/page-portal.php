<?php
/**
 * Template Name: Portalseite
 *
 * @package WordPress
 * @subpackage FAU
 * @since FAU 1.0
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

	<?php get_template_part('hero', 'small'); ?>

	<div id="content" class="content-portal">
		<div class="container">

			<div class="row">
							
				<div class="span8">
				    <?php if (function_exists('get_field')) { ?>
					<h2><?php the_field('headline'); ?></h2>
					<?php if( get_field('abstract') != ''): ?>
						<h3 class="abstract"><?php the_field('abstract'); ?></h3>
				    <?php endif; } ?>
							
					<?php the_content(); ?>
				</div>
				
				<div class="span4">
					<?php get_template_part('sidebar'); ?>
				</div>
				
			</div>

<?php endwhile; ?>
			
			<div class="hr"><hr></div>
			
			<?php  if (function_exists('get_field')) {
			    the_widget('FAUMenuSubpagesWidget', array('menu-slug' => get_field('portalmenu-slug')));
			  }
			?>

		</div>
	</div>

<?php get_footer(); ?>