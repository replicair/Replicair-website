<script>
	$(function(){
    	$("#content_top").slides({
	        effect: 'fade',
	        play: 5000,
	        pagination: true,
	        generatePagination: true,
	        generateNextPrev: true,
	        paginationClass: 'slidePagination',
	        currentClass: 'slideCurrent'
    	});
	});
</script>
<div id="content_top">
	<div class="slides_container">
    	<?php  foreach($this->slideshowList as $slideshow) { ?>
    	<div class="slides_content">
        	<div class="slide_desc">
            	<h3><?php echo $slideshow->subtitle  ?></h3>
                <h4><?php echo $slideshow->title  ?></h4>
                <?php echo $slideshow->content  ?>
			</div>
			<img src="<?php echo $this->slideshowFileLocation.$slideshow->filename  ?>" alt="<?php echo $slideshow->filename ?>" />
		</div>
        <?php } ?>
	</div>
</div>
					
