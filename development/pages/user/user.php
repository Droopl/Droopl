<aside id="side" class="profile">

	<section class="profile">
        <header>
        	<div class="profile_pic">
        		<?php if(!empty($user['picture'])){ ?>
                <img class="profile-img" src="images/profile_pictures/<?php echo $user['picture'];?>" alt="<?php echo $user['firstname'].' '.$user['lastname']?>">
                <?php }else{ ?>
                <img class="profile-img" src="images/profile_pictures/notfound.svg" alt="<?php echo $user['firstname'].' '.$user['lastname']?>">
                <?php }?>
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
            <ul>
                <li>
                    <span class="bluetxt">Quests</span>
                    <p><?php echo $user['quests']; ?></p>
                </li>
                <li>
                    <span class="orangetxt">propos</span>
                    <p><?php echo $user['proposals']; ?></p>
                </li>
                <li>
                    <span class="purpletxt">Followers</span>
                    <p><?php echo $user['followers']; ?></p>
                </li>
            </ul>
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



<div class="feed">

    <section class="filter">
        <ul class="filter-ul">
            <li><a href="?page=user&id=<?php echo $user['id'] ?>&filter=quests" <?php if(!isset($_GET['filter']) || $_GET['filter'] == 'quests'){ echo 'class="current-filter"';} ?>><?php echo $_SESSION['lang']['filterquests']; ?></a></li>
            <li><a href="?page=user&id=<?php echo $user['id'] ?>&filter=collection" <?php if(isset($_GET['filter']) &&  $_GET['filter'] == 'collection'){ echo 'class="current-filter"';} ?>><?php echo $_SESSION['lang']['filtercollection']; ?></a></li>
            <li><a href="?page=user&id=<?php echo $user['id'] ?>&filter=followers" <?php if(isset($_GET['filter']) &&  $_GET['filter'] == 'followers'){ echo 'class="current-filter"';} ?>><?php echo $_SESSION['lang']['filterfollowers']; ?></a></li>
        </ul>
    </section>

    <?php  if(empty($_GET["filter"]) || $_GET['filter'] == "quests"){ ?>

	<?php if(!empty($quests)){
    foreach ($quests as $key => $value) { if(!empty($value)){
    ?>

		<section class="quest" id="<?php echo $value['quest_id']; ?>">
        <header>

            <img src="images/profile_pictures/<?php if(!empty($value['picture'])){ echo $value['picture']; }else{ echo "notfound.svg"; }?>">
            <h1><a href="?page=user&id=<?php echo $value['id']; ?>"> <?php echo $value['firstname']; echo " "; echo $value['lastname'];?></a><?php if($value['type'] == 0){
                echo $_SESSION['lang']['questlooking'];
            }else{

                echo $_SESSION['lang']['questoffering'];

}?> <span><?php if($value['type'] == 0){ echo $value['item']; }?></span></h1>
        <?php if($value['type'] == 1){ ?>
            <a href="?page=user&id=<?php echo $value['user_id']; ?>&filter=collection" class="collection_item"><img src="images/collection/<?php echo $value['collection_image'] ?>"><span class="collection_item_name"><?php echo $value['item_name']; ?></span></a>
        <?php }
		if(!$isMobile){
		?>
        <h2 <?php if($value['id'] == $_SESSION['user']['id']){ echo "class='editable-post'"; } ?>><?php

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
        <?php }
		if($value['id'] == $_SESSION['user']['id']){?>
        <nav>
            <ul>
                <li class="options">
                    <span class="hide">Options</span>
                </li>

                <li>
                    <ul class="options">
                        <li><a href="?page=detail&questid=<?php echo $value['quest_id']; ?>&action=complete" class="icon-check"><span><?php echo $_SESSION['lang']['questfootercomplete']; ?></span></a></li>
                        <li><a href="?page=detail&questid=<?php echo $value['quest_id']; ?>&action=remove" class="icon-cross"><span><?php echo $_SESSION['lang']['questfooterremove']; ?></span></a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <?php } ?>
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
            <a href="?page=detail&questid=<?php echo $value['quest_id']; ?>" class="proposal icon-repeat"> <?php echo $value['propocount'] ?> <?php echo $_SESSION['lang']['questfooterpropo']; ?></a>
        </footer>
    </section>

	<?php } }
    }else{ ?>


    <?php if(isset($_SESSION['user']) && $_SESSION['user']['id'] == $user['id']){ ?>

        <section class="last_quest">

            <header>
                <h1 class="quest"><span class="hide">no more quests</span></h1>
                <h2>You don't have any quests</h2>
            </header>

            <p>You haven't post any quests yet, don't be shy just look around in your attic you'll find something worth our while.</p>

            <a href="?page=feed">create a quest</a>

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

        <li class="follower">

            <header>
                <img src="images/profile_pictures/<?php echo $value['picture'] ?>">
                <h1><?php echo $value['firstname'] ?></h1>
                <h2><?php echo $value['occupation'] ?></h2>
            </header>
            <aside>
                <header class="hide"><h1>User stats</h1></header>
                <nav>
                    <ul>
                         <li>
                            <span><?php echo $_SESSION['lang']['filterquests']; ?></span>
                            <p><?php echo $value['quests']; ?></p>
                        </li>
                        <li>
                            <span>propos</span>
                            <p><?php echo $value['proposals']; ?></p>
                        </li>
                        <li>
                            <span>Followers</span>
                            <p><?php echo $_SESSION['lang']['filterfollowers']; ?></p>
                        </li>
                    </ul>
                </nav>
            </aside>
        </li>

        <?php }} ?>
        </ul>


<?php }else{ ?>

    <section class="last_quest">

            <header>
                <h1 class="collection"><span class="hide">No Followers</span></h1>
                <h2>You don't have any followers yet</h2>
            </header>

            <p>Search for people by pressing <span icon="icon-search"></span>, maybe if you follow them they will follow you back ?</p>

            <a href="?page=add" class="add_collection_item">add an item</a>

    </section>

<?php }
}else{ ?>

<?php if(!empty($collection)){ ?>

    <section class="profile-collection">

        <ul>

            <?php if($_SESSION['user']['id'] == $user['id']){ ?>
            <li class="profile-collection-item template">
                <a href="?page=add" class="add">
                    <header>
                        <h1></h1>
                        <h2>Add a new item</h2>
                    </header>
                </a>
            </li>
            <?php } ?>

           <?php foreach ($collection as $key => $value) { if($_SESSION['user']['id'] == $user['id']){ ?>

            <li class="profile-collection-item">

                <span class="collection-item-privacy <?php if($value['status'] == 0){ echo "public"; }elseif($value['status'] == 1){ echo "private"; }else{ echo "public"; } ?>"></span>

                <span class="collection-item-menu">
                    <ul>
                        <li class="edit"><a id="<?php echo $value['collection_id']; ?>"></a></li>
                        <li class="delete"><a href="?page=user&filter=collection&id=<?php echo $user['id']; ?>&action=remove&collection_id=<?php echo $value['collection_id']; ?>" id="<?php echo $value['collection_id']; ?>"></a></li>
                    </ul>
                </span>
                <?php if(!empty($value["collection_image"])){ ?>
                <img src='images/collection/<?php echo $value["collection_image"]; ?>' >
                <?php }else{ ?>
                <img src="images/profile_pictures/notfound.svg" alt="no image">
                <?php }?>

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

                <p>By proposing items you can trade with other people on droopl. So you need to add some !</p>

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
