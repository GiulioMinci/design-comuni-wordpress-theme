<?php
/* Template Name: Novità
 *
 * novita template file
 *
 * @package Design_Comuni_Italia
 */
global $post, $with_shadow;
$search_url = esc_url( home_url( '/' ));

get_header();
?>
<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>
	<main>
	<div class="container">
		
		
		
		<?php
		while ( have_posts() ) :
			the_post();
			
			$with_shadow = true;
			?>
		
    <nav class="breadcrumb-container" aria-label="Percorso di navigazione">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" style="color: #008055;">Home</a><span class="separator">/</span></li>
        <li class="breadcrumb-item active">Comunicati e Notizie<span class="separator">/</span></li>
      </ol>
    </nav>
<h3 style="color: #008055; text-align: center;">Comunicati Stampa e Notizie</h3>

		<?php get_template_part("template-parts/novita/evidenza"); ?>
			<?php get_template_part("template-parts/novita/tutte-novita"); ?>
			<?php get_template_part("template-parts/common/valuta-servizio"); ?>
		<?php 
			endwhile; // End of the loop.
		?>
		  </div>
	</main>

<?php
get_footer();
