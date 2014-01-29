<?php

require_once '../bootstrap.php';

$view = new PAF_View_Composite('template1.phtml');
$view->title = 'Form sample';

$form = new PAF_Form_Base(PAF_Form_Base::NO_ELEMENTS, 'template2.phtml');

$form->addElement('login', new PAF_Validator_NotEmptyString());
$form->addElement('password', new PAF_Validator_NotEmptyString());

if (!empty($_POST))
{
    if ($form->process($_POST))
    {
        $view->message = 'All fields are valid. Your login is "' . $form->data->login . '". I\'ll keep your password secret ;).';
    }
    else
    {
        $view->message = 'Some fields are invalid.';
    }
}
else
{
    $view->message = 'Please, provide information.';
}

$view->addComponent('form', $form);
$view->render();
