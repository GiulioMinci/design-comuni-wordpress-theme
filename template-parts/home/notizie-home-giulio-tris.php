<?php 
    global $scheda;

    $description = dci_get_meta('descrizione_breve');
    $arrdata = dci_get_data_pubblicazione_arr("data_pubblicazione", '_dci_notizia_', $post->ID);
    $monthName = date_i18n('M', mktime(0, 0, 0, $arrdata[1], 10));
    $img = dci_get_meta('immagine');
    $argomenti = get_the_terms($post->ID, 'argomenti');

    // Verifica se il post ha argomenti
    $has_argomenti = $argomenti && !is_wp_error($argomenti);

    // Se il post ha argomenti, prendi solo il primo
    $categoria_name = '';
    $categoria_link = '';
    if ($has_argomenti) {
        $categoria_name = ucwords(strtolower($argomenti[0]->name)); // Converti il testo in minuscolo e metti la prima lettera in maiuscolo
        $categoria_link = get_term_link($argomenti[0]->term_id);
    }

    // Ottieni le categorie del post
    $categories = get_the_category();
    $category_list = wp_list_pluck($categories, 'name');
    $category_string = implode(', ', $category_list);

    // Ottieni le tassonomie del post
    $tipi_notizia_terms = get_the_terms($post->ID, 'tipi_notizia');
    $is_notizie = false;
    if ($tipi_notizia_terms && !is_wp_error($tipi_notizia_terms)) {
        foreach ($tipi_notizia_terms as $term) {
            if ($term->name === 'Notizie') {
                $is_notizie = true;
                break;
            }
        }
    }

    // Limita il titolo a 69 caratteri
    $titolo = get_the_title();
    $titolo_limite = strlen($titolo) > 36 ? mb_substr($titolo, 0, 24) . '...' : $titolo;

    // Se il titolo è corto, aggiungi una riga vuota
    if (strlen($titolo_limite) < 22) {
        $titolo_limite .= '<br>';
    }

    // Limita la descrizione a 78 caratteri
    $description_limite = mb_strimwidth($description, 0, 78, '...');

    // Verifica se il post è di tipo "notizie" e se ha un'immagine associata
    if ($has_argomenti && $img && $is_notizie) {
?>

<div class="col-md-6 col-xl-4">
    <div class="card-wrapper rounded " style="padding-left: 0px; padding-right: 0px;">

        <div class="card no-after rounded; shadow p-3;" style="background-color: rgba(255, 255, 255, 0.5);">
<div class="container"  >
            <div class="row" ;>
                <div class="col-md-12" style="padding-bottom: 24px;">
<div class="d-flex justify-content-between align-items-center mb-3" style="padding-top: 10px;">
<div class="chip chip-simple" style="background-color: #008055; ">
                            <a class="chip-label text-white" href="<?php echo $categoria_link; ?>"><?php echo $categoria_name; ?></a>
                        </div>
                        <span class="data" style="color: black;"><?php echo $arrdata[0].' '.strtoupper($monthName).' '.$arrdata[2]; ?></span>
                    </div>
                    <a class="text-decoration-none" href="<?php echo get_permalink(); ?>">
                        <h5 class="card-title" style="color: black; font-family: 'Titillium Web', sans-serif; font-size: 24px; line-height: 32px;"><?php echo $titolo_limite; ?></h5>
                    </a>
                    <p class="card-text text-secondary" style="font-family: Lora, serif; font-size: 16px; color: #333;">
                        <?php echo $description_limite; ?>
                    </p>
                    <div class="leggi-tutto">
                        <a href="<?php echo get_permalink(); ?>" style="text-decoration: none; color: black; font-family: 'Titillium Web', sans-serif; font-size: 14px; font-weight: bold;">
LEGGI TUTTO                            <img src="<?php echo get_template_directory_uri(); ?>/assets/svg/it-arrow-right.svg" alt="Freccia" style="vertical-align: middle;">
                        </a>
                    </div>
                </div>
            </div>
			
            <?php if ($img) { ?>
            <div class="img-responsive-wrapper" style="padding: 0;">
                <div class="img-responsive">
                    <figure class="img-wrapper">
                        <?php dci_get_img($img, ''); ?>
                    </figure>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
</div>
<?php } ?>
