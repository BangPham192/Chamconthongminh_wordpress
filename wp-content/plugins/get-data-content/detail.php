<?php
include_once('crawl.php');

    function getNew($link, $key) {

    $H_Crawl = new H_Crawl();
    // xoa het cac the javascript va nhung the co class=".thumblock" di
    $H_Crawl->arr_att_clean  = array('script','.thumblock');
    
    // lay title bai viet
    $title = $H_Crawl->getTitle($link, 'div h1');
    
    // lay noi dung bai viet
    $content = $H_Crawl->getContent($link, 'div.article-details-content');
    // xoa het cac link trong phan noi dung di
    if($content != NULL) {
        $content = $H_Crawl->removeLink($content);
    }
    

    }