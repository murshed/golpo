<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Golpo
 */

get_header(); ?>
	<div class="container">
		<div class="row">
			<div id="primary" class="content-area col-md-12">
				<main id="main" class="site-main" role="main">

				<?php if ( have_posts() ) : ?>

					<?php if ( is_home() && ! is_front_page() ) : ?>
						<header>
							<h2 class="page-title screen-reader-text"><?php single_post_title(); ?></h2>
						</header>
					<?php endif; ?>

					<?php while ( have_posts() ) : the_post(); ?>

						<?php
							get_template_part( 'template-parts/content', get_post_format() );
						?>

					<?php endwhile; ?>

					<?php
						the_posts_pagination( array(
							'mid_size' => 2,
							'prev_text' => '<i class="fa fa-angle-left"></i> ',
							'next_text' => ' <i class="fa fa-angle-right"></i>',
						));
					?>
				<?php else : ?>

					<?php get_template_part( 'template-parts/content', 'page' ); ?>

				<?php endif; ?>

				</main><!-- #main -->
			</div><!-- #primary -->
		</div><!-- .row -->
	</div><!-- .container -->
<?php get_footer(); ?>
