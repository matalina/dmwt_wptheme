<?php get_header(); ?>

		<div id="container" class="one-column">
			<div id="content" role="main">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<?php 
					$custom = get_post_custom(); 
					$potency = (int)$custom['skill'][0] + (int)$custom['str_final'][0];
				?>
							
				<div id="nav-above" class="navigation">
					<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'twentyten' ) . '</span> %title' ); ?></div>
					<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'twentyten' ) . '</span>' ); ?></div>
				</div><!-- #nav-above -->

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h1 class="entry-title"><?php the_title(); ?></h1>

					<div class="entry-meta">
						<?php //twentyten_posted_on(); ?>
						<?php
							wtdb_rank_output();
							if($custom['wilder'][0] == 'Yes')
								echo " | Wilder";
							echo " | ".$wtdb_status[$custom['status'][0]]." ".$wtdb_type[$custom['type'][0]]." played by ".$custom['handle'][0]." | ".$wtdb_tower[$custom['tower'][0]]." Tower | <a href=\"".$custom['bio_link'][0]."\">Wiki Link</a>";
						?>
					</div><!-- .entry-meta -->

					<div class="entry-content">
						<h2>Basic Information</h2>
						<strong class="label">Age:</strong><?php echo $custom['age'][0]; ?><br/>
						<strong class="label">Nation of origin:</strong><?php echo $custom['nation'][0]; ?><br/>
						<strong class="label">Hair:</strong><?php echo $custom['hair'][0]; ?><br/>
						<strong class="label">Eyes:</strong><?php echo $custom['eyes'][0]; ?><br/>
						<strong class="label">Skin:</strong><?php echo $custom['skin'][0]; ?><br/>
						<strong class="label">Height:</strong><?php echo $custom['height'][0]; ?><br/>
						<?php  if(!empty($custom['desc'][0]))  { ?>
						<strong class="label">Description:</strong><?php echo $custom['desc'][0]; ?><br/>
						<?php } ?>
						<?php  if(!empty($custom['voice'][0]))  { ?>
						<strong class="label">Voice:</strong><?php echo $custom['voice'][0]; ?><br/>
						<?php } ?>
						<?php  if(!empty($custom['person'][0]))  { ?>
						<strong class="label">Personality:</strong><?php echo $custom['person'][0]; ?><br/>
						<?php } ?>
						<?php  if(!empty($custom['skills'][0]))  { ?>
						<strong class="label">Special Skills:</strong><?php echo $custom['skills'][0]; ?><br/>
						<?php } ?>
						<?php  if(!empty($custom['weakness'][0]))  { ?>
						<strong class="label">Weaknesses:</strong><?php echo $custom['weakness'][0]; ?><br/>
						<?php } ?>
						<?php  if($custom['talent'][0] != 0)  { ?>
						<strong class="label">Talent:</strong><?php echo $wtdb_talent[$custom['talent'][0]]; ?><br/>
						<?php } ?>
						<?php  if($custom['ds'][0] != 0 ||!empty($custom['ds'][0]))  { ?>
						<strong class="label">Dream Score:</strong><?php echo $custom['ds'][0]; ?><br/>
						<?php } ?>
						<?php  if($custom['ws'][0] != 0 || !empty($custom['ws'][0]))  { ?>
						<strong class="label">Weapon Score:</strong><?php echo $custom['ws'][0]; ?><br/>
						<?php } ?>
						<br/>
						<h2>One Power Breakdown</h2>
						<table id="opscore">
						<thead>
							<tr><th>Air</th><th>Earth</th><th>Fire</th><th>Spirit</th><th>Water</th>><th>Strenth</th><th>Skill</th<th>Potency</th></tr>
						</thead>
						<tbody>
							<tr>
								<td><?php echo $custom['air'][0];?></td>
								<td><?php echo $custom['earth'][0];?></td>
								<td><?php echo $custom['fire'][0];?></td>
								<td><?php echo $custom['spirit'][0];?></td>
								<td><?php echo $custom['water'][0];?></td>
								<td><?php echo $custom['str_final'][0];
								if($custom['str_given'][0] > 0 || $custom['str_given'][0] != $custom['str_final'][0])
									echo "(".$custom['str_given'][0].")";?></td>								
								<td><?php echo $custom['skill'][0];
								if ($custom['special'][0] > 0)
								 echo "+".$custom['special'][0];?></td>
								<td><?php echo $potency;?></td>
							</tr>
						</tbody>
						</table>
						
						<?php
							if($custom['name1'][0] || $custom['name2'][0] || $custom['name3'][0] || $custom['name4'][0]) {
								?>
								
						<h2>Bonds</h2>	
								<?php
									if($custom['name1'][0]) {
										echo "Bonded to ".$custom['name1'][0]." of the ".$wtdb_warders[$custom['div1'][0]]." played by ".$custom['handle1'][0]."<br/>\n";
									}
									if($custom['name2'][0]) {
										echo "Bonded to ".$custom['name2'][0]." of the ".$wtdb_warders[$custom['div2'][0]]." played by ".$custom['handle2'][0]."<br/>\n";
									}
									if($custom['name3'][0]) {
										echo "Bonded to ".$custom['name3'][0]." of the ".$wtdb_warders[$custom['div3'][0]]." played by ".$custom['handle3'][0]."<br/>\n";
									}
									if($custom['name4'][0]) {
										echo "Bonded by ".$custom['name4'][0]." played by ".$custom['handle4'][0]."<br/>\n";
									}
								?>
							<br/>
								<?php
							}
						?>
						
						<h2>History</h2>
						<?php the_content(); ?>
				
						<h2>Requirements</h2>
						
						<?php
							if($custom['bio'][0] || $custom['op_breakdown'][0] || $custom['nquiz'][0] || $custom['mon'][0] || $custom['oprp'][0] || $custom['nc1'][0] || $custom['arches'][0]) {
								?>
								
							<h3>Novice</h3>	
							<table>
								<thead>
									<tr>
										<th>BIO</th>
										<th>QUZ</th>
										<th>OPBD</th>
										<th>MON</th>
										<th>OPRP</th>
										<th>NC1</th>
										<th>ARCH</th>
									</tr>
								</thead>
								<tbody>
								<tr>
								<?php
									if($custom['bio'][0] == 'Yes') 
										echo "<td>Yes</td>";
									else 
										echo "<td>No</td>";	
									if($custom['nquiz'][0] == 'Yes') 
										echo "<td>Yes</td>";
									else 
										echo "<td>No</td>";
									if($custom['op_breakdown'][0] == 'Yes') 
										echo "<td>Yes</td>";
									else 
										echo "<td>No</td>";	
									if($custom['mon'][0]) 
										echo "<td><a href=\"".$custom['mon'][0]."\">Yes</a></td>";
									else 
										echo "<td>No</td>";	
									if($custom['oprp'][0]) 
										echo "<td><a href=\"".$custom['oprp'][0]."\">Yes</a></td>";
									else 
										echo "<td>No</td>";		
									if($custom['nc1'][0]) 
										echo "<td><a href=\"".$custom['nc1_link'][0]."\">Yes</a></td>";
									else 
										echo "<td>No</td>";	
									if($custom['arches'][0]) 
										echo "<td><a href=\"".$custom['arches'][0]."\">Yes</a></td>";
									else 
										echo "<td>No</td>";	
								?>
								</tr>
								</tbody>
							</table>
								
								<?php
							}
						?>
						
						<?php
							if($custom['ac1'][0] || $custom['ac2'][0] || $custom['ac3'][0] || $custom['my_ajah'][0] || $custom['aquiz'][0] || $custom['oaths'][0]) {
								?>
								
							<h3>Accepted</h3>	
							<table>
							<thead>
							<tr>
								<th>AC1</th>
								<th>AC2</th>
								<th>AC3</th>
								<th>AJAH</th>
								<th>QUIZ</th>
								<th>OATH</th>
							</tr>	
							</thead>
							<tbody>		
								<tr>					
								<?php
								if($custom['ac1'][0]) 
									echo "<td><a href=\"".$custom['ac1_link'][0]."\">Yes</a></td>";
								else 
									echo "<td>No</td>";	
								if($custom['ac2'][0]) 
									echo "<td><a href=\"".$custom['ac2_link'][0]."\">Yes</a></td>";
								else 
									echo "<td>No</td>";		
								if($custom['ac3'][0]) 
									echo "<td><a href=\"".$custom['ac3_link'][0]."\">Yes</a></td>";
								else 
									echo "<td>No</td>";	
								if($custom['my_ajah'][0] == "Yes") 
									echo "<td>Yes</td>";
								else 
									echo "<td>No</td>";			
								if($custom['aquiz'][0]) 
									echo "<td>Yes</td>";
								else 
									echo "<td>No</td>";	
								if($custom['oaths'][0]) 
									echo "<td><a href=\"".$custom['oaths'][0]."\">Yes</a></td>";
								else 
									echo "<td>No</td>";	
								
							}
						?>
							</tr>
							</tbody>
						</table>
						<?php
							if($custom['train_ws'][0] != 0  || !empty($custom['ws'][0])) {
								?>
								
							<h3>Battle Readiness Score</h3>	
							<table>
							<thead>
								<th>BRS 0 - 1</th>
								<th>BRS 1 - 2</th>
								<th>BRS 2 - 3</th>
								<th>BRS 3 - 4</th>
								<th>BRS 4 - 5</th>
								<th>BRS 5 - 6</th>
								<th>BRS 6 - 7</th>
							</thead>
							<tbody>
							<tr>
							<?php
							if($custom['ws1'][0]) 
									echo "<td><a href=\"".$custom['ws1_link'][0]."\">Yes</a></td>";
								else 
									echo "<td>No</td>";	
							if($custom['ws2'][0]) 
									echo "<td><a href=\"".$custom['ws2_link'][0]."\">Yes</a></td>";
								else 
									echo "<td>No</td>";			
							if($custom['ws3'][0]) 
									echo "<td><a href=\"".$custom['ws3_link'][0]."\">Yes</a></td>";
								else 
									echo "<td>No</td>";	
							if($custom['ws4'][0]) 
									echo "<td><a href=\"".$custom['ws4_link'][0]."\">Yes</a></td>";
								else 
									echo "<td>No</td>";			
							if($custom['ws5'][0]) 
									echo "<td><a href=\"".$custom['ws5_link'][0]."\">Yes</a></td>";
								else 
									echo "<td>No</td>";		
							if($custom['ws6'][0]) 
									echo "<td><a href=\"".$custom['ws6_link'][0]."\">Yes</a></td>";
								else 
									echo "<td>No</td>";				
							if($custom['ws7'][0]) 
									echo "<td><a href=\"".$custom['ws7_link'][0]."\">Yes</a></td>";
								else 
									echo "<td>No</td>";			
											
							?>	
							</tr>
							</tbody>
							</table>
								<?php
							}
						?>
						
						<?php
							if($custom['all_aquiz'][0] || $custom['all_cd'][0] || $custom['six_ac1'][0] || $custom['six_ac2'][0] || $custom['six_ac3'][0] || $custom['six_ajah'][0] || $custom['six_oaths'][0]) {
								?>
								
							<h3>2nd or 3rd Character</h3>	
							<table>
							<thead>
							<tr>
								<th colspan="2">All</th><th colspan="4">After Six Months No play</th>
							</tr>
							<tr>
								<th>QUIZ</th>
								<th>CD</th>
								<th>AC1</th>
								<th>AC2</th>
								<th>AC3</th>
								<th>AJAH</th>
								<th>OATH</th>
							</tr>	
							</thead>
							<tbody>		
								<tr>					
								<?php
								if($custom['all_aquiz'][0]) 
									echo "<td>Yes</td>";
								else 
									echo "<td>No</td>";	
								if($custom['all_cd'][0]) 
									echo "<td><a href=\"".$custom['all_cd'][0]."\">Yes</a></td>";
								else 
									echo "<td>No</td>";		
								if($custom['six_ac1'][0]) 
									echo "<td><a href=\"".$custom['six_ac1_link'][0]."\">Yes</a></td>";
								else 
									echo "<td>No</td>";	
								if($custom['six_ac2'][0]) 
									echo "<td><a href=\"".$custom['six_ac2_link'][0]."\">Yes</a></td>";
								else 
									echo "<td>No</td>";	
								if($custom['six_ac3'][0]) 
									echo "<td><a href=\"".$custom['six_ac3_link'][0]."\">Yes</a></td>";
								else 
									echo "<td>No</td>";	
								if($custom['six_ajah'][0] == "Yes") 
									echo "<td>Yes</td>";
								else 
									echo "<td>No</td>";			

								if($custom['six_oaths'][0]) 
									echo "<td><a href=\"".$custom['six_oaths'][0]."\">Yes</a></td>";
								else 
									echo "<td>No</td>";	
								
						?>
							</tr>
							</tbody>
						</table>
								
						<?php
							}
						?>
						
						<?php
							if($custom['update_bio'][0] || $custom['ret_nquiz'][0] || $custom['ret_aquiz'][0] || $custom['ret_cd'][0]) {
								?>
								
							<h3>Returning Characters</h3>	
							<table>
							<thead>
							<tr>
								<th>All</th>
								<th>Aes Sedai</th>
								<th colspan="2">Aes Sedai after missing 1 year</th>
							</tr>
							<tr>
								<th>BIO</th>
								<th>CD</th>
								<th>NQUIZ</th>
								<th>AQUIZ</th>
							</tr>	
							</thead>
							<tbody>		
								<tr>					
								<?php
								if($custom['update_bio'][0]) 
									echo "<td>Yes</td>";
								else 
									echo "<td>No</td>";	
								if($custom['ret_cd'][0]) 
									echo "<td><a href=\"".$custom['ret_cd'][0]."\">Yes</a></td>";
								else 
									echo "<td>No</td>";		
								if($custom['ret_nquiz'][0]) 
									echo "<td><a href=\"".$custom['ret_nquiz'][0]."\">Yes</a></td>";
								else 
									echo "<td>No</td>";	
								if($custom['ret_aquiz'][0]) 
									echo "<td><a href=\"".$custom['ret_aquiz'][0]."\">Yes</a></td>";
								else 
									echo "<td>No</td>";	
								
						?>
							</tr>
							</tbody>
						</table>
								
						<?php
							}
						?>
						
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>
					</div><!-- .entry-content -->

					<div class="entry-utility">
						<?php twentyten_posted_in(); ?>
						<?php edit_post_link( __( 'Edit', 'twentyten' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-utility -->
				</div><!-- #post-## -->

				<div id="nav-below" class="navigation">
					<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'twentyten' ) . '</span> %title' ); ?></div>
					<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'twentyten' ) . '</span>' ); ?></div>
				</div><!-- #nav-below -->

<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #container -->

<?php get_footer(); ?>
