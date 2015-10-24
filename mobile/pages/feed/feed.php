<div class="feed">
    
    <section class="filter">
        <ul class="filter-ul">
            <li><a href="?filter=recent" <?php if(!isset($_GET['filter']) || $_GET['filter'] == 'recent'){ echo 'class="current-filter"';} ?>><?php  echo $_SESSION['lang']['filterrecent']; ?></a></li>
            <li><a href="?filter=popular" <?php if(isset($_GET['filter']) &&  $_GET['filter'] == 'popular'){ echo 'class="current-filter"';} ?>><?php  echo $_SESSION['lang']['filterpopu']; ?></a></li>
            <li><a href="?filter=nearby" <?php if(isset($_GET['filter']) &&  $_GET['filter'] == 'nearby'){ echo 'class="current-filter"';} ?>><?php  echo $_SESSION['lang']['filternearby']; ?></a></li>
        </ul>
    </section>

	<section class="post">
		<form action="" method="post" name="quest" id="quest" enctype="multipart/form-data">
			<div>
                <input type="text" id="type" name="type" class="hide" value="0">
				<input type="text" id="item" name="item" placeholder="<?php echo $_SESSION['lang']['formlooking']; ?>" tabindex="1" autocomplete="off">
                <div class="added-collection-item">
                    <p>Reflex Camera <span class="remove-collection-item icon-cross"></span></p>
                </div>
                <div class="switch-container">
                    <div class="contain-button">
                        <div class="button looking-mode"></div>
                    </div>
                </div>

			</div>
            
            <?php if(!empty($collection)){ ?>
            
                <div class="hide collection">
                	<input type="text" id="collection_item" name="collection_item" class="hide" value="">
                	<ul>
                        
                        <?php foreach ($collection as $key => $value) {?>
                        
                        <li id="<?php echo $value['collection_id']; ?>">
                            <img src="images/collection/<?php echo $value['collection_image']; ?>">
                            <div class="selected"><p class="icon-check"></p></div>
                            <p class="collection-item-name"><span><?php echo $value["item_name"]; ?></span></p>
                        </li>
                        
                        <?php } ?>
                        
                	</ul>
                </div>

            <?php }else{ ?>
            
                <div class="hide collection no-collection-items">
                    <header class="marg-bottom">
                        <h1 class="collection"><span class="hide">no more quests</span></h1>
                        <h2>You don't have any collection items yet.<a class="post-add-collection-item">Add item</a></h2>
                    </header>
                </div>
        
            <?php } ?>
            
			<!--<div class="hide collection">
                	<input type="text" id="collection_item" name="collection_item" class="hide" value="">
                	<ul>
                        <li id="1">
                            <img src="images/collection/dolce-gusto.png">
                            <div class="selected"><p class="icon-check"></p></div>
                            <p class="collection-item-name"><span>Dolce gusto</span></p>
                        </li>
                        <li id="2">
                            <img src="images/collection/canon-reflex.png">
                            <div class="selected"><p class="icon-check"></p></div>
                            <p class="collection-item-name"><span>Reflex camera</span></p>
                        </li>
                        <li id="3">
                            <img src="images/collection/disqueuse.png">
                            <div class="selected"><p class="icon-check"></p></div>
                            <p class="collection-item-name"><span>Disqueuse</span></p>
                        </li>
                        <li id="4">
                            <img src="images/collection/cleaner.jpg">
                            <div class="selected"><p class="icon-check"></p></div>
                            <p class="collection-item-name"><span>Aspirateur</span></p>
                        </li>
                	</ul>
            </div>-->
			<div>
				<input type="text" id="desc" name="desc" placeholder="<?php echo $_SESSION['lang']['formdescription']; ?>" tabindex="2" autocomplete="off">
				<nav>
					<select id="destination" name="destination">
					  <option value="public">Public</option>
					  <?php foreach ($communities as $key => $community) { ?>
					  <option value="<?php echo $community['community_id']; ?>" class="public icon-globe"><?php echo $community['community_name']; ?></option>
					  <?php  } ?>
					</select>
					<span class="upload_image">
					    <input type="file" id="quest_upload_image" accept="image/*" name="quest_upload_image"  tabindex="3">
					</span>
					<span class="hide uploaded_image"><img src=""><p class="icon-cross"></p></span>
					<input type="submit" id="quest_submit" name="quest_submit" value="" tabindex="4">
				</nav>
			</div>
		</form>
	</section>

	<?php foreach ($quests as $key => $value) {
		if(!empty($value)){
		?>

		<section class="quest" id="<?php echo $value['quest_id']; ?>" data-lat="<?php echo $value['latitude']; ?>" data-lng="<?php echo $value['longitude']; ?>">
		<header>

			<?php if(!empty($value['picture'])){ ?>
					<img src="images/profile_pictures/<?php echo $value['picture'];?>" alt="rachouan rejeb">
					<?php }else{ ?>
					<img src="images/profile_pictures/notfound.svg" alt="rachouan rejeb">
					<?php }?>
			<h1><a href="?page=user&id=<?php echo $value['id']; ?>"> <?php echo $value['firstname']; echo " "; echo $value['lastname'];?></a><?php if($value['type'] == 0){ 
				echo $_SESSION['lang']['questlooking'];
			}else{ 

				echo $_SESSION['lang']['questoffering'];

}?> <span><?php if($value['type'] == 0){ echo $value['item']; }?></span></h1>
		<?php if($value['type'] == 1){ ?>
			<a class="collection_item"><img id="<?php echo $value['collection_id'] ?>" src="images/collection/<?php echo $value['collection_image'] ?>"><span class="collection_item_name"><?php echo $value['item_name']; ?></span></a>
		<?php } ?>
		<h2 <?php if(isset($_SESSION['user']) && $value['id'] == $_SESSION['user']['id']){ echo "class='editable-post'"; } ?>><?php 

		if(!empty($_GET['filter']) && $_GET['filter'] == "popular"){
			echo $value['views']." views";
		}else if(!empty($_GET['filter']) && $_GET['filter'] == "nearby"){
			echo intval($value['distance'])." km";
		}else{

		$full = false;
 		$now = new DateTime;
	    $ago = new DateTime($value['creation_date']);
	    $diff = $now->diff($ago);

	    $diff->w = floor($diff->d / 7);
	    $diff->d -= $diff->w * 7;

	    $string = array(
	        'y' => 'year',
	        'm' => 'month',
	        'w' => 'week',
	        'd' => 'day',
	        'h' => 'hour',
	        'i' => 'minute',
	        's' => 'second',
	    );
	    foreach ($string as $k => &$v) {
	        if ($diff->$k) {
	            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
	        } else {
	            unset($string[$k]);
	        }
	    }

	    if (!$full) $string = array_slice($string, 0, 1);
	    $result =  $string ? implode(', ', $string) . ' ago' : 'just now';

	    echo $result;

	    }

		?></h2>
		<?php 
		if (isset($_SESSION['user'])) {
			
		if($value['id'] == $_SESSION['user']['id']){?>
		<nav>
			<ul>
				<li class="options">
					<span class="hide">Options</span>
				</li>

				<li>
					<ul class="options">
						<li><a href="?page=detail&questid=<?php echo $value['quest_id']; ?>&action=complete" class="icon-check"><span>Complete</span></a></li>
						<li><a href="?page=detail&questid=<?php echo $value['quest_id']; ?>&action=remove" class="icon-cross"><span>Remove</span></a></li>
					</ul>
				</li>
			</ul>
		</nav>
		<?php }} ?>
		</header>
		<aside class="info">
			<?php if(!empty($value['quest_description'])){ echo "<p>".$value['quest_description']."</p>"; } 
			if($value['image_url'] != NULL){ ?>
				<img src="questimages/images/<?php echo $value['image_url']; ?>">
			<?php }
			 ?>
		</aside>
		<footer>
			<a href="?page=detail&questid=<?php echo $value['quest_id']; ?>" class="proposal icon-repeat"> <?php echo $value['propocount'] ?> <?php echo $_SESSION['lang']['questfooterpropo']; ?></a>
			<a href="" class="shares icon-upload"> 15 <?php echo $_SESSION['lang']['questfootershares']; ?></a>
		</footer>
	</section>
    
	<?php }} ?>
    
</div>