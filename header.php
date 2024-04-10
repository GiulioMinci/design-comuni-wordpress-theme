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
$current_group   = dci_get_current_group();
?>


<<<<<<< Updated upstream
=======




>>>>>>> Stashed changes
<!doctype html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<<<<<<< Updated upstream
	<?php wp_head(); ?>
	
	
	
</head>
	
	

	
	
<body <?php body_class(); ?>>
	
	
	
=======
    <?php
wp_head();
?>
   <style>
        /* Stili personalizzati qui */
        .sticky-top {
            position: sticky;
            top: 0;
            z-index: 1000;
        }
	   
/* Aggiungi una transizione al logo */
.navbar-brand img {
    transition: opacity 0.3s ease, transform 0.3s ease;
}

/* Nascondi il logo di default */
.navbar-brand img {
    opacity: 0;
    transform: translateY(-100%);
}

/* Animazione per il logo sticky */
.sticky-header .navbar-brand img {
    opacity: 1;
    transform: translateY(0);
}

/* Aggiusta la posizione del menu quando il logo è visibile */
.sticky-header .navbar-toggler {
    margin-left: auto;
}

.sticky-header .navbar-collapse {
    margin-right: 100px; /* Sostituisci con la larghezza del logo */
}
	   
	   
	   
    </style>
</head>
<body <?php
body_class();
?>>
>>>>>>> Stashed changes

<?php
get_template_part("template-parts/common/svg");
?>
<?php
get_template_part("template-parts/common/sprites");
?>
<?php
get_template_part("template-parts/common/skiplink");
?>

<<<<<<< Updated upstream
<header class="it-header-wrapper">
    <?php get_template_part("template-parts/header/slimheader"); ?> 

    <div class="it-header-center-wrapper">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="it-header-center-content-wrapper">
              <div class="it-brand-wrapper">
                <a 
                href="<?php echo home_url(); ?>" 
                <?php if(!is_front_page()) echo 'title="Vai alla Homepage"'; ?>>
<div class="it-brand-text d-flex align-items-center" style="padding-bottom: 4px;">
                      <?php get_template_part("template-parts/common/logo"); ?>
                      <div>
                        <div class="it-brand-title"><?php echo dci_get_option("nome_comune"); ?></div>
                        <div class="it-brand-tagline d-none d-md-block">
                          <?php echo dci_get_option("motto_comune"); ?>
                        </div>
                      </div>
                    </div>
                </a>
              </div>
              <div class="it-right-zone">
              <?php
                    $show_socials = dci_get_option( "show_socials", "socials" );
                    if($show_socials == "true") : 
                    $socials = dci_get_option('link_social', 'socials');
                    ?>
                    <div class="it-socials d-none d-lg-flex">
                        <span>Seguici su:</span>
                        <ul>
                            <?php foreach ($socials as $social) { ?>
                              <li>
                                <a href="<?php echo $social['url_social'] ?>" target="_blank">
                                    <svg class="icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" href="#<?php echo $social['icona_social'] ?>"></use>
                                  </svg>
                                  <span class="visually-hidden"><?php echo $social['nome_social']; ?></span>
                                </a>
                            </li>
                            <?php } ?>                            
                        </ul><!-- /header-social-wrapper -->
                    </div><!-- /it-socials -->
                    <?php endif ?>
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
	
