<?php if($_GET['page'] != "login" && $_GET['page'] != "search" && $_GET['page'] != "messages"){ ?>
<section class="chat">
    <ul>
        <li class="animated fadeIn new-conversation">
            <span class="new-icon"></span>
            <form id="new-conversation-form" method="post">
                <input type="text" placeholder="New conversation ..." id="search-conversation" name="search-conversation">
                <ul>
                    <li>
                        <img src="images/profile_pictures/boris.jpg">
                        <p>Boris Debusscher</p>
                    </li>
                    <li>
                        <img src="images/profile_pictures/boris.jpg">
                        <p>Boris Debusscher</p>
                    </li>
                    <li>
                        <img src="images/profile_pictures/boris.jpg">
                        <p>Boris Debusscher</p>
                    </li>
                    <li>
                        <img src="images/profile_pictures/boris.jpg">
                        <p>Boris Debusscher</p>
                    </li>
                    <li>
                        <img src="images/profile_pictures/boris.jpg">
                        <p>Boris Debusscher</p>
                    </li>
                    <li>
                        <img src="images/profile_pictures/boris.jpg">
                        <p>Boris Debusscher</p>
                    </li>
                </ul>
            </form>
        </li>

        <?php if(!empty($dynamicConvos)){ ?>

            <?php foreach ($dynamicConvos as $key => $value) { ?>
                  <li class="conversation-bubble"><img src="images/profile_pictures/<?php echo $value['picture'];?>"><span class="close-conversation"><p class="icon-cross"></p></span><div class="conversation"><header><h1><a href="?page=user&id=<?php echo $value['id'];?>"><?php echo $value['firstname']." ".$value['lastname']; ?></a></h1></header><footer><ul></ul><form id="chat-form" method="post"><input placeholder="What's up ?" type="text" id="sent_msg" name="sent_msg"><input type="submit" id="submit_msg" name="submit_msg" value=""></form></footer></div><span class="new-msg animated-slow infinite pulse"></span></li>
            <?php } ?>
        
        <?php } ?>
        <li class="animated fadeIn more-conversations">
            <a href="?page=messages">
                <div>
                    <p>More conversations</p>
                </div>
            </a>
        </li>
    </ul>
</section>
<?php } ?>

</article>



<article class="search">

        <form>
            <input type="text" id="search_full" name="search_full" value="" placeholder="What are you looking for ?">
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
<footer class="hide">
	<header><h1>Footer</h1></header>
</footer>
</body>
</html>