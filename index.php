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
		<p>This theme is a test to document http://mapsam.com/wordmap/ integration into a wordpress theme</p>
		<div id='map'></div>

		<script>
			var titles = [];
			var excerpts = [];
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
				echo '<article>';
					$name = the_title('', '', false);
					$ex = the_content('','',true);
					$lat = get_post_meta($post->ID, "coordinates_lat", true );
					$lon = get_post_meta($post->ID, "coordinates_lon", true );
					echo '<h1>lat: '.$lat.'</h1>';
					echo '<h1>lng: '.$lon.'</h1>';
				echo '</article>';
		?>
				
		<script>
			var name = <?php echo json_encode($name); ?>;
			var ex = <?php echo json_encode($ex); ?>;
			var lat = <?php echo json_encode($lat); ?>;
			var lon = <?php echo json_encode($lon); ?>;
			var id = <?php json_encode(the_ID()) ?>;
			titles.push(name);
			excerpts.push(ex);
			lats.push(parseFloat(lat));
			lons.push(parseFloat(lon));
			ids.push(parseInt(id));
		</script>
				
			<?php endwhile;
			wp_reset_postdata(); ?>
		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>
