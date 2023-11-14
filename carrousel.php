<?php
/**
 * Plugin name: Carrousel
 * Author: Michelle Salois Gadoury
 * Description: Cette extension permettra d'afficher plusieurs vidéos de projets 
 * Version: 1.1.0
 */

function creation_carrousel() {
    
    $leCarrousel = '<div class="carrousel">';
    
        $args = array(
            'post_type' => 'post',
            'category_name' => 'projet',
            'posts_per_page' => -1,
        );
         $query = new WP_Query($args);

        if ($query->have_posts()) {
            $leCarrousel .= '<div class="carrousel_projets">';
           
            while ($query->have_posts()) : $query->the_post();

                $projet_title = get_the_title();
                $projet_content = get_the_content();
                $projet_video = get_post_gallery();

                    $leCarrousel .= '<div class="video_projet">';
                    $leCarrousel .= '<div class="la_video">' . $projet_video . '</div>';
                    $leCarrousel .= '</div>';

                    $leCarrousel .= '<div class="info_projet">';
                    $leCarrousel .= '<h3 class="titre_projet">' . $projet_title . '</h3>';
                    //$leCarrousel .= '<p class="descritpion_projet">' . $projet_content . '</p>';
                    

                    $leCarrousel .= '<div class="carrousel__bouton">';
                    $leCarrousel .= '<button id="carrousel__gauche"><--</button>';
                    $leCarrousel .= '<button id="carrousel__droite">--></button>';
                    $leCarrousel .= '</div>';
                    $leCarrousel .= '</div>';

            $leCarrousel .= '</div>';

            endwhile;    
        }

    $leCarrousel .= '</div>';

    return $leCarrousel;
}

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
