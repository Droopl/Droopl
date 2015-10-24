</article>



<article class="search">

        <form>
            <input type="text" id="search_full" name="search_full" value="" placeholder="<?php echo $_SESSION['lang']['formlooking']; ?>" autocomplete="off">
            <a href="?page=home" class="close"><span class="hide">close</span></a>
        </form>
        
        <ul>
            <li class="preloader">
                <svg id="preloader" version="1.1" id="loader-1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="50px" height="50px" viewBox="0 0 40 40" enable-background="new 0 0 40 40" xml:space="preserve">
                    <path opacity=".9" fill="#E0E1E1" d="M20.201,5.169c-8.254,0-14.946,6.692-14.946,14.946c0,8.255,6.692,14.946,14.946,14.946
                s14.946-6.691,14.946-14.946C35.146,11.861,28.455,5.169,20.201,5.169z M20.201,31.749c-6.425,0-11.634-5.208-11.634-11.634
                c0-6.425,5.209-11.634,11.634-11.634c6.425,0,11.633,5.209,11.633,11.634C31.834,26.541,26.626,31.749,20.201,31.749z" />
                    <path fill="#F47D67" d="M26.013,10.047l1.654-2.866c-2.198-1.272-4.743-2.012-7.466-2.012h0v3.312h0
                C22.32,8.481,24.301,9.057,26.013,10.047z">
                        <animateTransform attributeType="xml" attributeName="transform" type="rotate" from="0 20 20" to="360 20 20" dur="1s" repeatCount="indefinite" />
                    </path>
                </svg>
            </li>
        </ul>

</article>

<?php if($_GET['page'] == "user"){ ?>
<article class="rating hide scrollable">
    <header class="hide rating"><h1>Rating</h1></header>
    <div class="feed">
    <section class="rating">
        <header class="hide"><h1>Boris Debusscher</h1></header>
        <aside>
            <header class="hide"><h1>Rating between 0 and 5 stars</h1><a href=""><span>close</span></a></header>
            <nav>
                <header class="hide">
                    <h1>Main Rating</h1>
                </header>

                <ul>
                    <li class="star full"></li>
                    <li class="star full"></li>
                    <li class="star full"></li>
                    <li class="star full"></li>
                    <li class="star full"></li>
                </ul>
            </nav>
        </aside>
        <footer>
            <header class="hide"><h1>Submit your rating for Boris Debusscher</h1></header>
            <form action="?page=rateuser&id=<?php echo $_GET['id']; ?>"method="post">
                <input type="number" id="rating" name="rating" value="" class="hide">
                <input type="submit" id="submit_rating" name="submit_rating" value="Rate Boris Debusscher" class="check">
            </form>
        </footer>
    </section>
    </div>
</article>

<?php } ?>


<?php if($_GET['page'] == "communities" && !empty($_GET['action']) && $_GET['action'] == "create"){ ?>
<article class="create_community">
    <div class="feed">
    <section class="create_community">
        <form action="?page=communities" method="post" id="add_collection" name="add_collection" enctype="multipart/form-data">
            <header id="upload">
                <div class="dragndrop" id="dragndrop">
                    <div class="preloader">
                        <ul class="progress">
                        </ul>
                        <span class="remove-file"><p class="icon-cross"></p></span>
                        <input type="file" id="community_image" name="community_image" accept="image/*">
                    </div>
                </div>
                <h1>Drag and drop</h1>
                <p>Or press to browse</p>
            </header>
            <aside>
                <header>
                    <h1 class="hide">Info about your community</h1>
                    <input type="text" id="community_name" name="community_name" placeholder="Community name">
                </header>
                <textarea placeholder="Description" id="community_description" name="community_description"></textarea>
                <input type="text" id="commmunity_privacy" name="commmunity_privacy" class="hide" value="1">
                <input type="submit" id="add_item" name="add_item" value="Add Item">
                <div class="privacy_slider">
                    <div class="bar">
                        <div class="slider"><span class="icon-unlock"></span></div>
                        <span></span>
                    </div>
                </div>
            </aside>
        </form>
    </section>
    </div>
</article>
<?php } ?>

