<div class="messages">
<aside class="conversations">
    <form id="search-conversations">
        <input type="text" placeholder="<?php echo $_SESSION['lang']['conversationSearch']; ?>" id="search-conversations-input" name="search-conversations-input">
        <input type="button" id="submit-search-conversations" value="">
        <input type="button" id="new-conversation-btn" name="new-conversation-btn" value="">
    </form>
	<nav class="users">
		<ul>
      <?php if(!empty($conversations)){ ?>
			<?php foreach ($conversations as $key => $value) { ?>
			<li>
        <?php if(!$isMobile){?>
				<a href="?page=messages&id=<?php echo $value['conversation_id']; ?>" <?php if($value['conversation_id'] == $_SESSION['conversation']['conversation_id']){ echo 'class="selected"';} ?>>
        <?php }else{ ?>
          <a href="?page=message&id=<?php echo $value['conversation_id']; ?>" <?php if($value['conversation_id'] == $_SESSION['conversation']['conversation_id']){ echo 'class="selected"';} ?>>
        <?php } ?>
        <header>
					<?php if(!empty($value['picture'])){ ?>
					<img src="images/profile_pictures/<?php echo $value['picture'];?>" alt="rachouan rejeb">
					<?php }else{ ?>
					<img src="images/profile_pictures/notfound.svg" alt="rachouan rejeb">
					<?php }?>
					<h1><?php echo $value['firstname'].' '.$value['lastname']; ?> <span><?php $hours = date("H", strtotime($value['message_creation_date'])); $date = date("D", strtotime($value['message_creation_date'])); echo $hours.'h '.$date;?></span></h1>
					<p><span><?php echo $value['message']; ?></span><?php if($value['seen'] == 1){ ?><span class="seen"></span><?php } ?></p>
				</header>

			</a>
		</li>
			<?php } }else{ ?>
				<li>
					<div class="empty">
						<span class="icon-circle-plus"></span><?php echo $_SESSION['lang']['conversationCreate']; ?><span class="icon-arrow-up"></span>
					</div>
				</li>
      <?php }?>
		</ul>
	</nav>
</aside>

<?php if(!$isMobile){ ?>

<section class="messages">
	<?php if(!empty($messages)){ ?>
	<header>
		<h1><?php echo $convo_users[1]['firstname'].' '.$convo_users[1]['lastname']; ?><span class="status"></span></h1>
		<nav>
			<ul>
				<?php foreach ($convo_users as $key => $value) { ?>
				<?php if(isset($_SESSION['user']) && $_SESSION['user']['id'] != $value['user_id']){ ?>
					<?php if($value['user_typing'] == 1){ ?>
					<li class="user animated bounce infinite"><img src="images/profile_pictures/<?php echo $value['picture']; ?>"></li>
					<?php }else{ ?>
					<li class="user"><?php if(!empty($value['picture'])){ ?>
			<img src="images/profile_pictures/<?php echo $value['picture'];?>" alt="rachouan rejeb">
			<?php }else{ ?>
			<img src="images/profile_pictures/notfound.svg" alt="rachouan rejeb">
			<?php }?></li>
					<?php } ?>
				<?php }
			} ?>
			</ul>
		</nav>
	</header>
	<aside class="chat">
		<ul>
			<?php

			$amount = count($messages)-1;

			for ($i = $amount; $i >= 0; $i--) {

				if($messages[$i]['id'] != $_SESSION['user']['id']){

				?>

				<li id="<?php echo $messages[$i]['message_id']; ?>" class="message <?php if($messages[$i]['seen'] == 1){ echo "notseen"; } ?>"><p><?php if(!empty($messages[$i]['picture'])){ ?>
			<img src="images/profile_pictures/<?php echo $messages[$i]['picture'];?>" alt="rachouan rejeb">
			<?php }else{ ?>
			<img src="images/profile_pictures/notfound.svg" alt="rachouan rejeb">
			<?php }?><span><?php echo $messages[$i]['message']; ?></span></p></li>

			<?php
		}else{ ?>

		<li id="<?php echo $messages[$i]['message_id']; ?>" class="message <?php if($messages[$i]['seen'] == 1){ echo "notseen"; } ?>"><p class="me"><span><?php echo $messages[$i]['message']; ?></span></p></li>


		<?php }
		} ?>

			</ul>



	</aside>
	<form action="" method="post" enctype="multipart/form-data">
				<textarea id="message" name="message" placeholder="Whats up ?"></textarea>
				<input type="submit" id="send_message" name="send_message" value="send message">
			</form>

			<?php }else{?>
				<div class="empty_data">

					<header>
							<h1 class="messages"><span class="hide">no conversations</span></h1>
							<h2><?php echo $_SESSION['lang']['noConversationTitle']; ?></h2>
					</header>
					<p><?php echo $_SESSION['lang']['noConversationText']; ?></p>
					<a href="?page=messages&action=create"><?php echo $_SESSION['lang']['startConversation']; ?></a>
				</div>

			<?php } ?>
</section>

<?php } ?>

</div>
