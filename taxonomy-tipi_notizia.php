<?php
/**
 * Archivi tassonomia Tipi Notizia
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#custom-taxonomies
 * @link https://italia.github.io/design-comuni-pagine-statiche/sito/lista-risorse.html
 *
 * @package Design_Comuni_Italia
 */

get_header();

// Recupera i parametri di ricerca dalla query string
$query = isset($_GET['search']) ? sanitize_text_field($_GET['search']) : '';
$selected_argomenti = isset($_GET['argomenti']) ? intval($_GET['argomenti']) : 0;

// Imposta i parametri della query
$args = array(
    's' => $query,
    'post_type' => 'notizia',
    'posts_per_page' => -1, // Mostra tutti i risultati senza paginazione
);

// Aggiungi filtro per argomenti se specificato
if ($selected_argomenti) {
    $args['tax_query'] = array(
        array(
            'taxonomy' => 'argomenti',
            'field'    => 'id',
            'terms'    => $selected_argomenti,
        ),
    );
}

// Esegui la query
$the_query = new WP_Query($args);

// Recupera tutti gli argomenti
$argomenti = get_terms(array(
    'taxonomy' => 'argomenti',
    'hide_empty' => true,
));
?>

<main>
    <div class="container" id="main-container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <?php get_template_part("template-parts/common/breadcrumb"); ?>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center row-shadow">
            <div class="col-12 col-lg-10">
                <div class="cmp-hero">
                    <section class="it-hero-wrapper bg-white align-items-start">
                        <div class="it-hero-text-wrapper pt-0 ps-0 pb-4 pb-lg-60">
                            <h1 class="text-black" data-element="page-name"><?php echo single_term_title('', false); ?></h1>
                            <?php the_archive_description('<div class="hero-text"> <p>', '</p> </div>'); ?>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-grey-card py-5">
        <form role="search" id="search-form" method="get" class="search-form" action="<?php echo esc_url(home_url('/tipi_notizia/notizie/')); ?>">
            <div class="container">
                <h2 class="title-xxlarge mb-4">
                    Esplora tutte le notizie
                </h2>
                <div>
                    <div class="cmp-input-search">
                        <div class="form-group autocomplete-wrapper mb-0">
                            <div class="input-group">
                                <label for="autocomplete-two" class="visually-hidden">Cerca</label>
                                <input type="search" class="autocomplete form-control" placeholder="Cerca per parola chiave"
                                    id="autocomplete-two" name="search" value="<?php echo $query; ?>"
                                    data-bs-autocomplete="[]" />
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit" id="button-3">
                                        Invio
                                    </button>
                                </div>
                                <span class="autocomplete-icon" aria-hidden="true"><svg class="icon icon-sm icon-primary"
                                        role="img" aria-labelledby="autocomplete-label">
                                        <use href="#it-search"></use>
                                    </svg>
                                </span>
                            </div>
                            <p id="autocomplete-label" class="u-grey-light text-paragraph-card mt-2 mb-30 mt-lg-3 mb-lg-40">
                                <?php echo $the_query->found_posts; ?> notizie trovate in ordine alfabetico
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="container">
        <div class="row mb-4">
            <div class="col-md-6">
                <form action="<?php echo esc_url(home_url('/tipi_notizia/notizie/')); ?>" method="get">
                    <select name="argomenti" class="form-select" onchange="this.form.submit()">
                        <option value="0">Tutti gli argomenti</option>
                        <?php foreach ($argomenti as $argomento) : ?>
                            <option value="<?php echo $argomento->term_id; ?>" <?php selected($selected_argomenti, $argomento->term_id); ?>><?php echo $argomento->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </form>
            </div>
        </div>

        <div class="row g-4" id="load-more">
            <?php
            if ($the_query->have_posts()) {
                while ($the_query->have_posts()) {
                    $the_query->the_post();
                    $load_card_type = 'notizia';
                    get_template_part('template-parts/novita/cards-list');
                }
                wp_reset_postdata();
            } else {
                echo '<p>Nessuna notizia trovata</p>';
            }
            ?>
        </div>
        <?php get_template_part("template-parts/search/more-results"); ?>
</div>

<?php get_template_part("template-parts/common/valuta-servizio"); ?>
<?php get_template_part("template-parts/common/assistenza-contatti"); ?>
	
	
