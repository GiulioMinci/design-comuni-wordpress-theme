<?php
// Recupera tutte le notizie
$args = array(
    'post_type'      => 'notizia', // Tipo di post notizia
    'posts_per_page' => 3, // Numero di notizie da mostrare (1 iniziale + 2 sotto)
    'meta_query'     => array(
        array(
            'key'     => '_dci_notizia_notizia_in_evidenza',
            'compare' => 'EXISTS', // Controlla se il campo esiste
        ),
    ),
);

$notizie_query = new WP_Query($args);
?>

<head>
    <style>
        .custom-row-padding {
            margin-bottom: 25px;
        }


        .col-md-4 {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .col-md-4 img {
            max-height: 186px;
            width: auto;
            object-fit: contain;
        }
    </style>
</head>
<body>

<?php

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
        $categoria_name = ucwords(strtolower($argomenti[0]->name)); 
        $categoria_link = get_term_link($argomenti[0]->term_id);
    }

    // Output della card con le informazioni del post
    ?>
   <!-- Card principale -->
<style>	
.custom-row-padding {
    padding-top: 15px; /* Aggiungi il padding superiore */
}

.card-img-with-bg {
    width: 100%;
    height: 0;
    padding-top: calc(100% * 0.75); /* Aspect ratio 4:3 */
    background-size: cover;
    background-position: center;
    position: relative;
    overflow: hidden;
}

.card-img-with-bg a {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
}

.card-img-with-bg a:hover {
    text-decoration: none;
}


	
	.card-img-with-bg img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Ridimensiona l'immagine per coprire l'intero contenitore mantenendo l'aspetto */
}
</style>		
	
	
<div class="col-sm-12">
    <div class="container">
        <div class="row custom-row-padding">
            <div class="col-md-4">
                <!-- Immagine con sfondo -->
                <div class="card-img-with-bg" style="background-image: url('<?php echo esc_url($img); ?>');">
                    <a href="<?php echo esc_url(get_permalink()); ?>" style="color: #008055 !important;"></a>
                </div>
            </div>
            <div class="col-md-8" style="background-color: #F9F9FA;">
                <div class="card p-0 border-0 bg-transparent">
                    <div class="card-body">
                        <h5 class="card-title custom-title" style="text-transform: uppercase;"><a href="<?php echo esc_url(get_permalink()); ?>" style="color: #008055 !important;"><?php echo esc_html(get_the_title()); ?></a></h5>
                        <p class="card-text" style="font-family: 'Titillium Web', sans-serif; font-size: 18px; font-weight: 400; line-height: 28px; text-align: left;"><?php echo esc_html($description); ?></p>
                        <p class="card-text">
                            <small class="text-muted"><a href="<?php echo esc_url($categoria_link); ?>" style="color: #008055 !important; font-family: 'Titillium Web', sans-serif; font-weight: 700; font-size: 16px; line-height: 24.34px;"><?php echo esc_html($categoria_name); ?></a></small>
                        </p>
                    </div>
                </div>
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

                // Le altre notizie
                ?>
<style>
    .col-md-4 {
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }
    .col-md-4 img {
        max-height: 186px;
        width: auto;
        object-fit: contain;
    }
</style>
<div class="col-sm-6">
    <div class="row">
        <div class="col-md-4 custom-left-col" style="background-color: #F9F9FA;">
            <a href="<?php echo esc_url(get_permalink()); ?>">
                <img src="<?php echo esc_url($img); ?>" class="card-img-top" title="<?php echo esc_attr(get_the_title()); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
            </a>
        </div>
        <div class="col-md-8" style="background-color: #F9F9FA;">
            <div class="card p-0 border-0 bg-transparent">
                <div class="card-body">
                    <h5 class="card-title" style="text-transform: uppercase;"><a href="<?php echo esc_url(get_permalink()); ?>" style="color: #008055 !important;"><?php echo esc_html(get_the_title()); ?></a></h5>
                    <p class="card-text">
<small class="text-muted"><a href="<?php echo esc_url($categoria_link); ?>" style="color: #008055 !important; font-family: 'Titillium Web', sans-serif; font-weight: 700; font-size: 16px; line-height: 24.34px;"><?php echo esc_html($categoria_name); ?></a></small>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
					
            <?php }
            wp_reset_postdata();
            ?>
        </div>
  
<?php } ?>