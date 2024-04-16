<?php
/**
 * Design Comuni Italia functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Design_Comuni_Italia
 */

/**
 * Funzionalità Trasversali
 */
require get_template_directory() . '/inc/funzionalita_trasversali.php';

/**
 * Load more posts
 */
require get_template_directory() . '/inc/load_more.php';

/**
 * Vocabolario
 */
require get_template_directory() . '/inc/vocabolario.php';

/**
 * Extend User Taxonomy
 */
require get_template_directory() . '/inc/extend-tax-to-user.php';

/**
 * Implement Plugin Activations Rules
 */
require get_template_directory() . '/inc/theme-dependencies.php';

/**
 * Implement CMB2 Custom Field Manager
 */
if ( ! function_exists ( 'dci_get_tipologia_articoli_options' ) ) {
	require get_template_directory() . '/inc/cmb2.php';
	require get_template_directory() . '/inc/backend-template.php';
}

/**
 * Utils functions
 */
require get_template_directory() . '/inc/utils.php';

/**
 * Breadcrumb class
 */
require get_template_directory() . '/inc/breadcrumb.php';

/**
 * Activation Hooks
 */
require get_template_directory() . '/inc/activation.php';

/**
 * Actions & Hooks
 */
require get_template_directory() . '/inc/actions.php';

/**
 * Gutenberg editor rules
 */
require get_template_directory() . '/inc/gutenberg.php';

/**
 * Welcome page
 */
require get_template_directory() . '/inc/welcome.php';

/**
 * main menu walker
 */
require get_template_directory() . '/walkers/main-menu.php';

/**
 * menu header right walker
 */
require get_template_directory() . '/walkers/menu-header-right.php';

/**
 * footer info walker
 */
require get_template_directory() . '/walkers/footer-info.php';

/**
 * Filters
 */
require get_template_directory() . '/inc/filters.php';

if ( ! function_exists( 'dci_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function dci_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Design Comuni Italia, use a find and replace
		 * to change 'design_comuni_italia' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'design_comuni_italia', get_template_directory() . '/languages' );


        load_theme_textdomain( 'easy-appointments', get_template_directory() . '/languages' );

        // Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

        // image size
        if ( function_exists( 'add_image_size' ) ) {
            add_image_size( 'article-simple-thumb', 500, 384 , true);
            add_image_size( 'item-thumb', 280, 280 , true);
            add_image_size( 'item-gallery', 730, 485 , true);
            add_image_size( 'vertical-card', 190, 290 , true);

            add_image_size( 'banner', 600, 250 , false);
        }

	}
