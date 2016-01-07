<div class="communities">
<header class="intro">
	<div class="center">

	<div class="intro">
		<img src="images/assets/community_logo.svg" class="animated fadeInDown">
	</div>

	<div class="animated fadeInUp">
		<h1><?php echo $_SESSION['lang']['communityTitle']; ?></h1>
		<p><?php echo $_SESSION['lang']['communityText']; ?></p>

		<nav>
			<header class="hide"><h1>Liven a community</h1></header>
			<a href="?page=communities&action=create" class="create"><?php echo $_SESSION['lang']['createCommunity']; ?><span class="icon-circle-plus"></span></a>
		</nav>
	</div>
	</div>
</header>

<section class="communities animated fadeInUp">
	<div class="center">
	<header>
		<h1><?php echo $_SESSION['lang']['communityDiscover']; ?></h1>
		<nav><header class="hide"><h1><?php echo $_SESSION['lang']['communitySearch']; ?></h1></header>
			<form action="" method="get">
				<input type="text" id="search_communities" name="search_communities" placeholder="<?php echo $_SESSION['lang']['communitySearch']; ?>">
			</form>
		</nav>
	</header>
	<aside class="communities">

		<?php foreach ($communities as $key => $community) { ?>

		<section class="community">
			<header>
				<?php if(!empty($user['picture'])){ ?>
                <img src="images/communities/<?php echo $community['community_profile'];?>" alt="community">
                <?php }else{ ?>
                <img class="profile-img" src="images/profile_pictures/notfound.svg" alt="image not found">
                <?php }?>

				<h1><?php echo $community['community_name'];?></h1>
				<h2><?php if($community['genre'] == 0){ echo "Establishment"; }else{ echo "Group";}?></h2>
			</header>
			<aside>

			<nav class="join">
				<a href="?page=community&id=<?php echo $community['id'];?>&action=join" class="member"><?php echo $_SESSION['lang']['communityJoin']; ?><span class="icon-inbox"></span></a>
			</nav>
				<ul>
                <li>
                    <span class="bluetxt"><?php echo $_SESSION['lang']['questCount']; ?></span>
                    <p><?php echo $community['quests']; ?></p>
                </li>
                <li>
                    <span class="orangetxt"><?php echo $_SESSION['lang']['proposCount']; ?></span>
                    <p><?php echo $community['propos']; ?></p>
                </li>
                <li>
                    <span class="purpletxt"><?php echo $_SESSION['lang']['membersCount']; ?></span>
                    <p><?php echo $community['members']; ?></p>
                </li>
            </ul>
			</aside>
		</section>

		<?php }?>

	</aside>
	</div>
</section>

<div>
