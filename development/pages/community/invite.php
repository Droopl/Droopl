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
	</section>
    <section class="comusers">
        <header><h1><?php echo $_SESSION['lang']['sidemembers']; ?></h1></header>
        <nav>
            <?php if(!empty($members)){ ?>
            <ul>
                <?php foreach ($members as $key => $user) {?>
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
                <input type="text" id="search_users" name="search_users" placeholder="Search users" tabindex="1">
            </div>
            
        </form>
        <div>
        	<nav class="users">
        		<?php if(!empty($followers)){ ?>
            <ul>
                <?php foreach ($followers as $key => $user) {?>
                <?php if($user['id'] != NULL){ ?>
                <li>
                        <?php if(!empty($user['picture'])){ ?>
                        <img src="images/profile_pictures/<?php echo $user['picture'];?>" alt="rachouan rejeb">
                        <?php }else{ ?>
                        <img src="images/profile_pictures/notfound.svg" alt="rachouan rejeb">
                        <?php }?>

                        <p><span class="name"><?php echo $user['firstname']." ".$user['lastname']; ?></span><span class="occupation"><?php echo $user['occupation']; ?></span></p>

                        <?php if($user['accepted'] == NULL){ ?>
                        	<a href="?page=invite&action=invite&userid=<?php echo $user['id']; ?>&id=<?php echo $_GET['id']; ?>">Invite <span class="icon-plus"></span></a>
                        <?php }else{ ?>
                        	<a href="?page=invite&action=invite&userid=<?php echo $user['id']; ?>&id=<?php echo $_GET['id']; ?>" class="invited">Invite <span class="icon-check"></span></a>
                        <?php } ?>
                </li>
                <?php }} ?>
            </ul>

            <?php } ?>
        	</nav>
        </div>
    </section>
</div>