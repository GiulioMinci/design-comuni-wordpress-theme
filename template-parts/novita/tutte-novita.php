<?php
// Recupera i valori dei filtri
$query = isset($_GET['search']) ? sanitize_text_field($_GET['search']) : '';
$date_standard = isset($_GET['dateStandard']) ? sanitize_text_field($_GET['dateStandard']) : '';
$argomenti_selected = isset($_GET['argomenti']) ? intval($_GET['argomenti']) : '';

// Recupera tutti gli argomenti delle notizie
$argomenti = get_terms(array(
    'taxonomy'   => 'argomenti',
    'hide_empty' => true,
));

// Imposta i parametri della query
$args = array(
    'post_type'      => 'notizia',
    'posts_per_page' => 9,
    'orderby'        => 'date',
    'order'          => 'DESC',
    'offset'         => isset($_GET['offset']) ? intval($_GET['offset']) : 0, // Aggiunto offset
);

// Applica i filtri alla query
if (!empty($query)) {
    $args['s'] = $query;
}
if (!empty($date_standard)) {
    $args['date_query'] = array(
        array(
            'after'     => $date_standard, // Utilizza la data fornita direttamente
            'inclusive' => true,
        ),
    );
}
if (!empty($argomenti_selected)) {
    $args['tax_query'] = array(
        array(
            'taxonomy' => 'argomenti',
            'field'    => 'id',
            'terms'    => $argomenti_selected,
        ),
    );
}

// Esegui la query
$the_query = new WP_Query($args);
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caricamento dinamico dei risultati</title>
    <!-- Includi il file CSS -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">
</head>

<body>

    <div class="bg-white-card py-5">
        <div class="container">
            <div class="row align-items-center mb-4">
                <div class="col-md-4 mt-4 mt-md-0">
                    <form role="search" id="search-form" method="get" class="search-form d-flex align-items-center">
                        <div class="cmp-input-search mr-3">
                            <div class="form-group autocomplete-wrapper mb-0">
                                <label for="autocomplete-two" class="visually-hidden">Cerca</label>
                                <input type="search" class="autocomplete form-control" placeholder="Cerca per parola chiave"
                                    id="autocomplete-two" name="search" value="<?php echo esc_attr($query); ?>"
                                    data-bs-autocomplete="[]" />
                                <span class="autocomplete-icon" aria-hidden="true"><svg class="icon icon-sm icon-primary"
                                        role="img" aria-labelledby="autocomplete-label">
                                        <use href="#it-search"></use>
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <button class="btn btn-primary" type="submit" id="search-button">
                                Cerca
                            </button>
                        </div>
                    </form>
                </div>

                <div class="col-md-4 mt-4 mt-md-0">
                    <div class="form-group mb-0">
                        <select id="argomenti" name="argomenti" class="form-control">
                            <option value="">Tutti gli Argomenti</option>
                            <?php foreach ($argomenti as $argomento) { ?>
                                <option value="<?php echo esc_attr($argomento->term_id); ?>" <?php selected($argomenti_selected, $argomento->term_id); ?>><?php echo esc_html($argomento->name); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="col-md-4 mt-4 mt-md-0">
                    <div class="form-group mb-0">
                        <input type="date" id="dateStandard" name="dateStandard" class="form-control" value="<?php echo esc_attr($date_standard); ?>">
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <p id="autocomplete-label" class="u-grey-light text-paragraph-card mt-2 mb-0 mt-lg-3 mb-lg-0">
                <?php echo $the_query->found_posts; ?> notizie trovate in ordine alfabetico
            </p>
            <div class="row g-4" id="load-more">
                <?php
                // Loop attraverso i post
                if ($the_query->have_posts()) :
                    while ($the_query->have_posts()) : $the_query->the_post();
                        $load_card_type = 'notizia';
                        get_template_part('template-parts/novita/cards-list');
                    endwhile;
                    wp_reset_postdata();
                else :
                    echo '<p>Nessuna notizia trovata.</p>';
                endif;
                ?>
            </div>

            <!-- Pulsante "Carica altri risultati" -->
            <div class="d-flex justify-content-center mt-4" id="load-more-btn">
                <?php if ($the_query->max_num_pages > 1) : ?>
                    <button type="button" class="btn btn-primary" id="load-more-button">Carica altri risultati</button>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Includi il file JavaScript -->
    <script>
        document.getElementById('search-form').addEventListener('submit', function(event) {
            event.preventDefault();

            var query = document.getElementById('autocomplete-two').value.trim();
            var dateStandard = document.getElementById('dateStandard').value.trim();
            var argomentiId = document.getElementById('argomenti').value.trim();

            var url = window.location.pathname + '?search=' + encodeURIComponent(query) + '&dateStandard=' + encodeURIComponent(dateStandard) + '&argomenti=' + encodeURIComponent(argomentiId);
            
            window.location.href = url;    });

    document.getElementById('load-more-button').addEventListener('click', function() {
        var loadButton = this;
        var loadMoreDiv = document.getElementById('load-more');
        var queryParams = new URLSearchParams(window.location.search);
        var currentResultsCount = loadMoreDiv.children.length;
        var offset = currentResultsCount;

        queryParams.set('offset', offset);
        var newUrl = window.location.pathname + '?' + queryParams.toString();

        fetch(newUrl)
            .then(response => response.text())
            .then(data => {
                var parser = new DOMParser();
                var doc = parser.parseFromString(data, 'text/html');
                var newResults = doc.getElementById('load-more').children;

                for (var i = 0; i < newResults.length; i++) {
                    loadMoreDiv.appendChild(newResults[i].cloneNode(true));
                }

                var newResultsCount = newResults.length;
                if (newResultsCount < 9) {
                    loadButton.style.display = 'none';
                }
            })
            .catch(error => {
                console.error('Si è verificato un errore durante il caricamento dei risultati:', error);
            });
    });
</script>
</body>

</html>

       
