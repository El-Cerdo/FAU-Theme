<?php
/**
 * The template for displaying a single post.
 *
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
				<div class="span8">
					
					<?php get_template_part('content', 'news-single'); ?>
					<?php contutto_pdfbutton(); ?>
					
				</div>
			</div>

		</div>
	</div>
	
<?php endwhile; ?>

<?php get_footer(); ?>