<aside id="side" class="profile">
    
	<section class="community">
        <header>
        	<div class="profile_pic">
        		<img src="images/communities/<?php echo $community['community_profile'];?>">
        	</div>
        	<h1><?php echo $community['community_name'];?></h1>
            <h2><?php if($community['genre'] == 0){ echo "Establishment"; }else{ echo "Group";}?></h2>
        	<nav> 
                <?php if(!$isMember){?>
                <a href="?page=community&id=<?php echo $_GET['id'];?>&action=join" class="member"><?php echo $_SESSION['lang']['communityjoin']; ?><span class="icon-inbox"></span></a>
                <?php }else{ ?>
                <a href="?page=community&id=<?php echo $_GET['id'];?>&action=leave" class="member leave"><?php echo $_SESSION['lang']['communityleave']; ?><span class="icon-outbox"></span></a>
                <?php } ?>
        	</nav>
        </header>
        <div class="description-container">
            <p>
        	   <?php echo $community['description'];?>
            </p>
        </div>
	</section>
    <section class="comusers">
        <header><h1><?php echo $_SESSION['lang']['sidemembers']; ?></h1></header>
        <nav>
            <?php if(!empty($users)){ ?>
            <ul>
                <?php foreach ($users as $key => $user) {?>
                <li>
                    <a href="?page=user&id=<?php echo $user['user_id'] ?>">
                        <?php if(!empty($user['picture'])){ ?>
                        <img src="images/profile_pictures/<?php echo $user['picture'];?>" alt="rachouan rejeb">
                        <?php }else{ ?>
                        <img src="images/profile_pictures/notfound.svg" alt="rachouan rejeb">
                        <?php }?>
                    </a>
                </li>
                <?php } ?>
            </ul>

            <?php } ?>
        </nav>
    </section>
</aside>



<div class="feed">
    <section class="post">
        <form action="" method="post" name="quest" id="quest" enctype="multipart/form-data">
            <div>
                <input type="text" id="type" name="type" class="hide" value="0">
                <input type="text" id="item" name="item" placeholder="<?php echo $_SESSION['lang']['formlooking']; ?>" tabindex="1">
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
                <input type="text" id="desc" name="desc" placeholder="<?php echo $_SESSION['lang']['formdescription']; ?>" tabindex="2">
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

        <section class="quest" id="<?php echo $value['quest_id']; ?>">
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
            <a class="collection_item"><img id="<?php echo $value['collection_id']; ?>" src="images/collection/<?php echo $value['collection_image'] ?>"><span class="collection_item_name"><?php echo $value['item_name']; ?></span></a>
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
        <nav>
            <ul>
                <li class="options">
                    <span class="hide">Options</span>
                </li>

                <li>
                    <ul class="options show">
                        <li><a href="?page=detail&questid=<?php echo $value['quest_id']; ?>&action=complete" class="icon-check"><span><?php echo $_SESSION['lang']['questfootercomplete']; ?></span></a></li>
                        <li><a href="?page=detail&questid=<?php echo $value['quest_id']; ?>&action=remove" class="icon-cross"><span><?php echo $_SESSION['lang']['questfooterremove']; ?></span></a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        </header>
        <?php if(!empty($value['quest_description'])){ ?>
        <aside class="info">
            <p>
            <?php echo $value['quest_description'] ?></p>
            <?php 
            if($value['image_url'] != NULL){ ?>
                <img src="questimages/images/<?php echo $value['image_url']; ?>">
            <?php }
             ?>
        </aside>
        <?php } ?>    
        <footer>
            <a href="?page=detail&questid=<?php echo $value['quest_id']; ?>" class="proposal icon-repeat"> <?php echo $value['propocount'] ?> <?php echo $_SESSION['lang']['questfooterpropos']; ?></a>
            <a href="" class="shares icon-upload"> 15 <?php echo $_SESSION['lang']['questfootershares']; ?></a>
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
