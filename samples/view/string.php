<?php

require_once '../bootstrap.php';

$view = new PAF_View_String('<h1>A usage of view</h1><p>With PAF_View_String</p>');
$view->prepend('<!DOCTYPE html><html><body>');
$view->append('</body></html>');

$view->render();

