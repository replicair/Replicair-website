<div id="middle-mid">
	<?php include('../lib/includes/nav/nav-admin.inc'); ?>
	<div id="content" class="content-extended">
		<?php if ($this->action == 'create') { ?>
		<h3 class="admin">Créer une News</h3>
		<?php } else { ?>
		<h3 class="admin">Modifier une News</h3>
		<?php }?>
		<form action="news.php" method="post" enctype="multipart/form-data">
			<input type="hidden" name="object_id" value="<?php echo $this->object->id; ?>" />
 			<p class="form">
 				<label class="simple" for="form-title" title="Titre de cette actualité. Il sera affiché dans la liste des actualités et dans le zoom de l'actualité.">Titre</label>				
 				<input class="simple" type="text" id="form-title" name="object_title" value="<?php echo htmlspecialchars($this->object->title); ?>"/>
 			</p>
 			<p class="form">
 				<label class="simple" for="form-title-short" title="Titre raccourci de cette actualité. Il sera affiché dans le petit bandeau actualités en bas de la page.">Titre raccourci</label>				
 				<input class="simple" type="text" id="form-title-short" name="object_titleShort" value="<?php echo htmlspecialchars($this->object->titleShort); ?>"/>
 			</p>
 			<p class="form">
 				<label class="textarea" for="form-abstract" title="Résumé de cette actualité. Il sera affiché uniquement dans la liste des actualités.">Résumé</label>
 				<textarea class="ckeditor" type="text" id="form-abstract" name="object_abstract"><?php echo $this->object->abstract; ?></textarea>
 			</p>
 			<p class="form">
 				<label class="simple" for="form-abstract-short" title="Résumé raccourci de cette actualité. Il sera affiché uniquement dans le bandeau des actualités en bas de page." >Résumé raccourci</label>				
 				<input class="simple" type="text" id="form-abstract-short" name="object_abstractShort" value="<?php echo htmlspecialchars($this->object->abstractShort); ?>"/>
 			</p>
 			<p class="form">
 				<label class="textarea" for="form-content" title="Contenu de la news. Il sera affiché dans le zoom de cette actualité.">Contenu</label>
 				<textarea class="ckeditor" type="text" id="form-content" name="object_content"><?php echo $this->object->content; ?></textarea>
 			</p>
 			<p class="form">
 				<label class="simple" for="form-image" title="Image de l'actualité. Elle sera affiché tel quel dans la page zoom. Actuellement, pas de vignettes créées, prévu mais plutôt par la proposition de l'ajout d'une autre image (pour ne pas déformer par exemple). Pour la liste et le bandeau les images sont juste à taille fixées (respectivement 125x85 et 116x90)">Image</label>
 				<input class="file" type="file" id="form-image" name="file" />
 			</p>
 			<p class="form">
 				<input class="submit" type="submit" name="<?php echo $this->action; ?>" />
 			</p>
		</form> 
	</div>
</div>