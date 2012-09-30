<div id="middle-mid">
	<?php include('../lib/includes/nav/nav-admin.inc'); ?>
	<div id="content" class="content-extended">
		<script>
			$(function() {
				$.datepicker.setDefaults($.datepicker.regional["fr"]);
				$( "#form-date" ).datepicker({ dateFormat: "dd/mm/yy" });			
			});
		</script>
		<?php if ($this->action == 'create') { ?>
		<h3 class="admin">Créer une Revue de presse</h3>
		<?php } else { ?>
		<h3 class="admin">Modifier Revue de presse</h3>
		<?php }?>
		<form action="press_review.php" method="post" enctype="multipart/form-data">
			<input type="hidden" name="object_id" value="<?php echo $this->object->id; ?>" />
			<input type="hidden" id="dateFormat" name="dateFormat" value="<?php echo $this->dateFormat; ?>" />
 			<p class="form">
 				<label class="simple" for="form-date" title="Date associée à cette revue de presse.">Date</label>				
 				<input class="simple" type="text" id="form-date" name="object_date" value="<?php echo htmlspecialchars($this->object->date); ?>"/>
 			</p>
 			<p class="form">
 				<label class="simple" for="form-source" title="Source de la revue de presse">Source</label>				
 				<input class="simple" type="text" id="form-source" name="object_source" value="<?php echo htmlspecialchars($this->object->source); ?>"/>
 			</p>
 			<p class="form">
 				<label class="simple" for="form-author" title="Auteur de la revue de presse">Auteur</label>				
 				<input class="simple" type="text" id="form-author" name="object_author" value="<?php echo htmlspecialchars($this->object->author); ?>"/>
 			</p>
 			<p class="form">
 				<label class="simple" for="form-label" title="Label utilisé pour la revue de presse. Si un lien est fourni, il sera appliqué sur ce label.">Label</label>				
 				<input class="simple" type="text" id="form-label" name="object_label" value="<?php echo htmlspecialchars($this->object->label); ?>"/>
 			</p>
 			<p class="form">
 				<label class="simple" for="form-url" title="Lien vers la ressource de la revue de presse si elle est disponible en ligne. Le lien sera appliqué au label.">URL</label>				
 				<input class="simple" type="text" id="form-url" name="object_url" value="<?php echo htmlspecialchars($this->object->url); ?>"/>
 			</p>
 			<?php if ($this->action == 'create') { ?>
 			<p class="form">
 				<label class="simple" for="form-file" title="Fichier associé à la revue de presse. N'accepte que les PDF. Un bug existe en cours de recherche/résolution. S'il n'était pas résolu à la mise en ligne, contactez l'administrateur pour qu'il associe le fichier">Fichier</label>
 				<input class="file" type="file" id="form-file" name="file" />
 			</p>
 			<?php } ?>
 			<p class="form">
 				<input class="submit" type="submit" name="<?php echo $this->action; ?>" />
 			</p>
		</form> 
	</div>
</div>