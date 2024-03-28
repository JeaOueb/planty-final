<?php
/**
 * Theme functions and definitions.
 *
 * For additional information on potential customization options,
 * read the developers' documentation:
 *
 * https://developers.elementor.com/docs/hello-elementor-theme/
 *
 * @package HelloElementorChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'HELLO_ELEMENTOR_CHILD_VERSION', '2.0.0' );

/**
 * Load child theme scripts & styles.
 *
 * @return void
 */
function hello_elementor_child_scripts_styles() {

	wp_enqueue_style(
		'hello-elementor-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		[
			'hello-elementor-theme-style',
		],
		HELLO_ELEMENTOR_CHILD_VERSION
	);

}
add_action( 'wp_enqueue_scripts', 'hello_elementor_child_scripts_styles', 20 );


// Création d'un lien "Admin" dans le menu de navigation du header, qui n'est affiché que lorsque l'utilisateur est connecté sur WordPress Admin, entre le lien Nous rencontrer et le lien "Commander", grâce à un hook

// Fonction qui permet d'ajouter l'élément Admin au menu de navigation
function add_admin_item_to_nav_menu($items, $args) 
{
    if (is_user_logged_in() && $args->theme_location == 'menu-1') {
        // Créer le nouvel élément de menu, si l'utilisateur est connecté
        $new_item = '<li id="menu-item-477"><a href="/planty/wp-admin/"><span>Admin</span></a></li>';

        // Initialiser un compteur qui compte les éléments du menu (0=1er élément)
        $counter = 0;

        // Parcourir les éléments du menu existant
        $menu_items = explode('</li>', $items);
        foreach ($menu_items as &$menu_item) {
            $menu_item .= '</li>';
            $counter++;
           
            // Insérer le nouvel élément après le premier élément du menu (2e position)
            if ($counter === 1) {
                $menu_item .= $new_item;
            }
        }

        // Joindre les éléments du menu dans une seule chaîne
        $items = implode('', $menu_items);
    }
    //  les éléments de menu modifiés sont renvoyés pour être affichés dans le menu de navigation
    return $items;
}
// cette fonction sera appelée chaque fois que les éléments de menu sont générés dans WordPress, permettant ainsi de modifier dynamiquement les éléments du menu
add_filter('wp_nav_menu_items', 'add_admin_item_to_nav_menu', 10, 2);

