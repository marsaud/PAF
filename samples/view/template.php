<?php

require_once '../bootstrap.php';

$template = new PAF_View_Template('template1.phtml');

$template->title = 'Template sample';
$template->h1 = 'Welcome to the template sample';
$template->h2a = 'Let\'s talk about the template';
$template->pa = 'The template defines the html structure of the page (doctype, titles, paragraphs, ...).';
$template->h2b = 'The data';
$template->pb = 'The information written on this page has been passed to the PAF_View_Template object as pure text. The object dispatches the text in the places chosen in the template.';

$template->render();
