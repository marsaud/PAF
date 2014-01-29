<?php
require_once '../../bootstrap.php';

$node0 = new PAF_View_Component_TreeNode('NODE 0');
$node1 = new PAF_View_Component_TreeNode('NODE 1');
$node2 = new PAF_View_Component_TreeNode('NODE 2');
$node3 = new PAF_View_Component_TreeNode('NODE 3');
$node4 = new PAF_View_Component_TreeNode('NODE 4');
$node5 = new PAF_View_Component_TreeNode('NODE 5');
$node6 = new PAF_View_Component_TreeNode('NODE 6');
$node7 = new PAF_View_Component_TreeNode('NODE 7');
$node8 = new PAF_View_Component_TreeNode('NODE 8');
$node9 = new PAF_View_Component_TreeNode('NODE 9');

$node0->add($node1->add($node2));
$node1->add($node3);
$node0->add($node4->add($node5));
$node4->add($node6);
$node7->add($node8->add($node9));
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link type="text/css" rel="stylesheet" media="screen" href="http://localhost/bootstrap-3.0.0-dist/dist/css/bootstrap.min.css"/>
        <style type="text/css">
            .childnodes {
                padding-left: 5px;
                margin-left: 40px;
                border-left: 1px lightgrey solid;
            }
        </style>
        <title></title>
    </head>
    <body>
        <?php
        $node0->render();
        $node7->render();
        ?>
        <script src="http://localhost/jquery.js"></script>
        <script type="text/javascript" src="http://localhost/bootstrap-3.0.0-dist/dist/js/bootstrap.min.js"></script>
    </body>
</html>
