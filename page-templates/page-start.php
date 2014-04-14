<?php
/**
 * Template Name: Startseite
 *
 * @package WordPress
 * @subpackage FAU
 * @since FAU 1.0
 */

get_header(); ?>

<?php $options = get_option('fau_theme_options', array('start_header_count' => 5, 'start_news_count' => 3)); ?>

	<div id="hero">
		<div id="hero-slides">
			
			<?php $hero_query = new WP_Query('category_name=header&posts_per_page='.$options['start_header_count']); ?>

			<?php while ($hero_query->have_posts()) : $hero_query->the_post(); ?>
				<div class="hero-slide">
					<?php the_post_thumbnail('hero'); ?>
					<div class="hero-slide-text">
						<div class="container">
							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2><br>
							<?php the_excerpt(); ?>
						</div>
					</div>
				</div>
			<?php endwhile; ?>
		
		</div>
		<div class="container">
			<div class="row">
				<div class="span3">
					<?php if(has_nav_menu('quicklinks-1')): ?>
						<h3><?php echo fau_get_menu_name('quicklinks-1'); ?></h3>
						<?php wp_nav_menu( array( 'theme_location' => 'quicklinks-1', 'container' => false, 'items_wrap' => '<ul class="menu-faculties %2$s">%3$s</ul>' ) ); ?>
					<?php endif; ?>
				</div>
				<div class="span3">
					<?php if(has_nav_menu('quicklinks-2')): ?>
						<h3><?php echo fau_get_menu_name('quicklinks-2'); ?></h3>
						<?php wp_nav_menu( array( 'theme_location' => 'quicklinks-2', 'container' => false, 'items_wrap' => '<ul class="%2$s">%3$s</ul>' ) ); ?>
					<?php endif; ?>
				</div>
				<div class="span3">
					<?php if(has_nav_menu('quicklinks-3')): ?>
						<h3><?php echo fau_get_menu_name('quicklinks-3'); ?></h3>
						<?php wp_nav_menu( array( 'theme_location' => 'quicklinks-3', 'container' => false, 'items_wrap' => '<ul class="%2$s">%3$s</ul>' ) ); ?>
					<?php endif; ?>
				</div>
				<div class="span3">
					<?php if(has_nav_menu('quicklinks-4')): ?>
						<h3><?php echo fau_get_menu_name('quicklinks-4'); ?></h3>
						<?php wp_nav_menu( array( 'theme_location' => 'quicklinks-4', 'container' => false, 'items_wrap' => '<ul class="%2$s">%3$s</ul>' ) ); ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>

	<div id="content">
		<div class="container">
			
			<?php if ( is_active_sidebar( 'banner-ad-right' ) ) : ?>
				<div class="banner-ad-right">
					<?php dynamic_sidebar( 'banner-ad-right' ); ?>
				</div>
			<?php endif; ?>
			
			<div class="row">
				<div class="span8">
					
					<?php $news_query = new WP_Query('tag=startseite&posts_per_page='.$options['start_news_count']); ?>
					<?php $i = 0; ?>
					<?php while ($news_query->have_posts()) : $news_query->the_post(); ?>
						
						<div class="news-item">
					
						<?php if($i > 0): ?>
							<h2>
						<?php else: ?>
							<h2>
						<?php endif; ?>
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h2>
						
						
							<div class="row">
								<?php if(has_post_thumbnail( $post->ID )): ?>
								<div class="span3">
									<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('post-thumb'); ?></a>
								</div>
								<div class="span5">
								<?php else: ?>
								<div class="span8">
								<?php endif; ?>
									<p><?php the_field('abstract'); ?> <a href="<?php the_permalink(); ?>" class="read-more-arrow">→</a></p>
								</div>
							</div>
						</div>
					
						<?php $i++; ?>
					<?php endwhile; ?>
					
					<?php
						$category = get_category_by_slug('news');
					?>
					
					<div class="news-more-links">
						<a class="news-more" href="<?php echo get_category_link($category->term_id); ?>">Mehr Meldungen</a>
						<a class="news-rss" href="<?php echo get_category_feed_link($category->term_id); ?>">RSS</a>
					</div>
					
				</div>
				<div class="span4">
					
					<?php $topevent_query = new WP_Query('tag=top&posts_per_page=1'); ?>
					<?php while ($topevent_query->have_posts()) : $topevent_query->the_post(); ?>
						<div class="widget">
							<h2 class="small"><a href="<?php the_permalink(); ?>"><?php the_field('topevent_title', $post->ID); ?></a></h2>
							<div class="row">
								<?php if(get_field('topevent_image', $post->ID)): ?>
									<div class="span2">
										<?php $image = wp_get_attachment_image_src(get_field('topevent_image', $post->ID), 'topevent-thumb'); ?>
										<a href="<?php the_permalink(); ?>"><img src="<?php echo $image[0]; ?>"></a>
									</div>
									<div class="span2">
								<?php else: ?>
									<div class="span4">
								<?php endif; ?>
									<?php
									/*
										$date = DateTime::createFromFormat('Ymd', get_field('topevent_date', $post->ID)); 
										$timestamp = $date->format('U');
										<div class="topevent-date"><?php echo date_i18n('j. F Y', $timestamp); ?></div>
										*/
									?>
									<div class="topevent-description"><?php the_field('topevent_description', $post->ID); ?></div>
									</div>
							</div>
						</div>
					<?php endwhile; ?>
					
					<?php if ( is_active_sidebar( 'sidebar-right' ) ) : ?>
						<?php dynamic_sidebar( 'sidebar-right' ); ?>
					<?php endif; ?>
				</div>
			</div>
			
			<?php if ( is_active_sidebar( 'menu-subpages' ) ) : ?>
				<div class="hr"><hr></div>
				<?php
					$widgets = wp_get_sidebars_widgets();
					$count = count($widgets['menu-subpages']);
				?>
				<div class="portal-subpages<?php if($count > 1) echo ' portal-subpages-tabs'; ?>">
					<?php dynamic_sidebar( 'menu-subpages' ); ?>
				</div>
			<?php endif; ?>
			
			<?php if ( is_active_sidebar( 'banner-area' ) ) : ?>
				<div class="hr"><hr></div>
				<?php dynamic_sidebar( 'banner-area' ); ?>
			<?php endif; ?>
			
			
			</div>
			<div id="social">
				<div class="container">
					<div class="row">
						<?php if($options['socialmedia']): ?>
							<div class="span3">
								<h2 class="small"><strong>FAU</strong>Social</h2>
								<ul class="social">
									<?php if($options['socialmedia_facebook']): ?>
										<li class="social social-facebook"><a href="<?php echo $options['socialmedia_facebook']; ?>" target="_blank"><?php echo $options['socialmedia_facebook_text']; ?></a></li>
									<?php endif; ?>
									<?php if($options['socialmedia_twitter']): ?>
										<li class="social social-twitter"><a href="<?php echo $options['socialmedia_twitter']; ?>" target="_blank"><?php echo $options['socialmedia_twitter_text']; ?></a></li>
									<?php endif; ?>
									<?php if($options['socialmedia_gplus']): ?>
										<li class="social social-gplus"><a href="<?php echo $options['socialmedia_gplus']; ?>" target="_blank"><?php echo $options['socialmedia_gplus_text']; ?></a></li>
									<?php endif; ?>
									<?php if($options['socialmedia_youtube']): ?>
										<li class="social social-youtube"><a href="<?php echo $options['socialmedia_youtube']; ?>" target="_blank"><?php echo $options['socialmedia_youtube_text']; ?></a></li>
									<?php endif; ?>
									<?php if($options['socialmedia_vimeo']): ?>
										<li class="social social-vimeo"><a href="<?php echo $options['socialmedia_vimeo']; ?>" target="_blank"><?php echo $options['socialmedia_vimeo_text']; ?></a></li>
									<?php endif; ?>
									<?php if($options['socialmedia_xing']): ?>
										<li class="social social-xing"><a href="<?php echo $options['socialmedia_xing']; ?>" target="_blank"><?php echo $options['socialmedia_xing_text']; ?></a></li>
									<?php endif; ?>
								</ul>
							</div>
						<?php endif; ?>
						<div class="span9">
							<?php if ( is_active_sidebar( 'social-media' ) ) : ?>
								<?php dynamic_sidebar( 'social-media' ); ?>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
			<div class="container">
			

		</div>
	</div>


<?php get_footer(); ?>