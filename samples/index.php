<?php
require_once realpath('../library/PAF/View/Component/TreeNode.php');

function prepareUrl($path)
{
    $url = preg_replace('/^.*samples/', 'http://' . $_SERVER['HTTP_HOST'], $path);
    $unixUrl = str_replace('\\', '/', $url);
    return $unixUrl;
}

/**
 * 
 * @param string $dirPath
 * 
 * @return PAF_View_Component_TreeNode|null
 */
function browseDirectory($dirPath)
{
    if (is_dir($dirPath) && !in_array(basename($dirPath), array('.', '..')))
    {
        $dirNode = new PAF_View_Component_TreeNode(basename($dirPath));
        $directory = opendir(realpath($dirPath));
        while (false !== ($subDirName = readdir($directory)))
        {
            $subNode = browseDirectory($dirPath . DIRECTORY_SEPARATOR . $subDirName);
            if (NULL !== $subNode)
            {
                $dirNode->add($subNode);
            }
        }
        closedir($directory);
    }
    elseif (is_file($dirPath) && ('.php' === substr(basename($dirPath), -4)) && !in_array(basename($dirPath), array('bootstrap.php', 'index.php')))
    {
        $dirNode = new PAF_View_Component_TreeNode('<a href="' . prepareUrl($dirPath) . '">' . basename($dirPath) . '</a>');
    }
    else
    {
        $dirNode = NULL;
    }

    return $dirNode;
}

$topNode = browseDirectory(realpath('.'));
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
        <title>PAF Samples</title>
    </head>
    <body>
        <?php
        foreach ($topNode as $node)
        {
            $node->render();
        }
        ?>
        <script src="http://localhost/jquery.js"></script>
        <script type="text/javascript" src="http://localhost/bootstrap-3.0.0-dist/dist/js/bootstrap.min.js"></script>
    </body>
</html>