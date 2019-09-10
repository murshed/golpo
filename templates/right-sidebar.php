<?php
/**
 * Template Name: Right Sidebar
 * The template for displaying page right siderbar.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Golpo
 */
get_header(); ?>

    <div class="container">
        <div class="row">
            <div id="primary" class="content-area col-md-9">
                <main id="main" class="site-main" role="main">

                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php get_template_part( 'template-parts/content', 'custom' ); ?>

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