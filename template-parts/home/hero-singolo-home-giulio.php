 <?php
        while (have_posts()) :
            the_post();

            ?>
            <section class="it-hero-wrapper it-dark it-overlay">
                <!-- - img-->
                <div class="img-responsive-wrapper">
                    <div class="img-responsive">
                        <div class="img-wrapper"><img src="https://privacy.minci.it/wp-content/uploads/2024/03/20210401134324-assisi-umbria-gettyimages-495038776.jpg" title="titolo immagine" alt="descrizione immagine"></div>
                    </div>
                </div>
                <!-- - texts-->
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="it-hero-text-wrapper bg-dark">
                                <span class="it-Categoria">Categoria</span>
                                <h2>Benvenuti nel nuovo portale della Regione Umbria</h2>
                                <p class="d-none d-lg-block">Benvenuti sul nuovo portale istituzionale della Regione Umbria, il cuore verde d'Italia! Esplora le nostre risorse e scopri tutto ciò che la nostra splendida regione ha da offrire. Siamo qui per fornirti informazioni, risorse e supporto per rendere la tua esperienza indimenticabile. Buona navigazione!</p>
                                <div class="it-btn-container"><a class="btn btn-sm btn-secondary" href="#">Label CTA</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php
        endwhile; // End of the loop.
        ?>