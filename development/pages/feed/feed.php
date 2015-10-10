<aside id="side">
	<section class="quest">
		<h1><?php 

		switch ($_SESSION['language']) {
	        case 'en':
	        echo "Quests";
	        break;

	        case 'nl':
	        echo "Zoekers";
	        break;

	        case 'fr':
	        echo "Quêtes";
	        break;
	        
	        default:
	        echo "Quests";
	        break;
	    } 
	    ?>
		</h1>
		<ul>
			<?php foreach ($publicquests as $id => $val) { ?>
			<li>
				<a href="?page=detail&questid=<?php echo $val['quest_id']; ?>" alt="<?php echo $val['firstname']; ?>">
					<?php if(!empty($val['picture'])){ ?>
					<img src="images/profile_pictures/<?php echo $val['picture'];?>" alt="rachouan rejeb">
					<?php }else{ ?>
					<img src="images/profile_pictures/notfound.svg" alt="rachouan rejeb">
					<?php }?>
					<p><span><?php echo $val['firstname']; echo " "; echo $val['lastname'];?></span> <?php if($val['type'] == 0){ 

            switch ($_SESSION['language']) {
                case 'en':
                echo "is looking for ";
                break;

                case 'nl':
                echo "zoekt ";
                break;

                case 'fr':
                echo "cherche ";
                break;

                default:
                echo "is looking for ";
                break;
            } 
	    }else{ switch ($_SESSION['language']) {
                case 'en':
                echo "is offering ";
                break;

                case 'nl':
                echo "biedt aan ";
                break;

                case 'fr':
                echo "propose ";
                break;

                default:
                echo "is offering ";
                break;
            }
            }?> <span>
            <?php if($val['type'] == 0){  echo $val['item']; }else{ echo $val['item_name']; } ?>
             </span></p>
				</a>
			</li>

			<?php } ?>

		</ul>
	</section>
    <section class="collection">
        <h1><?php 

		switch ($_SESSION['language']) {
	        case 'en':
	        echo "My collection";
	        break;

	        case 'nl':
	        echo "Mijn collectie";
	        break;

	        case 'fr':
	        echo "Ma collection";
	        break;
	        
	        default:
	        echo "My collection";
	        break;
	    } 
	    ?></h1>
        
        <?php if(!empty($collection)){ ?>
            
            <ul>
                
                <?php if(count($collection) >= 3){ ?>
                    <li class="add-to-collection"></li>
                <?php } ?>
                
                <?php for($i = 0; $i < 3; $i++){ ?>
                
                <?php if(!empty($collection[$i])){ ?>
                
                <li><img id="<?php echo $collection[$i]['collection_id']; ?>" src="images/collection/<?php echo $collection[$i]['collection_image']; ?>" alt="collection item rachouan rejeb"></li>
                
                <?php }else{ ?>
                	<li class="add-to-collection bordered"></li>
                <?php } ?>
                
                <?php } ?>
                
                <?php if(count($collection) >= 3){ ?>
                <li class="more-collection-items"><a class="more-collection-items-link" href="?page=user&id=<?php echo $_SESSION['user']['id']; ?>&filter=collection"><div><span>More</span></div></a></li>
                <?php } ?>
            </ul>

        <?php }else{ ?>
        
            <ul>
                <li class="add-to-collection bordered"></li>
                <li class="no-items-msg">You don't have any items yet.</li>
            </ul>
        
        <?php } ?>
        
        <!--<ul>
            <li class="add-to-collection"></li>
            <li><img src="images/collection/dolce-gusto.png" alt="collection item rachouan rejeb"></li>
            <li><img src="images/collection/canon-reflex.png" alt="collection item rachouan rejeb"></li>
            <li><img src="images/collection/disqueuse.png" alt="collection item rachouan rejeb"></li>
            <a class="more-collection-items-link" href="?page=user&id=<?php echo $_SESSION['user']['id']; ?>&filter=collection"><li class="more-collection-items"><div><span>More</span></div></li></a>
        </ul>-->
    </section>
	<section class="activity">
		<h1><?php 

		switch ($_SESSION['language']) {
	        case 'en':
	        echo "Activity";
	        break;

	        case 'nl':
	        echo "Activiteit";
	        break;

	        case 'fr':
	        echo "Activité";
	        break;
	        
	        default:
	        echo "Activity";
	        break;
	    } 
	    ?></h1>
		<ul class="progress">
		  <!--  Item  -->
		  <li data-name="<?php if(!($propocount['propocount'] >= 1000)){ echo $propocount['propocount']; }else{ echo round($propocount['propocount'],1) . "K"; } ?> propos" data-percent="30%"> <svg viewBox="-10 -10 220 220">
		    <g fill="none" stroke-width="15" transform="translate(100,100)">
		      <path d="M 0,-100 A 100,100 0 0,1 86.6,-50" stroke="#2BBCAF"/>
		      <path d="M 86.6,-50 A 100,100 0 0,1 86.6,50" stroke="#2BBCAF"/>
		      <path d="M 86.6,50 A 100,100 0 0,1 0,100" stroke="#2BBCAF"/>
		      <path d="M 0,100 A 100,100 0 0,1 -86.6,50" stroke="#2BBCAF"/>
		      <path d="M -86.6,50 A 100,100 0 0,1 -86.6,-50" stroke="#2BBCAF"/>
		      <path d="M -86.6,-50 A 100,100 0 0,1 0,-100" stroke="#2BBCAF"/>
		    </g>
		    </svg> <svg viewBox="-10 -10 220 220">
		    <path id="count" d="M200,100 C200,44.771525 155.228475,0 100,0 C44.771525,0 0,44.771525 0,100 C0,155.228475 44.771525,200 100,200 C155.228475,200 200,155.228475 200,100 Z" stroke-dashoffset="<?php echo ($propocount['propocount']/500*100)*6.3 ?>"></path>
		    </svg> 
	</li>
		  <!--  Item  -->
		  <li data-name="<?php if(!($questcount['quest_count'] >= 1000)){ echo $questcount['quest_count']; }else{ echo round($questcount['quest_count'],1) . "K"; } ?> quests" data-percent="45%"> <svg viewBox="-10 -10 220 220">
		    <g fill="none" stroke-width="15" transform="translate(100,100)">
		      <path d="M 0,-100 A 100,100 0 0,1 86.6,-50" stroke="#F5896E"/>
		      <path d="M 86.6,-50 A 100,100 0 0,1 86.6,50" stroke="#F5896E"/>
		      <path d="M 86.6,50 A 100,100 0 0,1 0,100" stroke="#F5896E"/>
		      <path d="M 0,100 A 100,100 0 0,1 -86.6,50" stroke="#F5896E"/>
		      <path d="M -86.6,50 A 100,100 0 0,1 -86.6,-50" stroke="#F5896E"/>
		      <path d="M -86.6,-50 A 100,100 0 0,1 0,-100" stroke="#F5896E"/>
		    </g>
		    </svg> <svg viewBox="-10 -10 220 220">
		    <path id="count" d="M200,100 C200,44.771525 155.228475,0 100,0 C44.771525,0 0,44.771525 0,100 C0,155.228475 44.771525,200 100,200 C155.228475,200 200,155.228475 200,100 Z" stroke-dashoffset="<?php echo ($questcount['quest_count']/500*100)*6.3 ?>"></path>
		    </svg> </li>

		  <!--  Item  -->
		  <li data-name="<?php if(!($usercount['usercount'] >= 1000)){ echo $usercount['usercount']; }else{ echo round($usercount['usercount'],1) . "K"; } ?> users" data-percent="65%"> <svg viewBox="-10 -10 220 220">
		    <g fill="none" stroke-width="15" transform="translate(100,100)">
		      <path d="M 0,-100 A 100,100 0 0,1 86.6,-50" stroke="#44587A"/>
		      <path d="M 86.6,-50 A 100,100 0 0,1 86.6,50" stroke="#44587A"/>
		      <path d="M 86.6,50 A 100,100 0 0,1 0,100" stroke="#44587A"/>
		      <path d="M 0,100 A 100,100 0 0,1 -86.6,50" stroke="#44587A"/>
		      <path d="M -86.6,50 A 100,100 0 0,1 -86.6,-50" stroke="#44587A"/>
		      <path d="M -86.6,-50 A 100,100 0 0,1 0,-100" stroke="#44587A"/>
		    </g>
		    </svg> <svg viewBox="-10 -10 220 220">
		    <path id="count" d="M200,100 C200,44.771525 155.228475,0 100,0 C44.771525,0 0,44.771525 0,100 C0,155.228475 44.771525,200 100,200 C155.228475,200 200,155.228475 200,100 Z" stroke-dashoffset="<?php echo ($usercount['usercount']/100*100)*6.3 ?>"></path>
		    </svg> </li>

		  <!--  Item  -->
		  <li data-name="3K droops" data-percent="95%"> <svg viewBox="-10 -10 220 220">
		    <g fill="none" stroke-width="15" transform="translate(100,100)">
		      <path d="M 0,-100 A 100,100 0 0,1 86.6,-50" stroke="#90CCCF"/>
		      <path d="M 86.6,-50 A 100,100 0 0,1 86.6,50" stroke="#90CCCF"/>
		      <path d="M 86.6,50 A 100,100 0 0,1 0,100" stroke="#90CCCF"/>
		      <path d="M 0,100 A 100,100 0 0,1 -86.6,50" stroke="#90CCCF"/>
		      <path d="M -86.6,50 A 100,100 0 0,1 -86.6,-50" stroke="#90CCCF"/>
		      <path d="M -86.6,-50 A 100,100 0 0,1 0,-100" stroke="#90CCCF"/>
		    </g>
		    </svg> <svg viewBox="-10 -10 220 220">
		    <path id="count" d="M200,100 C200,44.771525 155.228475,0 100,0 C44.771525,0 0,44.771525 0,100 C0,155.228475 44.771525,200 100,200 C155.228475,200 200,155.228475 200,100 Z" stroke-dashoffset="<?php echo 95*6.3 ?>"></path>
		    </svg> </li>
 
