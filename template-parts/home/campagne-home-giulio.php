<?php
global $post;

// Array per memorizzare le immagini e i titoli delle notizie
$images = array();
$titles = array();
$links = array(); // Array per memorizzare i link alle pagine delle notizie

$query = isset($_GET['search']) ? dci_removeslashes($_GET['search']) : null;
$args = array(
    's'         => $query,
    'post_type' => 'notizia',
    'posts_per_page' => -1 // Mostra tutti i post senza limiti
);

$the_query = new WP_Query($args);

// Popola gli array con le immagini, i titoli e i link delle notizie
if ($the_query->have_posts()) :
    while ($the_query->have_posts()) : $the_query->the_post();
        $img = dci_get_meta('immagine');
        if ($img) {
            $images[] = $img;
            $titles[] = get_the_title();
            $links[] = get_permalink(); // Ottieni il link alla pagina della notizia
        }
    endwhile;
    wp_reset_postdata();
endif;
?>

<style>
.card-wrapper {
    position: relative;
}

.card-overlay {
    position: absolute;
    bottom: 0; /* Posiziona il testo nel margine inferiore */
    left: 0;
    width: 100%;
    padding: 10px; /* Padding per il contenuto */
    box-sizing: border-box; /* Calcola il padding e il bordo come parte della larghezza e dell'altezza dell'elemento */
    background-color: rgba(0, 0, 0, 0.5); /* Sfondo con trasparenza */
    color: #ffffff; /* Testo bianco */
}

.card-title {
    margin: 0; /* Rimuovi il margine predefinito dal titolo */
    font-size: 1rem; /* Dimensione del carattere del titolo */
}
</style>

<div class="it-carousel-wrapper it-carousel-landscape-abstract-three-cols it-full-carousel it-standard-image splide" data-bs-carousel-splide>
    <div class="splide__track">
        <ul class="splide__list">
            <?php foreach ($images as $key => $image) : ?>
                <li class="splide__slide">
                    <div class="it-single-slide-wrapper">
                        <a href="<?php echo $links[$key]; ?>" class="card-wrapper">
                            <div class="card card-img no-after">
                                <div class="img-responsive-wrapper">
                                    <div class="img-responsive">
                                        <div class="img-wrapper"><img src="<?php echo $image; ?>" alt="<?php echo $titles[$key]; ?>"></div>
                                    </div>
                                </div>
                                <div class="card-overlay">
                                   <?php echo $titles[$key]; ?>
                                </div>
                            </div>
                        </a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