<div class="it-header-navbar-wrapper" id="header-nav-wrapper1" style="background-color:#007a52;">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div
              class="navbar navbar-expand-lg has-megamenu"
            >
				

				
              <button
                class="custom-navbar-toggler"
                type="button"
                aria-controls="nav4"
                aria-expanded="false"
                aria-label="Mostra/Nascondi la navigazione"
                data-bs-target="#nav4"
                data-bs-toggle="navbarcollapsible"
              >
                <svg class="icon">
                  <use href="#it-burger"></use>
                </svg>
              </button>
              <div class="navbar-collapsable" id="nav4">
                <div class="overlay" style="display: none"></div>
                <div class="close-div">
                  <button class="btn close-menu" type="button">
                    <span class="visually-hidden">Nascondi la navigazione</span>
                    <svg class="icon">
                      <use href="#it-close-big"></use>
                    </svg>
					  
					
                  </button>
					
					
					
                </div>
                <div class="menu-wrapper">
                <a href="<?php echo home_url(); ?>" aria-label="Vai alla homepage" class="logo-hamburger">
                    <?php get_template_part("template-parts/common/logo-mobile"); ?>
                  <div class="it-brand-text">
                    <div class="it-brand-title"><?php echo dci_get_option("nome_comune"); ?></div>
                  </div>
                </a>
                <nav aria-label="Principale">
                  <?php
                      $location = "menu-header-main";
                      if ( has_nav_menu( $location ) ) {
                          wp_nav_menu(array(
                            "theme_location" => $location, 
                            "depth" => 0,  
                            "menu_class" => "navbar-nav", 
                            'items_wrap' => '<ul class="%2$s" id="%1$s" data-element="main-navigation">%3$s</ul>',
                            "container" => "",
                            'list_item_class'  => 'nav-item',
                            'link_class'   => 'nav-link',
                            'current_group' => $current_group,
                            'walker' => new Main_Menu_Walker()
                          ));
                      }
                    ?>
                </nav>
                <nav aria-label="Secondaria">
                  <?php
                    $location = "menu-header-right";
                    if ( has_nav_menu( $location ) ) {
                        wp_nav_menu(array(
                          "theme_location" => $location, 
                          "depth" => 0,  
                          "menu_class" => "navbar-nav navbar-secondary", 
                          "container" => "",
                          'list_item_class'  => 'nav-item',
                          'link_class'   => 'nav-link',
                          'walker' => new Menu_Header_Right_Walker()
                        ));
                    }
                    ?>
                </nav>
                  <?php
                    $show_socials = dci_get_option( "show_socials", "socials" );
                    if($show_socials == "true") : 
                    $socials = dci_get_option('link_social', 'socials');
                    ?>
                    <div class="it-socials">
                        <span>Seguici su:</span>
                        <ul>
                            <?php foreach ($socials as $social) { ?>
                              <li>
                                <a href="<?php echo $social['url_social'] ?>" target="_blank">
                                    <svg class="icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" href="#<?php echo $social['icona_social'] ?>"></use>
                                  </svg>
                                  <span class="visually-hidden"><?php echo $social['nome_social']; ?></span>
                                </a>
                            </li>
                            <?php } ?>                            
                        </ul><!-- /header-social-wrapper -->
                    </div><!-- /it-socials -->
                    <?php endif ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</header>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
        var headerNavWrapper1 = document.getElementById('header-nav-wrapper1');
        var headerNavWrapperTop = headerNavWrapper1.offsetTop;
        var headerNavWrapperHeight = headerNavWrapper1.offsetHeight;

        window.addEventListener('scroll', function() {
            var scrollPosition = window.scrollY;
            if (scrollPosition >= headerNavWrapperTop) {
                // Quando l'elemento header-nav-wrapper1 esce dalla visualizzazione della pagina, aggiungi la classe fixed-top
                headerNavWrapper1.classList.add('fixed-top');
                // Aggiungi una classe di altezza al corpo per mantenere il layout quando header-nav-wrapper1 diventa fisso
                document.body.style.paddingTop = headerNavWrapperHeight + 'px';
            } else {
                // Rimuovi la classe fixed-top quando l'elemento è tornato nella visualizzazione della pagina
                headerNavWrapper1.classList.remove('fixed-top');
                // Ripristina il padding del corpo quando l'elemento header-nav-wrapper1 non è più fisso
                document.body.style.paddingTop = '0';
            }
        });
    });
    </script>

	
	
<?php
if(!is_user_logged_in())
    get_template_part("template-parts/common/access-modal");
