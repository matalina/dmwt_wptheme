<?php
/*
	Template Name: Handle v. Character Listing
*/
?>
<?php get_header(); ?>

		<div id="container" class="one-column">
			<div id="content" role="main">

<?php if ( have_posts() ) { the_post() ?>
							
				<div id="nav-above" class="navigation">
					<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'twentyten' ) . '</span> %title' ); ?></div>
					<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'twentyten' ) . '</span>' ); ?></div>
				</div><!-- #nav-above -->

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h1 class="entry-title"><?php the_title(); ?></h1>

					<div class="entry-meta">
						<?php //twentyten_posted_on(); ?>
					</div><!-- .entry-meta -->

					<div class="entry-content">
					
<table class="wtdb_table">
	<thead>
		<tr>
			<th>Handle</th>
			<th>Name</th>
			<th>Rank</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
<?php 
	rewind_posts();
	$loop = new WP_Query(array('post_type' => 'wtdb_character', 'nopaging' => true, 'orderby' => 'meta_value', 'order' => 'ASC', 'meta_key' => 'handle'));
	while ( $loop->have_posts() ) {
		$loop->the_post();
		
		$custom = get_post_custom();
		$status = $wtdb_status[$custom['status'][0]];
		$dm_handle = $custom['handle'][0];
		$talent = $wtdb_talent[$custom['talent'][0]];
		$age = $custom['age'][0];
		$op = $custom['skill'][0]."(+".$custom['special'][0].")/".$custom['str_final'][0];
		
		
		echo "<tr><td>$dm_handle</td><td class=\"wtdb_name\"><a href=\"";
		the_permalink();
		echo "\">";
		the_title();
		echo "</a></td><td>";
		wtdb_rank_output();
		echo "</td><td>$status</td></tr>\n";
		
		}
	?>
	</tbody>
</table>	
</div>
<?php } ?>
			</div><!-- #content -->
		</div><!-- #container -->

<?php get_footer(); ?>