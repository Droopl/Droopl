<div class="feed">
<section class="quest" id="<?php echo $quest['quest_id']; ?>">
<header>

<?php if(!empty($quest['picture'])){ ?>
<img src="images/profile_pictures/<?php echo $quest['picture'];?>" alt="rachouan rejeb">
<?php }else{ ?>
<img src="images/profile_pictures/notfound.svg" alt="rachouan rejeb">
<?php }?>
<h1><a href="?page=user&id=<?php echo $quest['id']; ?>"> <?php echo $quest['firstname']; echo " "; echo $quest['lastname'];?></a><?php if($quest['type'] == 0){ 

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
        echo "is looking for ";
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
    
}?><span><?php echo $quest['item']; ?></span></h1>
	<a href="?page=<?php echo $_GET['page']; ?>&questid=<?php echo $_GET['questid']; ?>" class="close"><span class="hide">close</span></a>
</header>
<?php if(!empty($quest['quest_description'])){ ?>
    <aside class="info">
    <p>
    <?php echo $quest['quest_description'] ?></p>
    <?php 
    if($quest['image_url'] != NULL){ ?>
        <span class="icon-paper-clip"><a href="questimages/images/<?php echo $quest['image_url']; ?>" class="attachement" target="_blank">1 image</a></span>
    <?php }
     ?>
    </aside>
<?php }else{ ?>
    <aside class="info">
        <p>No description</p>
    </aside>
<?php } ?>
<footer class="detail">
    
    <?php if($_SESSION['user']['id'] != $quest['id'] && !$accepted ){ ?>
        <div class="search-collection-container">
            <div class="search-proposal">
                <form action="?page=detail&questid=<?php echo $_GET['questid']; ?>" method="post">

                    <input type="text" placeholder="Propose an item from your collection" name="search_proposals" id="search_proposals">
                    <input type="submit" name="submit_search" id="submit_search" value>
                    <input type="text" id="collection_item" name="collection_item" class="hide" value="">
                    <div class="added-collection-item">
                        <p>Reflex Camera <span class="remove-collection-item icon-cross"></span></p>
                    </div>
                    
                </form>
            </div>
            <?php if(!empty($collection)){ ?>

                <div class="hide collection">
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
        </div>

    <?php }else{ ?>

        <div class="hide collection no-collection-items">
            <header class="marg-bottom">
                <h1 class="collection"><span class="hide">no more quests</span></h1>
                <h2>You don't have any collection items yet.<a class="post-add-collection-item">Add item</a></h2>
            </header>
        </div>
</div>
    <?php } } ?>
<div class="proposals-list">
    <ul class="list">

        <?php 

        if(!empty($proposals)){

        foreach ($proposals as $key => $value) {?>
            <li class="propo" id="<?php echo $value['propo_id']; ?>">
            <ul>
                <li class="profile-pic">
                    <img src="images/profile_pictures/<?php echo $value['picture']; ?>">
                </li>
                <li class="profile-name">
                    <p><a href="?page=user&id=<?php echo $value['id']; ?>"><?php  echo $value['firstname']; ?> <?php echo $value['lastname']; ?></a> proposed</p>
                </li>
                <li class="collection-pic">
                    <img src="images/collection/<?php echo $value['collection_image']; ?>">
                </li>
                <li class="options">
                    <ul>
                        <li><a href="?page=messages&id<?php echo $value['user_id']; ?>&action=new" class="icon-speech-bubble"></a></li>
                         <li><a href="?page=detail&questid=<?php echo $quest['quest_id']; ?>&id=<?php echo $value['propo_id']; ?>&action=confirm" class="icon-check"></a></li>
                    </ul>
                </li>
            </ul>
        </li>


        <?php }}else{ ?>

        <?php if(!$accepted){ ?>

        <div class="no-proposals-container">
            <h1 class="no-proposals-icon"></h1>
        	<p class="no-proposals-yet">There are no proposals yet</p>
        </div>
        
        <?php }else{ ?>

             <div class="trophy">
                <img src="images/assets/propo_accepted_trophy.svg">
                <header><h1><?php echo $acceptedProposal['firstname']." ".$acceptedProposal['lastname'];?></h1></header>
                <p>Has won this! quest congratulations</p>
             </div>

       <?php  }} ?>
        
        
    </ul>
</div>
</footer>
</section>
</div>
