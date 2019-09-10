<?php
/**
 * The template for displaying all single posts.
 * 
 * User Profile: https://profiles.wordpress.org/fahimmurshed
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Golpo
 */

get_header(); ?>
<div class="container">
	<div class="row">
		<div id="primary" class="content-area col-md-9">
			<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', get_post_format() ); ?>

				<?php the_post_navigation(array(
					'prev_text'          => '<i class="fa fa-angle-double-left"></i> %title',
					'next_text'          => '%title <i class="fa fa-angle-double-right"></i>',
				)); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // End of the loop. ?>

			</main><!-- #main -->
		</div><!-- #primary -->
		<?php get_sidebar(); ?>
	</div>
</div>

<?php get_footer(); ?>
