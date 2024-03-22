<div class="card-wrapper centered responsive">
    <?php foreach ($posts as $post) {
        // Ottenere i valori specifici per ogni post all'interno del ciclo
        $img = dci_get_meta("immagine", '_dci_notizia_', $post->ID);
        $arrdata = dci_get_data_pubblicazione_arr("data_pubblicazione", '_dci_notizia_', $post->ID);
        $monthName = date_i18n('M', mktime(0, 0, 0, $arrdata[1], 10));
        $descrizione_breve = dci_get_meta("descrizione_breve", '_dci_notizia_', $post->ID);
        
        // Ottenere le categorie del post
        $argomenti = get_the_terms($post, 'argomenti');
    ?>
        <div class="card mb-1 col-sm-4">
            <div class="card-body">
                <div class="category-top">
                    <?php
                        // Verifica se ci sono categorie associate al post
                        if ($argomenti && !is_wp_error($argomenti)) {
                            // Itera su ogni categoria e visualizza il nome con le classi CSS desiderate
                            foreach ($argomenti as $argomento) {
                                echo '<a class="category chip chip-success chip-text-only text-uppercase text-center text-white rounded-pill" href="#"> ' . ucwords(strtolower(esc_html($argomento->name))) . ' </a>';
                            }
                        } else {
                            // Se non ci sono categorie, visualizza un messaggio di fallback
                            echo '<a class="category chip chip-success chip-text-only text-uppercase text-center text-white rounded-pill" href="#">Categoria Mancante</a>';
                        }
                    ?>
                    <?php if (is_array($arrdata) && count($arrdata)) { ?>
                        <span class="data"><?php echo $arrdata[0] . '/' . $arrdata[1] . '/' . $arrdata[2]; ?></span>
                    <?php } ?>
                </div>
                <h3 class="card-title big-heading h5" style="font-size: 18px;"><?php echo $post->post_title ?></h3>
                <a class="read-more" href="<?php echo get_permalink($post->ID); ?>">
                    <span class="text">Leggi tutto</span>
                    <svg class="icon"><use xlink:href="#it-arrow-right"></use></svg>
                </a>
                <p class="card-text font-serif" style="font-size: 16px;"><?php echo $descrizione_breve ?></p>
                <?php if ($img) { ?>
                    <div class="card-image-wrapper with-read-more pb-5">
                        <div class="card-image card-image-rounded pb-5">
                            <?php dci_get_img($img, 'img-fluid'); ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
</div>
