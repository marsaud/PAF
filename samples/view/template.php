<?php

require_once '../bootstrap.php';

$template = new PAF_View_Template('template1.phtml');

$template->title = 'Template sample';
$template->h1 = 'Welcome to the template sample';
$template->h2a = 'Let\'s start !';
$template->pa = 'This is a first piece of content.';
$template->h2b = 'Let\'s continue !';
$template->pb = 'This next piece will be the last.';

$template->render();
