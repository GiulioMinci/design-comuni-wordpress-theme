<?php
/**
 * Persona Pubblica template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Design_Comuni_Italia
 */
global $uo_id, $gallery;
get_header();

while (have_posts()) : the_post();

    // Get post meta values
    $nome = get_post_meta(get_the_ID(), '_dci_persona_pubblica_nome', true);
    $cognome = get_post_meta(get_the_ID(), '_dci_persona_pubblica_cognome', true);
    $descrizione_breve = get_post_meta(get_the_ID(), '_dci_persona_pubblica_descrizione_breve', true);
    $competenze = get_post_meta(get_the_ID(), '_dci_persona_pubblica_competenze', true);
    $deleghe = get_post_meta(get_the_ID(), '_dci_persona_pubblica_deleghe', true);
	$biografia = get_post_meta(get_the_ID(), '_dci_persona_pubblica_biografia', true);
	$cv_url = get_post_meta(get_the_ID(), '_dci_persona_pubblica_curriculum_vitae', true);
    $ulteriori_informazioni = get_post_meta(get_the_ID(), '_dci_persona_pubblica_ulteriori_informazioni', true);
    $punti_contatto = dci_get_meta("punti_contatto", $prefix, $post->ID);
	$gallery = dci_get_meta("gallery", $prefix, $post->ID);
	$meta_value = get_post_meta(get_the_ID(), '_dci_persona_pubblica_foto_id', true);
	$organizzazione = dci_get_meta("organizzazioni", $prefix, $post->ID);
    // Output the post content
// Larghezza e altezza desiderate
$width = 200;
$height = 300;
    ?>

    <div class="container px-4 my-4" id="main-container">
      <div class="row">
        <div class="col px-lg-4">
            <?php get_template_part("template-parts/common/breadcrumb"); ?>
        </div>
          <div class="col-lg-3 offset-lg-1">
                        <?php
                        $inline = true;
                        get_template_part('template-parts/single/actions');
                        ?>
                    </div>
      </div>
      <div class="row border-top row-column-border row-column-menu-left border-light">
        <aside class="col-lg-4">
                                            <h1 class="title-xxxlarge" data-element="person-title">
                                        <?php the_title(); ?>
                                    </h1>

								   <?php if (is_numeric($meta_value) && $meta_value > 0) {
    // Verifica se l'allegato immagine esiste
    $image = wp_get_attachment_image($meta_value, array($width, $height), false, array('class' => 'custom-image-class'));

    if ($image) {
        // Output dell'immagine
        echo $image;
    } else {
        // Se l'allegato immagine non esiste
        echo 'L\'immagine associata non esiste.';
    }
} else {
    // Se il valore restituito non è un ID valido
    echo 'ID immagine non valido.';
} ?>
            <div class="cmp-navscroll sticky-top" aria-labelledby="accordion-title-one">
                <nav class="navbar it-navscroll-wrapper navbar-expand-lg" aria-label="Indice della pagina" data-bs-navscroll>
                    <div class="navbar-custom" id="navbarNavProgress">
                        <div class="menu-wrapper">
                            <div class="link-list-wrapper">
                                <div class="accordion">
                                    <div class="accordion-item">
                                        <span class="accordion-header" id="accordion-title-one">
                                        <button
                                            class="accordion-button pb-10 px-3 text-uppercase"
                                            type="button"
                                            aria-controls="collapse-one"
                                            aria-expanded="true"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#collapse-one"
                                        >Indice della pagina
                                            <svg class="icon icon-sm icon-primary align-top">
                                                <use xlink:href="#it-expand"></use>
                                            </svg>
                                        </button>
                                        </span>
                                        <div class="progress">
                                            <div class="progress-bar it-navscroll-progressbar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <div id="collapse-one" class="accordion-collapse collapse show" role="region" aria-labelledby="accordion-title-one">
                                            <div class="accordion-body">
                                                <ul class="link-list" data-element="page-index">
                                                    <li class="nav-item">
                                                    <a class="nav-link" href="#descrizione_breve">
                                                    <span class="title-medium">Descrizione breve</span>
                                                    </a>
                                                    </li>


                                                <?php if( $competenze ) { ?>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#competenze">
                                                                    <span class="title-medium">Competenze</span>
                                                                    </a>
                                                                </li>
                                                                <?php } ?>

                                                 <?php if( $deleghe ) { ?>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#deleghe">
                                                                    <span class="title-medium">Deleghe</span>
                                                                    </a>
                                                                </li>
                                                                <?php } ?>

                                                           <?php if( $biografia ) { ?>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#biografia">
                                                                    <span class="title-medium">Biografia</span>
                                                                    </a>
                                                                </li>
                                                                <?php } ?>

                                                           <?php if( $cv_url ) { ?>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#cv_url">
                                                                    <span class="title-medium">Curriculum</span>
                                                                    </a>
                                                                </li>
                                                                <?php } ?>


                                                <?php if( is_array($punti_contatto) && count($punti_contatto) ) { ?>
                                                <li class="nav-item">
                                                <a class="nav-link" href="#contatti">
                                                <span class="title-medium">Contatti</span>
                                                </a>
                                                </li>
                                                <?php } ?>

                                                    <li class="nav-item">
                                                    <a class="nav-link" href="#gallery">
                                                    <span class="title-medium">Galleria</span>
                                                    </a>
                                                    </li>

                                                                                                        <li class="nav-item">
                                                    <a class="nav-link" href="#organizzazione">
                                                    <span class="title-medium">Unità organizzativa</span>
                                                    </a>
                                                    </li>

                                                <?php if( $ulteriori_informazioni ) { ?>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#ulteriori_informazioni">
                                                                    <span class="title-medium">Ulteriori Informazioni</span>
                                                                    </a>
                                                                </li>
                                                                <?php } ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </aside>

        <section class="col-lg-8 it-page-sections-container border-light"> 
          <article id="descrizione_breve" class="it-page-section mb-5" data-audio>
              <h3 class="mb-3">Descrizione Breve</h3>
              <div class="richtext-wrapper font-serif">
                  <?php echo $descrizione_breve; ?>
              </div>              
          </article>

          <article id="competenze" class="it-page-section mb-5" data-audio>
              <h3 class="mb-3">Competenze</h3>
              <div class="richtext-wrapper font-serif">
                  <?php echo $competenze; ?>
              </div>              
          </article>

                    <article id="deleghe" class="it-page-section mb-5" data-audio>
              <h3 class="mb-3">Deleghe</h3>
              <div class="richtext-wrapper font-serif">
                  <?php echo $deleghe; ?>
              </div>              
          </article>

                              <article id="biografia" class="it-page-section mb-5" data-audio>
              <h3 class="mb-3">Biografia</h3>
              <div class="richtext-wrapper font-serif">
                  <?php echo $biografia; ?>
              </div>              
          </article>

