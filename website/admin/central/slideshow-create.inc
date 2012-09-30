<div id="middle-mid">
	<?php include('../lib/includes/nav/nav-admin.inc'); ?>
	<div id="content" class="content-extended">
		<?php if ($this->action == 'create') { ?>
		<h3 class="admin">Créer un Slideshow</h3>
		<?php } else { ?>
		<h3 class="admin">Modifier un Slideshow</h3>
		<?php }?>
		<form action="slideshow.php" method="post" enctype="multipart/form-data">
			<input type="hidden" name="object_id" value="<?php echo $this->object->id; ?>" />
 			<p class="form">
 				<label class="simple" for="form-title" title="Titre du slideshow">Titre</label>				
 				<input class="simple" type="text" id="form-title" name="object_title" value="<?php echo htmlspecialchars($this->object->title); ?>"/>
 			</p>
 			<p class="form">
 				<label class="simple" for="form-subtitle" title="Sous-titre du slideshow">Sous-titre</label>				
 				<input class="simple" type="text" id="form-title" name="object_subtitle" value="<?php echo htmlspecialchars($this->object->subtitle); ?>"/>
 			</p>
 			<p class="form">
 				<label class="textarea" for="form-content" title="Contenu du slideshow">Contenu</label>
 				<textarea class="ckeditor" type="text" id="form-content" name="object_content"><?php echo $this->object->content; ?></textarea>
 			</p>
 			<p class="form">
 				<label class="simple" for="form-position" title="Un entier (1, 2, 3...) qui définira la position du slideshow dans la pagination">Position</label>				
 				<input class="simple" type="text" id="form-position" name="object_position" value="<?php echo $this->object->position; ?>"/>
 			</p>
 			<p class="form">
 				<label class="simple" for="form-image" title="Image du slideshow. Taille 793x250">Image</label>
 				<input class="file" type="file" id="form-image" name="file" />
 			</p>
 			<p class="form">
 				<input class="submit" type="submit" name="<?php echo $this->action; ?>" />
 			</p>
		</form> 
	</div>
</div>