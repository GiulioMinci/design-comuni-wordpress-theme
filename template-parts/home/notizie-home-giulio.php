<div class="row justify-content-center">
    <?php
    $args = array(
        'post_type'      => 'notizia',
        'posts_per_page' => 3, // Limita il numero di notizie a 3
        'orderby'        => 'date',
        'order'          => 'DESC'
    );

    $latest_notizie = new WP_Query($args);

    if ($latest_notizie->have_posts()) :
        while ($latest_notizie->have_posts()) : $latest_notizie->the_post();
            // Ottenere le categorie del post
            $categories = get_the_terms(get_the_ID(), 'category');

            // Ottenere la data di pubblicazione
            $post_date = get_the_date('d/m/Y');

            // Ottenere l'autore del post
            $author = get_the_author();

            // Ottenere il riassunto del contenuto
            $excerpt = get_the_excerpt();
    ?>
            <div class="col-12 col-lg-4">
                <!--start card-->
                <div class="card-wrapper" style="
                    display: flex;
                    flex-direction: column;
                    align-items: flex-start;
                    padding: 0px;
                    position: relative;
                    width: 435px;
                    height: 432px;
                    filter: drop-shadow(0px 8px 16px rgba(0, 0, 0, 0.15));
                    border-radius: 4px;
                    margin-bottom: 10px; /* Aggiunto margine inferiore di 10px */
                ">
                    <div class="card" style="
                        display: flex;
                        flex-direction: column;
                        align-items: flex-start;
                        padding: 24px;
                        gap: 24px;
                        width: 435px;
                        height: 272px;
                        background: #008055; /* Colore di sfondo verde */
                        flex: none;
                        order: 0;
                        align-self: stretch;
                        flex-grow: 0;
                        color: #FFFFFF; /* Testo bianco */
                    ">
                        <div class="card-body" style="
                            display: flex;
                            flex-direction: column;
                            align-items: flex-start;
                            padding: 0px;
                            gap: 24px;
                            width: 387px;
                            height: 224px;
                            flex: none;
                            order: 0;
                            align-self: stretch;
                            flex-grow: 0;
                        ">
                            <div class="category-top" style="
                                display: flex;
                                flex-direction: row;
                                justify-content: space-between;
                                align-items: center;
                                padding: 0px;
                                gap: 16px;
                                width: 387px;
                                height: 24px;
                                flex: none;
                                order: 0;
                                align-self: stretch;
                                flex-grow: 0;
                            ">
                                <?php if ($categories && !is_wp_error($categories)) : ?>
                                    <?php foreach ($categories as $category) : ?>
                                        <a class="category chip chip-success chip-text-only text-uppercase text-center text-white rounded-pill" href="<?php echo esc_url(get_category_link($category->term_id)); ?>"><?php echo esc_html($category->name); ?></a>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <a class="category chip chip-success chip-text-only text-uppercase text-center text-white rounded-pill" href="#">Categoria Mancante</a>
                                <?php endif; ?>
                                <span class="data"><?php echo $post_date; ?></span>
                            </div>
                            <h3 class="card-title big-heading h5" style="
                                width: 387px;
                                height: 64px;
                                font-family: 'Titillium Web';
                                font-style: normal;
                                font-weight: 600;
                                font-size: 24px;
                                line-height: 32px;
                                flex: none;
                                order: 0;
                                align-self: stretch;
                                flex-grow: 0;
                            "><?php the_title(); ?></h3>
                            <p class="card-text font-serif" style="
                                width: 387px;
                                height: 48px;
                                font-family: 'Lora';
                                font-style: normal;
                                font-weight: 400;
                                font-size: 16px;
                                line-height: 24px;
                                flex: none;
                                order: 1;
                                align-self: stretch;
                                flex-grow: 0;
                            "><?php echo $excerpt; ?></p>
                            <a class="read-more" href="<?php the_permalink(); ?>" style="
                                display: flex;
                                align-items: center;
                                color: #FFFFFF; /* Testo bianco */
                                text-decoration: none; /* Disattiva sottolineatura */
                            ">
                                <span class="text">Leggi di più</span>
                                <svg class="icon" style="
                                    width: 24px;
                                    height: 24px;
                                    flex: none;
                                    order: 1;
                                    flex-grow: 0;
                                "><use href="/bootstrap-italia/dist/svg/sprites.svg#it-arrow-right"></use></svg>
                            </a>
                        </div>
                    </div>
                </div>
                <!--end card-->
            </div>
    <?php
        endwhile;
        wp_reset_postdata();
    else :
        echo 'Nessuna notizia trovata';
    endif;
    ?>
</div>
