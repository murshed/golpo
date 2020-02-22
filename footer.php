<?php
/**
 * The template for displaying the footer.
 *
 * User Profile: https://profiles.wordpress.org/fahimmurshed
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Golpo
 */

?>
</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container">
			<div class="row">
				<div class="col-sm">
					<div class="site-info">
					<?php /* translators: %s: Site Info */ ?>
						<?php echo wp_kses_post(get_theme_mod( 'footer_text', sprintf('<a href="%1$s">%2$s</a>', esc_url( esc_html__('//wordpress.org/', 'golpo')), __('Proudly powered by WordPress', 'golpo')) )); ?>
						<?php if(get_theme_mod( 'footer_love', 1)): ?>
							<span class="sep"> | </span>
							<?php /* translators: %s: Author */ ?>
							<?php printf( esc_html__( 'Golpo (The Story) theme by %1$s', 'golpo' ), '<a href="'.esc_url('//murshidalam.com/').'" rel="follow" target="_blank">Fahim Murshed</a>' ); ?>
						<?php endif; ?>
					</div><!-- .site-info -->
				</div>
				<div class="col-auto">
					<ul class="social-footer clearfix">
						<?php if( get_theme_mod( 'social_facebook' )): ?>
							<li><a href="<?php echo esc_url( get_theme_mod( 'social_facebook' ) ); ?>" class="facebook"><i class="fa fa-facebook"></i></a></li>
						<?php endif; ?>
						<?php if( get_theme_mod( 'social_twitter' )): ?>
							<li><a href="<?php echo esc_url( get_theme_mod( 'social_twitter' ) ); ?>" class="twitter"><i class="fa fa-twitter"></i></a></li>
						<?php endif; ?>
						<?php if( get_theme_mod( 'social_instagram' )): ?>
							<li><a href="<?php echo esc_url( get_theme_mod( 'social_instagram' ) ); ?>" class="instagram"><i class="fa fa-instagram"></i></a></li>
						<?php endif; ?>
						<?php if( get_theme_mod( 'social_github' )): ?>
							<li><a href="<?php echo esc_url( get_theme_mod( 'social_github' ) ); ?>" class="github"><i class="fa fa-github"></i></a></li>
						<?php endif; ?>
						<?php if( get_theme_mod( 'social_youtube' )): ?>
							<li><a href="<?php echo esc_url( get_theme_mod( 'social_youtube' ) ); ?>" class="youtube"><i class="fa fa-youtube"></i></a></li>
						<?php endif; ?>
					</ul>
				</div>
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->


<?php wp_footer(); ?>

</body>
</html>
