 <section class="feed">
	<div id="main">
		<?php 

		$i = 0;
		// This is meant to be used with AJAX in order to make the post-layout one collumn or three
		function create_rows($binary) {

			// Getting total number of currently published posts
			$count_posts = wp_count_posts();
			$published_posts = $count_posts->publish;

			global $row_number;

			// Again, AJAX is meant to be used to feed in the argument "three"
			if ($binary = three) {
			
				// If number of posts is perfectly divisible by three, then make the amount of rows equal to the result
				if ($published_posts % 3 == 0) {
					$row_number = (int) ($published_posts / 3);
				}
				// If number of posts is NOT equally divisible by three, like with a decimal remainder, then add an extra row to even the collumns out
				else {
					$row_number = (int) ($published_posts / 3 ) + 1;
				}
			}
			elseif ($binary = one) {
				$row_number = $published_posts;
			}
		}

		create_rows(one);		
		?>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<?php
		// Begin new row
		if($i == 0) {
			echo '<div class="ng-row">';
		}
		?>

		<!-- Spit out HTML stylings for each post within the loop within here -->
		<div class="half">
			<?php the_content(); ?>
			<div class="buttons"> <a class="post-link" rel="<?php the_ID(); ?>" href="<?php the_permalink();?>">
				<?php echo get_comments_number( $post_id ); ?>
				<?php 
				if ((get_comments_number( $post_id )) == 1 ) {
					echo "Comment";
				}
				else {
					echo "Comments";
				}
				?>
				</a>
			</div>
		</div>
		<!-- Spit out HTML stylings for each post within the loop within here -->

		<?php
		// Closes the row once i is equal to the total amount of rows
		$i++;
		if($i == $row_number) {
			$i = 0;
			echo '</div>';
		}
		?>

		<?php endwhile; ?>
		<?php endif ?>
	</div>
</section>
