<?php

namespace App\Services;

class PlantillaService
{
    private $title = null;
    private $icon = null;
    private $ficheros_css = array();
    private $ficheros_js = array();
    private $data;
    private $vista;
    private $breadcrumb = array();
    private $header = true;
    private $sidebar = true;
    private $footer = true;
    private $page_breadcrumb = true;
    private $page_class = 'page-wrapper';


    function setTitle($title): void {
        $this->title = $title;
    }

    function setIcon($icon): void {
        $this->icon = $icon;
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

    function setHeader($header) {
        $this->header = $header;
    }

    function setSidebar($sidebar) {
        $this->sidebar = $sidebar;
        if (!$sidebar) {
            $this->page_class = 'auth-wrapper';
        }
    }

    public function setFooter($footer)
    {
        $this->footer = $footer;
    }

    public function setPageBreadcrumb($page_breadcrumb)
    {
        $this->page_breadcrumb = $page_breadcrumb;
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


    public function loadSelect2()
    {
        $this->setCss('plugins/select2/dist/css/select2.min.css');
        $this->setCss('plugins/select2/custom.css');
        $this->setJs('plugins/select2/dist/js/select2.full.min.js');
        $this->setJs('plugins/select2/dist/js/i18n/es.js');
    }


    public function loadDaterangepicker()
    {
        $this->setCss('plugins/daterangepicker/daterangepicker.css');
        $this->setJs('plugins/daterangepicker/custom.js');
        $this->setJs('plugins/daterangepicker/daterangepicker.js');
    }

}
