<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Design_Comuni_Italia
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php
        if ( is_singular() ) :
            the_title( '<h1 class="entry-title">', '</h1>' );
        else :
            the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
        endif;
        ?>
    </header><!-- .entry-header -->

    <div class="container-border-top">
        <?php
        // Display the post content.
        the_content();
        ?>
    </div><!-- .container-border-top -->

    <?php
    // Esegui la ricerca dei servizi dal database e mostra i risultati
    global $wpdb;
    if (isset($_GET['s']) && !empty($_GET['s'])) {
        $search_query = '%' . $wpdb->esc_like($_GET['s']) . '%';
        $table_name = $wpdb->prefix . 'servizi_uau';

        $results = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT * FROM $table_name WHERE titolo LIKE %s OR areaTematica LIKE %s",
                $search_query,
                $search_query
            )
        );

        if ($results) {
            foreach ($results as $result) {
                // Visualizza i risultati dei servizi
                echo '<div class="search-result">';
                echo '<h2 class="entry-title"><a href="' . esc_url($result->url) . '">' . esc_html($result->areaTematica) . '</a></h2>';
                echo '<p>' . esc_html($result->titolo) . '</p>';
                echo '</div>';
            }
        } else {
            // Nessun risultato trovato
            echo '<p>Nessun risultato trovato.</p>';
        }
    }
    ?>
</article><!-- #post-<?php the_ID(); ?> -->
