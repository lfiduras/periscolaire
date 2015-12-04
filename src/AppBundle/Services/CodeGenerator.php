<?php

namespace AppBundle\Services;

class CodeGenerator{
	
	public function genCode($nbCaracteres = 10){
		return substr(md5(uniqid(rand(), true)),0,20);
	}
	
}