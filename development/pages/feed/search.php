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

</ul>

</li>

<li class="part">
	<header><h1>Users</h1></header>
	<ul class="user_search">
		<?php if(!empty($users)){ ?>
<?php foreach ($users as $id => $user) { ?>

<li class="user" id="<?php echo $user['id']; ?>">
	<a href="?page=user&id=<?php echo $user['id']; ?>" class="user">
    <header>
        <?php if(!empty($value['picture'])){ ?>
		<img src="images/profile_pictures/<?php echo $user['picture'];?>" alt="rachouan rejeb">
		<?php }else{ ?>
		<img src="images/profile_pictures/notfound.svg" alt="rachouan rejeb">
		<?php }?>
        <h1><b><?php echo $user['firstname']; echo " "; echo $user['lastname'];?></b></h1>
    </header>
    </a>
</li>
	
<?php }
}else{ ?>

<li>No users found</li>

<?php } ?>
</ul>
</li>


<li class="part">
	<header><h1>Items</h1></header>
	<ul class="items_search">

<?php foreach ($items as $id => $item) { ?>

<li class="item" id="1">
	<a href="?page=item&id=1" class="user">
    <header>
        <img src="images/profile_pictures/notfound.svg" alt="rachouan rejeb">
        <h1><b></b></h1>
    </header>
    </a>
</li>
	
<?php } ?>
</ul>
</li>

</ul>
</div>
</article>