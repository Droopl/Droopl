<?php

$routes = array(

	'timer' => array('controller' => 'Timer', 'action' => 'timer'),
	'feed' => array('controller' => 'Feed', 'action' => 'feed'),
	'search' => array('controller' => 'Feed', 'action' => 'search'),
    'detail' => array('controller' => 'Feed', 'action' => 'detail'),
    'community' => array('controller' => 'Community', 'action' =>'community'),
    'communities' => array('controller' => 'Community', 'action' =>'communities'),
    'invite' => array('controller' => 'Community', 'action' =>'invite'),
    'about' => array('controller' => 'About', 'action' =>'about'),
	'login' => array('controller' => 'User', 'action' => 'login'),
	'verification' => array('controller' => 'Verification', 'action' => 'verification'),
	'feedback' => array('controller' => 'Feedback', 'action' => 'feedback'),
	'register' => array('controller' => 'User', 'action' => 'register'),
	'user' => array('controller' => 'User', 'action' => 'user'),
	'collection' => array('controller' => 'Collection', 'action' =>'remove'),
	'settings' => array('controller' => 'User', 'action' =>'settings'),
	'update' => array('controller' => 'Collection', 'action' =>'update'),
	'add' => array('controller' => 'Collection', 'action' =>'add'),
	'item' => array('controller' => 'Collection', 'action' =>'item'),
	'messages' => array('controller' => 'Messages', 'action' =>'messages'),
	'rateuser' => array('controller' => 'Rating', 'action' =>'rateuser'),
	'404' => array('controller' => 'NotFound', 'action' =>'notFound'),

);