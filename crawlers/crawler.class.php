<?php

class Crawler{
	
	private $url;
	private $parameters;
	private $is_post = false;
	private $curlobj;
	private $html;
	private $post_fields;
	
	public function __construct(){
	}
	
	public function __crawl( $url, $parameters = array() ){
		$this->url = $url;
		$this->parameters = $parameters;
		if( ! empty( $parameters ) ){
			$this->is_post = true;
			foreach( $parameters as $k=>$v ){
				$this->post_fields .= $k . '=' . $v . '&';
			}
			$this->post_fields = rtrim( $this->post_fields, '&' );
		}
		$this->__init();
		$this->__exec();
		return $this->getHtml();
	}
	
	private function __init(){
		$this->curlobj = curl_init();
		curl_setopt( $this->curlobj, CURLOPT_URL, $this->url );
		curl_setopt( $this->curlobj, CURLOPT_URL, $this->url );
		curl_setopt( $this->curlobj, CURLOPT_AUTOREFERER, true );
		curl_setopt( $this->curlobj, CURLOPT_RETURNTRANSFER, true );
		if( $this->is_post ){
			curl_setopt( $this->curlobj, CURLOPT_POST, true );
			curl_setopt( $this->curlobj, CURLOPT_POSTFIELDS, $this->post_fields );
		}
	}
	
	private function __exec(){
		$this->html = curl_exec( $this->curlobj );
	}
	
	public function getHtml(){
		return $this->html;
	}
	
}

?>