<article class="search_full">
<div class="search">
<ul class="search_results">

<li  class="part">
	<header><h1>Quests</h1></header>
	<ul class="quest_search">
	<?php foreach ($quests as $key => $value) { ?>

	<li class="quest" id="<?php echo $value['quest_id']; ?>">
		<a href="?page=detail&questid=<?php echo $value['quest_id']; ?>" class="quest">
	    <header>
	        <?php if(!empty($value['picture'])){ ?>
			<img src="images/profile_pictures/<?php echo $value['picture'];?>" alt="rachouan rejeb">
			<?php }else{ ?>
			<img src="images/profile_pictures/notfound.svg" alt="rachouan rejeb">
			<?php }?>
	        <h1><b><?php echo $value['firstname']; echo " "; echo $value['lastname'];?></b> <?php if($value['type'] == 0){ echo "is looking for "; }else{ echo "is offering ";}?><span><?php echo $value['item']; ?></span></h1>
	    </header>
	    <aside class="info">
	        <p><?php echo $value['quest_description']; ?></p>
	    </aside>
	    </a>
	</li>

	
<?php } ?>
<li class="quest">
    <p>No more quests</p>
</li>
</ul>

</li>

<li class="part">
	<header><h1>Users</h1></header>
	<ul class="user_search">
<?php foreach ($users as $id => $user) { ?>

<li class="user">
            <a href="?page=user&id=<?php echo $user['id']; ?>">
            <header>
                <?php if(!empty($value['picture'])){ ?>
                <img src="images/profile_pictures/<?php echo $value['picture'];?>" alt="rachouan rejeb">
                <?php }else{ ?>
                <img src="images/profile_pictures/notfound.svg" alt="rachouan rejeb">
                <?php }?>
                <h1><?php echo $user['firstname'] ?></h1>
                <h2><?php echo $user['occupation'] ?></h2>
            </header>
            <aside>
                <header class="hide"><h1>User stats</h1></header>
                <nav>
                    <ul>
                         <li>
                            <span>Quests</span>
                            <p><?php echo $user['quests']; ?></p>
                        </li>
                        <li>
                            <span>propos</span>
                            <p><?php echo $user['proposals']; ?></p>
                        </li>
                        <li>
                            <span>Followers</span>
                            <p><?php echo $user['followers']; ?></p>
                        </li>
                    </ul>
                </nav>
            </aside>
            </a>
        </li>
	
<?php }?>

<li class="user">
    <p>No more users</p>
</li>
</ul>
</li>


<li class="part">
	<header><h1>Items</h1></header>
	<ul class="items_search">

<?php foreach ($items as $id => $item) { ?>

  <li class="item">

        <span id="<?php echo $item['collection_id']; ?>" class="collection-item-detail"></span>
        <img src='images/collection/<?php echo $item["collection_image"]; ?>' >
        <h1 class="profile-collection-item-name"><?php echo $item['item_name'] ?><span class="<?php if($item['available'] == 0){ echo "available"; }else{ echo "not-available"; } ?>"></span></h1>
    </li>
	
<?php } ?>
<li class="item">
    <p>No more items</p>
</li>
</ul>
</li>

</ul>
</div>
</article>