<html>
<head>
    <title>Dir View</title>
    <style>
        body{
            margin: 0;
            padding: 0;
        }
        .container{
            display: flex;
            flex-direction: row;
            height: 100%;
        }
        .browse{
            overflow: scroll;
            max-width: 20%;
            flex-grow: 1;
            flex-shrink: 2;
        }
        .preview{
            overflow: scroll;
            background: #a0a0a0;
            width: auto;
            flex-grow: 2;
            flex-shrink: 1;
        }
        .dir{
        }
        .file{

        }
        .dir-a{
            background-color: #dbdbdb;
        }
        .file-a{
            background-color: #f0f0f0;
        }
        .entry{
            display: block;
            padding: 10px;
            margin: 1px;
            white-space: nowrap;
        }
        .dir-contents{
            display: flex;
            flex-direction: column;
        }
    </style>
</head>
<body>
<div class="container">
<div class="browse">
<div style="width:100%;display:table;">
<?php
$base_url = "http://localhost:9090/";
$indent = "&nbsp;&nbsp;&nbsp;&nbsp;";
function getDirContents($dir, &$tree) {
    $files = scandir($dir);
    foreach ($files as $key => $value) {
        $path = $dir . DIRECTORY_SEPARATOR . $value;
        if (!is_dir($path)) {
            if (pathinfo($value)['extension']=="html") {
                $tree[] = $path;
            }
        } else if ($value[0] != ".") {
            $tree[$value] = array();
            $subtree = getDirContents($path, $tree[$value]);
            if (count($subtree)==0) {
                unset($tree[$value]);
            }
        }
    }
    return $tree;
}
function printTree($tree, $depth=0){
    global $indent;
    foreach($tree as $key => $value) {
        if (is_array($value)){
            echo "<div class=\"dir\"><a class=\"dir-a entry\">" . str_repeat($indent, $depth) . "&#128193; $key</a>\n";
            echo "<div class=\"dir-contents\" style=\"display: none;\">\n";
            printTree($value, $depth+1);
            echo "</div></div>\n";
        } else {
            $filename = pathinfo($value)['filename'];
            $url = $base_url . substr($value, 2);
            echo "<div class=\"file\"><a class=\"file-a entry\" name=\"$url\">" . str_repeat($indent, $depth) . "&#128196; $filename</a></div>\n";
        }
    }
}

$tree = array();
$tree = getDirContents('.', $tree);
printTree($tree);

?>
    </div>
</div>
<div class="preview">
    <div>
    <iframe style="width:100%; height:100%;" id="preview"></iframe>
    </div>
</div>
</div>
<script type="text/javascript">
    menus = function() {
        var dirContent = this.parentElement.querySelector(".dir-contents");
        console.log(dirContent);
        if (dirContent.style.display === "none") {
            dirContent.style.display = "block";
        } else {
            dirContent.style.display = "none";
        }
    };
    preview = function() {
        document.getElementById('preview').src = this.name;
    }
    var submenu = document.getElementsByClassName("dir-a");
    for (var i = 0; i < submenu.length; i++) {
        submenu[i].addEventListener('click', menus);
    }
    submenu = document.getElementsByClassName("file-a");
    for (var i = 0; i < submenu.length; i++) {
        submenu[i].addEventListener('click', preview);
    }
</script>
</body>
</html>
