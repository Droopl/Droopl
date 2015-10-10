<aside id="side" class="profile fixed">
    
	<section class="profile">
        <header>
        	<div class="profile_pic">
        		<img src="images/profile_pictures/<?php echo $user['picture'];?>">
        		<span class="badge">creator</span>
        	</div>
        	<h1><?php echo $user['firstname'];?> <?php echo $user['lastname'];?></h1>
            <h2><?php echo $user['occupation'];?></h2>
        	<nav <?php if(isset($_SESSION['user']) && $_SESSION['user']['id'] != $user['id']){ echo "class='stars'"; }else{ echo "class='stars marg-bottom'"; } ?>> 
        		<ul>
                    <?php 
                    $rating = floatval($user['rating']);
                    for ($i=0; $i < 5; $i++) { ?>
                        <?php 
                        if($rating == 0.5){
                        ?>
                        <li class="half"></li>

                    <?php }else if($rating >= 1){ ?>
                        <li class="full"></li>
                    <?php }else{ ?>
                        <li></li>
                   <?php  }
                   $rating--; 
               } ?>
        		</ul>
                <?php if(isset($_SESSION['user']) && $_SESSION['user']['id'] != $user['id']){ ?>
        		<?php if(!$isFollowed){ ?>

        			<a href="?page=<?php echo $_GET['page'];?>&action=follow&id=<?php echo $user['id']; ?>" class="icon-circle-plus follow"> follow</a>

        		<?php }else{ ?>

        			<a href="?page=<?php echo $_GET['page'];?>&action=unfollow&id=<?php echo $user['id']; ?>" class="icon-circle-check followed"> following</a>
                
        		<?php }} ?>
                
        	</nav>
        </header>
        <div class="description-container">
            <p>
        	   <?php echo $user['description'];?>
            </p>
        </div>
        <div class="user-coordinates hide"><?php echo $user['latitude']; echo " "; echo $user['longitude']; ?></div>
        <div class="map-container">
            <a class="google-maps-link" href="http://maps.google.com/?ie=UTF8&hq=&ll=<?php echo $user['latitude']; echo ","; echo $user['longitude']; ?>&z=13"></a>
            <div id="map-canvas">
            </div>
            <div class="marker-container">
                <div class="ellipse-1"></div>
                <div class="ellipse-2"></div>
                <div class="ellipse-3"></div>
            </div>
        </div>
	</section>
</aside>



