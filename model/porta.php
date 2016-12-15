<?php

class Porta{

  private $idPort;
  private $port;
  private $state;
  private $service;
  
  public function getIdPort(){
		return $this->idPort;
	}

	public function setIdPort($idPort){
		$this->idPort = $idPort;
	}

	public function getPort(){
		return $this->port;
	}

	public function setPort($port){
		$this->port = $port;
	}

	public function getState(){
		return $this->state;
	}

	public function setState($state){
		$this->state = $state;
	}

	public function getService(){
		return $this->service;
	}

	public function setService($service){
		$this->service = $service;
	}

}




?>
