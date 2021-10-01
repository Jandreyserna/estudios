<?php
/*
Plugin Name: estudios
Description: Este plugin sirve para crear item de menu.
Version: 0.001
Author: Jandrey Steven Serna
License: private
*/



class PrimaryClass
{
    public function __construct()
    {
        add_action('init', [$this, 'init']);
        //add_action( 'init', [$this, '']);
    }
    public function init() : void
    {
        add_action('admin_menu', [$this, 'menu_pages']);

    }

    public function menu_pages() : void
    {
        add_menu_page(
            'CREAR',
            'CREAR',
            'administrator',
            'CREAR',
            [$this, 'admin_page' ],
            'dashicons-welcome-learn-more',
            4
        );

        if ( $menuPages = get_option( "registed_Menu") ) {
            foreach($menuPages){

            }
        }
        
    }

    public function menu_pages_register() : void
    {
        $arregloMenu = array ([
            $this->newMenu,
            $this->newMenu,
            'administrator',
            'Slug-'.$this->newMenu,
            [$this, 'admin_page_registed' ],
            'dashicons-welcome-learn-more',
            4
        ]);

        

        add_option( "registed_Menu", $arregloMenu);
        
    }

    public function admin_page_registed()
    {
      echo "Hola desde tu nueva paage de menu";
    }

    /**
     * funciones de menus y submenus
     *
     * @return Void
     **/

    public function admin_page()
    {
        if(!empty($_POST['menu-name'])){
            echo "hola desde post";
            $this->newMenu = $_POST['menu-name'];
            //new RegisterItemsClass($_POST['menu-name']);

            $this->menu_pages_register();
            // add_action('admin_menu', [$this, 'menu_pages_register']);
        }


?>
      <form class="" action="" method="post">
        <label for="camp">digite el nombre del menu</label>
        <input type="text" name="menu-name" value="">
        <button type="submit" name="button">Registrar</button>
      </form>
<?php
    }


}

new PrimaryClass;
