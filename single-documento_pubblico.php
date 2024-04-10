<?php
/**
 * Documento pubblico template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Design_Comuni_Italia
 */

global $uo_id, $inline;

get_header();
?>

    <main>
        <?php 
        while ( have_posts() ) :
            the_post();
            $user_can_view_post = dci_members_can_user_view_post(get_current_user_id(), $post->ID);

            //$prefix= '_dci_documento_pubblico_';			
            $identificativo = dci_get_meta("identificativo");
            $numero_protocollo = dci_get_meta("numero_protocollo");
            $data_protocollo = dci_get_meta("data_protocollo");			
            $tipo_documento = wp_get_post_terms( $post->ID, array( 'tipi_documento', 'tipi_doc_albo_pretorio' ) );
            $descrizione_breve = dci_get_meta("descrizione_breve");
            $url_documento = dci_get_meta("url_documento");
            $file_documento = dci_get_meta("file_documento");
            $descrizione = dci_get_wysiwyg_field("descrizione_estesa");
            $ufficio_responsabile = dci_get_meta("ufficio_responsabile");
            $autori = dci_get_meta("autori");
            $formati = dci_get_wysiwyg_field("formati");
            $licenza = wp_get_post_terms( $post->ID, array( 'licenze' ) );
            $servizi = dci_get_meta("servizi");
            $data_inizio = dci_get_meta("data_inizio");
            $data_fine = dci_get_meta("data_fine");
            $dataset = dci_get_meta("dataset");
            $more_info = dci_get_wysiwyg_field("ulteriori_informazioni");
            $riferimenti_normativi = dci_get_wysiwyg_field("riferimenti_normativi"); 			
            $documenti_collegati = dci_get_meta("documenti_collegati");
			$paragrafi_extra = get_post_meta($post->ID, '_dci_documento_pubblico_paragrafi_extra', true);
			$pdf_url = generate_pdf_from_page_content(get_the_content(), get_the_title());
			$post_id = get_the_ID();
			$prefix = '_dci_documento_pubblico_';
			$ulteriori_allegati = get_post_meta($post_id, $prefix . 'ulteriori_allegati', true);
			$urn = get_post_meta($post->ID, '_dci_urn', true);


		
            ?>
		
		
		
		

		
		
		
            <div class="container" id="main-container">
                <div class="row">
                    <div class="col px-lg-4">
                        <?php get_template_part("template-parts/common/breadcrumb"); ?>
	
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 px-lg-4 py-lg-2">
                        <h1><?php the_title(); ?></h1>
                        <h2 class="visually-hidden">Dettagli del documento</h2>
                        <?php if($numero_protocollo) { ?>
                            <h4>Protocollo <?= $numero_protocollo ?> del <?= $data_protocollo ?></h4>
                        <?php } ?>
                        <p>
                            <?php echo $descrizione_breve; ?>
                        </p>
                    </div>
                    <div class="col-lg-3 offset-lg-1">
                        <?php
                        $inline = true;
                        get_template_part('template-parts/single/actions');
                        ?>
                    </div>
                </div>
            </div><!-- ./main-container -->

            <div class="container">
                <div class="row border-top border-light row-column-border row-column-menu-left">
                    <aside class="col-lg-3">
