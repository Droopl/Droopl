<div class="messages">
<section class="messages">
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
				<li class="add"><input type="submit" id="add_user" name="add_user"></li>
			</ul>
		</nav>
	</header>
	<aside class="chat" id="1">
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
				<div id="message_image_upload">
					<input type="file" id="image_upload" accept="image/*"  name="image_upload">
				</div>
				<input type="submit" id="send_message" name="send_message" value="send message">
			</form>
</section>
</div>