?>
=======
<!-- Header superiore -->
<?php
get_template_part("template-parts/header/slimheader");
?>
<!-- Fine Header superiore -->

    
  <div class="it-nav-wrapper">
        <div class="it-header-center-wrapper it-small-header theme-light">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="it-header-center-content-wrapper">
                            <div class="it-brand-wrapper">
                                <a href="<?php
echo home_url();
?>" <?php
if (!is_front_page()) {
    echo 'title="Vai alla Homepage"';
}
?>>
                                    <div class="it-brand-text d-flex align-items-center">
                                        <?php
get_template_part("template-parts/common/logo");
?>
                                       <div>
                                            <div class="it-brand-title"><?php
echo dci_get_option("nome_comune");
?></div>
                                            <div class="it-brand-tagline d-none d-md-block">
                                                <?php
echo dci_get_option("motto_comune");
?>
                                           </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="it-right-zone">
                                <?php
$show_socials = dci_get_option("show_socials", "socials");
if ($show_socials == "true"):
    $socials = dci_get_option("link_social", "socials");
?>
                                   <div class="it-socials d-none d-lg-flex">
                                        <span>Seguici su:</span>
                                        <ul>
                                            <?php
    foreach ($socials as $social) {
?>
                                               <li>
                                                    <a href="<?php
        echo $social["url_social"];
?>" target="_blank">
                                                        <svg class="icon"><use xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                              href="#<?php
        echo $social["icona_social"];
?>"></use>
                                                        </svg>
                                                        <span class="visually-hidden"><?php
        echo $social["nome_social"];
?></span>
                                                    </a>
                                                </li>
                                            <?php
    }
?>
                                       </ul><!-- /header-social-wrapper -->
                                    </div><!-- /it-socials -->
                                <?php
endif;
?>
                               <div class="it-search-wrapper">
                                    <span class="d-none d-md-block">Cerca</span>
                                    <button class="search-link rounded-icon" type="button"
                                            data-bs-toggle="modal" data-bs-target="#search-modal"
                                            aria-label="Cerca nel sito">
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
    </div>    
    
    
    
<!-- Navbar principale -->
<header id="main-header" class="it-header-wrapper sticky-top">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="<?php
echo home_url();
?>">
                <!-- Logo qui -->
                <img src="/wp-content/uploads/2024/03/Logo-rounded-2-1.png" alt="Logo">
            </a>

            <!-- Bottone per il toggle del menu su schermi ridotti -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Contenuto del menu -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <!-- Elementi del menu qui -->
<li class="nav-item">
    <a class="nav-link text-white link-sans-bold-lg" href="https://privacy.minci.it/novita/" style="font-family: 'Titillium Web', sans-serif; font-weight: 600; font-size: 18px; line-height: 28px;">Comunicati stampa e Notizie</a>
</li>
<li class="nav-item">
    <a class="nav-link text-white link-sans-bold-lg" href="https://privacy.minci.it/amministrazione/documenti-e-dati/" style="font-family: 'Titillium Web', sans-serif; font-weight: 600; font-size: 18px; line-height: 28px;">Documenti</a>
</li>
<li class="nav-item">
    <a class="nav-link text-white link-sans-bold-lg" href="https://privacy.minci.it/argomento/focus/" style="font-family: 'Titillium Web', sans-serif; font-weight: 600; font-size: 18px; line-height: 28px;">Focus</a>
</li>
                </ul>

                <!-- Barra di ricerca, social icons, etc. -->
                <div class="d-flex align-items-center">
                    <!-- Barra di ricerca -->



                        
                </div>
            </div>
        </div>
    </nav>
</header>
<!-- Fine Navbar principale -->

<?php
if (!is_user_logged_in()) {
    get_template_part("template-parts/common/access-modal");
}
?>
	
	<script>
document.addEventListener("DOMContentLoaded", function() {
    var header = document.getElementById("main-header");

    window.addEventListener("scroll", function() {
        if (window.scrollY > 50) {
            header.classList.add("sticky-header");
        } else {
            header.classList.remove("sticky-header");
        }
    });
});
</script>	
	

<?php
wp_footer();
?>
</body>
</html>
>>>>>>> Stashed changes
