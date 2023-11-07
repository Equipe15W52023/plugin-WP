<?php
/**
 * Plugin name: Carrousel
 * Author: Michelle Salois Gadoury
 * Description: Cette extension permettra d'afficher plusieurs vidéos de projets 
 * Version: 1.0.0
 */

function mon_enqueue_js(){
    $version_js = filemtime(plugin_dir_path(__FILE__) . "js/carrousel.js");    

    wp_enqueue_script('em_plugin_carrousel_js',
                    plugin_dir_url(__FILE__) ."js/carrousel.js",
                    array(),
                    $version_js,
                    true);

}

add_action('wp_enqueue_scripts', 'mon_enqueue_js');


function creation_carrousel()
{
     $args = array(
            'post_type' => 'post',
            'category_name' => 'projet',
            'posts_per_page' => -1,
        );
    
    return "
    <div class='carrousel'>
    <figure class='carrousel__figure'></figure>
    <div class='carrousel__bouton'>
    <button class='carrousel__gauche'><--</button>
    <button class='carrousel__droite'>--></button>
    </div>
    <form class='carrousel__form'><?php the_content(); ?></form>
    </div> <!-- fin du carrousel -->
    ";
}
add_shortcode('carrousel', 'creation_carrousel');
