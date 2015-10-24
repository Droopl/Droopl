<article class="add_collection">
	<div class="feed">
	<section class="add-collection-item">
		<form action="?page=add" method="post" id="add_collection" name="add_collection" enctype="multipart/form-data">
			<header id="upload">
				<div class="dragndrop" id="dragndrop">
					<div class="preloader">
						<ul class="progress">
						</ul>
                        <span class="remove-file"><p class="icon-cross"></p></span>
						<input type="file" id="collection_image" name="collection_image" accept="image/*">
					</div>
				</div>
				<h1>Drag and drop</h1>
				<p>Or press to browse</p>
			</header>
			<aside>
				<header>
					<h1 class="hide">Info about your item</h1>
					<input type="text" id="item_name" name="item_name" placeholder="Item name">
				</header>
				<textarea placeholder="Description" id="item_description" name="item_description"></textarea>

				<input type="submit" id="add_item" name="add_item" value="Add Item">
			</aside>
		</form>
	</section>
	</div>
</article>