<div class="feed fixed">
    
    <section class="filter">
        <ul class="filter-ul">
            <li><a href="?page=user&id=<?php echo $user['id'] ?>&filter=quests" <?php if(!isset($_GET['filter']) || $_GET['filter'] == 'quests'){ echo 'class="current-filter"';} ?>>Quests</a></li>
            <li><a href="?page=user&id=<?php echo $user['id'] ?>&filter=collection" <?php if(isset($_GET['filter']) &&  $_GET['filter'] == 'collection'){ echo 'class="current-filter"';} ?>>Collection</a></li>
            <li><a href="?page=user&id=<?php echo $user['id'] ?>&filter=followers" <?php if(isset($_GET['filter']) &&  $_GET['filter'] == 'followers'){ echo 'class="current-filter"';} ?>>Followers</a></li>
        </ul>
    </section>

    <?php  if(empty($_GET["filter"]) || $_GET['filter'] == "quests"){ ?>

	<?php if(!empty($quests)){
    foreach ($quests as $key => $value) { if(!empty($value)){
    ?>

		<section class="quest <?php if($value['type'] == 0){ echo "red"; }else{ echo "blue"; } ?>" id="<?php echo $value['quest_id']; ?>">
        <header>

            <img src="images/profile_pictures/<?php echo $value['picture'];?>">
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
            <a href="?page=user&id=<?php echo $value['user_id']; ?>&filter=collection" class="collection_item"><img src="images/collection/<?php echo $value['collection_image'] ?>"><span class="collection_item_name"><?php echo $value['item_name']; ?></span></a>
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
            <p>
            <?php echo $value['quest_description'] ?></p>
            <?php 
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
    
	<?php } }
    }else{ ?>
    
    
    <?php if(isset($_SESSION['user']) && $_SESSION['user']['id'] == $user['id']){ ?>
    
        <section class="last_quest">

            <header>
                <h1 class="quest"><span class="hide">no more quests</span></h1>
                <h2>Why don't you have any items</h2>
            </header>

            <p>By proposing items you can trade with other people on droopl. So you need to add some</p>

            <a href="?page=feed">add an item</a>

        </section>
    
    <?php }else{ ?>
    
    
        <section class="last_quest">

            <header class="marg-bottom">
                <h1 class="quest"><span class="hide">no more quests</span></h1>
                <h2><?php echo $user['firstname']; ?> doesn't have any quests yet.</h2>
            </header>

        </section>
    

    <?php } } ?>

    





<?php }elseif(!empty($_GET["filter"]) && $_GET['filter'] == "followers") { ?>

        <?php  if(!empty($followers)){ ?>

        <ul class="followers">

        <?php foreach ($followers as $key => $value) { if(isset($_SESSION['user']) && $_SESSION['user']['id'] == $value['id']){}else{ ?>

        <li>
            
            <header>
                <img src="images/profile_pictures/<?php echo $value['picture'] ?>">
                <h1><?php echo $value['firstname'] ?></h1>
            </header>
            <a href="?page=user&id=<?php echo $value['id']; ?>&action=unfollow">Following</a>
        </li>

        <?php }} ?>
        </ul>


<?php }
}else{ ?>

<?php if(!empty($collection)){ ?>
    
    <section class="profile-collection">

        <ul>

           <?php foreach ($collection as $key => $value) { if($_SESSION['user']['id'] == $user['id']){ ?>

            <li class="profile-collection-item">
                
                <span class="collection-item-privacy <?php if($value['status'] == 0){ echo "public"; }elseif($value['status'] == 1){ echo "private"; }else{ echo "public"; } ?>"></span>
                
                <span class="collection-item-menu">
                    <ul>
                        <li class="edit"><a id="<?php echo $value['collection_id']; ?>"></a></li>
                        <li class="delete"><a href="?page=user&filter=collection&id=<?php echo $user['id']; ?>&action=remove&collection_id=<?php echo $value['collection_id']; ?>" id="<?php echo $value['collection_id']; ?>"></a></li>
                    </ul>
                </span>
                
                <img src='images/collection/<?php echo $value["collection_image"]; ?>' >
                <h1 class="profile-collection-item-name"><?php echo $value['item_name'] ?><span class="<?php if($value['available'] == 0){ echo "available"; }else{ echo "not-available"; } ?>"></span></h1>
            </li>
            
            <?php }else{ if($value['status'] == 0){ ?>
            
                <li class="profile-collection-item">

                <span id="<?php echo $value['collection_id']; ?>" class="collection-item-detail"></span>
                <img src='images/collection/<?php echo $value["collection_image"]; ?>' >
                <h1 class="profile-collection-item-name"><?php echo $value['item_name'] ?><span class="<?php if($value['available'] == 0){ echo "available"; }else{ echo "not-available"; } ?>"></span></h1>
            </li>

            <?php } } } ?>

        </ul>
        
    </section>

<?php }else{ ?>
    
    <?php if(isset($_SESSION['user']) && $_SESSION['user']['id'] == $user['id']){ ?>
    
        <section class="last_quest">

                <header>
                    <h1 class="collection"><span class="hide">no more quests</span></h1>
                    <h2>No collection items yet ?</h2>
                </header>

                <p>You haven't post any quests yet, don't be shy just look around in your attic you'll find something worth our while.</p>

                <a href="?page=add" class="add_collection_item">add an item</a>

        </section>
    
    <?php }else{ ?>
    
        <section class="last_quest">

                <header class="marg-bottom">
                    <h1 class="collection"><span class="hide">no more quests</span></h1>
                    <h2><?php echo $user['firstname']; ?> doesn't have any collection items yet.</h2>
                </header>
            
            
        </section>
    
<?php } }
} ?>
</div>
