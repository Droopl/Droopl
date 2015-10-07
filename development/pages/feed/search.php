<ul class="search_results">
<?php foreach ($quests as $key => $value) { ?>

	<li class="quest" id="<?php echo $value['quest_id']; ?>">
		<a href="?page=detail&questid=<?php echo $value['quest_id']; ?>" class="quest">
	    <header>
	        <img src="images/profile_pictures/<?php echo $value['picture']; ?>">
	        <h1><b><?php echo $value['firstname']; echo " "; echo $value['lastname'];?></b> <?php if($value['type'] == 0){ echo "is looking for "; }else{ echo "is offering ";}?><span><?php echo $value['item']; ?></span></h1>
	    </header>
	    <aside class="info">
	        <p><?php echo $value['quest_description']; ?></p>
	    </aside>
	    </a>
	</li>
	
<?php } ?>
</ul>