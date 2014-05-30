<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package _s
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<div id='map' style ="position:relative; display: block; width:100%; height: 300px;"></div>test

		<script>
			var group = [];
			var lats = [];
			var lons = [];
			var ids = [];
		</script>

		<?php
		$args = array( 
			'post_type'			=> 'post',
			'posts_per_page'	=> 999
		);
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) :
			while ( $query->have_posts() ) : $query->the_post();
				$name = the_title('', '', false);
				$lat = get_post_meta($post->ID, "latitude", true );
				$lon = get_post_meta($post->ID, "longitude", true );
				?>
				<script>
					var name = <?php echo json_encode($name); ?>;
					var lat = <?php echo json_encode($lat); ?>;
					var lon = <?php echo json_encode($lon); ?>;
					var id = <?php json_encode(the_ID()) ?>;
					group.push(name);
					lats.push(parseFloat(lat));
					lons.push(parseFloat(lon));
					ids.push(parseInt(id));
				</script>
			<?php endwhile;
			wp_reset_postdata(); ?>
		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
<script>
var map = L.mapbox.map('map', 'examples.map-i86nkdio')
    .setView([39.0997, -94.5783], 9); 
</script>