endif;
add_action( 'after_setup_theme', 'dci_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function dci_widgets_init() {
}
add_action( 'widgets_init', 'dci_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function dci_scripts() {

    //wp_deregister_script('jquery');

	//load Bootstrap Italia latest css if exists in node_modules
    if (file_exists(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'node_modules/bootstrap-italia/dist/css/bootstrap-italia-comuni.min.css')) {
        wp_enqueue_style( 'dci-boostrap-italia-min', get_template_directory_uri() . '/node_modules/bootstrap-italia/dist/css/bootstrap-italia-comuni.min.css');
    }
    else {
        wp_enqueue_style( 'dci-boostrap-italia-min', get_template_directory_uri() . '/assets/css/bootstrap-italia.min.css');
    }
    wp_enqueue_style( 'dci-comuni', get_template_directory_uri() . '/assets/css/comuni.css', array('dci-boostrap-italia-min'));

    wp_enqueue_style( 'dci-font', get_template_directory_uri() . '/assets/css/fonts.css', array('dci-comuni'));
    wp_enqueue_style( 'dci-wp-style', get_template_directory_uri()."/style.css", array('dci-comuni'));


	wp_enqueue_script( 'dci-modernizr', get_template_directory_uri() . '/assets/js/modernizr.custom.js');

	// print css
    wp_enqueue_style('dci-print-style',get_template_directory_uri() . '/print.css', array(),'20190912','print' );

	// footer
    //load Bootstrap Italia latest js if exists in node_modules
    if (file_exists(dirname(__FILE__) . DIRECTORY_SEPARATOR . '/node_modules/bootstrap-italia/dist/js/bootstrap-italia.bundle.min.js')) {
        wp_enqueue_script( 'dci-boostrap-italia-min-js', get_template_directory_uri() . '/node_modules/bootstrap-italia/dist/js/bootstrap-italia.bundle.min.js', array(), false, true);
    }
    else {
        wp_enqueue_script( 'dci-boostrap-italia-min-js', get_template_directory_uri() . '/assets/js/bootstrap-italia.bundle.min.js', array(), false, true);
    }
	wp_enqueue_script( 'dci-comuni', get_template_directory_uri() . '/assets/js/comuni.js', array(), false, true);
	wp_add_inline_script( 'dci-comuni', 'window.wpRestApi = "' . get_rest_url() . '"', 'before' );

	wp_enqueue_script( 'dci-jquery-easing', get_template_directory_uri() . '/assets/js/components/jquery-easing/jquery.easing.js', array(), false, true);
	wp_enqueue_script( 'dci-jquery-scrollto', get_template_directory_uri() . '/assets/js/components/jquery.scrollto/jquery.scrollTo.js', array(), false, true);
	wp_enqueue_script( 'dci-jquery-responsive-dom', get_template_directory_uri() . '/assets/js/components/ResponsiveDom/js/jquery.responsive-dom.js', array(), false, true);
	wp_enqueue_script( 'dci-jpushmenu', get_template_directory_uri() . '/assets/js/components/jPushMenu/jpushmenu.js', array(), false, true);
	wp_enqueue_script( 'dci-perfect-scrollbar', get_template_directory_uri() . '/assets/js/components/perfect-scrollbar-master/perfect-scrollbar/js/perfect-scrollbar.jquery.js', array(), false, true);
	wp_enqueue_script( 'dci-vallento', get_template_directory_uri() . '/assets/js/components/vallenato.js-master/vallenato.js', array(), false, true);
	wp_enqueue_script( 'dci-jquery-responsive-tabs', get_template_directory_uri() . '/assets/js/components/responsive-tabs/js/jquery.responsiveTabs.js', array(), false, true);
	wp_enqueue_script( 'dci-fitvids', get_template_directory_uri() . '/assets/js/components/fitvids/jquery.fitvids.js', array(), false, true);
	wp_enqueue_script( 'dci-sticky-kit', get_template_directory_uri() . '/assets/js/components/sticky-kit-master/dist/sticky-kit.js', array(), false, true);
	
	wp_enqueue_script( 'dci-jquery-match-height', get_template_directory_uri() . '/assets/js/components/jquery-match-height/dist/jquery.matchHeight.js', array(), false, true);

	if(is_singular(array("servizio", "struttura", "luogo", "evento", "scheda_progetto", "post", "circolare", "indirizzo")) || is_archive() || is_search() || is_post_type_archive("luogo")) {
		wp_enqueue_script( 'dci-leaflet-js', get_template_directory_uri() . '/assets/js/components/leaflet/leaflet.js', array(), false, true);
    }

	if(is_singular(array("evento","scheda_progetto")) || is_home() || is_archive() ){
		wp_enqueue_script( 'dci-clndr-json2', get_template_directory_uri() . '/assets/js/components/clndr/json2.js', array(), false, false);
		wp_enqueue_script( 'dci-clndr-moment', get_template_directory_uri() . '/assets/js/components/clndr/moment.js', array(), false, false);
		wp_enqueue_script( 'dci-clndr-underscore', get_template_directory_uri() . '/assets/js/components/clndr/underscore.js', array(), false, false);
		wp_enqueue_script( 'dci-clndr-clndr', get_template_directory_uri() . '/assets/js/components/clndr/clndr.js', array(), false, false);
		wp_enqueue_script( 'dci-clndr-it', get_template_directory_uri() . '/assets/js/components/clndr/it.js', array(), false, false);
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'dci_scripts' );

function add_menu_link_class( $atts, $item, $args ) {
	if (property_exists($args, 'link_class')) {
	  $atts['class'] = $args->link_class;
	}
	return $atts;
  }
  add_filter( 'nav_menu_link_attributes', 'add_menu_link_class', 1, 3 );

  function add_menu_list_item_class($classes, $item, $args) {
	if (property_exists($args, 'list_item_class')) {
		$classes[] = $args->list_item_class;
	}
	return $classes;
  }
  add_filter('nav_menu_css_class', 'add_menu_list_item_class', 1, 3);

  function max_nav_items($sorted_menu_items, $args){
    if (property_exists($args, 'li_slice')) {
		$slice = $args->li_slice;
		$items = array();
		foreach($sorted_menu_items as $item){
			if($item->menu_item_parent != 6) continue;
			$items[] = $item;
		}
		$items = array_slice($items, $slice[0], $slice[1]);
		foreach($sorted_menu_items as $key=>$one_item){
			if($one_item->menu_item_parent == 0 && !in_array($one_item,$items)){
				unset($sorted_menu_items[$key]);
			}
		}
	}
    return $sorted_menu_items;
}
add_filter("wp_nav_menu_objects","max_nav_items",10,2);

function console_log ($output, $msg = "log") {
    echo '<script> console.log("'. $msg .'",'. json_encode($output) .')</script>';
};

function get_parent_template () {
	return basename( get_page_template_slug( wp_get_post_parent_id() ) );
}

 // Restituisce il formato e le dimensioni di un allegato
function getFileSizeAndFormat($url) {
    $percorso = parse_url($url);
    $percorso = isset($percorso["path"]) ? substr($percorso["path"], 0, -strlen(pathinfo($url, PATHINFO_BASENAME))) : '';
    $response = wp_remote_head($url);

    if (is_wp_error($response)) {
        return 'Errore nel recupero delle informazioni del file';
    }

    $headers = wp_remote_retrieve_headers($response);
    $content_length = isset($headers['content-length']) ? intval($headers['content-length']) : 0;

    $base = log($content_length, 1024);
    $suffixes = array('', 'Kb', 'Mb', 'Gb', 'Tb');
    $size_formatted = round(pow(1024, $base - floor($base)), 2) . ' ' . $suffixes[floor($base)];

    $info_file = pathinfo($url);
    $file_format = strtoupper(isset($info_file['extension']) ? $info_file['extension'] : '');

    return $file_format . ' ' . $size_formatted;
}




/**
 * Genera un PDF dal contenuto della pagina e lo salva nella directory wp-content/uploads/pdf_generati
 *
 * @param string $content Il contenuto della pagina da convertire in PDF
 * @param string $title Il titolo della pagina per denominare il file PDF
 * @return string|false Restituisce l'URL del PDF generato o false in caso di errore
 */
function generate_pdf_from_page_content($content, $title) {
    require_once(ABSPATH . 'wp-content/themes/design-comuni-wordpress-theme-main/inc/lib/TCPDF/tcpdf.php');

    // Crea un nuovo oggetto TCPDF
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // Imposta il formato della pagina e le informazioni del documento
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Your Name');
    $pdf->SetTitle($title);
    $pdf->SetSubject('Generated PDF');
    $pdf->SetKeywords('PDF, WordPress, Generate');

    // Imposta i margini
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // Imposta il tipo di carattere
    $pdf->SetFont('helvetica', '', 10);

    // Aggiungi una pagina
    $pdf->AddPage();

    // Scrivi il contenuto della pagina nel PDF
    $pdf->writeHTML($content, true, false, true, false, '');

    // Genera il nome del file PDF usando il titolo della pagina
    $filename = sanitize_title($title) . '.pdf';

    // Salva il PDF nella directory specificata
    $upload_dir = wp_upload_dir();
    $pdf_dir = trailingslashit($upload_dir['basedir']) . 'pdf_generati/';
    $pdf_path = $pdf_dir . $filename;

    // Crea la directory se non esiste
    if (!file_exists($pdf_dir)) {
        wp_mkdir_p($pdf_dir);
    }

    // Salva il PDF
    $pdf->Output($pdf_path, 'F');

    // Restituisci l'URL del PDF generato
    $pdf_url = trailingslashit($upload_dir['baseurl']) . 'pdf_generati/' . $filename;
    return $pdf_url;
}





add_action('save_post_documento_pubblico', 'dci_salva_urn_normativa_regionale', 10, 3);
function dci_salva_urn_normativa_regionale($post_id, $post, $update) {
    // Evita l'esecuzione durante i salvataggi automatici
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    
    // Verifica dei permessi
    if (!current_user_can('edit_post', $post_id)) return;

    $tipo_atto = isset($_POST['_dci_tipo_atto']) ? $_POST['_dci_tipo_atto'] : '';
    $data_emissione = isset($_POST['_dci_data_emissione']) ? $_POST['_dci_data_emissione'] : '';
    $numero_atto = isset($_POST['_dci_numero_atto']) ? $_POST['_dci_numero_atto'] : '';
    $autorita_emittente = isset($_POST['_dci_autorita_emittente']) ? $_POST['_dci_autorita_emittente'] : '';

    // Crea l'URN. 
    $urn = "urn:nir:regione:" . sanitize_title($autorita_emittente) . ":" . sanitize_title($tipo_atto) . ":" . date('Y-m-d', strtotime($data_emissione)) . ":" . sanitize_text_field($numero_atto);

    // Salva l'URN come metadato del post
    update_post_meta($post_id, '_dci_urn', $urn);
}

function aggiungi_query_var_personalizzate($vars) {
    $vars[] = 'urn'; // Assicurati che 'urn' sia riconosciuto come una query var valida
    return $vars;
}
add_filter('query_vars', 'aggiungi_query_var_personalizzate');







add_action('template_redirect', 'gestisci_richiesta_urn_custom');
function gestisci_richiesta_urn_custom() {
    $query_str = isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : '';
    $urn_prefix = 'urn:nir:';
    $urn = '';

    if (substr($query_str, 0, strlen($urn_prefix)) === $urn_prefix) {
        $urn = urldecode($query_str); // Decodifica l'URN
        $urn = sanitize_text_field($urn); // Sanifica l'URN per la sicurezza

        // Logica per cercare il post basato sull'URN nel tipo di post documento_pubblico
        $args = array(
            'post_type' => 'documento_pubblico', // Specifica il tipo di post custom
            'meta_query' => array(
                array(
                    'key' => '_dci_urn', // Assicurati che corrisponda al campo meta effettivo
                    'value' => $urn,
                    'compare' => '='
                )
            ),
            'posts_per_page' => 1
        );
        $query = new WP_Query($args);

        if ($query->have_posts()) {
            $query->the_post();
            wp_redirect(get_permalink()); // Reindirizza alla pagina del post trovato
            exit;
        } else {
            wp_redirect(home_url('/404')); // Nessun post trovato con quell'URN, reindirizza a una pagina di errore
            exit;
        }
    }
}




// Definisci una funzione per ottenere i metadata personalizzati dei post
function get_custom_post_metadata() {
    global $wpdb;
    
    $query = "SELECT post_id,
                     MAX(CASE WHEN meta_key = '_dci_notizia_immagine_id' THEN meta_value END) AS image_id,
                     MAX(CASE WHEN meta_key = '_dci_notizia_immagine' THEN meta_value END) AS image_url,
                     MAX(CASE WHEN meta_key = '_dci_notizia_descrizione_breve' THEN meta_value END) AS description,
                     MAX(CASE WHEN meta_key = '_dci_notizia_data_pubblicazione' THEN meta_value END) AS publication_date,
                     MAX(CASE WHEN meta_key = '_dci_notizia_data_scadenza' THEN meta_value END) AS expiration_date,
                     MAX(CASE WHEN meta_key = '_dci_notizia_testo_completo' THEN meta_value END) AS full_text
              FROM {$wpdb->prefix}postmeta
              GROUP BY post_id";
    $results = $wpdb->get_results($query, ARRAY_A);

    // Rimuovi le stringhe HTML, le classi delle div e i caratteri di nuova riga dal campo full_text
    foreach ($results as &$result) {
        if (isset($result['full_text'])) {
            $result['full_text'] = strip_tags($result['full_text']); // Rimuovi le stringhe HTML
            $result['full_text'] = preg_replace('/<div[^>]*>/', '', $result['full_text']); // Rimuovi le div aperte
            $result['full_text'] = preg_replace('/<\/div>/', '', $result['full_text']); // Rimuovi le div chiuse
            $result['full_text'] = str_replace("\n", "", $result['full_text']); // Rimuovi i caratteri di nuova riga
			$result['full_text'] = str_replace("\r", "", $result['full_text']); // Rimuovi i caratteri di ritorno a capo
            $result['full_text'] = str_replace("\r\n", "", $result['full_text']); // Rimuovi i caratteri di ritorno a capo e nuova riga consecutivi
            $result['full_text'] = str_replace("\r\r", "", $result['full_text']); // Rimuovi i caratteri di ritorno a capo consecutivi
            $result['full_text'] = str_replace("\n\n", "", $result['full_text']); // Rimuovi i caratteri di nuova riga consecutivi
			$result['full_text'] = str_replace("\r\n\r\n", "", $result['full_text']); // Rimuovi i caratteri di nuova riga consecutivi
			$result['full_text'] = str_replace("\r\n\r\n", "", $result['full_text']); // Rimuovi i caratteri di nuova riga consecutivi
			            $result['full_text'] = strip_tags($result['full_text']); // Rimuovi le stringhe HTML
            $result['full_text'] = preg_replace('/<div[^>]*>/', '', $result['full_text']); // Rimuovi le div aperte
            $result['full_text'] = preg_replace('/<\/div>/', '', $result['full_text']); // Rimuovi le div chiuse
            $result['full_text'] = str_replace("\n", "", $result['full_text']); // Rimuovi i caratteri di nuova riga
			$result['full_text'] = str_replace("\r", "", $result['full_text']); // Rimuovi i caratteri di ritorno a capo
            $result['full_text'] = str_replace("\r\n", "", $result['full_text']); // Rimuovi i caratteri di ritorno a capo e nuova riga consecutivi
            $result['full_text'] = str_replace("\r\r", "", $result['full_text']); // Rimuovi i caratteri di ritorno a capo consecutivi
            $result['full_text'] = str_replace("\n\n", "", $result['full_text']); // Rimuovi i caratteri di nuova riga consecutivi
			$result['full_text'] = str_replace("\r\n\r\n", "", $result['full_text']); // Rimuovi i caratteri di nuova riga consecutivi
			


        }
    }

    // Filtra i risultati per rimuovere quelli con tutti i campi null (eccetto "post_id")
    $filtered_results = array_filter($results, function($item) {
        // Rimuovi il campo "post_id" dalla valutazione
        unset($item['post_id']);
        // Verifica se tutti gli altri campi sono nulli
        return !empty(array_filter($item));
    });
	
	



    // Restituisci i risultati filtrati
    return $filtered_results;
}

// Registra una route per l'API
add_action('rest_api_init', function () {
    register_rest_route('api', '/documenti', array(
        'methods' => 'GET',
        'callback' => 'get_custom_post_metadata',
    ));
});


// ricerca su notizie
// Avvia la sessione
session_start();

// Funzione per impostare gli argomenti selezionati nella sessione
function set_selected_argomenti($argomenti_selected) {
    $_SESSION['selected_argomenti'] = $argomenti_selected;
}

// Funzione per ottenere gli argomenti selezionati dalla sessione
function get_selected_argomenti() {
    return isset($_SESSION['selected_argomenti']) ? $_SESSION['selected_argomenti'] : '';
}
<<<<<<< Updated upstream










// Assicuriamoci che il codice venga eseguito correttamente
error_log("Il codice sta per essere eseguito.");

// Controllo se la tabella esiste già
global $wpdb;
$table_name = $wpdb->prefix . 'servizi_uau';

if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
    // La tabella non esiste, quindi la creiamo
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        titolo varchar(255) NOT NULL,
        url varchar(255) NOT NULL,
        ente varchar(255) NOT NULL,
        areaTematica varchar(255) NOT NULL,
        materie text NOT NULL,
        uffici varchar(255) NOT NULL,
        dataPrimaPubblicazione datetime NOT NULL,
        dataUltimoAggiornamento datetime NOT NULL,
        stato varchar(255) NOT NULL,
        visualizzazioni mediumint(9) NOT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);

    // Aggiungiamo un messaggio di debug
    error_log("La tabella è stata creata con successo.");
} else {
    // La tabella esiste già
    // Aggiungiamo un messaggio di debug
    error_log("La tabella esiste già.");
}

