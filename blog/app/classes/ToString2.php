<?php

namespace App\classes;

class ToString2
{
	private $string;

	public function __construct()
	{
		$this->string = '<html><body><pre>&lt;p&gt;DSADASDASDSAdasdasdadsdasdadsadsdadsdadsadsdasdsdasdadsadsdads&lt;/p&gt;</pre></body></html>';
	}

	public function __toString(){
        return $this->string;
	}
}

