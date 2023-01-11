<?php

use Bitrix\Main\Loader;

/**
 * @param $url - YouTube video-URL
 * @return array URL-templates, preview picture, video-id
 */

function buildCurrentURLClear() {
    $curPage = $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    $curPage = explode('?', $curPage);
    $curPage = $curPage[0];
    return $curPage;
}

function buildCanonicalURL() {
    $curPage = $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    $arPos_trim = [];
    $arPos_replace = [];
    $arPos_trim[] = strpos($curPage, "filter/");
    $arPos_replace[] = "sort";
    $arPos_replace[] = "order";
    $arPos_replace[] = "view";
    foreach ($arPos_trim as $pos_filter) {
        if ($pos_filter) $curPage = substr($curPage, 0, $pos_filter);
    }
    $curPage = explode('?', $curPage);
    $curPage = $curPage[0];
//    foreach ($arPos_replace as $pos_filter) {
//        if (isset($_GET[$pos_filter]) && $pos_filter != false) {
//            if (count($_GET) > 1) {
//                $curPage = str_replace($pos_filter . "=" . $_GET[$pos_filter] . "&", "", $curPage);
//                $curPage = str_replace($pos_filter . "=" . $_GET[$pos_filter], "", $curPage);
//            } else {
//                $curPage = str_replace("?". $pos_filter . "=" . $_GET[$pos_filter], "", $curPage);
//            }
//        }
//    }
    if ($curPage{strlen($curPage) - 1} == "?") {
        $curPage = substr($curPage, 0, strlen($curPage) - 1);
    }

    if (!empty($_GET))
        foreach ($_GET as $key => $value)
            if (gettype(strpos($key, "PAGEN_")) == "integer")
                if ($value != 1 && $value) {
                    if (!$first_symbol) $first_symbol = "?"; else $first_symbol = "&";
                    $curPage .= $first_symbol . $key . "=" . $value;
                    break;
                }
    unset($first_symbol);
    $curPage = str_replace("index.php", "", $curPage);
    return $curPage;
}

function pagenTitle() {
    if (!empty($_GET))
        foreach ($_GET as $key => $value)
            if (gettype(strpos($key, "PAGEN_")) == "integer")
                if ($value != 1) {
                    return (" - страница " . $value);
                }
}

function SEOExceptionPage() {
    $url = $_SERVER["DOCUMENT_ROOT"] . "/include/SEO/SEOExceptions.txt";
    $handle = @fopen($url, "r");
    if ($handle == false) {
        return;
    }
    $curPage = buildCurrentURLClear();
    while (($string = fgets($handle, 4096)) !== false) {
        $string = str_replace(array("\r","\n"),"", $string);
        if ($string == $curPage) {
            return true;
        }
    }
    return false;
}

function EchoCanonicalRobots() {
    if (SEOExceptionPage() == true) {
        echo('<meta name="robots" content="noindex,nofollow">');
    } else {
        echo('<link rel="canonical" href="' . buildCanonicalURL() . '">');
    }
}