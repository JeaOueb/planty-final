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


// Création d'un lien "Admin" dans le menu de navigation du header, qui n'est affiché que lorsque l'utilisateur est connecté sur WordPress Admin, en utilisant un hook

function add_admin_item_to_nav_menu($items, $args)
{
    if (is_user_logged_in() && $args->theme_location == 'menu-1') {
        // Créer le nouvel élément de menu
        $new_item = '<li id="menu-item-477"><a href="/planty/wp-admin/"><span>Admin</span></a></li>';

        // Initialiser un compteur
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
    return $items;
}

add_filter('wp_nav_menu_items', 'add_admin_item_to_nav_menu', 10, 2);