<div class="cmp-navscroll sticky-top" id="navscroll" aria-labelledby="accordion-title-one" style="padding-top: 60px; margin-bottom: 80px; z-index: 1;">
	
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
                                                        >INDICE DELLA PAGINA
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
                                                                <?php if( $descrizione) { ?>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#descrizione">
                                                                        <span class="title-medium">Descrizione</span>
                                                                    </a>
                                                                </li>
                                                                <?php } ?>
														
																
																 <!-- Aggiunta dinamici dei paragrafi extra al menu -->
                                                                <?php foreach ($paragrafi_extra as $index => $paragrafo) {
                                                                    // Accedi al valore del titolo del paragrafo e al suo ID
                                                                    $titolo = $paragrafo['_dci_documento_pubblico_titolo-paragrafo-extra'];
                                                                    $id = 'paragrafo_extra_' . sanitize_title($titolo); // ID univoco del paragrafo extra
                                                                ?>
                                                                    <!-- Stampa della voce di menu per il titolo corrente con l'attributo href contenente l'ID del paragrafo -->
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#<?php echo $id; ?>">
                                                                            <span class="title-medium"><?php echo ucwords($titolo); ?></span>
                                                                        </a>
                                                                    </li>
                                                                <?php } ?>
																
																
                                                                <?php if( $url_documento || $file_documento ) { ?>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#documento">
                                                                        <span class="title-medium">Documento</span>
                                                                    </a>
                                                                </li>
																
                                                                <?php } ?>
																
															   <li class="nav-item">
                                                                    <a class="nav-link" href="#dettagli_documento">
                                                                        <span class="title-medium">Dettagli del documento</span>
                                                                    </a>
                                                                </li>	

                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#ufficio_responsabile">
                                                                        <span class="title-medium">Ufficio responsabile</span>
                                                                    </a>
                                                                </li>

                                                                <?php if( $autori) { ?>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#autore">
                                                                        <span class="title-medium">Autore/i</span>
                                                                    </a>
                                                                </li>
                                                                <?php } ?>
												

                                                                <?php if( $servizi && count($servizi) ) { ?>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#servizi">
                                                                        <span class="title-medium">Servizi collegati</span>
                                                                    </a>
                                                                </li>
                                                                <?php } ?>

                                                                <?php if( $data_inizio) { ?>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#data_inizio">
                                                                        <span class="title-medium">Data inizio</span>
                                                                    </a>
                                                                </li>
                                                                <?php } ?>

                                                                <?php if( $data_fine) { ?>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#data_fine">
                                                                        <span class="title-medium">Data fine</span>
                                                                    </a>
                                                                </li>
                                                                <?php } ?>

                                                                <?php if( $dataset && count($dataset) ) { ?>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#dataset">
                                                                        <span class="title-medium">Dataset</span>
                                                                    </a>
                                                                </li>
                                                                <?php } ?>

                                                                <?php if( $more_info) { ?>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#ulteriori_informazioni">
                                                                        <span class="title-medium">Ulteriori informazioni</span>
                                                                    </a>
                                                                </li>
                                                                <?php } ?>

                                                                <?php if( $riferimenti_normativi) { ?>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#riferimenti_normativi">
                                                                        <span class="title-medium">Riferimenti normativi</span>
                                                                    </a>
                                                                </li>
                                                                <?php } ?>

                                                                <?php if( is_array($documenti_collegati) && count($documenti_collegati) ) { ?>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#documenti_collegati">
                                                                        <span class="title-medium">Documenti collegati</span>
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

<div class="col-12 col-lg-9" >
                        <div class="it-page-sections-container"  >
                            <?php if( $descrizione) { ?>
                            <section id="descrizione" class="it-page-section mb-5" style="padding-top: 15px;">
                                <h4>Descrizione</h4>
                                <div class="richtext-wrapper lora">
                                    <?php echo $descrizione; ?>
									
							                  </div>
                            </section>
							
                            <?php } ?>
							
							
							
								<!-- Aggiungi il contenuto dei paragrafi extra -->
								<?php if (!empty($paragrafi_extra)) {
									foreach ($paragrafi_extra as $index => $paragrafo) {
										// Ottieni il titolo e il testo del paragrafo extra
										$titolo = $paragrafo['_dci_documento_pubblico_titolo-paragrafo-extra'];
										$testo = $paragrafo['_dci_documento_pubblico_corpo-paragrafo-extra'];

										// Assicurati che il titolo non sia vuoto
										if (!empty($titolo)) {
											// Capitalizza la prima lettera del titolo
											$titolo = ucfirst($titolo);
								?>
       										 <section id="paragrafo_extra_<?php echo sanitize_title($titolo); ?>" class="it-page-section mb-5" style="padding-top: 15px;">
												<h4 class="section-title"><?php echo $titolo; ?></h4>

												<?php 
												// Stampa il testo del paragrafo
												echo $testo;
												?>
												
											</section>
								<?php
										}
									}
								}
								?>
							
							
								<section id="documento" class="it-page-section mb-5" style="padding-top: 15px;">
									<h4>Documento</h4>
									<div class="card-wrapper card-teaser-wrapper card-teaser-wrapper-equal">
										<?php if (!empty($file_documento)) { ?>
										<div class="card card-teaser shadow-sm p-4 mt-3 rounded border border-light flex-nowrap">
											<svg class="icon" aria-hidden="true">
												<use xlink:href="#it-clip"></use>
											</svg>
											<div class="card-body">
												<h5 class="card-title">
                                                    <a class="text-decoration-none" href="<?php echo $file_documento; ?>" aria-label="Scarica il documento <?php echo $documento->post_title; ?>" title="Scarica il documento <?php echo $documento->post_title; ?>">
                                                        <?php echo $documento->post_title; ?> (<?php echo getFileSizeAndFormat($file_documento);?>)														Documento allegato
													</a>
												</h5>
											</div>
										</div>
										<?php } ?>

										<?php if (!empty($url_documento)) { ?>
										<div class="card card-teaser shadow-sm p-4 mt-3 rounded border border-light flex-nowrap">
											<svg class="icon" aria-hidden="true">
												<use xlink:href="#it-clip"></use>
											</svg>
											<div class="card-body">
												<h5 class="card-title">
													<a class="text-decoration-none" href="<?php echo $url_documento; ?>">
														Vedi il documento online
													</a>
												</h5>
											</div>
										</div>
										<?php } ?>

										<?php if (!empty($pdf_url)) { ?>
										<div class="card card-teaser shadow-sm p-4 mt-3 rounded border border-light flex-nowrap">
											<svg class="icon" aria-hidden="true">
												<use xlink:href="#it-file"></use>
											</svg>
											<div class="card-body">
												<h5 class="card-title">
													<a class="text-decoration-none" href="<?php echo $pdf_url; ?>">
														Il contenuto di questa pagina in pdf
													</a>
												</h5>
											</div>
										</div>
										<?php } ?>
									</div><!-- ./card-wrapper -->
								</section>
							
							
									<section id="ulteriori-allegati" class="it-page-section mb-5" style="padding-top: 15px;">
										<?php if (!empty($ulteriori_allegati)) : ?>
											<h4>Ulteriori Allegati</h4>
											<div class="card-wrapper card-teaser-wrapper card-teaser-wrapper-equal">
												<?php foreach ($ulteriori_allegati as $allegato) : ?>
													<div class="card card-teaser shadow-sm p-4 mt-3 rounded border border-light">
														<svg class="icon" aria-hidden="true">
															<use xlink:href="#it-file"></use>
														</svg>
														<div class="card-body">
															<?php if (!empty($allegato['file_allegato'])) : ?>
																<h5 class="card-title">
																	<a class="text-decoration-none" href="<?php echo esc_url($allegato['file_allegato']); ?>" target="_blank">
																		<?php echo esc_html($allegato['titolo'] ?? 'Titolo non disponibile'); ?>
																	</a>
																</h5>
															<?php endif; ?>
															<?php if (!empty($allegato['descrizione'])) : ?>
																<p class="card-text">
																	<?php echo esc_html($allegato['descrizione']); ?>
																</p>
															<?php endif; ?>
														</div>
													</div>
												<?php endforeach; ?>
											</div>
										<?php endif; ?>
									</section>
							
							
							



                            <?php if ($autori &&  is_array($autori) && count($autori)) { ?>
                            <section id="autore" class="it-page-section mb-5" style="padding-top: 15px;">
                                <h4>Autore/i</h4>
                                <div class="card-wrapper card-teaser-wrapper card-teaser-wrapper-equal">
                                    <?php foreach ($autori as $persona_id) { ?>
                                        <div class="card card-teaser shadow-sm p-4 mt-3 rounded border border-light flex-nowrap">
                                            <?php get_template_part("template-parts/persona/card"); ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </section>
                            <?php } ?>

								<div id="dettagli_documento" class="it-page-section mb-5" style="padding-top: 15px;">
									<h4>Dettagli Documento</h4>
									<div class="table-responsive">
										<table class="table table-bordered">
											<tbody>
												<?php if ($formati) { ?>
												<tr>
													<th scope="row">Formati disponibili</th>
													<td><?php echo $formati ?></td>
												</tr>
												<?php } ?>

												<?php if ($licenza) { ?>
												<tr>
													<th scope="row">Licenza distribuzione</th>
													<td>
														<?php foreach($licenza as $tipo) { 
															echo $tipo->name . '<br>';
														} ?>
													</td>
												</tr>
												<?php } ?>

												<?php if ($servizi && is_array($servizi) && count($servizi) > 0) { ?>
												<tr>
													<th scope="row">Servizi collegati</th>
													<td>
														<?php foreach ($servizi as $servizio_id) {
															$servizio = get_post($servizio_id);
															echo esc_html($servizio->post_title) . '<br>';
														} ?>
													</td>
												</tr>
												<?php } ?>

												<?php if ($data_inizio) { ?>
												<tr>
													<th scope="row">Data inizio</th>
													<td><?php echo date_i18n('j F Y', strtotime($data_inizio)); ?></td>
												</tr>
												<?php } ?>

												<?php if ($data_fine) { ?>
												<tr>
													<th scope="row">Data fine</th>
													<td><?php echo date_i18n('j F Y', strtotime($data_fine)); ?></td>
												</tr>
												<?php } ?>
												<?php if ($urn) : ?>
												<tr>	
													<th scope="row">Urn permanente</th>
													<td><?php echo esc_html($urn); ?></td>
												</tr>
								<?php endif; ?>
											</tbody>
										</table>
									</div>
								</div>
							
							
							
							
							
							
							
                            <section id="ufficio_responsabile" class="it-page-section mb-5" style="padding-top: 15px;">
                                <h4>Ufficio responsabile</h4>
                                <div class="card-wrapper card-teaser-wrapper card-teaser-wrapper-equal">
                                    <?php foreach ($ufficio_responsabile as $uo_id) {
                                        $with_border = true;
                                        get_template_part("template-parts/unita-organizzativa/card");
                                    } ?>
                                </div>
                            </section>
							
							
                            <?php if ( $more_info ) {  ?>
                            <section id="ulteriori_informazioni" class="it-page-section mb-5" style="padding-top: 15px;">
                                <h4>Ulteriori informazioni</h4>
                                <div class="richtext-wrapper lora">
                                    <?php echo $more_info ?>
                                </div>
                            </section>
                            <?php }  ?>

                            <?php if ( $riferimenti_normativi ) { ?>
                            <section id="riferimenti_normativi" class="it-page-section mb-5" style="padding-top: 15px;">
                                <h4>Riferimenti normativi</h4>
                                <div class="richtext-wrapper lora">
                                    <?php echo $riferimenti_normativi ?>

									
					
									
                                </div>
                            </section>
                            <?php } ?>
							
							
							


								
								
								
							<?php if ($documenti_collegati && is_array($documenti_collegati) && count($documenti_collegati) > 0) { ?>
								<article id="documenti_collegati" class="it-page-section anchor-offset mt-5">
									<h3>Documenti correlati</h3>
									<div class="card-wrapper card-teaser-wrapper card-teaser-wrapper-equal">
										<?php foreach ($documenti_collegati as $all_url) { ?>
											<?php //$all_id = attachment_url_to_postid($all_url); 
											$documento = get_post($all_url);
											$with_border = true;
											get_template_part("template-parts/documento/card"); ?>
										<?php } ?>
									</div>
								</article>
							<?php } ?>
                          
							
							
							
                        </div><!-- /it-page-sections-container -->

                        <div>
                            <?php get_template_part('template-parts/single/page_bottom'); ?>
                        </div>

										</div><!-- ./col-12 col-9 -->

                </div><!-- ./row border-top border-light row-column-border row-column-menu-left -->
            </div><!-- ./container -->

            <?php get_template_part("template-parts/common/valuta-servizio"); ?>
            <?php get_template_part("template-parts/common/assistenza-contatti"); ?>

        <?php
        endwhile; // End of the loop.
        ?>
    </main>
    <script>
        const descText = document.querySelector('#descrizione')?.closest('article').innerText;
        const wordsNumber = descText.split(' ').length
        document.querySelector('#readingTime').innerHTML = `${Math.ceil(wordsNumber / 200)} min`;



    </script>



<?php
get_footer();