<?
class verify {
	// other validation examples: http://php.net/manual/ru/filter.examples.validation.php
	function init(){
		
	}
	function email( $what ){
		if ( filter_var($what, FILTER_VALIDATE_EMAIL) )
			return true;
		return false;
	}
	function phone( $what ){
		if ( filter_var($what, FILTER_VALIDATE_REGEXP, array('options'=>array('regexp'=>'/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/')) ) )
			return true;
		return false;
	}
	function url( $what ){
		if ( filter_var($what, FILTER_VALIDATE_URL) )
			return true;
		return false;
	}
	function ip( $what ){
		if ( filter_var($what, FILTER_VALIDATE_IP) )
			return true;
		return false;
	}
}