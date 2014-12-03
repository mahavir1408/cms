<?php
if(isset($doctype)) {
    echo $doctype;
}
?>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
<?php
if(isset($title)) {
    echo $title;
}
if(isset($meta)) {
    foreach($meta as $meta_tag) {
        echo $meta_tag.PHP_EOL;
    }
}
if(isset($css_tags)) {
    foreach($css_tags as $css_tag) {
        echo $css_tag.PHP_EOL;
    }
}
if(isset($js_tag)) {
    echo $js_tag.PHP_EOL;
}
if(isset($misc_head)) {
    echo $misc_head.PHP_EOL;
}
?>    
</head>
<!--HEADER ENDS HERE -->