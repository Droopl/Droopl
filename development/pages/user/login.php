<article class="login">
    <div class="hide" id="loggedin"><?php echo $isloggedin; ?></div>

	<section>

        <?php
        $login = true;
        if(!empty($_GET["setup"]) && $_GET["setup"] != "login"){
            $login = false;
        }else if(empty($_GET["setup"])){
            $login = false;
        }?>

		<header>
			<h1 class="logo animated fadeInUp"><span class="hide">Droopl</span></h1>
			<p class=" delay1 animated fadeInUp" >Droopl isn't just sharing, it's a way of living</p>

            <nav class="delay1 animated fadeInUp">
            <ul>
            <li><a href="index.php?page=login&setup=quest" class="<?php if(!$login){echo "current-filter";} ?>">Quest</a></li>
            <li><a href="index.php?page=login&setup=login" class="<?php if($login){echo "current-filter";} ?>">Sign in</a>
            </li>
            </ul>
            </nav>
		</header>



        <?php if($login){?>

            <form class="delay1 animated fadeInUp" method="post" id="login" name="login_form">
                <header>
                    <h1>Sign in</h1>
                    <?php if(!empty($_SESSION["errors"])){?>
                    <nav>
                        <ul>
                            <?php foreach ($_SESSION["errors"] as $key => $value) { ?>
                                <li><?php echo $value?></li>
                            <?php } ?>

                        </ul>
                    </nav>

                    <?php } ?>
                    <svg id="preloader" version="1.1" id="loader-1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="34px" height="34px" viewBox="0 0 40 40" enable-background="new 0 0 40 40" xml:space="preserve">
                <path opacity=".9" fill="#E0E1E1" d="M20.201,5.169c-8.254,0-14.946,6.692-14.946,14.946c0,8.255,6.692,14.946,14.946,14.946
            s14.946-6.691,14.946-14.946C35.146,11.861,28.455,5.169,20.201,5.169z M20.201,31.749c-6.425,0-11.634-5.208-11.634-11.634
            c0-6.425,5.209-11.634,11.634-11.634c6.425,0,11.633,5.209,11.633,11.634C31.834,26.541,26.626,31.749,20.201,31.749z" />
                <path fill="#F47D67" d="M26.013,10.047l1.654-2.866c-2.198-1.272-4.743-2.012-7.466-2.012h0v3.312h0
            C22.32,8.481,24.301,9.057,26.013,10.047z">
                    <animateTransform attributeType="xml" attributeName="transform" type="rotate" from="0 20 20" to="360 20 20" dur="1s" repeatCount="indefinite" />
                </path>
            </svg>
                </header>
                <div class="inner-form-container">
    			 <input type="text" id="email" name="email" placeholder="Email" value="<?php echo $email; ?>">
    			 <input type="password" id="pass" name="pass" placeholder="Password" value="<?php echo $password; ?>">
    			 <input type="submit" id="submit_btn" name="submit_btn" value="sign in">
                </div>
    		</form>

        <?php }else{ ?>
            <form class="delay1 animated fadeInUp" action="index.php?page=register" method="post" name="register_quest" id="register_quest" enctype="multipart/form-data">
    			<div>
                    <input type="text" id="type" name="type" class="hide" value="0">
    				<input type="text" id="item" name="item" placeholder="<?php echo $_SESSION['lang']['formlooking']; ?>" tabindex="1">
    			</div>

    			<div>
    				<textarea id="desc" name="desc" placeholder="<?php echo $_SESSION['lang']['formdescription']; ?>" tabindex="2"></textarea>
    				<nav>
    				<span class="upload_image">
    				    <input type="file" id="quest_upload_image" accept="image/*" name="quest_upload_image"  tabindex="3">
    				</span>
    				<span class="hide uploaded_image"><img src=""><p class="icon-cross"></p></span>
    				<input type="submit" id="register_submit" name="register_submit" value="post" tabindex="4">
    			</nav>
    			</div>
    		</form>

        <?php } ?>




        <footer id="create-account" class="delay3 animated fadeInUp">
            <p class="create-account">or <a href="?page=register">click here</a> to create your free account</p>
        </footer>
	</section>
</article>
