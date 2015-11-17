<div class="communities">
<header class="intro">
	<div class="center">

	<div class="intro">
		<img src="images/assets/community_logo.svg" class="animated fadeInDown">
	</div>

	<div class="animated fadeInUp">
		<h1>Start trading with people from your own community</h1>
		<p>
			Our communities will help bring people who have the same intrests closer than ever.
			Trade with your friends, neighbours or colleges even goats ? We give you the freedom to
			create your own community and give it a life of its own. 
		</p>

		<nav>
			<header class="hide"><h1>Liven a community</h1></header>
			<a href="?page=communities&action=create" class="create">Create a community<span class="icon-circle-plus"></span></a>
		</nav>
	</div>
	</div>
</header>

<section class="communities animated fadeInUp">
	<div class="center">
	<header>
		<h1>Most active Communities</h1>
		<nav><header class="hide"><h1>Search communities</h1></header>
			<form action="" method="get">
				<input type="text" id="search_communities" name="search_communities" placeholder="Search for communties">
			</form>
		</nav>
	</header>
	<aside class="communities">

		<?php foreach ($communities as $key => $community) { ?>

		<section class="community">
			<header>
				<img src="images/communities/<?php echo $community['community_profile'];?>">
				<h1><?php echo $community['community_name'];?></h1>
				<h2><?php if($community['genre'] == 0){ echo "Establishment"; }else{ echo "Group";}?></h2>
			</header>
			<aside>

			<nav class="join">
				<a href="?page=community&id=<?php echo $community['id'];?>&action=join" class="member">Join community<span class="icon-inbox"></span></a>
			</nav>
				<ul>
                <li>
                    <span class="bluetxt">Quests</span>
                    <p><?php echo $community['quests']; ?></p>
                </li>
                <li>
                    <span class="orangetxt">propos</span>
                    <p><?php echo $community['propos']; ?></p>
                </li>
                <li>
                    <span class="purpletxt">Members</span>
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