<?php
include_once(SITE_PATH . '/lib/classes/Template.php');
include_once(SITE_PATH . '/lib/classes/Mail.php');
include_once(SITE_PATH . '/lib/script/securimage/securimage.php');

class MailController {
	
	var $defaultFrom = MAIL_FROM;
	var $defaultTo = MAIL_TO;
	
	var $parameterForm = "email";
	
	
	private function mapRequestObject($parameters) {
		$object = new Mail();
		$object->subject = $parameters['mail_subject'];
		$object->message = $parameters['mail_message'];
		$object->from = $parameters['mail_from'];
		$object->phone = $parameters['mail_phone'];
		$object->name = $parameters['mail_name'];
		//$object->capcha = $parameters['captcha_code'];
		return $object;
	}
	
	private function cleanString($string) {
		$bad = array("content-type","bcc:","to:","cc:","href");
		return str_replace($bad,"",$string);
	}
	
	private function checkMail($mail) {
		$errors = array();
		
		$regexpString = '/^[A-Za-z .\'-]+$/';
		$regexpMail = '/^[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}$/i';
		
		/*$securimage = new Securimage();
		if ($securimage->check($mail->capcha) == false) {
			array_push($errors,"Le code fourni ne correspondait pas à l'image générée, veuillez réessayer.");
			return $errors;
		}*/
		
		if (empty($mail->from) && empty($mail->phone)) {
			array_push($errors,"Le courriel ou le téléphone sont nécessaires pour que nous puissions vous recontacter.");
		}
		if (empty($mail->subject)) {
			array_push($errors,"Le sujet est obligatoire.");
		}
		if (empty($mail->message)) {
			array_push($errors,"Le message est obligatoire.");
		}
		
		if (count($errors) == 0) {
			if(strlen($mail->name) > 255) {
				array_push($errors,"Le nom fourni est trop long.");
			}
			if(strlen($mail->from) > 255) {
				array_push($errors,"Le courriel fourni est trop long.");
			}
			if(strlen($mail->phone) > 15) {
				array_push($errors,"Le téléphone fourni est trop long.");
			}
			if(strlen($mail->SUBJECT) > 255) {
				array_push($errors,"Le sujet fourni est trop long.");
			}
		}
			
		if (count($errors) == 0) {
			if(!preg_match($regexpString,$mail->name)) {
				array_push($errors,"Le nom fourni ne semble pas être valide.");
			}
			if(!preg_match($regexpMail,$mail->from)) {
				array_push($errors,"Le courriel fourni ne semble pas être un email valide.");
			}
			if(strlen($mail->message) < 2) {
				array_push($errors,"Le message fourni ne semble pas valide.");
			}
		}
		return $errors;
	}
	
	private function getMessageFieldValue($key, $value) {
		if (!empty($value)) {
			return $key. " : " .$value."\n";
		}
		else {
			return $key. " : non fourni.\n";
		}
	}
	
	private function adaptMail($mail) {
		$mail->from = $this->cleanString($mail->from);
		$mail->subject = $this->cleanString($mail->subject);
		$mail->message = $this->cleanString($mail->message);
		$mail->name = $this->cleanString($mail->name);
		$mail->phone = $this->cleanString($mail->phone);
		
		$message = "#################### Emetteur ####################\n";
		$message .= $this->getMessageFieldValue("Nom",$mail->name);
		$message .= $this->getMessageFieldValue("E-Mail",$mail->from);
		$message .= $this->getMessageFieldValue("Téléphone",$mail->phone);
		
		$message .= "\n#################### Message ####################\n";
		$message .= $mail->message;
		
		$mail->message = $message;
		return $mail;
	}
	
	private function sendMail($mailToSend) {
		$from = $this->defaultFrom;
		if (!empty($mailToSend->from)) {
			$from = $mailToSend->from; 
		}
		$headers = 'From: '.$this->defaultFrom."\r\n".
				'Reply-To: '.$from."\r\n" .
				'Content-Type: text/plain; charset="iso-8859-1"' .
				'X-Mailer: PHP/' . phpversion();
		if(@mail($this->defaultTo, $mailToSend->subject, $mailToSend->message, $headers)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	private function prepareTemplateForMail($mail, $errors, $sended) {
		$t = new Template();
		$t->mail = $mail;
		$t->errors = $errors;
		
		if ($sended == TRUE) {
			$t->mailResult = 'OK';
		}
		else {
			if (count($errors) > 0) {
				$t->mailResult = 'KO';
			} else {
				$t->mailResult = 'NOK';
			}
		}
		
		return $t;
	}
	
	public function handleMail($post) {	
		/*$regexpString = '/^[A-Za-z .\'-]+$/';
		preg_match($regexpString,"tsert");*/
		$mail = new Mail();
		$errors = array();
		$sended = FALSE;
		if (isset($post[$this->parameterForm])) {
			$mail = $this->mapRequestObject($post);
			$errors = $this->checkMail($mail);
			if (count($errors) == 0) {
				$finalmail = $this->adaptMail($mail);
				$sended = $this->sendMail($finalmail);
				if ($sended == FALSE) {
					array_push($errors,"L'envoi du mail a échoué pour des raisons techniques.");
				}
				else {
					$mail = new Mail();
				}
			}
		}
		return $this->prepareTemplateForMail($mail, $errors, $sended);
	}
}
?>