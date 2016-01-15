<aside id="side" class="profile">

	<section class="community">
        <header>
        	<div class="profile_pic">
                <?php if(!empty($community['community_profile'])){ ?>
                <img src="images/communities/<?php echo $community['community_profile'];?>">
                <?php }else{ ?>
                <img src="images/profile_pictures/notfound.svg" alt="<?php echo $user['community_name'];?>">
                <?php }?>

        	</div>
        	<h1><?php echo $community['community_name'];?></h1>
            <h2><?php if($community['genre'] == 0){ echo "Establishment"; }else{ echo "Group";}?></h2>
        	<nav>
                <?php if(!$isMember){?>
                <a href="?page=community&id=<?php echo $_GET['id'];?>&action=join" class="member"><?php echo $_SESSION['lang']['communityjoin']; ?><span class="icon-inbox"></span></a>
                <?php }else{ ?>
                <a href="?page=community&id=<?php echo $_GET['id'];?>&action=leave" class="member leave"><?php echo $_SESSION['lang']['communityleave']; ?><span class="icon-outbox"></span></a>
                <?php } ?>
                <a href="?page=invite&id=<?php echo $_GET['id'];?>" class="member">Invite people<span class="icon-plus"></span></a>
        	</nav>
        </header>
        <div class="description-container">
            <ul>
                <li>
                    <span class="bluetxt">Quests</span>
                    <p><?php echo $community['quests']; ?></p>
                </li>
                <li>
                    <span class="orangetxt">propos</span>
                    <p><?php echo $community['propos']; ?></p>
                </li>
                <li>
                    <span class="purpletxt">Members</span>
                    <p><?php echo $community['members']; ?></p>
                </li>
            </ul>
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
                            <?php if(!empty($value['collection_image'])){ ?>
                        <img src="images/collection/<?php echo $value['collection_image']; ?>">
                        <?php }else{ ?>
                        <img class="profile-img" src="images/profile_pictures/notfound.svg">
                        <?php }?>

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
            <div>
                <textarea id="desc" name="desc" placeholder="<?php echo $_SESSION['lang']['formdescription']; ?>" tabindex="2"></textarea>
                <nav>

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

        <section class="quest" id="<?php echo $value['quest_id']; ?>">
        <header>

            <img src="images/profile_pictures/<?php if(!empty($value['picture'])){ echo $value['picture']; }else{ echo "notfound.svg"; }?>">
            <h1><a href="?page=user&id=<?php echo $value['id']; ?>"> <?php echo $value['firstname']; echo " "; echo $value['lastname'];?></a><?php if($value['type'] == 0){
                echo $_SESSION['lang']['questlooking'];
            }else{

                echo $_SESSION['lang']['questoffering'];

}?> <span><?php if($value['type'] == 0){ echo $value['item']; }?></span></h1>
        <?php if($value['type'] == 1){?>


            <a href="?page=user&id=<?php echo $value['user_id']; ?>&filter=collection" class="collection_item">
                <?php if(!empty($value['collection_image'])){ ?>
            <img id="<?php echo $value['collection_id'] ?>" src="images/collection/<?php echo $value['collection_image'] ?>">
            <?php }else{ ?>
            <img id="<?php echo $value['collection_id'] ?>"  class="profile-img" src="images/profile_pictures/notfound.svg">
            <?php }?><span class="collection_item_name"><?php echo $value['item_name']; ?></span></a>
        <?php } ?>
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
        <?php if($value['id'] == $_SESSION['user']['id']){?>
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
    <?php }} ?>

    <section class="last_quest">

        <header>
            <h1 class="quest"><span class="hide">no more quests</span></h1>
            <h2>You're out of quests</h2>
        </header>

        <p>There are no quests posted yet to this community</p>


    </section>

</div>
