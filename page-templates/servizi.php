<?php
/*
 * Template Name: Servizi
 * Descrizione: Pagina per visualizzare i servizi ottenuti dalle API
 */

get_header();
?>

<main>
    <?php
    while (have_posts()) :
        the_post();
        ?>
        <!-- Hero section -->
        <?php get_template_part("template-parts/hero/hero"); ?>

        <!-- Tutti i servizi section -->
        <?php get_template_part("template-parts/servizio/tutti-servizi"); ?>

        <!-- Container -->
        <div class="container">
            <!-- Carousel dei servizi -->
            <?php get_template_part('template-parts/home/carousel-servizi'); ?>

            <!-- Categorie dei servizi -->
            <?php get_template_part("template-parts/servizio/categorie"); ?>

            <!-- Valutazione dei servizi -->

            <!-- Contatti e assistenza -->
        </div>
        <?php
    endwhile; // End of the loop.
    ?>
</main>





<?php
get_footer();
?>
