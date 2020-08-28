<html>
<head>
    <title>Dir View</title>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
</head>
<body>

<?php
$indent = "----";
function getDirContents($dir, &$tree) {
    echo "$dir";
    $files = scandir($dir);
    foreach ($files as $key => $value) {
        $path = $dir . DIRECTORY_SEPARATOR . $value;
        if (!is_dir($path)) {
            if (pathinfo($value)['extension']=="html") {
                $tree[] = $value;
            }
        } else if ($value[0] != ".") {
            $tree[$value] = array();
            getDirContents($path, $tree[$value]);
        }
    }
    return $tree;
}
function printTree($tree, $depth=0){
    global $indent;
    foreach($tree as $key => $value) {
        if (is_array($value)){
            echo str_repeat($indent, $depth) . "$key \n";
            printTree($value, $depth+1);
        } else {
            echo str_repeat($indent, $depth) . "$value\n";
        }
    }
}

$tree = array();
getDirContents('.', $tree);
printTree($tree);

?>

<script>
    $(".childshow").click(function (e) {
        e.stopPropagation();
        jQuery(this).children('.childshow').toggle();
    });
</script>
</body>
</htmll>
