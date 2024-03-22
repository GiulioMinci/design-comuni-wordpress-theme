<?php
global $post;

$max_posts = 6; // Numero massimo di notizie da mostrare

// Array per memorizzare le immagini e i titoli delle notizie
$images = array();
$titles = array();
$post_ids = array(); // Array per memorizzare gli ID dei post

$query = isset($_GET['search']) ? dci_removeslashes($_GET['search']) : null;
$args = array(
    's'         => $query,
    'post_type' => 'notizia',
    'posts_per_page' => $max_posts // Limita il numero di post
);

$the_query = new WP_Query($args);

// Popola gli array con le immagini, i titoli e gli ID dei post
if ($the_query->have_posts()) :
    while ($the_query->have_posts()) : $the_query->the_post();
        $img = dci_get_meta('immagine');
        if ($img) {
            $images[] = $img;
            $titles[] = get_the_title();
            $post_ids[] = $post->ID; // Memorizza l'ID del post
        }
    endwhile;
    wp_reset_postdata();
endif;
?>

<style>
.it-griditem-text {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    background-color: rgba(0, 0, 0, 0.5); /* Sfondo con trasparenza */
    color: #ffffff; /* Testo bianco */
    padding: 5px 10px; /* Padding per il contenuto */
    font-size: 14px; /* Dimensione del carattere */
    font-weight: bold; /* Grassetto */
    box-sizing: border-box; /* Calcola il padding e il bordo come parte della larghezza e dell'altezza dell'elemento */
}
.img-wrapper {
    position: relative;
}
</style>

<div class="it-grid-list-wrapper it-quilted-grid">
    <div class="grid-row">
        <!-- Colonna sinistra -->
        <div class="col-12 col-md-6">
            <?php if (!empty($images[0])) : ?>
                <div class="it-grid-item-wrapper ">
                    <a href="<?php echo get_permalink($post_ids[0]); ?>" class="it-griditem-overlay-link"> <!-- Aggiunto classe al link -->
                        <div class="img-responsive-wrapper">
                            <div class="img-responsive">
                                <div class="img-wrapper">
                                    <img src="<?php echo $images[0]; ?>" alt="<?php echo $titles[0]; ?>">
                                    <div class="card-overlay"><?php echo $titles[0]; ?></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endif; ?>
        </div>
        <!-- Colonna destra -->
        <div class="col-12 col-md-6">
            <div class="grid-row">
                <!-- Prima metà della colonna destra -->
                <div class="col-6">
                    <?php if (!empty($images[1])) : ?>
                        <div class="it-grid-item-wrapper">
                            <a href="<?php echo get_permalink($post_ids[1]); ?>" class="it-griditem-overlay-link"> <!-- Aggiunto classe al link -->
                                <div class="img-responsive-wrapper">
                                    <div class="img-responsive">
                                        <div class="img-wrapper">
                                            <img src="<?php echo $images[1]; ?>" alt="<?php echo $titles[1]; ?>">
                                            <div class="card-overlay"><?php echo $titles[1]; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
                <!-- Seconda metà della colonna destra -->
                <div class="col-6">
                    <?php if (!empty($images[2])) : ?>
                        <div class="it-grid-item-wrapper ">
                            <a href="<?php echo get_permalink($post_ids[2]); ?>" class="it-griditem-overlay-link"> <!-- Aggiunto classe al link -->
                                <div class="img-responsive-wrapper">
                                    <div class="img-responsive">
                                        <div class="img-wrapper">
                                            <img src="<?php echo $images[2]; ?>" alt="<?php echo $titles[2]; ?>">
                                            <div class="card-overlay"><?php echo $titles[2]; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <!-- Riga inferiore -->
            <div class="grid-row">
                <!-- Singola colonna -->
                <div class="col-12">
                    <?php if (!empty($images[3])) : ?>
                        <div class="it-grid-item-wrapper it-grid-item-double-w">
                            <a href="<?php echo get_permalink($post_ids[3]); ?>" class="it-griditem-overlay-link"> <!-- Aggiunto classe al link -->
                                <div class="img-responsive-wrapper">
                                    <div class="img-responsive">
                                        <div class="img-wrapper">
                                            <img src="<?php echo $images[3]; ?>" alt="<?php echo $titles[3]; ?>">
											<div class="card-overlay">
                                            <?php echo $titles[3]; ?>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