<article id="cv_url" class="it-page-section mb-5" data-audio>
<h3 class="mb-3">Curriculum</h3>
<?php
if ($cv_url) {
    // Visualizza il link al curriculum vitae
    echo '<a href="' . esc_url($cv_url) . '" target="_blank"><b>Visualizza Curriculum Vitae</b></a>';
} else {
    // Messaggio in caso il curriculum vitae non sia disponibile
    echo 'Curriculum Vitae non disponibile.';
}
?>
</article>

          <article id="contatti" class="it-page-section mb-5">
          <?php if( is_array($punti_contatto) && count($punti_contatto) ) { ?>
            <h3 class="mb-3">Contatti</h3>
            <?php foreach ($punti_contatto as $pc_id) {
                get_template_part('template-parts/single/punto-contatto');
            } ?>
          <?php } ?>
          </article>

          <?php if (is_array($gallery) && count($gallery)) {
          get_template_part("template-parts/single/gallery");
              } ?>
<article id="organizzazione" class="it-page-section mb-5" data-audio>
    <h3 class="mb-3">Unità organizzativa</h3>
    <?php
    // Assicurati di avere $a_cura_di definito correttamente prima di utilizzarlo
    if (is_array($organizzazione) && count($organizzazione)) :
        foreach ($organizzazione as $uo_id) :
            $with_border = true;
            get_template_part("template-parts/unita-organizzativa/card");
        endforeach;
    else :
        // Messaggio di fallback se $a_cura_di non è un array valido o è vuoto
        echo '<p>Nessuna unità organizzativa disponibile.</p>';
    endif;
    ?>
</article>

          <article id="ulteriori_informazioni" class="it-page-section mb-5">
              <h3 class="mb-3">Ulteriori Informazioni</h3>
          <?php if ($ulteriori_informazioni) { ?>
              <div class="mt-5">
                  <div class="callout">
                      <div class="callout-title">
                          <svg class="icon">
                          <use xlink:href="#it-info-circle"></use>
                          </svg>
                      </div>
                      <?php echo $ulteriori_informazioni; ?>
                  </div>
              </div>
          <?php } ?>
          </article>
          <?php get_template_part('template-parts/single/page_bottom'); ?>
          </section>
      </div>

    </div>
		            <div class="container">

								            <?php get_template_part("template-parts/common/valuta-servizio"); ?>
            </div>

    <!-- <?php get_template_part('template-parts/single/more-posts', 'carousel'); ?> -->

  <?php
  endwhile; // End of the loop.
  ?>

</main>

<?php
get_footer();