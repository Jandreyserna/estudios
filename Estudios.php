<?php
/*
Plugin Name: Estudios
Description: Este plugin sirve para crear item de menu.
Version: 0.1
Author: Jandrey Steven Serna
License: private
*/



class PrimaryClass
{
    public function __construct()
    {
        add_action('init', [$this, 'init']);
    }

    public function init() : void
    {
        add_action('admin_menu', [$this, 'menu_pages']);

    }

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function menu_pages() : void
    {
        add_menu_page(
            'CREAR',
            'CREAR',
            'administrator',
            'CREAR',
            [$this, 'admin_page'],
            'dashicons-welcome-learn-more',
            4
        );

        if ( $menuPages = get_option('registed_menu_pages') ) {
            foreach($menuPages as $menuPage){
                add_menu_page(
                    $menuPage['page_title'],
                    $menuPage['menu_title'],
                    $menuPage['capability'],
                    $menuPage['menu_slug'],
                    $menuPage['callable'],
                    $menuPage['icon_url'],
                    $menuPage['position'],
                );
                if( !empty($menuPage['submenus']) ){
                    foreach( $menuPage['submenus'] as $submenu){
                        add_submenu_page( 
                            $submenu['parent_slug'],
                            $submenu['page_title'], 
                            $submenu['menu_title'], 
                            $submenu['capability'], 
                            $submenu['menu_slug'], 
                            $submenu['callable'], 
                            $submenu['position'] 
                        );
                    }
                }             
            }
        }
    }

    public function menu_pages_register(string $name) : void
    {
        $slug = strtolower($name);
        $slug = str_replace(' ', '-', $name);

        $menuPage = array (
            'page_title' => $name,
            'menu_title' => $name,
            'capability' => 'administrator',
            'menu_slug'  => $slug,
            'callable' => [$this, 'admin_page_registed' ],
            'icon_url' => 'dashicons-welcome-learn-more',
            'position' => 4
        );

        if ( $menuPages = get_option('registed_menu_pages') ) {
            $menuPages[] = $menuPage;

            update_option( "registed_menu_pages", $menuPages);
        } else {
            add_option( "registed_menu_pages", array($menuPage) );
        }
    }

    /**
     * undocumented function summary
     *
     * funcion para registrar submenus
     *

     * @throws conditon
     **/
    public function submenu_pages_register(string $namesubmenu , int $position) : void
    {
        $slug = strtolower($namesubmenu);
        $slug = str_replace(' ', '-', $namesubmenu);
        $menuPages = get_option('registed_menu_pages');
        $submenuPage = array (
            'parent_slug' => $menuPages[$position]['menu_slug'] ,
            'page_title' => $namesubmenu,
            'menu_title' => $namesubmenu,
            'capability' => 'administrator',
            'menu_slug'  => $slug,
            'callable' => [$this, 'sub_admin_page_registed' ],
            'position' => 1
        );

        if ( $menuPages = get_option('registed_menu_pages') ) {
            if ( !empty($menuPages[$position]['submenus'])  ) {

                $menuPages[$position]['submenus'][] = $submenuPage;
                update_option( "registed_submenu_pages", $menuPages);

            } else {

                $menuPages[$position]['submenus'] = array($submenuPage);
                update_option( "registed_submenu_pages", $menuPages);
            }  
        }
    }

    public function admin_page_registed()
    {
      echo "Hola desde tu nueva paage de menu";
    }

    public function sub_admin_page_registed()
    {
      echo "Hola desde tu nueva sub page de menu";
    }

    /**
     * funciones de menus y submenus
     *
     * @return Void
     **/

    public function admin_page()
    {
        if ( !empty($_POST['menu-name']) ) {

            $this->menu_pages_register( sanitize_text_field($_POST['menu-name']) );

        } else if ( !empty($_POST['submenu-name']) ) {

            $positionMenu = $_POST['Menu'];
            $this->submenu_pages_register( 
                sanitize_text_field($_POST['submenu-name']), 
                $positionMenu  
            );
        }
        $menuPages = get_option('registed_menu_pages');
        ?>

        <form class="" action="" method="post">
            <label for="camp">Digite el nombre del menu</label>
            <input type="text" name="menu-name" value="">
            <button type="submit" name="button">Registrar</button>
        </form>

        <form class="" action="" method="post">

            <select name="Menu" required>
                <option value="" disabled selected>Escoger un Menu</option>
                <?php $j = 0;
                      foreach ($menuPages as $menuPage): ?>
                            <option value="<?=$j?>"> <?= $menuPage['page_title']?>)</option>
                <?php endforeach; ?>
            </select>

            <label for="camp">Digite el nombre del Submenu</label>
            <input type="text" name="submenu-name" value="">
            <button type="submit" name="button">Registrar</button>
        </form>

        
        <?php
    }


}

new PrimaryClass;
