<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>DROOPL</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1 , maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,500,700,900,300,100' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="css/feather.css">
    <link rel="stylesheet" type="text/css" href="css/animate.css">
    <link rel="stylesheet" type="text/css" href="css/loaders.min.css">
    <link rel="stylesheet" type="text/css" href="css/hover.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/communities.css">
	<link rel="stylesheet" type="text/css" href="css/register.css">
	<script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
	<script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
	<script src="js/jquery.min.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDW4WkPdqlHs1e-hRent6pjDumSxAboPe4&libraries=places&sensor=false&types=(cities)"></script>
	<script type="text/javascript" src="js/app.js"></script>
	<script type="text/javascript" src="js/drooplgame.js"></script>
	<script type="text/javascript" src="js/chat.js"></script>
</head>

<body>
    <!--<noscript>
        <style type="text/css">
            #menu,article {display:none;}
        </style>
        <div id="noscriptmsg">
            <h1 class="enable-js-img"></h1>
            <p>Please enable javascript, little gangster.</p>
        </div>
    </noscript>!-->
    <div class="js-language hide"><?php echo $_SESSION['language']; ?></div>
    
    <audio id="sounds" src="" class="hide"></audio>

    <?php if($_GET['page'] != "login" && $_GET['page'] != "register" && $_GET['page'] != "timer"){ ?>
<header id="menu">
	<div>
    <h1><a href="?page=feed" class="logo"><span class="hide">Droopl</span></a></h1>
    <form action="">
        <input type="button" id="search_submit" name="search_submit" value="search">
    </form>

    <nav>
    	<ul>
    		<li id="notif" class="notifications">
    			<span class="icon-bell"></span>
    			<ul>

    				<?php foreach ($notifications as $key => $value) { 

    					switch ($value['notification_type']) {
    						case '0': ?>
    							<li <?php echo 'id="'.$value['notification_id'].'"'; if($value['seen'] == 0){ echo 'class="notif notseen"';}else{ echo 'class="notif"';} ?>><a href="?page=detail&questid=<?php echo $value['quest_id']; ?>"><span class="icon icon-repeat"></span> New proposal from <?php echo $value['firstname']; ?> <span class="time"><?php 

									$full = false;
							 		$now = new DateTime;
								    $ago = new DateTime($value['notification_creation_date']);
								    $diff = $now->diff($ago);

								    $diff->w = floor($diff->d / 7);
								    $diff->d -= $diff->w * 7;

								    $string = array(
								        'y' => 'year',
								        'm' => 'month',
								        'w' => 'week',
								        'd' => 'day',
								        'h' => 'h',
								        'i' => 'm',
								        's' => 's',
								    );
								    foreach ($string as $k => &$v) {
								        if ($diff->$k) {
								            $v = $diff->$k . ' ' . $v;
								        } else {
								            unset($string[$k]);
								        }
								    }

								    if (!$full) $string = array_slice($string, 0, 1);
								    $result =  $string ? implode(', ', $string) : 'just now';

								    echo $result;

									?></a></span></li>
    							<?php break;


    							case '2': ?>
    							<li  <?php echo 'id="'.$value['notification_id'].'"'; if($value['seen'] == 0){ echo 'class="notif notseen"';}else{ echo 'class="notif"';} ?>><a href="?page=user&id=<?php echo $value['user_id']; ?>"><span class="icon icon-circle-plus"></span><?php echo $value['firstname']; ?> followed you<span class="time"><?php 

									$full = false;
							 		$now = new DateTime;
								    $ago = new DateTime($value['notification_creation_date']);
								    $diff = $now->diff($ago);

								    $diff->w = floor($diff->d / 7);
								    $diff->d -= $diff->w * 7;

								    $string = array(
								        'y' => 'year',
								        'm' => 'month',
								        'w' => 'week',
								        'd' => 'day',
								        'h' => 'h',
								        'i' => 'm',
								        's' => 's',
								    );
								    foreach ($string as $k => &$v) {
								        if ($diff->$k) {
								            $v = $diff->$k . ' ' . $v;
								        } else {
								            unset($string[$k]);
								        }
								    }

								    if (!$full) $string = array_slice($string, 0, 1);
								    $result =  $string ? implode(', ', $string) : 'just now';

								    echo $result;

									?></a></span></li>
    							<?php break;

    							case '3': ?>
    							<li  <?php echo 'id="'.$value['notification_id'].'"'; if($value['seen'] == 0){ echo 'class="notif notseen"';}else{ echo 'class="notif"';} ?>><a href="?page=user&id=<?php echo $value['user_id']; ?>"><span class="icon icon-circle-plus"></span><?php echo $value['firstname']; ?> followed you back<span class="time"><?php 

									$full = false;
							 		$now = new DateTime;
								    $ago = new DateTime($value['notification_creation_date']);
								    $diff = $now->diff($ago);

								    $diff->w = floor($diff->d / 7);
								    $diff->d -= $diff->w * 7;

								    $string = array(
								        'y' => 'year',
								        'm' => 'month',
								        'w' => 'week',
								        'd' => 'day',
								        'h' => 'h',
								        'i' => 'm',
								        's' => 's',
								    );
								    foreach ($string as $k => &$v) {
								        if ($diff->$k) {
								            $v = $diff->$k . ' ' . $v;
								        } else {
								            unset($string[$k]);
								        }
								    }

								    if (!$full) $string = array_slice($string, 0, 1);
								    $result =  $string ? implode(', ', $string) : 'just now';

								    echo $result;

									?></a></span></li>
    							<?php break;


    							case '6': ?>
    							<li  <?php echo 'id="'.$value['notification_id'].'"'; if($value['seen'] == 0){ echo 'class="notif notseen"';}else{ echo 'class="notif"';} ?>><a href="?page=detail&questid=<?php echo $value['quest_id']; ?>"><span class="icon icon-heart"></span>You won <?php echo $value['firstname']; ?>'s quest<span class="time"><?php 

									$full = false;
							 		$now = new DateTime;
								    $ago = new DateTime($value['notification_creation_date']);
								    $diff = $now->diff($ago);

								    $diff->w = floor($diff->d / 7);
								    $diff->d -= $diff->w * 7;

								    $string = array(
								        'y' => 'year',
								        'm' => 'month',
								        'w' => 'week',
								        'd' => 'day',
								        'h' => 'h',
								        'i' => 'm',
								        's' => 's',
								    );
								    foreach ($string as $k => &$v) {
								        if ($diff->$k) {
								            $v = $diff->$k . ' ' . $v;
								        } else {
								            unset($string[$k]);
								        }
								    }

								    if (!$full) $string = array_slice($string, 0, 1);
								    $result =  $string ? implode(', ', $string) : 'just now';

								    echo $result;

									?></a></span></li>
    							<?php break;
    						
    					}
					 } ?>
    				
                   
    			</ul>
    		</li>
    		<li class="profile">
                <?php if(!empty($_SESSION['user'])){ ?>
               
    			<?php if(!empty($_SESSION['user']['picture'])){ ?>
				<img class="profile-img" src="images/profile_pictures/<?php echo $_SESSION['user']['picture'];?>" alt="rachouan rejeb">
				<?php }else{ ?>
				<img class="profile-img" src="images/profile_pictures/notfound.svg" alt="rachouan rejeb">
				<?php }?>
                
                <ul class="scrollable">
                    <li><a href="?page=user&id=<?php echo $_SESSION['user']['id']; ?>" class="icon-head"><span><?php echo $_SESSION['lang']['menuprofile']; ?></span></a></li>
                     <li><a href="?page=user&id=<?php echo $_SESSION['user']['id']; ?>&action=edit" class="icon icon-cog"> <span><?php echo $_SESSION['lang']['menusettings']; ?></span></a></li>
            <li><a class="about icon icon-command" href="?page=about"><span><?php echo $_SESSION['lang']['menuabout']; ?></span></a></li>
            <li><a href="?page=<?php if(!empty($_GET['page'])){ echo $_GET['page'];}else{ echo '?page=feed';} ?>&action=feedback"class="bug icon icon-flag"><span><?php echo $_SESSION['lang']['menufeedback'];?></span></a></li>
                     <li><a class="logout icon icon-lock"><span><?php echo $_SESSION['lang']['menulogout']; ?></span></a></li>
                </ul>
                <?php }else{ ?>

                    <a class="login-or-register" href="?page=login"><?php 
            switch ($_SESSION['language']) {
			        case 'en':
			        echo "Login or Register";
			        break;

			        case 'nl':
			        echo "Inloggen of registreren";
			        break;

			        case 'fr':
			        echo "Connexion ou inscription";
			        break;
			        
			        default:
			        echo "Login or Register";
			        break;
			    }
            ?></a>

                <? } ?>
    		</li>
    	</ul>
    </nav>
    </div>
</header>


<?php } ?>
    
<article>
	<header class="hide">
		<h1>Droopl <?php echo $_GET["page"];?></h1>
	</header>
	<?php if(isset($_SESSION['user']) && $_SESSION['user']['verification'] == "0" && $_GET['page'] != "register"){ ?>
	<section class="verif animated fadeInDown"><span class="icon-circle-check"></span>Your account hasn't been verified yes click <a href="?page=verification">here</a> to resend verification code</section>
	<?php } ?>
