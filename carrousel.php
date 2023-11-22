<?php
/**
 * Plugin name: Carrousel
 * Author: Michelle Salois Gadoury
 * Description: Cette extension permettra d'afficher plusieurs vidéos de projets 
 * Version: 1.2.0
 */

function creation_carrousel($atts) {
    ob_start();
    
    //$leCarrousel = '<div class="article">';
      //$leCarrousel .= '</div>';
           /* $leCarrousel .= '<div class="carrousel__bouton">';
                    $leCarrousel .= '<button id="carrousel__gauche"><--</button>';
                    $leCarrousel .= '<button id="carrousel__droite">--></button>';
                    $leCarrousel .= '</div>';*/
     $atts = shortcode_atts(array(
        'posts_per_page' => 5, // Nombre d'articles à afficher
    ), $atts);               
    
        $query_args = array(
            'post_type' => 'post',
            'category_name' => 'projet',
            'posts_per_page' => $atts['posts_per_page'],
        );
         $query = new WP_Query($query_args);

        if ($query->have_posts()) {
            echo '<div id="carousel">';
            //$leCarrousel .= '<div class="tructruc">';
           
            while ($query->have_posts()) {
            $query->the_post();
        echo '<div class="tructruc">';
            echo '<div>' . get_the_title() . '</div>';
            echo '<div>' . get_the_content() . '</div>';
             echo '</div>';
            }
        echo '</div>';

                //$projet_title = get_the_title();
                //$projet_content = get_the_content();
               // $projet_video = get_post_gallery();

       
        //$leCarrousel .= '<div class="article">';
       // $leCarrousel .= '<h2 class="titre_projet">' . $projet_title . '</h2>';
        //$leCarrousel .= '<p class="descritpion_projet">' . $projet_content . '</p>';

                  /* $leCarrousel .= '<div class="video_projet">';
                   // $leCarrousel .= '<div class="la_video">' . $projet_video . '</div>';
                    $leCarrousel .= '</div>';

                    $leCarrousel .= '<div class="info_projet">';
                    $leCarrousel .= '<h3 class="titre_projet">' . $projet_title . '</h3>';
                    $leCarrousel .= '<p class="descritpion_projet">' . $projet_content . '</p>';*/

                    
//$leCarrousel .= '</div>';
          

            //endwhile;    
        //}

     echo '<button id="prevBtn" onclick="plusSlides(-1)">Précédent</button>';
        echo '<button id="nextBtn" onclick="plusSlides(1)">Suivant</button>';
    }

    wp_reset_postdata();

    $output = ob_get_clean();
    return $output;
}


   // $leCarrousel .= '</div>';

    //return $leCarrousel;
    //wp_reset_postdata();
    //return ob_get_clean();
//}


function mon_enqueue_js(){
    $version_js = filemtime(plugin_dir_path(__FILE__) . "js/carrousel.js");    

    wp_enqueue_script('em_plugin_carrousel_js',
                    plugin_dir_url(__FILE__) ."js/carrousel.js",
                    array(),
                    $version_js,
                    true);
}

add_action('wp_enqueue_scripts', 'mon_enqueue_js');
add_shortcode('carrousel', 'creation_carrousel');
?>
