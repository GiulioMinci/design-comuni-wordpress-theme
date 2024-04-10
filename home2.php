<?php
/**
 * Template Name: Template home2
 * Template Post Type: post, page
 * Description: Questo è un template personalizzato.
 */
get_header();
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>

</head>
<body <?php body_class(); ?> style="overflow-x: hidden;">
<section id="notizie-hero" style="padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px ">
    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <?php
            $sectionToShow = isset($_GET['section']) ? $_GET['section'] : 'notizie'; 
            if ($sectionToShow == 'hero') {
                echo '<section id="hero-home" style="padding-left: 0px; padding-right: 0px; padding-top: 25px">';
                get_template_part('template-parts/home/hero-singolo-home-giulio');
                echo '</section>';
            } elseif ($sectionToShow == 'notizie') {
                echo '<section id="news-home" style="padding-left: 0px; padding-right: 0px; padding-top: 25px">';
                ?>
                <div class="container"> 
                <?php
                get_template_part('template-parts/home/hero-notizie-home-giulio');
                ?>
                </div> 
                <?php
                echo '</section>';
            }
            ?>
        </main>
    </div>
</section>


	
	
<div class="container">
    <div class="row">
        <section id="titolo-cards" style="padding-left: 0px; padding-right: 0px; padding-top: 50px">
            <h3 style="text-align: center;">Aree Tematiche</h3>
        </section>

        <section id="cards-home" style="padding-left: 0px; padding-right: 0px; padding-top: 25px">
            <?php get_template_part('template-parts/home/content', 'cards'); ?>
			

        </section>
    </div>
</div>

<div class="container">
    <section id="notizie-home" style="padding-left: 0px; padding-right: 0px; padding-top: 50px; padding-bottom: 50px">
        <h3 style="text-align: center;">Notizie</h3>
        <div style="height: 25px;"></div>
        <div class="row g-4" id="load-more-notizie">
            <?php
            $query_notizie = isset($_GET['search']) ? dci_removeslashes($_GET['search']) : null;
            $args_notizie = array(
                's'              => $query_notizie,
                'post_type'      => 'notizia',
                'posts_per_page' => 20,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'tipi_notizia',
                        'field'    => 'slug',
                        'terms'    => 'Notizie', 
                    ),
                ),
            );

            $the_query_notizie = new WP_Query($args_notizie);
            $displayed_posts_notizie = 0;

            while ($the_query_notizie->have_posts() && $displayed_posts_notizie < 3): $the_query_notizie->the_post();
                get_template_part('template-parts/home/notizie-home-giulio-tris');
                $displayed_posts_notizie++;
            endwhile;
            wp_reset_postdata();
            ?>
        </div>
    </section>

    <section id="comunicati-home" style="padding-left: 0px; padding-right: 0px; padding-top: 50px; padding-bottom: 50px">
        <h3 style="text-align: center;">Comunicati Stampa</h3>
        <div style="height: 25px;"></div>
        <div class="row g-4" id="load-more-comunicati">
            <?php
            // Criteri per i comunicati stampa
            $args_comunicati = array(
                's'              => $query_notizie,
                'post_type'      => 'notizia',
                'posts_per_page' => 20,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'tipi_notizia',
                        'field'    => 'slug',
                        'terms'    => 'Comunicati', 
                    ),
                ),
            );

            $the_query_comunicati = new WP_Query($args_comunicati);
            $displayed_posts_comunicati = 0;

            while ($the_query_comunicati->have_posts() && $displayed_posts_comunicati < 3): $the_query_comunicati->the_post();
                get_template_part('template-parts/home/comunicati-home-giulio-tris');
                $displayed_posts_comunicati++;
            endwhile;
            wp_reset_postdata();
            ?>
        </div>
    </section>
</div>

<section id="immaginievidenza" style="padding-left: 0px; padding-right: 0px; padding-top: 50px; padding-bottom: 50px ">
    <h3 style="text-align: center;">I Focus della Regione</h3>
    <div style="height: 25px;"></div>
    <section class="ultime-immagini">
        <div class="container">
            <div class="row">
                <?php get_template_part('template-parts/home/immaginievidenza'); ?>
            </div>
        </div>
    </section>

    <section id="comunicati-home" style="padding-left: 0px; padding-right: 0px; padding-top: 50px; padding-bottom: 50px ">
        <h3 style="text-align: center;">Campagne di Comunicazione</h3>
        <div style="height: 25px;"></div>
        <section class="campagne-sensibilizzazione">
            <div class="container">
                <div class="row">
                    <?php get_template_part('template-parts/home/campagne-home-giulio'); ?>
                </div>
            </div>
        </section>
    </section>
</section>

<a href="?section=hero"><h2> Hero</h2></a>
<a href="?section=notizie"><h2> Notizie</h2></a>

<?php get_footer(); ?>
</body>
</html>