// Funzione per popolare la tabella servizi-uau con i dati dall'API primaria
function populate_servizi_uau_table() {
    global $wpdb;

    // URL dell'API
    $api_url = 'https://accessounico.regione.umbria.it/api/report/export';

    // Esegue la richiesta all'API
    $response = wp_remote_get($api_url);

    // Verifica se la richiesta è andata a buon fine
    if (!is_wp_error($response)) {
        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body);

        // Verifica se ci sono dati nella risposta
        if (!empty($data)) {
            $table_name = $wpdb->prefix . 'servizi_uau';

            // Cicla sui dati e inserisce ogni record nella tabella
            foreach ($data as $item) {
                // Verifica se l'ente è uguale a "Regione Umbria"
                if ($item->ente === "Regione Umbria") {
                    $wpdb->insert(
                        $table_name,
                        array(
                            'titolo' => $item->titolo,
                            'url' => $item->url,
                            'ente' => $item->ente,
                            'areaTematica' => $item->areaTematica,
                            'uffici' => $item->uffici,
                            'dataPrimaPubblicazione' => $item->dataPrimaPubblicazione,
                            'dataUltimoAggiornamento' => $item->dataUltimoAggiornamento,
                            'stato' => $item->stato,
                            'visualizzazioni' => $item->visualizzazioni,
                        )
                    );
                }
            }
        }
    }
}




=======
>>>>>>> Stashed changes
