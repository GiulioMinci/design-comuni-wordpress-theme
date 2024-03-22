<?php
// Recupera tutte le notizie
$args = array(
    'post_type' => 'notizia', // Tipo di post notizia
    'posts_per_page' => 3, // Numero di notizie da mostrare (1 iniziale + 2 sotto)
);

$notizie_query = new WP_Query($args);

// Verifica se ci sono notizie
if ($notizie_query->have_posts()) {
    // Recupera e mostra la prima notizia
    $notizie_query->the_post();

    // Recupera le informazioni del post
    $description = dci_get_meta('descrizione_breve');
    $img = dci_get_meta('immagine');
    $argomenti = get_the_terms(get_the_ID(), 'argomenti');

    // Verifica se il post ha argomenti
    $has_argomenti = $argomenti && !is_wp_error($argomenti);

    // Se il post ha argomenti, prendi solo il primo
    $categoria_name = '';
    $categoria_link = '';
    if ($has_argomenti) {
        $categoria_name = ucwords(strtolower($argomenti[0]->name)); // Converti il testo in minuscolo e metti la prima lettera in maiuscolo
        $categoria_link = get_term_link($argomenti[0]->term_id);
    }

    // Output della card con le informazioni del post
    ?>

    <!-- Card principale -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="it-carousel-wrapper it-carousel-landscape-abstract splide shadow p-3" data-bs-carousel-splide>
                    <div class="splide__track">
                        <ul class="splide__list">
                            <li class="splide__slide">
                                <div class="it-single-slide-wrapper">
                                    <a href="<?php echo esc_url(get_permalink()); ?>">
                                        <div class="img-responsive-wrapper">
                                            <div class="img-responsive">
                                                <div class="img-wrapper">
                                                    <img src="<?php echo esc_url($img); ?>" title="<?php echo esc_attr(get_the_title()); ?>" alt="<?php echo esc_attr($description); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="it-text-slider-wrapper-outside">
                                        <div class="card-wrapper">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title" style="font-family: 'Titillium Web', sans-serif; font-weight: 700; font-size: 28px; line-height: 40px; text-transform: uppercase;"><a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html(get_the_title()); ?></a></h5>
                                                    <p class="card-text" style="font-family: 'Titillium Web', sans-serif; font-weight: 400; font-size: 18px; line-height: 28px;"><?php echo esc_html($description); ?></p>
                                                    <p class="card-text">
                                                        <small class="text-muted"><a href="<?php echo esc_url($categoria_link); ?>"><?php echo esc_html($categoria_name); ?></a></small>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Nuova riga per le notizie successive -->

        <div class="row">
            <?php
            // Recupera e mostra le altre due notizie
            while ($notizie_query->have_posts()) {
                $notizie_query->the_post();

                // Recupera le informazioni del post
                $description = dci_get_meta('descrizione_breve');
                $img = dci_get_meta('immagine');
                $argomenti = get_the_terms(get_the_ID(), 'argomenti');

                // Verifica se il post ha argomenti
                $has_argomenti = $argomenti && !is_wp_error($argomenti);

                // Se il post ha argomenti, prendi solo il primo
                $categoria_name = '';
                $categoria_link = '';
                if ($has_argomenti) {
                    $categoria_name = ucwords(strtolower($argomenti[0]->name)); // Converti il testo in minuscolo e metti la prima lettera in maiuscolo
                    $categoria_link = get_term_link($argomenti[0]->term_id);
                }

                // Output della card con le informazioni del post per le notizie successive
                ?>

                <div class="col-sm-6 ">
                    <div class="it-carousel-wrapper it-carousel-landscape-abstract splide shadow p-3" data-bs-carousel-splide>
                        <div class="splide__track">
                            <ul class="splide__list">
                                <li class="splide__slide">
                                    <div class="it-single-slide-wrapper">
                                        <a href="<?php echo esc_url(get_permalink()); ?>">
                                            <div class="img-responsive-wrapper">
                                                <div class="img-responsive">
                                                    <div class="img-wrapper">
                                                        <img src="<?php echo esc_url($img); ?>" title="<?php echo esc_attr(get_the_title()); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="it-text-slider-wrapper-outside">
                                            <div class="card-wrapper">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h5 class="card-title" style="font-family: 'Titillium Web', sans-serif; font-weight: 700; font-size: 18px; line-height: 24px; text-transform: uppercase;"><a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html(get_the_title()); ?></a></h5>
                                                        <p class="card-text">
                                                            <small class="text-muted"><a href="<?php echo esc_url($categoria_link); ?>"><?php echo esc_html($categoria_name); ?></a></small>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            <?php }
            wp_reset_postdata();
            ?>
        </div>
    </div>
<?php } ?>
