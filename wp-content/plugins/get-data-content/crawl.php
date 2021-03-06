<?php
 
class H_Crawl{
 
    var $html_content = '';
    var $arr_att_clean = array();
 
    function H_Crawl(){
        // nothing to do
    }
 
    // function lay title cua bai viet
    function getTitle($link, $att_title){
        if($this->html_content==''){
            $html = file_get_html($link);
            $this->html_content = $html;
        }else{
            $html = $this->html_content;
        }
 
        foreach($html->find($att_title) as $e){
            $title = $e->innertext;
        }
        return $title;
    }
 
    // function lay noi dung cua mot bai viet
    function  getContent($link, $att_content){
        if($this->html_content==''){
            $html = file_get_html($link);
            $this->html_content = $html;
        }else{
            $html = $this->html_content;
        }
 
        foreach($html->find($att_content) as $e){
            $content_html = $e->innertext;
        }
        $html = str_get_html($content_html);
 
        foreach($this->arr_att_clean as $att_clean){
            // google+
            foreach($html->find($att_clean) as $e){
                $e->outertext = '';
            }
        }
 
        $ret = $html->save();
        return $ret;
    }
 
    // function remove het cac lien ket trong mot chuoi html truyen vao
    function removeLink($content){
        $html = str_get_html($content);
        // link content
        foreach($html->find('a') as $e){
            $e->outertext = $e->innertext;
        }
        $ret = $html->save();
        return $ret;
    }
 
    // function xoa phan tu html cuoi cung
    function removeLastElement($content, $element){
        $html = str_get_html($content);
        // link content
        $html->find($element, -1)->outertext = '';
        $ret = $html->save();
        return $ret;
    }
 
    // function xoa phan tu html truyen vao dau tien
    function removeFirstElement($content, $element){
        $html = str_get_html($content);
        $html->find($element, 0)->outertext = '';
        $ret = $html->save();
        return $ret;
    }
 
}
