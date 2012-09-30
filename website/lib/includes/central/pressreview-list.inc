<ul class="pressreview-list">
<?php
foreach($this->list as $object) {
?>
		<li>
			<span class="pressreview-title">
				<?php echo $object->source ?>
				<?php
				if ($object->url != NULL and $object->url != "") { 
					echo "<a href='".$object->url."' target='blank'>".$object->label."</a>";
				}
				else {
					echo $object->label;
				}
				if ($object->file != null and $object->file != "") {
					if ($object->fileType == "pdf") {
						echo " - <a href='lib/script/download.php?type=pressreview&filename=".$object->file."'><img src='img/icons/pdf.gif' alt='".$object->file."' /></a>";
					}
					else {
						echo " - <a href='lib/script/download.php?type=pressreview&filename=".$object->file."'>".$object->file."</a>";
					}
				}
				?>
			</span>
			<span class="pressreview-complement">
				<?php echo $object->dateFormatted ?>
				-
				<?php echo $object->author ?>
			</span>
		</li>
<?php } ?>
</ul>
<div class="pagination">
	<?php include($this->path . '/lib/includes/util/pagination.inc'); ?>
</div>