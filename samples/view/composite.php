<?php

require_once '../bootstrap.php';

$composite = new PAF_View_Composite('template2.phtml');
$composite->title = 'Composite sample';

$menu = new PAF_View_String('<ul><li><a href="#">One</a></li><li><a href="#">Two</a></li><li><a href="#">Three</a></li></ul>');
$composite->addComponent('menu', $menu);

$content = new PAF_View_Template('template3.phtml');
$content->h1 = 'Welcome to the composite sample';
$content->h2a = 'Let\'s talk about the components';
$content->pa = 'The 3 link menu on top of page is a PAF_View_String object rendered. The content of the page is the rendering of a PAF_View_Template object.';
$content->h2b = 'The composite view';
$content->pb = 'In this exemple, the PAF_View_Composite object renders the whole page with it\'s own template for the main html/body skeleton, and renders the menu and content components in the chosen places in the template.';

$composite->addComponent('content', $content);

$composite->render();
