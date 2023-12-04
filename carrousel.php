<?php
/**
 * Plugin name: Carrousel
 * Author: Michelle Salois Gadoury
 * Description: Cette extension permettra d'afficher plusieurs articles dans un carrousel
 * Version: 1.4.0
 */
function creation_carrousel($atts) {
    ob_start();

     $atts = shortcode_atts(array(
        'posts_per_page' => 5, 
    ), $atts);               
    
    $query_args = array(
        'post_type' => 'post',
        'category_name' => 'projet',
        'posts_per_page' => $atts['posts_per_page'],
    );
        $query = new WP_Query($query_args);

    if ($query->have_posts()) {
        echo '<div class="carrousel">';

            while ($query->have_posts()) {
            $query->the_post();

            echo '<div class="projet_article">';

            echo '<div class="projet_info">';
                //les boutons pour changer d'articles
                echo '<div class="carrousel_bouton">';
                echo '<button id="bouton_gauche" onclick="plusArticles(-1)"></button>';
                echo '<button id="bouton_droit" onclick="plusArticles(1)"></button>';
                echo '</div>';

                //titre et description
                echo '<div class="projet_titre_desc">';
                echo '<h2 class="test">' . get_the_title() . '</h2>';
                echo '<p>' . get_the_content() . '</p>';
                echo '</div>';
            echo '</div>';

                //image de fond (miniature)
                echo '<div class="projet_image">';
                echo '<div>' . the_post_thumbnail('medium') . '</div>';
                echo '</div>';

            echo '</div>';
            }
        echo '</div>';
    }

    wp_reset_postdata();
    $output = ob_get_clean();
    return $output;
}
//shortcode du plugin [carrousel]
add_shortcode('carrousel', 'creation_carrousel');

//chercher la page javascript du carrousel
function mon_enqueue_js(){
    $version_js = filemtime(plugin_dir_path(__FILE__) . "js/carrousel.js");    

    wp_enqueue_script('em_plugin_carrousel_js',
                    plugin_dir_url(__FILE__) ."js/carrousel.js",
                    array(),
                    $version_js,
                    true);
}
add_action('wp_enqueue_scripts', 'mon_enqueue_js');



