<?php
    /**
     * Plugin Name: Get Data Content
     * Plugin URI: http://hocwp.net // Địa chỉ trang chủ của plugin
     * Description: Đây là plugin đầu tiên mà tôi viết dành riêng cho WordPress, chỉ để học tập mà thôi.
     * Version: 1.0
     * Author: Bang Pham
     * Author URI: 
     * License: GPLv2
     */
    include_once("simple_html_dom.php");
    include_once('detail.php');
 
    // $link = 'https://www.marrybaby.vn';
    
    // $H_Crawl = new H_Crawl();
    // // xoa het cac the javascript va nhung the co class=".thumblock" di
    // $H_Crawl->arr_att_clean  = array('script','.thumblock');
    
    // // lay title bai viet
    // $title = $H_Crawl->getTitle($link, 'div h1');
    
    // // lay noi dung bai viet
    // $content = $H_Crawl->getTitle($link, 'div.article-details-content');
    
    // // xoa het cac link trong phan noi dung di
    // $content = $H_Crawl->removeLink($content);
    
    // var_dump($title);
    // die
    // var_dump($content);

    function register_mysettings() {
        register_setting( 'mfpd-settings-group', 'mfpd_option_name' );
    }
    
    function mfpd_create_menu() {
            add_menu_page('My First Plugin Settings', 'MFPD Settings', 'administrator', __FILE__, 'mfpd_settings_page',plugins_url('/images/icon.png', __FILE__), 1);
            add_action( 'admin_init', 'register_mysettings' );
    }
    add_action('admin_menu', 'mfpd_create_menu'); 

    function mfpd_settings_page() {
        $html = file_get_html('https://www.marrybaby.vn');
        // $url = $html->find('a');
        foreach ($html->find('a') as $key => $element) {
            if (strrpos($element->href, 'https://www.marrybaby.vn/benh-tre-em/11-chieu-hay-giup-me-ha-sot-nhanh-cho-tre') !== false) {
                // var_dump($element->href);
                // echo $element->href . '<br>';
                getNew($element->href, $key);
            }
            // die;
            // getNew($element->href, $key);
        }
    }
    