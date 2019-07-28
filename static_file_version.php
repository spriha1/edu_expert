<?php
function autoVer($url)
{
	$path = pathinfo($url); 
	// $path = array(
	// 	'dirname' => '/scripts',
	// 	'basename' => 'test.js',
	// 	'ext' => 'js'
	// )

    $ver = '.'.filemtime($_SERVER['DOCUMENT_ROOT'].$url).'.';
    //
    echo $path['dirname'].'/'.str_replace('.', $ver, $path['basename']);
}
?>