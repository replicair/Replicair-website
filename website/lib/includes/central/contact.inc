<?php
	if ($this->mailResult == "KO" or $this->mailResult == "OK") { ?>
		<script>
		function showHide(action,id) {
			if (action == 'show') {
				$('#'+id).css("display", "block");
			}
			if (action == 'hide') {
				$('#'+id).css("display", "none");
			}
		};
		</script>
	<?php }
	if ($this->mailResult == "KO") { ?>
		<div id="errors" class="floatingmessage">
		<img class="close" src="<?php echo $this->rootImg ?>img/style/close.png" alt="fermer" onclick="showHide('hide','errors');" />
		<img class="floatingmessageheader" src="<?php echo $this->rootImg ?>img/style/error.png" alt="erreur" />
		<p>Votre message n'a pas pu être envoyé pour les raisons suivantes : </p>
			<ul>
				<?php foreach ($this->errors as $error) { ?>
				<li><?php echo $error?></li>
				<?php } ?>
			</ul>
			<p>Si le problème persiste, nous vous invitons à nous contacter par votre client email habituel à <a class="normal" href="mailto:<?php echo MAIL_TO ?>"><?php echo MAIL_TO ?></a></p>
		</div>
	<?php 
	}
	if ($this->mailResult == "OK") { ?>
	<div id="validmessage" class="floatingmessage">
	<img  class="close"  src="<?php echo $this->rootImg ?>img/style/close.png" alt="fermer" onclick="showHide('hide','validmessage');" />
	<img class="floatingmessageheader" src="<?php echo $this->rootImg ?>img/style/valid.png" alt="erreur" />
	<p>Votre message a bien été envoyé à notre association.</p>
	<p>Nous en prendrons bientôt connaissance.</p>
	<p>Merci pour votre intérêt !</p>
	</div>
	<?php
	}
	?>
	<h3 class="form">Formulaire de contact</h3>
	<div class="form">
	<form action="contact.php" method="post">
		<p class="form">
 			<label class="public" for="form-email-name">Nom</label>				
 			<input class="public" type="text" id="form-email-name" name="mail_name" maxlength="255" value="<?php echo $this->mail->name ?>"/>
 		</p>
 		<p class="form">
 			<label class="public" for="form-email-from">Courriel</label>				
 			<input class="public" type="text" id="form-email-from" name="mail_from" maxlength="255" value="<?php echo $this->mail->from ?>"/>
 		</p>
 		<p class="form">
 			<label class="public" for="form-email-phone">Téléphone</label>				
 			<input class="public" type="text" id="form-email-phone" name="mail_phone" maxlength="15" value="<?php echo $this->mail->phone ?>"/>
 		</p>
 		<p class="form">
 			<label class="public" for="form-email-subject">Sujet</label>				
 			<input class="public" type="text" id="form-email-subject" name="mail_subject" maxlength="255" value="<?php echo $this->mail->subject ?>"/>
 		</p>
 		<p class="form">
 			<label class="public textarea" for="form-email-message">Message</label>
 			<textarea class="public" type="text" id="form-email-message" name="mail_message"><?php echo $this->mail->message ?></textarea>
 		</p>
 		<div style="margin-top:10px; width: 100%">
 			<img style="margin: auto; margin-top:10px; display: block; clear: both; width: 200px;" id="captcha" src="<?php echo $this->rootImg ?>lib/script/securimage/securimage_show.php" alt="CAPTCHA Image" />
 			<div style="width: 130px; margin: auto;">
 				<a href="#" onclick="document.getElementById('captcha').src = '<?php echo $this->rootImg ?>lib/script/securimage/securimage_show.php?' + Math.random(); return false"><img src="<?php echo $this->rootImg ?>img/style/refresh.png" style="height: 20px;" alt="générer une autre image" title="générer une nouvelle image" /></a>
 				<input type="text" name="captcha_code" size="10" maxlength="6" />
 			</div>
		</div>
 		<p class="form" style="text-align:right; margin-right: 80px;">
 			<?php if ($this->mailResult == "KO") { ?>
 			<img src="<?php echo $this->rootImg ?>img/style/error.png" alt="erreur" title="Montrer les erreurs" style="width: 50px;cursor: pointer;" onclick="showHide('show','errors')" />
 			<?php } ?>
 			<button title="Soumettre votre message" type="submit" name="email" style="border: 0; background: transparent; cursor: pointer;">
    			<img src="<?php echo $this->rootImg ?>img/style/send.png" width="50" height="50" alt="submit" />
			</button>
 		</p>
	</form>
	</div>