</ul>
	</section>
	<section class="communities">
		<header><h1>Communities</h1></header>
		<nav>
			<ul>
				<?php foreach ($communities as $key => $community) { ?>
					<li><a href="?page=community&id=<?php echo $community['community_id']; ?>"><img src="images/communities/<?php echo $community['community_profile']; ?>"><p><span><?php echo $community['community_name']; ?></span><span class="icon-head"> 203</span></p></a></li>
				<?php } ?>
			</ul>
		</nav>
	</section>
</aside>
<div class="feed">
    
    <section class="filter">
        <ul class="filter-ul">
            <li><a href="?filter=recent" <?php if(!isset($_GET['filter']) || $_GET['filter'] == 'recent'){ echo 'class="current-filter"';} ?>>Recent</a></li>
            <li><a href="?filter=popular" <?php if(isset($_GET['filter']) &&  $_GET['filter'] == 'popular'){ echo 'class="current-filter"';} ?>><?php 
            switch ($_SESSION['language']) {
			        case 'en':
			        echo "Popular";
			        break;

			        case 'nl':
			        echo "Populair";
			        break;

			        case 'fr':
			        echo "Populaire ";
			        break;
			        
			        default:
			        echo "Popular";
			        break;
			    }
            ?></a></li>
            <li><a href="?filter=nearby" <?php if(isset($_GET['filter']) &&  $_GET['filter'] == 'nearby'){ echo 'class="current-filter"';} ?>><?php 
            switch ($_SESSION['language']) {
			        case 'en':
			        echo "Nearby";
			        break;

			        case 'nl':
			        echo "Dichtbij";
			        break;

			        case 'fr':
			        echo "À proximité ";
			        break;
			        
			        default:
			        echo "Nearby";
			        break;
			    }
            ?></a></li>
        </ul>
    </section>

	<section class="post">
		<form action="" method="post" name="quest" id="quest" enctype="multipart/form-data">
			<div>
                <input type="text" id="type" name="type" class="hide" value="0">
				<input type="text" id="item" name="item" <?php
                       switch($_SESSION['language']) {
                
                            case 'en':
                            echo "placeholder='What are you looking for ?'"; 
                            break;

                            case 'fr':
                            echo "placeholder='Qu&#39;est-ce que vous cherchez ?'";
                            break;

                            case 'nl':
                            echo "placeholder='Wat ben je naar op zoek ?'";
                            break;

                            default:
                            echo "placeholder='What are you looking for ?'"; 
                            break;
                        }
                       ?> tabindex="1">
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
				<input type="text" id="desc" name="desc" placeholder="Description" tabindex="2">
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
			</div>
		</form>
	</section>

	<?php foreach ($quests as $key => $value) {
		if(!empty($value)){
		?>

		<section class="quest <?php if($value['type'] == 0){ echo "red"; }else{ echo "blue"; } ?>" id="<?php echo $value['quest_id']; ?>" data-lat="<?php echo $value['latitude']; ?>" data-lng="<?php echo $value['longitude']; ?>">
		<header>

			<?php if(!empty($value['picture'])){ ?>
					<img src="images/profile_pictures/<?php echo $value['picture'];?>" alt="rachouan rejeb">
					<?php }else{ ?>
					<img src="images/profile_pictures/notfound.svg" alt="rachouan rejeb">
					<?php }?>
			<h1><a href="?page=user&id=<?php echo $value['id']; ?>"> <?php echo $value['firstname']; echo " "; echo $value['lastname'];?></a><?php if($value['type'] == 0){ 
				switch ($_SESSION['language']) {
			        case 'en':
			        echo "is looking for ";
			        break;

			        case 'nl':
			        echo "zoekt een ";
			        break;

			        case 'fr':
			        echo "cherche ";
			        break;
			        
			        default:
			        echo "is offering ";
			        break;
    			} 
			}else{ 

				switch ($_SESSION['language']) {
			        case 'en':
			        echo "is offering ";
			        break;

			        case 'nl':
			        echo "biedt aan ";
			        break;

			        case 'fr':
			        echo "propose ";
			        break;
			        
			        default:
			        echo "is offering ";
			        break;
			    }

}?><span><?php if($value['type'] == 0){ echo $value['item']; }?></span></h1>
		<?php if($value['type'] == 1){ ?>
			<a id="<?php echo $value['collection_id'] ?>" class="collection_item"><img src="images/collection/<?php echo $value['collection_image'] ?>"><span class="collection_item_name"><?php echo $value['item_name']; ?></span></a>
		<?php } ?>
		<h2><?php 

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

		?></h2>
		</header>
		<aside class="info">
			<?php if(!empty($value['quest_description'])){ echo "<p>".$value['quest_description']."</p>"; } 
			if($value['image_url'] != NULL){ ?>
				<img src="questimages/images/<?php echo $value['image_url']; ?>">
			<?php }
			 ?>
		</aside>
		<footer>
			<a href="?page=detail&questid=<?php echo $value['quest_id']; ?>" class="proposal icon-repeat"> <?php echo $value['propocount'] ?> proposals</a>
			<a href="" class="shares icon-upload"> 15 shares</a>
		</footer>
	</section>
    
	<?php }} ?>

	<section class="last_quest">

		<header>
			<h1 class="quest"><span class="hide">no more quests</span></h1>
			<h2>You're out of quests</h2>
		</header>

		<p>If you want to see more quests, you will need to get social. Follow some cool people on droopl and see the quests poor in.</p>

		<a href="?page=people">find people</a>

	</section>
    
</div>