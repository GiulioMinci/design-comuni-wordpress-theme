<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Design_Comuni_Italia
 */
$theme_locations = get_nav_menu_locations();
$current_group = dci_get_current_group();
?>
<!doctype html>
<html lang="it">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php get_template_part("template-parts/common/svg"); ?>
<?php get_template_part("template-parts/common/sprites"); ?>
<?php get_template_part("template-parts/common/skiplink"); ?>

<header id="main-header" class="it-header-wrapper " data-bs-target="#header-nav-wrapper" style="">

    <?php get_template_part("template-parts/header/slimheader"); ?> 

	
	
<div class="it-nav-wrapper">
<div class="it-header-center-wrapper it-small-header theme-light">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="it-header-center-content-wrapper">
              <div class="it-brand-wrapper">
                <a 
                href="<?php echo home_url(); ?>" 
                <?php if (!is_front_page()) {
                    echo 'title="Vai alla Homepage"';
                } ?>>
                    <div class="it-brand-text d-flex align-items-center">
                      <?php get_template_part("template-parts/common/logo"); ?>
                      <div>
                        <div class="it-brand-title"><?php echo dci_get_option(
                            "nome_comune",
                        ); ?></div>
                        <div class="it-brand-tagline d-none d-md-block">
                          <?php echo dci_get_option("motto_comune"); ?>
                        </div>
                      </div>
                    </div>
                </a>
              </div>
              <div class="it-right-zone">
              <?php
              $show_socials = dci_get_option("show_socials", "socials");
              if ($show_socials == "true"):
                  $socials = dci_get_option("link_social", "socials"); ?>
                    <div class="it-socials d-none d-lg-flex">
                        <span>Seguici su:</span>
                        <ul>
                            <?php foreach ($socials as $social) { ?>
                              <li>
                                <a href="<?php echo $social[
                                    "url_social"
                                ]; ?>" target="_blank">
                                    <svg class="icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" href="#<?php echo $social[
                                        "icona_social"
                                    ]; ?>"></use>
                                  </svg>
                                  <span class="visually-hidden"><?php echo $social[
                                      "nome_social"
                                  ]; ?></span>
                                </a>
                            </li>
                            <?php } ?>                            
                        </ul><!-- /header-social-wrapper -->
                    </div><!-- /it-socials -->
                    <?php
              endif;
              ?>
                <div class="it-search-wrapper">
                  <span class="d-none d-md-block">Cerca</span>
                  <button class="search-link rounded-icon" type="button" data-bs-toggle="modal" data-bs-target="#search-modal" aria-label="Cerca nel sito">
                      <svg class="icon">
                        <use href="#it-search"></use>
                      </svg>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

		
		
		
		
