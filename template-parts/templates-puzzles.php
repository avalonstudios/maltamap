<?php
/**
 * Template Name: Puzzles Page
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Malta_Map_Society
 */

get_header();
?>
<?php
if ( have_rows( 'images' ) ) {
	$puzzleArr = [];
	$img;
	while ( have_rows( 'images' ) ) { the_row();
		$title = get_sub_field( 'title' );
		$image = get_sub_field( 'image' );
		$image = wp_get_attachment_image_src( $image, 'medium_large' );
		$img[ 'title' ] = $title;
		$img[ 'src' ] = $image[0];
		$img[ 'width' ] = $image[1];
		$img[ 'height' ] = $image[2];
		array_push( $puzzleArr, $img );
	}
}
$puzzleJSON = json_encode( $puzzleArr );
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			<div id="collage">
				<div id="playPanel" style="padding:0;display:none;">
					<h3 id="imgTitle"></h3>
					<hr class="my-3">
					<div class="row" style="display:inline-block; margin:auto; width:100%; vertical-align:top;">
						<ul id="sortable" class="sortable col-sm-12 col-xl-8"></ul>
						<div id="actualImageBox" class="col-sm-6 col-xl-4">
							<div id="stepBox">
								<div>Steps:</div><div class="stepCount">0</div>
							</div>
							<div id="timeBox">
								<div>Time Taken: <span id="timerPanel"></span> secs</div>
							</div>
							<img id="actualImage" />
							<hr class="my-2">
							<span>Re-arrange to create a picture like this.</span>
							<div id="levelPanel" class="btn-group btn-group-toggle" data-toggle="buttons">
								<label class="btn btn-secondary active" for="easy">
									<input type="radio" name="level" id="easy" checked value="3" />Easy
								</label>

								<label class="btn btn-secondary" for="medium">
									<input type="radio" name="level" id="medium" value="4" />Medium
								</label>

								<label class="btn btn-secondary" for="hard">
									<input type="radio" name="level" id="hard" value="5" />Hard
								</label>

								<label class="btn btn-secondary" for="extreme">
									<input type="radio" name="level" id="extreme" value="8" />Extreme
								</label>
							</div>
							<hr class="my-2">
							<div>
								<button id="btnRule" type="button" class="tn btn-outline-dark" onclick="rules();">Rules</button>
								<button id="newPhoto" type="button" class="tn btn-outline-dark">Another Photo</button>
								<button id="btnReplay" type="button" class="tn btn-outline-dark" onclick="about();">About</button>
							</div>
						</div>
					</div>
				</div>
				<div id="gameOver" style="display:none;">
					<div style="background-color: #fc9e9e; padding: 5px 10px 20px 10px; text-align: center; ">
						<h2 style="text-align:center">Game Over!!</h2>
						Congratulations!! <br /> You have completed this picture.
						<br />
						Steps: <span class="stepCount">0</span> steps.
						<br />
						Time Taken: <span class="timeCount">0</span> seconds<br />
						<div>
							<button type="button" onclick="window.location.reload(true);">Play Again</button>
						</div>
					</div>
				</div>

				<script>
					var images = <?php echo $puzzleJSON; ?>;

					$(function () {
						var gridSize = $('#levelPanel :radio:checked').val();
						imagePuzzle.startGame(images, gridSize);
						
						$('#newPhoto').click(function () {
							var gridSize = $('#levelPanel :radio:checked').val();  // Take the updated gridSize from UI.
							imagePuzzle.startGame(images, gridSize);
						});

						$('#levelPanel :radio').change(function (e) {
							var gridSize = $(this).val();
							imagePuzzle.startGame(images, gridSize);
						});
					});
					function rules() {
						alert('Re arrange the image parts in a way that it correctly forms the picture. \nThe no. of steps taken will be counted.');
					}
					function about() {
						alert('Developed by Anurag Gandhi. \nHe can be contacted at: soft.gandhi@gmail.com');
					}
				</script>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
//get_sidebar();
get_footer();