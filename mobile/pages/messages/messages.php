<div class="messages">
<aside class="conversations">
    <form id="search-conversations">
        <input type="text" placeholder="Search conversations ..." id="search-conversations-input" name="search-conversations-input">
        <input type="button" id="submit-search-conversations" value="">
        <input type="button" id="new-conversation-btn" name="new-conversation-btn" value="">
    </form>
	<nav class="users">
		<ul>
			<?php foreach ($conversations as $key => $value) { ?>
			<li>
				<a href="?page=messages&id=<?php echo $value['conversation_id']; ?>" <?php if($value['conversation_id'] == $_SESSION['conversation']['conversation_id']){ echo 'class="selected"';} ?>>
				<header>
					<?php if(!empty($value['picture'])){ ?>
					<img src="images/profile_pictures/<?php echo $value['picture'];?>" alt="rachouan rejeb">
					<?php }else{ ?>
					<img src="images/profile_pictures/notfound.svg" alt="rachouan rejeb">
					<?php }?>
					<h1><?php echo $value['firstname'].' '.$value['lastname']; ?> <span><?php $hours = date("H", strtotime($value['message_creation_date'])); $date = date("D", strtotime($value['message_creation_date'])); echo $hours.'h '.$date;?></span></h1>
					<p><span><?php echo $value['message']; ?></span><?php if($value['seen'] == 1){ ?><span>Not seen</span><?php } ?></p>
				</header>
				
			</a>
		</li>
			<?php } ?>
		</ul>
	</nav>
</aside>


    
</div>