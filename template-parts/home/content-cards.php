
  <title>Carousel Cards</title>

  <!-- Splide.js CSS -->
  <link href="https://cdn.jsdelivr.net/npm/@splidejs/splide/dist/css/splide.min.css" rel="stylesheet">
  <style>
    /* Ingrandisci i pallini */
    .splide__pagination.splide__pagination--bottom {
      font-size: 20px;
    }
    /* Nascondi i pulsanti di navigazione */
    .splide__arrow {
      display: none;
    }
  </style>
<body>

<div class="container py-5">

  <!-- Carousel -->
  <div class="splide it-carousel-landscape-abstract-three-cols-dots" id="cardCarousel">
    <div class="splide__track">
      <ul class="splide__list">
        <?php
        global $post;
        $argomenti_evidenza = dci_get_option('argomenti_evidenziati', 'argomenti');

        if (is_array($argomenti_evidenza) && count($argomenti_evidenza)) {
          $numGroups = ceil(count($argomenti_evidenza) / 6);
          for ($i = 0; $i < $numGroups; $i++) {
            echo '<li class="splide__slide">';
            echo '<div class="row g-4">';
            for ($j = $i * 6; $j < min(($i + 1) * 6, count($argomenti_evidenza)); $j++) {
              $arg_id = $argomenti_evidenza[$j];
              $argomento = get_term_by('id', $arg_id, 'argomenti');
              $img = dci_get_term_meta('immagine', "dci_term_", $argomento->term_id);

              echo '<div class="col-md-4 mb-3">';
              echo '<div class="card card-teaser rounded card-bg card-space">';
              echo '<a href="' . get_term_link($argomento->term_id) . '" class="text-decoration-none text-dark d-flex align-items-center">';
              echo '<img src="' . get_template_directory_uri() . '/assets/svg/it-pa.svg" alt="Icona PA" class="mr-3" style="width: 43.34px; height: 63.34px; margin-top: 3.33px; margin-left: 13.33px;">';
              echo '<div class="card-body">';
              echo '<div class="card-title font-titillium text-center" style="font-weight: 600;font-size: 15px; line-height: 24px; padding-left: 20px;">' . $argomento->name . '</div>';
              echo '</div>';
              echo '</a>';
              echo '</div>';
              echo '</div>';
            }
            echo '</div>';
            echo '</li>';
          }
        }
        ?>
      </ul>
    </div>
  </div>

</div>


<!-- Splide.js JS -->
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide/dist/js/splide.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    new Splide('#cardCarousel', {
      perPage: 1,
      pagination: true,
      arrows: false, // Rimuovi i pulsanti di navigazione
    }).mount();
  });
</script>


