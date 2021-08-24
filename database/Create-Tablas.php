<?php


class Hook_activation_desactivate
{
  public $wpdb;
  public $nombre_tabla;
  public $key_foreaneas = null;

  function __construct()
  {
      global $wpdb;
      $this->wpdb = $wpdb; # dejamos el wpdb como global dentro de el archivo modelo.php
      $this->nombre_tabla = 'wp_options';
  }

    function insertar_data_wpdb($datos)
    {
        $this->wpdb->insert(
            $this->nombre_tabla, # TABLA
            $datos # DATOS
        );
    }


    function view_data_delete()
    {
        $informacion = $this->wpdb->get_results(
          "SELECT *
          FROM `{$this->nombre_tabla}`
          WHERE option_name = 'flikimax'",
           'ARRAY_A'
         );
        return (isset($informacion[0])) ? $informacion : null;
  }

  function data_delete($data)
    {
        $this->wpdb->delete( 
            $this->nombre_tabla, 
            array( 'option_id' => $data) 
        );
    }

  

}
//$nombre_tabla = $wpdb-> prefix . "flikimax";

//$created = dbDelta(
//    "CREATE TABLE $nombre_tabla (
//        ID bigint(20) unsigned NOT NULL AUTO_INCREMENT,
//        Name_complete Varchar (60) NOT NULL DEFAULT 'NN',
//        PRIMARY KEY (ID)

//    ) CHARACTER SET utf8 COLLATE utf8_spanish2_ci;"
//);