<article class="collection_item">
	<div class="feed">
	<section id="<?php echo $item['collection_id']; ?>" class="detail-collection-item <?php if($item['user_id'] == $_SESSION['user']['id']){ echo "editable"; } ?>">
		<form action="?page=add" method="post" id="edit_collection" name="edit_collection" enctype="multipart/form-data">
			<header id="upload">
                <?php if($item['user_id'] == $_SESSION['user']['id']){ ?>
                    <input type="submit" id="edit_item" name="edit_item" value="Edit">
                <?php } ?>
                <?php if($item['user_id'] == $_SESSION['user']['id']){ ?>
				<div class="dragndrop" id="dragndrop" style="background-image: <?php if(!empty($item['collection_image'])){ echo "url(images/collection/".$item['collection_image']; }else{ echo "url(images/profile_pictures/notfound.svg";} ?>);border: none">
					<div class="preloader">
						<ul class="progress">
						</ul>
						<input type="file" id="collection_image" name="collection_image" accept="image/*">
                        <span class="remove-file"><p class="icon-cross"></p></span>
					</div>
				</div>
                <?php }else{ ?>
                <?php if(!empty($item['collection_image'])){ ?>
                                <img class="non-editable-collection-img" src="images/collection/<?php echo $item['collection_image']; ?>">
                <?php }else{ ?>
                                <img class="non-editable-collection-img" src="images/profile_pictures/notfound.svg" alt="image not found">
                <?php }?>

                <?php } ?>
			</header>
			<aside>
                <a class="close-collection-detail"></a>
				<header>
					<h1 class="hide">Info about your item</h1>
					<input type="text" id="item_name" name="item_name" value="<?php echo $item['item_name']; ?>" required readonly>
				</header>
				<textarea id="item_description" name="item_description" readonly><?php if(!empty($item['description'])){ echo $item['description']; }else{ echo "this item has no description yet";} ?></textarea>
                <div class="button-container">
                    <?php if($item['available'] == 0){ ?>
                        <p class="available"></p>
                        <input class="availability<?php if($item['user_id'] == $_SESSION['user']['id']){ echo "-editable"; } ?>" type="button" id="availability-btn" name="availability-btn" value="available">
                        <input type="text" name="item_availability" id="item_availability" class="hide" value="0">
                    <?php }else{ ?>
                        <p class="not-available"></p>
                        <input class="availability<?php if($item['user_id'] == $_SESSION['user']['id']){ echo "-editable"; } ?>" type="button" id="availability-btn" name="availability-btn" value="not available">
                        <input type="text" name="item_availability" id="item_availability" class="hide" value="1">
                    <?php } ?>

                    <?php if($item['user_id'] == $_SESSION['user']['id']){ if($item['status'] == 0){ ?>
                        <p class="public"></p>
                        <input class="privacy<?php if($item['user_id'] == $_SESSION['user']['id']){ echo "-editable"; } ?>" type="button" id="privacy-btn" name="privacy-btn" value="public">
                        <input type="text" name="item_privacy" id="item_privacy" class="hide" value="0">
                    <?php }else{ ?>
                        <p class="private"></p>
                        <input class="privacy<?php if($item['user_id'] == $_SESSION['user']['id']){ echo "-editable"; } ?>" type="button" id="privacy-btn" name="privacy-btn" value="private">
                        <input type="text" name="item_privacy" id="item_privacy" class="hide" value="1">
                    <?php } }?>
                </div>
			</aside>
		</form>
	</section>
	</div>
</article>