<div class="it-header-navbar-wrapper sticky-custom" style="background-color: #008055;">
      <div class="container">
		  <div class="row align-items-center">
          <div class="col-12">
			  
            <!--start nav-->
            <nav class="navbar navbar-expand-lg has-megamenu" aria-label="Navigazione principale">
              <button class="custom-navbar-toggler" type="button" aria-controls="navC2" aria-expanded="false" aria-label="Mostra/Nascondi la navigazione" data-bs-toggle="navbarcollapsible" data-bs-target="#navC2">
                <svg class="icon"><use href="#it-burger"></use></svg>
              </button>
              <div class="navbar-collapsable" id="navC2" style="display: none;">
                <div class="overlay" style="display: none;"></div>
                <div class="close-div">
                  <button class="btn close-menu" type="button">
                    <span class="visually-hidden">Nascondi la navigazione</span>
                    <svg class="icon"><use href="#it-close-big"></use></svg>
                  </button>
                </div>
  
						<div class="menu-wrapper">
							<ul class="navbar-nav" >
							
							<li class="nav-item dropdown megamenu" style="margin: auto;">
						<button type="button" class="nav-link dropdown-toggle px-lg-2 px-xl-3" data-bs-toggle="dropdown" aria-expanded="false" style="color: white;">
					<span style="color: white; font-weight: bold; font-size: 18px;">Amministrazione</span>
							<svg role="img" class="icon icon-xs ms-1"  style="filter: invert(100%)";><use href="#it-expand"></use></svg>
						</button>

                      <div class="dropdown-menu shadow-lg" role="region" aria-labelledby="megamenu-6" >
                        <div class="megamenu pb-5 pt-3 py-lg-0">
                          <div class="row">
            			    <div class="col-lg-6">
                              <div class="row">
                                <div class="col-12 it-vertical it-description pb-lg-3">
                                  <div class="description-content ps-4 ps-sm-5 ms-3">
                                    <div class="ratio ratio-21x9 lightgrey-bg-a1 mb-4 rounded">
                                      <figure class="figure">
										    <img src="https://www.umbriacronaca.it/wp-content/uploads/2024/03/1-176.jpg" class="rounded float-start" alt="Un'immagine generica segnaposto con angoli arrotondati">
										</figure>
										
                                    </div>
                                    <p style="color: black;">
 											 <figcaption class="figure-caption">Una didascalia per l'immagine sopra.</figcaption>
                                    </p>
                                  </div>
                                </div>
                              </div>
                            </div>
            			    <div class="col-lg-6">
                              <div class="it-heading-link-wrapper">
                                <a class="it-heading-link" href="https://privacy.minci.it/amministrazione/"><svg role="img" class="icon icon-sm me-2 mb-1"  style="filter: invert(100%)"><use href="#it-arrow-right-triangle"></use></svg>
                                <span style="color: black;">Esplora l'amministrazione</span>
                                </a>
                              </div>
                              <div class="row">
                                <div class="col-12 col-lg-6">
                                  <div class="link-list-wrapper">
                                    <ul class="link-list">
                                      <li>
                                        <a class="list-item dropdown-item" href="https://privacy.minci.it/amministrazione/organi-di-governo/">
                                          <svg role="img" class="icon icon-sm me-2"  style="filter: invert(100%)"><use href="#it-arrow-right-triangle "></use></svg>
                                          <span>Organi di Governo</span>
                                        </a>
                                      </li>
                                      <li>
                                        <a class="list-item dropdown-item" href="https://privacy.minci.it/amministrazione/aree-amministrative/">
                                          <svg role="img" class="icon icon-sm me-2"  style="filter: invert(100%)"><use href="#it-arrow-right-triangle"></use></svg>
                                          <span>Aree amministrative</span>
                                        </a>
                                      </li>
                                      <li>
                                        <a class="list-item dropdown-item " href="https://privacy.minci.it/amministrazione/enti-e-fondazioni/">
                                          <svg role="img" class="icon icon-sm me-2"  style="filter: invert(100%)"><use href="#it-arrow-right-triangle"></use></svg>
                                          <span>Enti e fondazioni</span>
                                        </a>
                                      </li>
                                    </ul>
                                  </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                  <div class="link-list-wrapper">
                                    <ul class="link-list">
                                      <li>
                                        <a class="list-item dropdown-item" href="https://privacy.minci.it/amministrazione/politici/">
                                          <svg role="img" class="icon icon-sm me-2"  style="filter: invert(100%)"><use href="#it-arrow-right-triangle"></use></svg>
                                          <span>Politici</span>
                                        </a>
                                      </li>
                                      <li>
                                        <a class="list-item dropdown-item" href="https://privacy.minci.it/amministrazione/personale-amministrativo/">
                                          <svg role="img" class="icon icon-sm me-2"  style="filter: invert(100%)"><use href="#it-arrow-right-triangle"></use></svg>
                                          <span>Personale amministrativo</span>
                                        </a>
                                      </li>
                                      <li>
                                        <a class="list-item dropdown-item " href="https://privacy.minci.it/amministrazione/uffici/">
                                          <svg role="img" class="icon icon-sm me-2"  style="filter: invert(100%)"><use href="#it-arrow-right-triangle"></use></svg>
                                          <span>Uffici</span>
                                        </a>
                                      </li>
                                    </ul>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
				 <li class="nav-item dropdown" style="margin: auto;">
                      <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: white;" id="mainNavDropdownC2">
                        <span style= "font-weight: bold; font-size: 18px";>News</span>
					<svg class="icon icon-xs" style="filter: invert(100%);"><use href="#it-expand"></use></svg>
                      </a>
                      <div class="dropdown-menu" role="region" aria-labelledby="mainNavDropdownC2">
                        <div class="link-list-wrapper">
                          <ul class="link-list">
							  
                            <li><a class="dropdown-item list-item"  href="https://privacy.minci.it/tipi_notizia/avvisi/"><span>Avvisi</span></a></li>
                            <li><a class="dropdown-item list-item" href="https://privacy.minci.it/tipi_notizia/comunicati/"><span>Comunicati stampa</span></a></li>
                            <li><a class="dropdown-item list-item" href="https://privacy.minci.it/tipi_notizia/notizie/"><span>Notizie</span></a></li>
                            <li><span class="divider"></span></li>
                            <li><a class="dropdown-item list-item" href="#"><span>Eventi</span></a></li>
                          </ul>
                        </div>
                      </div>
                    </li>
						
							<li class="nav-item">
								<a class="nav-link" href="https://privacy.minci.it/amministrazione/documenti-e-dati/" style="color: white; font-weight: bold; font-size: 18px; text-decoration: none;">Documenti</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="https://privacy.minci.it/argomento/focus/" style="color: white; font-weight: bold; font-size: 18px; text-decoration: none;">Focus</a>
							</li>
					
                  </ul>
                </div>
              </div>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>

	
	<script>
jQuery(document).ready(function($) {
    var lastScrollTop = 0;
    var headerHeight = $('#main-header').outerHeight();

    $(window).scroll(function() {
        var scrollTop = $(this).scrollTop();
        if (scrollTop > lastScrollTop && scrollTop > headerHeight) {
            $('#main-header').addClass('hidden');
        } else {
            $('#main-header').removeClass('hidden');
        }
        lastScrollTop = scrollTop;
    });
});
</script>
	
</header>


	
<?php if (!is_user_logged_in()) {
    get_template_part("template-parts/common/access-modal");
} ?>

