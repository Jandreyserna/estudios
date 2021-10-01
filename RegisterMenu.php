<?php
class RegisterItemsClass
{
    public $name;
    public function __construct($name)
    {
        $this->name = $name;
        add_action('init', [$this, 'init']);
    }


    public function init() : void
    {
        add_action('admin_menu', [$this, 'menu_pages_register']);
    }


    public function menu_pages_register() : void
    {

        add_menu_page(
            $this->name,
            $this->name,
            'administrator',
            'Slug-'.$this->name,
            [$this, 'admin_page' ],
            'dashicons-welcome-learn-more',
            4
        );
    }

    public function admin_page()
    {
      echo "Hola desde tu nueva paage de menu";
    }


}
