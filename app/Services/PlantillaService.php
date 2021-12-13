<?php

namespace App\Services;

class PlantillaService
{
    private $title = null;
    private $ficheros_css = array();
    private $ficheros_js = array();
    private $data;
    private $vista;
    private $breadcrumb = array();


    function setTitle($title): void {
        $this->title = $title;
    }

    function setCss($fichero_css): void {
        $this->ficheros_css[] = $fichero_css;
    }

    function setJs($fichero_js): void {
        $this->ficheros_js[] = $fichero_js;
    }

    function setBreadcrumb($breadcrumb) {
        $this->breadcrumb = $breadcrumb;
    }


    public function load($vista, $data = array()) {
        $this->vista = $vista;
        $this->data = $data;
        return view('plantilla/plantilla', get_object_vars($this));
    }


    public function loadDatatables()
    {
        $this->setCss('plantilla/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css');
        $this->setJs('plugins/DataTables/custom.js');
        $this->setJs('plugins/DataTables/datatables.min.js');
    }

}
