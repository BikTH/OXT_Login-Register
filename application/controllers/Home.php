<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends App {

	protected $activePage = null;

	function __construct(){
		parent::__construct();	
	}


    public function index(){
		$this->lang->load('website/homepage', $this->language);
		$this->loadpage("homepage", array("title"=> "Openxtech", "description"=> "Template for website"));
	}



    private function loadpage($pageDIR, $meta){
		$this->load->view("website/header/head", array("meta"=> $meta, "self"=> $this));
		$this->load->view("website/header/header", array("active"=> $this->activePage, "self"=> $this));
		
		$this->load->view("website/".$pageDIR, array("self"=> $this));
		
		$this->load->view("website/footer/footer", array("active"=> $this->activePage, "self"=> $this));
		$this->load->view("website/footer/endscript", array("active"=> $this->activePage, "self"=> $this));
	}



	public function routepage($a = "", $b = null, $c = null){
		$b = !is_null($b) ? "/".$b : "";
		$c = !is_null($c) ? "/".$c : "";
		
		$dir = $a.$b.$c;
		
		// echo 'views/website/pages/' . $dir . ".php"; return;
		
		if( !is_file( APPPATH . 'views/website/pages/' . $dir . ".php" ) ){ show_404(); }
		
		$currentPage = explode("/", $dir); 
		$currentPage = is_null($b) ? $a : $a."-".$currentPage[ count($currentPage) - 1 ];
		
		// CHARGEMENT DU FICHIER LANGUE
		$this->lang->load('website/'.$currentPage, $this->language);
		
		// MARQUONS COMME ACTIVE
		$this->activePage = $a;
		
		// CHARGEMENT DE LA VUE.
		$this->loadpage("pages/".$dir, $this->meta($currentPage) );
	}



	private function meta($pageID){
		$metas = array("home"=> array("title"=> $this->lang("title"), "description"=> $this->lang("description")));
		
		if( array_key_exists($pageID, $metas) ){
			return $metas[$pageID];
		} else {
			return array("title"=> "", "description"=> "");
		}
	}
}