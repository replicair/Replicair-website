<?php

class Mail {
	
	var $subject;
	var $message;
	var $phone;
	var $from;
	var $name;
	
	public function toString() {
		return "Mail:[name:".$this->name."][from:".$this->from."][phone:".$this->phone."][subject:".$this->subject."]";
	}
}
?>