<aside id="side">
    <section class="quest">
        <h1><?php 

        switch ($_SESSION['language']) {
            case 'en':
            echo "Quests";
            break;

            case 'nl':
            echo "Zoekers";
            break;

            case 'fr':
            echo "Quêtes";
            break;
            
            default:
            echo "Quests";
            break;
        } 
        ?>
        </h1>
        <ul>
            <?php foreach ($publicquests as $id => $val) { ?>
            <li>
                <a href="?page=detail&questid=<?php echo $val['quest_id']; ?>" alt="<?php echo $val['firstname']; ?>">
                    <?php if(!empty($val['picture'])){ ?>
                    <img src="images/profile_pictures/<?php echo $val['picture'];?>" alt="rachouan rejeb">
                    <?php }else{ ?>
                    <img src="images/profile_pictures/notfound.svg" alt="rachouan rejeb">
                    <?php }?>
                    <p><span><?php echo $val['firstname']; echo " "; echo $val['lastname'];?></span> <?php if($val['type'] == 0){ 

            switch ($_SESSION['language']) {
                case 'en':
                echo "is looking for ";
                break;

                case 'nl':
                echo "zoekt ";
                break;

                case 'fr':
                echo "cherche ";
                break;

                default:
                echo "is looking for ";
                break;
            } 
        }else{ switch ($_SESSION['language']) {
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
            }?> <span>
            <?php if($val['type'] == 0){  echo $val['item']; }else{ echo $val['item_name']; } ?>
             </span></p>
                </a>
            </li>

            <?php } ?>

        </ul>
    </section>
    <section class="collection">
        <h1><?php 

        switch ($_SESSION['language']) {
            case 'en':
            echo "My collection";
            break;

            case 'nl':
            echo "Mijn collectie";
            break;

            case 'fr':
            echo "Ma collection";
            break;
            
            default:
            echo "My collection";
            break;
        } 
        ?></h1>
        
        <?php if(!empty($collection)){ ?>
            
            <ul>
                
                <?php if(count($collection) >= 3){ ?>
                    <li class="add-to-collection"></li>
                <?php } ?>
                
                <?php for($i = 0; $i < 3; $i++){ ?>
                
                <?php if(!empty($collection[$i])){ ?>
                
                <li><img id="<?php echo $collection[$i]['collection_id']; ?>" src="images/collection/<?php echo $collection[$i]['collection_image']; ?>" alt="collection item rachouan rejeb"></li>
                
                <?php }else{ ?>
                    <li class="add-to-collection bordered"></li>
                <?php } ?>
                
                <?php } ?>
                
                <?php if(count($collection) >= 3){ ?>
                <li class="more-collection-items"><a class="more-collection-items-link" href="?page=user&id=<?php echo $_SESSION['user']['id']; ?>&filter=collection"><div><span>More</span></div></a></li>
                <?php } ?>
            </ul>

        <?php }else{ ?>
        
            <ul>
                <li class="add-to-collection bordered"></li>
                <li class="no-items-msg">You don't have any items yet.</li>
            </ul>
        
        <?php } ?>
        
        <!--<ul>
            <li class="add-to-collection"></li>
            <li><img src="images/collection/dolce-gusto.png" alt="collection item rachouan rejeb"></li>
            <li><img src="images/collection/canon-reflex.png" alt="collection item rachouan rejeb"></li>
            <li><img src="images/collection/disqueuse.png" alt="collection item rachouan rejeb"></li>
            <a class="more-collection-items-link" href="?page=user&id=<?php echo $_SESSION['user']['id']; ?>&filter=collection"><li class="more-collection-items"><div><span>More</span></div></li></a>
        </ul>-->
    </section>
    <section class="activity">
        <h1><?php 

        switch ($_SESSION['language']) {
            case 'en':
            echo "Activity";
            break;

            case 'nl':
            echo "Activiteit";
            break;

            case 'fr':
            echo "Activité";
            break;
            
            default:
            echo "Activity";
            break;
        } 
        ?></h1>
        <ul class="progress">
          <!--  Item  -->
          <li data-name="<?php if(!($propocount['propocount'] >= 1000)){ echo $propocount['propocount']; }else{ echo round($propocount['propocount'],1) . "K"; } ?> propos" data-percent="30%"> <svg viewBox="-10 -10 220 220">
            <g fill="none" stroke-width="15" transform="translate(100,100)">
              <path d="M 0,-100 A 100,100 0 0,1 86.6,-50" stroke="#2BBCAF"/>
              <path d="M 86.6,-50 A 100,100 0 0,1 86.6,50" stroke="#2BBCAF"/>
              <path d="M 86.6,50 A 100,100 0 0,1 0,100" stroke="#2BBCAF"/>
              <path d="M 0,100 A 100,100 0 0,1 -86.6,50" stroke="#2BBCAF"/>
              <path d="M -86.6,50 A 100,100 0 0,1 -86.6,-50" stroke="#2BBCAF"/>
              <path d="M -86.6,-50 A 100,100 0 0,1 0,-100" stroke="#2BBCAF"/>
            </g>
            </svg> <svg viewBox="-10 -10 220 220">
            <path id="count" d="M200,100 C200,44.771525 155.228475,0 100,0 C44.771525,0 0,44.771525 0,100 C0,155.228475 44.771525,200 100,200 C155.228475,200 200,155.228475 200,100 Z" stroke-dashoffset="<?php echo ($propocount['propocount']/500*100)*6.3 ?>"></path>
            </svg> 
    </li>
          <!--  Item  -->
          <li data-name="<?php if(!($questcount['quest_count'] >= 1000)){ echo $questcount['quest_count']; }else{ echo round($questcount['quest_count'],1) . "K"; } ?> quests" data-percent="45%"> <svg viewBox="-10 -10 220 220">
            <g fill="none" stroke-width="15" transform="translate(100,100)">
              <path d="M 0,-100 A 100,100 0 0,1 86.6,-50" stroke="#F5896E"/>
              <path d="M 86.6,-50 A 100,100 0 0,1 86.6,50" stroke="#F5896E"/>
              <path d="M 86.6,50 A 100,100 0 0,1 0,100" stroke="#F5896E"/>
              <path d="M 0,100 A 100,100 0 0,1 -86.6,50" stroke="#F5896E"/>
              <path d="M -86.6,50 A 100,100 0 0,1 -86.6,-50" stroke="#F5896E"/>
              <path d="M -86.6,-50 A 100,100 0 0,1 0,-100" stroke="#F5896E"/>
            </g>
            </svg> <svg viewBox="-10 -10 220 220">
            <path id="count" d="M200,100 C200,44.771525 155.228475,0 100,0 C44.771525,0 0,44.771525 0,100 C0,155.228475 44.771525,200 100,200 C155.228475,200 200,155.228475 200,100 Z" stroke-dashoffset="<?php echo ($questcount['quest_count']/500*100)*6.3 ?>"></path>
            </svg> </li>

          <!--  Item  -->
          <li data-name="<?php if(!($usercount['usercount'] >= 1000)){ echo $usercount['usercount']; }else{ echo round($usercount['usercount'],1) . "K"; } ?> users" data-percent="65%"> <svg viewBox="-10 -10 220 220">
            <g fill="none" stroke-width="15" transform="translate(100,100)">
              <path d="M 0,-100 A 100,100 0 0,1 86.6,-50" stroke="#44587A"/>
              <path d="M 86.6,-50 A 100,100 0 0,1 86.6,50" stroke="#44587A"/>
              <path d="M 86.6,50 A 100,100 0 0,1 0,100" stroke="#44587A"/>
              <path d="M 0,100 A 100,100 0 0,1 -86.6,50" stroke="#44587A"/>
              <path d="M -86.6,50 A 100,100 0 0,1 -86.6,-50" stroke="#44587A"/>
              <path d="M -86.6,-50 A 100,100 0 0,1 0,-100" stroke="#44587A"/>
            </g>
            </svg> <svg viewBox="-10 -10 220 220">
            <path id="count" d="M200,100 C200,44.771525 155.228475,0 100,0 C44.771525,0 0,44.771525 0,100 C0,155.228475 44.771525,200 100,200 C155.228475,200 200,155.228475 200,100 Z" stroke-dashoffset="<?php echo ($usercount['usercount']/100*100)*6.3 ?>"></path>
            </svg> </li>

          <!--  Item  -->
          <li data-name="3K droops" data-percent="95%"> <svg viewBox="-10 -10 220 220">
            <g fill="none" stroke-width="15" transform="translate(100,100)">
              <path d="M 0,-100 A 100,100 0 0,1 86.6,-50" stroke="#90CCCF"/>
              <path d="M 86.6,-50 A 100,100 0 0,1 86.6,50" stroke="#90CCCF"/>
              <path d="M 86.6,50 A 100,100 0 0,1 0,100" stroke="#90CCCF"/>
              <path d="M 0,100 A 100,100 0 0,1 -86.6,50" stroke="#90CCCF"/>
              <path d="M -86.6,50 A 100,100 0 0,1 -86.6,-50" stroke="#90CCCF"/>
              <path d="M -86.6,-50 A 100,100 0 0,1 0,-100" stroke="#90CCCF"/>
            </g>
            </svg> <svg viewBox="-10 -10 220 220">
            <path id="count" d="M200,100 C200,44.771525 155.228475,0 100,0 C44.771525,0 0,44.771525 0,100 C0,155.228475 44.771525,200 100,200 C155.228475,200 200,155.228475 200,100 Z" stroke-dashoffset="<?php echo 95*6.3 ?>"></path>
            </svg> </li>
 
</ul>
    </section>
    <section class="communities">
        <header><h1>Communities</h1></header>
        <nav>
            <ul>
                <?php foreach ($communities as $key => $community) { ?>
                    <li><a href="?page=community&id=<?php echo $community['community_id']; ?>"><img src="images/communities/<?php echo $community['community_profile']; ?>"><p><span><?php echo $community['community_name']; ?></span><span class="icon-head"> <?php echo $community['usercount'] ?></span></p></a></li>
                <?php } ?>
            </ul>
        </nav>
    </section>
</aside>

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

                    <?php if($quest['type'] == 1){ ?>
                    <input type="text" placeholder="Propose an item from your collection" name="search_proposals" id="search_proposals" class="half">
                    <input type="text" placeholder="Propose an item from <?php echo $quest['firstname']; ?>'s collection" name="user_search_proposals" id="user_search_proposals" class="half">
                    <input type="submit" name="submit_search" id="submit_search" value>
                    <input type="text" id="collection_item" name="collection_item" class="hide" value="">
                    <input type="text" id="user_collection_item" name="user_collection_item" class="hide" value="">
                    <div class="added-collection-item">
                        <p>Reflex Camera <span class="remove-collection-item icon-cross"></span></p>
                    </div>

                    <?php }else{ ?>

                     <input type="text" placeholder="Propose an item from your collection" name="search_proposals" id="search_proposals">
                    <input type="submit" name="submit_search" id="submit_search" value>
                    <input type="text" id="collection_item" name="collection_item" class="hide" value="">
                    <div class="added-collection-item">
                    <p>Reflex Camera <span class="remove-collection-item icon-cross"></span></p>
                    </div>


                    <?php } ?>
                    
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

                 <?php if($quest['type'] == 1){ ?>

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

                 <?php } ?>
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

    <?php if(!$accepted && !$completed){ ?>
    <ul class="list">

        <?php 

        if(!empty($proposals)){

        foreach ($proposals as $key => $value) {?>
            <li class="propo <?php if($quest['id'] == $_SESSION['user']['id']){ echo 'myquest'; }elseif ($value['id'] == $_SESSION['user']['id']) { echo 'mypropo'; }?>" id="<?php echo $value['propo_id']; ?>">
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
                <?php if($quest['id'] == $_SESSION['user']['id']){ ?>
                <li class="options">
                    <ul>
                        <li><a href="?page=messages&userid=<?php echo $value['id']; ?>&action=new" class="icon-speech-bubble"></a></li>
                         <li><a href="?page=detail&questid=<?php echo $quest['quest_id']; ?>&id=<?php echo $value['propo_id']; ?>&action=confirm" class="icon-check"></a></li>
                    </ul>
                </li>
                <?php }elseif ($value['id'] == $_SESSION['user']['id']) {?>
                 <li class="options">
                    <ul>
                         <li><a href="?page=detail&questid=<?php echo $quest['quest_id']; ?>&id=<?php echo $value['propo_id']; ?>&action=delete" class="icon-cross"></a></li>
                    </ul>
                </li>
                <?php } ?>
            </ul>
        </li>


        <?php }}else{ ?>

        <div class="no-proposals-container">
            <h1 class="no-proposals-icon"></h1>
            <p class="no-proposals-yet">There are no proposals yet</p>
        </div>

    <?php } ?>
        
        
    </ul>

    <?php }else if($accepted && !$completed){ ?>

    <div class="trophy">
        <img src="images/assets/propo_accepted_trophy.svg">
        <header><h1><?php echo $acceptedProposal['firstname']." ".$acceptedProposal['lastname'];?></h1></header>
        <p>Has won this! quest congratulations</p>
     </div>

   <?php }else if($completed){ ?>
    <div class="trophy">
        <img src="images/assets/quest_completed.svg">
        <header><h1>Quest Completed</header>
        <p>Your quest is completed</p>
    </div>

   <?php  } ?>
</div>
</footer>
</section>
</div>
