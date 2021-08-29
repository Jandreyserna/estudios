<?php
/*
Plugin Name: Primera clase
Description: Este plugin sirve. Estudiando wordpress.
Version: 1.0
Author: Jandrey Steven Serna 
License: private
*/

/**
 * Clase inicial plugin
 */
class PrimeraClase  
{
    public function __construct()
    {
        add_action('init', [$this, 'init']);
        //add_action('init', [$this, 'shortcodes_init']);
        register_activation_hook(__FILE__, [$this, 'activation']);
        register_deactivation_hook(__FILE__, [$this, 'deactivation']);
    }


    public function init() : void
    {
        add_shortcode( 'autor', [$this ,'shortcode_mostrar_autor']);
        add_action('admin_menu', [$this, 'menu_pages']);
    }

    public function menu_pages() : void
    {
        add_menu_page(
            'Menu',
            'Menu',
            'administrator',
            'flikifeo',
            [$this, 'admin_page'],
            'dashicons-schedule',
            3
        );

        add_options_page (
            'OAF Settings', 
            'OAF Settings', 
            'manage_options', 
            'oaf_create_submenu_plugin', 
            [$this, 'oaf_create_submenu_function']
        );
    }


    public function oaf_create_submenu_function()
    {
        echo "Aloha setting page";
    }
    
    public function admin_page()
    {
        echo "Aloha admin_page";
    }



    /**
     * Activacion del plugin
     *
     * @return Void
     **/
    public function activation() : void
    {
        $option = get_option('aloha');
        if (!$option) {
            add_option('aloha', 'Aloha mundo');
        }
    }

    /**
    * Desactivacion del plugin
    *
    * @return Void
    **/
    function deactivation() : void
    {
        if ($option = get_option('aloha')) {
            delete_option('aloha');
        }
    }
    function shortcode_mostrar_autor($atts) {

        $p = shortcode_atts( array (
              'nombre' => 'Invitado'
              ), $atts );
              
        $texto = "<H1>".'Este artículo ha sido creado por '.$p['nombre']."</H1>";
        return $texto;
    }
    
    /* function shortcodes_init(){
        add_shortcode( 'shortcode_name', 'shortcode_handler_function' );

       } */
}


new PrimeraClase;




/*
add_action('init', 'fnt_init', 0);
function fnt_init() {
    add_action('admin_menu', 'leeft_admin_menu');
}

function leeft_admin_menu()
{
    add_menu_page(
      'Menu',
      'Menu',
      'administrator',
      'flikifeo',
      'admin_page',
      'dashicons-schedule',
      3
    );
}
*/


/*

add_action( 'admin_menu', 'oaf_create_submenu');

function oaf_create_submenu() {

	add_options_page ('OAF Settings', 'OAF Settings', 'manage_options', 'oaf_create_submenu_plugin', 'oaf_create_submenu_function' );

}

function oaf_create_submenu_function () {
    echo "aloha";
}

function admin_page()
{
    echo "aloha fliki";
}
*/