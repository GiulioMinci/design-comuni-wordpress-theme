<?php
/**
 * Template Name: Template di prova
 * Template Post Type: post, page
 * Description: Questo è un template personalizzato.
 */

get_header();
?>

<main id="main-container" class="main-container petrol">
    <?php get_template_part("template-parts/common/breadcrumb"); ?>
    
    <!-- Visualizza il contenuto della pagina -->
    <section class="section bg-gray-light">
        <div class="container">
            <div class="row variable-gutters d-flex justify-content-center">
                <div class="col-lg-8 pt84">
                    <?php
                    // Ottieni il contenuto della pagina
                    $page_content = get_post_field( 'post_content', get_the_ID() );
                    echo wpautop( do_shortcode( $page_content ) );
                    ?>
                </div>
            </div>
        </div>
    </section>

    <main id="main-container" class="main-container redbrown">
        <h1 class="visually-hidden">
            <?php echo dci_get_option("nome_comune"); ?>
        </h1>
        <section id="head-section">
            <h2 class="visually-hidden">Contenuti in evidenza</h2>
            <?php
            $messages = dci_get_option( "messages", "home_messages" );
            if($messages && !empty($messages)) {
                get_template_part("template-parts/home/messages");
            }
            ?>
            <?php get_template_part("template-parts/home/notizie"); ?>
      
			
<section id="notizie-home" style="padding-left: 0px; padding-right: 0px;">
    <h2 style="text-align: center;">Notizie</h2>
    <?php get_template_part("template-parts/home/card-notizie-evidenza"); ?>


</section>

			<section id="comunicati-home" style="padding-top: 50px; padding-left: 50px; padding-right: 50px;">
    <h2 style="text-align: center;">Comunicati Stampa</h2>
			</section>
    <?php get_template_part("template-parts/home/comunicati-stampa"); ?>

        </section>
		
        <?php get_template_part("template-parts/home/ricerca"); ?>

    </main>
	
</main>

<?php
get_footer();
?>
