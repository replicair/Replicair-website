
				<script>
					function showNewsPreviewPanel() {
					$('#newsPreviewContainerSim').css("display","none");
					$('#newsPreviewContainer').css("display","block");
					$('#newsPreviewContainer').animate({
					    opacity: 1,
					  }, 5000, function() {
					    // Animation complete.
					  });
					$('#newsPreviewActivator').animate({
					    opacity: 0,
					  }, 3000, function() {
						  $('#newsPreviewActivator').css("display","none");
					  });
					}
				</script> 
				<div id="newsPreviewContainerSim" class="newsPanelContainer">&nbsp;</div>
				<div id="newsPreviewContainer" class="newsPanelContainer" style="display:none;" >
					<?php if ($this->newsPreviewList != NULL and count($this->newsPreviewList) > 0) {
						foreach($this->newsPreviewList as $newsPreview) { 
					?>
					<a href="news-list.php">
					<div class="newsPreview">	
						<div class="newsPreviewView">
							<img src="<?php echo $this->newsFileLocation.$newsPreview->filename  ?>" />
						</div>
						<div class="newsPreviewContent">
							<p class="newsPreviewTitle"><?php echo $newsPreview->titleShort  ?></p>
							<p class="newsPreviewAbstract"><?php echo $newsPreview->abstractShort  ?></p>
						</div>
					</div>
					</a>
					<?php }
					}
					?>
				</div>
				
				<div id="newsPreviewActivator" style="position: relative; top: -20px; padding-left: 40px; color: white; font-weight:bold; font-size:10pt;font-family:'Trebuchet MS', Helvetica, sans-serif;" >
					<span onmouseover="showNewsPreviewPanel();"><?php echo $this->newsPreviewDate  ?> | <span style="color: silver;">Actualités</span></span>
				</div>
				