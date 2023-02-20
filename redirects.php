<?php
if ($_SERVER['HTTP_HOST'] == "www.kingfish.by") {
    $_SERVER['HTTP_HOST'] = "kingfish.by";
    header('Location: https//'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], true, 301);
    exit();
}
if ($_SERVER['REQUEST_URI'] != strtolower($_SERVER['REQUEST_URI'])) {
    if (!file_exists($_SERVER['REQUEST_URI'])){
        header('Location: https/'.$_SERVER['HTTP_HOST'] . strtolower($_SERVER['REQUEST_URI']), true, 301);
        exit();
    }
}
if ($_SERVER['REQUEST_URI']){
    $_SERVER['REQUEST_URI'] = str_replace('/index.php', '/', $_SERVER['REQUEST_URI']);
    $_SERVER['REQUEST_URI'] = str_replace('/index.html', '/', $_SERVER['REQUEST_URI']);
    while (strpos($_SERVER['REQUEST_URI'], '//') !== false) {
        $_SERVER['REQUEST_URI'] = str_replace('//', '/', $_SERVER['REQUEST_URI']);
    }
    header('Location: https//'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], true, 301);
    exit();
}
