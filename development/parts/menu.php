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
	<script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
	<!--<script src="js/jquery.min.js"></script>!-->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDW4WkPdqlHs1e-hRent6pjDumSxAboPe4&sensor=false&types=(cities)"></script>
	<script type="text/javascript" src="js/app.js"></script>
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

    <?php if($_GET['page'] != "login"){ ?>
<header id="menu">
	<div>
    <h1><a href="?page=feed" class="logo"><span class="hide">Droopl</span></a></h1>
    <form action="">
        <input type="button" id="search_submit" name="search_submit" value="search">
    </form>

    <nav>
    	<ul>
    		<li><a href="?page=feed" <?php if($_GET['page'] == "feed"){ echo 'class="current-menu-page"'; }?> ><?php 
            switch ($_SESSION['language']) {
			        case 'en':
			        echo "Dashboard";
			        break;

			        case 'nl':
			        echo "Dashboard";
			        break;

			        case 'fr':
			        echo "Dashboard";
			        break;
			        
			        default:
			        echo "Dashboard";
			        break;
			    }
            ?></a></li>
            <li><a href="?page=messages" <?php if($_GET['page'] == "messages"){ echo 'class="current-menu-page"'; }?> ><?php 
            switch ($_SESSION['language']) {
			        case 'en':
			        echo "Messages";
			        break;

			        case 'nl':
			        echo "Berichten";
			        break;

			        case 'fr':
			        echo "Messages";
			        break;
			        
			        default:
			        echo "Messages";
			        break;
			    }
            ?></a></li>
    		<li><a href="" <?php if($_GET['page'] == "items"){ echo 'class="current-menu-page"'; }?> ><?php 
            switch ($_SESSION['language']) {
			        case 'en':
			        echo "Find items";
			        break;

			        case 'nl':
			        echo "Vind spullen";
			        break;

			        case 'fr':
			        echo "Recherche d'objets";
			        break;
			        
			        default:
			        echo "Find items";
			        break;
			    }
            ?></a></li>
    		<li><a href="" <?php if($_GET['page'] == "people"){ echo 'class="current-menu-page"'; }?> ><?php 
            switch ($_SESSION['language']) {
			        case 'en':
			        echo "People";
			        break;

			        case 'nl':
			        echo "Mensen";
			        break;

			        case 'fr':
			        echo "Personnes";
			        break;
			        
			        default:
			        echo "People";
			        break;
			    }
            ?></a></li>
    		<li id="notif" class="notifications">
    			<span class="icon-bell"></span>
    			<ul>

    				<?php foreach ($notifications as $key => $value) { 

    					switch ($value['notification_type']) {
    						case '0': ?>
    							<li <?php echo 'id="'.$value['notification_id'].'"'; if($value['seen'] == 0){ echo 'class="notif notseen"';}else{ echo 'class="notif"';} ?>><span class="icon icon-repeat"></span> New proposal from <?php echo $value['firstname']; ?> <span class="time"><?php 

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

									?></span></li>
    							<?php break;


    							case '2': ?>
    							<li  <?php echo 'id="'.$value['notification_id'].'"'; if($value['seen'] == 0){ echo 'class="notif notseen"';}else{ echo 'class="notif"';} ?>><span class="icon icon-circle-plus"></span><?php echo $value['firstname']; ?> followed you<span class="time"><?php 

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

									?></span></li>
    							<?php break;

    							case '3': ?>
    							<li  <?php echo 'id="'.$value['notification_id'].'"'; if($value['seen'] == 0){ echo 'class="notif notseen"';}else{ echo 'class="notif"';} ?>><span class="icon icon-circle-plus"></span><?php echo $value['firstname']; ?> followed you back<span class="time"><?php 

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

									?></span></li>
    							<?php break;
    						
    					}
					 } ?>
    				
                   
    			</ul>
    		</li>
    		<li class="profile">
                <?php if(!empty($_SESSION['user'])){ ?>
               
    			<img class="profile-img" src="images/profile_pictures/<?php echo $_SESSION['user']['picture']; ?>" alt="Rachouan Rejeb">
                
                <ul class="scrollable">
                    <li><a href="?page=user&id=<?php echo $_SESSION['user']['id']; ?>" class="icon-head"><span><?php 
            switch ($_SESSION['language']) {
			        case 'en':
			        echo "My profile";
			        break;

			        case 'nl':
			        echo "Mijn profiel";
			        break;

			        case 'fr':
			        echo "Mon profil";
			        break;
			        
			        default:
			        echo "My profile";
			        break;
			    }
            ?></span></a></li>
                     <li><a href="?page=user&id=<?php echo $_SESSION['user']['id']; ?>&action=edit" class="icon icon-cog"> <span><?php 
            switch ($_SESSION['language']) {
			        case 'en':
			        echo "Settings";
			        break;

			        case 'nl':
			        echo "Instellingen";
			        break;

			        case 'fr':
			        echo "Paramètres";
			        break;
			        
			        default:
			        echo "Settings";
			        break;
			    }
            ?></span></a></li>
            <li><a class="bug icon icon-flag"><span><?php 
            switch ($_SESSION['language']) {
			        case 'en':
			        echo "Report Bug";
			        break;

			        case 'nl':
			        echo "Fout rapporteren";
			        break;

			        case 'fr':
			        echo "Raporté une bug";
			        break;
			        
			        default:
			        echo "Report Bug";
			        break;
			    }
            ?></span></a></li>
                     <li><a class="logout icon icon-lock"><span><?php 
            switch ($_SESSION['language']) {
			        case 'en':
			        echo "Logout";
			        break;

			        case 'nl':
			        echo "uitloggen";
			        break;

			        case 'fr':
			        echo "Déconnexion";
			        break;
			        
			        default:
			        echo "Logout";
			        break;
			    }
            ?></span></a></li>
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