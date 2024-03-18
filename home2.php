<?php
/**
 * Template Name: Template home2
 * Template Post Type: post, page
 * Description: Questo è un template personalizzato.
 */
get_header();
?>


    <section id="notizie-hero" style="padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px ">
        <div id="primary" class="content-area">
            <main id="main" class="site-main">
                <?php
                $sectionToShow = isset($_GET['section']) ? $_GET['section'] : 'hero'; // Sezione predefinita
                if ($sectionToShow == 'hero') {
                    echo '<section id="hero-home" style="padding-left: 0px; padding-right: 0px; padding-top: 25px">';
                    get_template_part('template-parts/home/hero-singolo-home-giulio');
                    echo '</section>';
                } elseif ($sectionToShow == 'notizie') {
                    echo '<section id="news-home" style="padding-left: 0px; padding-right: 0px; padding-top: 25px">';
                    ?>
                    <div class="container"> <!-- Apertura container aggiunto per il secondo template part -->
                    <?php
                    get_template_part('template-parts/home/hero-notizie-home-giulio');
                    ?>
                    </div> <!-- Chiusura del container aggiunto -->
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
        <section id="notizie-home" style="padding-left: 0px; padding-right: 0px; padding-top: 50px; padding-bottom: 50px ">
            <h3 style="text-align: center;">Notizie</h3>
            <div style="height: 25px;"></div>

            <div class="row g-4" id="load-more">
                <?php
                $max_posts = isset($_GET['max_posts']) ? $_GET['max_posts'] : 8;
                $load_posts = 10;
                $query = isset($_GET['search']) ? dci_removeslashes($_GET['search']) : null;
                $args = array(
                    's'         => $query,
                    'post_type' => 'notizia'
                );

                $the_query = new WP_Query($args);
                $posts = $the_query->posts;

                usort($posts, function ($a, $b) {
                    return dci_get_data_pubblicazione_ts("data_pubblicazione", '_dci_notizia_', $b->ID) - dci_get_data_pubblicazione_ts("data_pubblicazione", '_dci_notizia_', $a->ID);
                });
                $posts = array_slice($posts, 0, $max_posts);

                foreach ($posts as $post) {
                    if ($post->post_type === 'notizia') {
                        // Aggiungi una condizione per verificare il post_type
                        // e includi solo le card delle notizie
                        $load_card_type = 'notizia';
                        get_template_part('template-parts/home/notizie-home-giulio-tris');
                    }
                }
                wp_reset_postdata();
                ?>
            </div>
        </section>

        <section id="comunicati-home" style="padding-left: 0px; padding-right: 0px; padding-top: 50px; padding-bottom: 50px;  ">
            <h3 style="text-align: center;">Comunicati Stampa</h3>
            <div style="height: 25px; "></div>

            <div class="row g-4; " id="load-more">
                <?php
                $max_posts = isset($_GET['max_posts']) ? $_GET['max_posts'] : 4;
                $load_posts = 1;
                $query = isset($_GET['search']) ? dci_removeslashes($_GET['search']) : null;
                $args = array(
                    's'         => $query,
                    'post_type' => 'notizia'
                );

                $the_query = new WP_Query($args);
                $posts = $the_query->posts;

                usort($posts, function ($a, $b) {
                    return dci_get_data_pubblicazione_ts("data_pubblicazione", '_dci_notizia_', $b->ID) - dci_get_data_pubblicazione_ts("data_pubblicazione", '_dci_notizia_', $a->ID);
                });
                $posts = array_slice($posts, 0, $max_posts);

                foreach ($posts as $post) {
                    if ($post->post_type === 'notizia') {
                        // Aggiungi una condizione per verificare il post_type
                        // e includi solo le card delle notizie
                        $load_card_type = 'notizia';
                        get_template_part('template-parts/home/comunicati-home-giulio-tris');
                    }
                }
                wp_reset_postdata();
                ?>
            </div>
        </section>

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
    </div>


<a href="?section=hero"><h2> Hero</h2></a>
<a href="?section=notizie"><h2> Notizie</h2></a>

<div class="row">
    <?php get_footer(); ?>