<?php if($_GET['page'] == "messages" && isset($_GET['action']) && $_GET['action'] == "create"){ ?>
<article class="newconvo">
    <section class="animated slideInUp">
        <header class="hide"><h1>new conversation</h1></header>
        <form action="" method="post" >
            <input type="text" id="search_people" name="search_people" placeholder="Search for people" autofocus>
            <input type="text" id="user_id" name="user_id" value="6" class="hide">
            <div class="search_users">
                <?php if(!empty($users)){ ?>
                <ul>
                    <?php foreach ($users as $key => $user) { ?>
                         <li><img src="images/profile_pictures/<?php echo $user['picture']; ?>"></li>
                   <?php  } ?>
                   
                </ul>
                <?php }else{ ?>
                <p>No user found</p>
                <?php } ?>
            </div>
            <div>
                <textarea placeholder="New message" id="message" name="message"></textarea>
                <input type="submit" id="create_new" name="create_new" value="submit">
            </div>
        </form>
    </section>
</article>
<?php } ?>
<article class="detail hide scrollable">
    <header class="hide detail"><h1>Detail</h1></header>
</article>
<article class="add_collection hide scrollable">
    <header class="hide add_collection"><h1>Add collection</h1></header>
</article>
<article class="collection_item hide scrollable">
    <header class="hide collection_item"><h1>collection detail</h1></header>
</article>
<article class="remove-msg">
    <div class="animated slideInUp remove-collection-item-msg">
        <p>Are you sure you want to delete this item from your collection ?</p>
        <a href="?page=collection&action=remove&collection_id=<?php if(isset($_GET) && !empty($_GET['collection_id'])){ echo $_GET['collection_id'];} ?>" class="yes-btn"><span>Yes</span></a>
        <a class="cancel-btn"><span>Cancel</span></a>
    </div>
</article>
<article class="new-conversation">
        <form class="animated slideInUp" id="new-conversation-form" method="post">
                <input type="text" placeholder="New conversation ..." id="search-conversation" name="search-conversation">
                <span class="close-new-conversation"></span>
                <input>
                <ul class="recent-list">
                    <h1>Recent</h1>
                    <li id="1">
                        <img src="images/profile_pictures/boris.jpg">
                        <p>Boris Debusscher</p>
                    </li>
                    <li id="1">
                        <img src="images/profile_pictures/boris.jpg">
                        <p>Boris Debusscher</p>
                    </li>
                    <li id="1">
                        <img src="images/profile_pictures/boris.jpg">
                        <p>Boris Debusscher</p>
                    </li>
                    <li id="1">
                        <img src="images/profile_pictures/boris.jpg">
                        <p>Boris Debusscher</p>
                    </li>
                    <li id="1">
                        <img src="images/profile_pictures/boris.jpg">
                        <p>Boris Debusscher</p>
                    </li>
                    <li id="1">
                        <img src="images/profile_pictures/boris.jpg">
                        <p>Boris Debusscher</p>
                    </li>
                </ul>
        </form>
</article>
<?php if(!empty($_GET['action']) && $_GET['action'] == "feedback"){ ?>
<article class="feedback">
    <div class="feed">
        <section class="feedback animated fadeInUp">
            <form action="?page=feedback" method="post">
                <header>
                    <img src="images/assets/droopl_logo.svg">
                    <h1><?php echo $_SESSION['lang']['feedbacktitle']; ?></h1>
                    <div class="type">
                        <div>
                            <input type="radio" id="type" name="type" checked="checked" value="0">
                            <label id="type"><p><?php echo $_SESSION['lang']['feedback']; ?></p></label>
                        </div>

                        <div>
                            <input type="radio" id="type" name="type" value="1">
                            <label id="type"><p><?php echo $_SESSION['lang']['feedbackbug']; ?></p></label>
                        </div>
                        
                    </div>
                </header>
                <textarea placeholder="<?php echo $_SESSION['lang']['feedbackText']; ?>" required id="feedback" name="feedback"></textarea>
                <input type="submit" id="feedback_btn" name="feedback_btn" value="send feedback">
            </form>
        </section>
    </div>
</article>
<?php } ?>
<footer class="hide">
	<header><h1>Footer</h1></header>
</footer>
</body>
</html>