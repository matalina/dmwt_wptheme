<?php
/*
	Template Name: Accepted Requirements Table
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
					
<?php 
	rewind_posts();
	$loop = new WP_Query(array('post_type' => 'wtdb_character', 'nopaging' => true, 'orderby' => 'title', 'order' => 'ASC'));
	
	$novice_output = "";
	$accepted_output = "";
	$alt_output = "";
	$ret_output = "";
	$ws_output = "";
	
	while ( $loop->have_posts() ) {
		$loop->the_post();
		
		$custom = get_post_custom();
		
		if($custom['rank'][0] == 1) {
			$accepted_output .= "<tr>";
			$accepted_output .= "<tr><td class=\"wtdb_name\"><a href=\"".get_permalink()."\">".the_title('','',false)."</a></td>";
			if($custom['ac1'][0]) 
				$accepted_output .= "<td><a href=\"".$custom['ac1_link'][0]."\">Yes</a></td>";
			else 
				$accepted_output .= "<td>No</td>";	
			if($custom['ac2'][0]) 
				$accepted_output .= "<td><a href=\"".$custom['ac2_link'][0]."\">Yes</a></td>";
			else 
				$accepted_output .= "<td>No</td>";		
			if($custom['ac3'][0]) 
				$accepted_output .= "<td><a href=\"".$custom['ac3_link'][0]."\">Yes</a></td>";
			else 
				$accepted_output .= "<td>No</td>";	
			if($custom['my_ajah'][0] == "Yes") 
				$accepted_output .= "<td>Yes</td>";
			else 
				$accepted_output .= "<td>No</td>";			
			if($custom['aquiz'][0]) 
				$accepted_output .= "<td>Yes</td>";
			else 
				$accepted_output .= "<td>No</td>";	
			if($custom['oaths'][0]) 
				$accepted_output .= "<td><a href=\"".$custom['oaths'][0]."\">Yes</a></td>";
			else 
				$accepted_output .= "<td>No</td>";			
			$accepted_output .= "</tr>";	
		}
		
		}
	?>	
	<h2>Accepted Table</h2>
	<table class="wtdb_table">
		<thead>
			<tr>
				<th>Name</th>
				<th>AC1</th>
				<th>AC2</th>
				<th>AC3</th>
				<th>AJAH</th>
				<th>QUIZ</th>
				<th>OATH</th>
			</tr>
		</thead>
		<tbody>
			<?php echo $accepted_output;?>
		</tbody>
		</table>	

</div>
<?php } ?>
			</div><!-- #content -->
		</div><!-- #container -->

<?php get_footer(); ?>