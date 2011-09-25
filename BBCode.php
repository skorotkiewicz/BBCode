<?php
/*
 *      bbcode.php
 *      
 *      Copyright 2011 Sebastian Korotkiewicz <mod@itunix.eu>
 *      
 *      This program is free software; you can redistribute it and/or modify
 *      it under the terms of the GNU General Public License as published by
 *      the Free Software Foundation; either version 2 of the License, or
 *      (at your option) any later version.
 *      
 *      This program is distributed in the hope that it will be useful,
 *      but WITHOUT ANY WARRANTY; without even the implied warranty of
 *      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *      GNU General Public License for more details.
 *      
 *      You should have received a copy of the GNU General Public License
 *      along with this program; if not, write to the Free Software
 *      Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 *      MA 02110-1301, USA.
 */


	

	function BBCode($text) {

	/* Config */
	$imagesAlt  = true;
	$youImgDesc = 'http://example.com/';
	/* End Config */


		/*
		 * Block HTML
		 * */

		$text = htmlspecialchars($text, ENT_QUOTES);


		/*
		 * format
		 * 
		 * [b]example[/b]
		 * <strong>example</strong>
		 * */
		
		$text=str_replace("[b]", "<strong>", $text);
		$text=str_replace("[/b]", "</strong>", $text);
		
		$text=str_replace("[u]", "<u>", $text);
		$text=str_replace("[/u]", "</u>", $text);
		
		$text=str_replace("[i]", "<i>", $text);
		$text=str_replace("[/i]", "</i>", $text);
		
		$text=str_replace("[s]", "<s>", $text);
		$text=str_replace("[/s]", "</s>", $text);

		/*
		 * images
		 * 
		 * [img]http://http://example.com/images.png[/img]
		 * <img src="http://example.com/images.png" />
		 * */
		$text=str_replace("[img]", "<img src='", $text);
		if ($imagesAlt) {
			$text=str_replace("[/img]", "' alt='$youImgDesc' />", $text);
		} else {
			$text=str_replace("[/img]", "' />", $text);
		}

		/*
		 * color
		 * 
		 * [color=ff0000]aaa[/color]
		 * <a style="color: #ff0000">aaa</a>
		 * */
		preg_match('/\[color=(.*)\](.*)\[\/color\]/', $text, $color2);
		$colors 	= $color2[1];
		$textColor	= $color2[2];

		$text=str_replace('[color='.$colors.']'.$textColor.'[/color]', '<a style="color: #'.$colors.';" />'.$textColor.'</a>', $text);


		/*
		 * url to link
		 * 
		 * [a]url[/a]
		 * <a href="url">aaa</a>
		 * */

		preg_match('/\[a\](.*)\[\/a\]/', $text, $url);
		$urla 	= $url[1];

		$text=str_replace('[a]'.$urla.'[/a]', '<a href="'.$urla.'">'.$urla.'</a>', $text);
		//$text=str_replace('[a]'.$urla.'[/a]', '<a href="'.$urla.'">[LINK]</a>', $text);


		/*
		 * image with href
		 * 
		 * [a=url]urlImage[/a]
		 * <a href="url"><img src="urlImage" /></a>
		 * */
		preg_match('/\[a=(.*)\](.*)\[\/a\]/', $text, $urls);
		$aUrl 	= $urls[1];
		$imgUrl	= $urls[2];

		if ($imagesAlt) {
			$text=str_replace('[a='.$aUrl.']'.$imgUrl.'[/a]', '<a href="'.$aUrl.'"><img src="'.$imgUrl.'" alt="'.$youImgDesc.'" /></a>', $text);
		} else {
			$text=str_replace('[a='.$aUrl.']'.$imgUrl.'[/a]', '<a href="'.$aUrl.'"><img src="'.$imgUrl.'" /></a>', $text);
		}


		/*
		 * Emoticons
		 * 
		 * ":)" > "<img src="http://example.com/emoticons/smile.png" />"
		 * */

		$text=str_replace(':)', '<img src="http://example.com/emoticons/smile1.png" />', $text);
		$text=str_replace(':D', '<img src="http://example.com/emoticons/smile2.png" />', $text);
		$text=str_replace(':P', '<img src="http://example.com/emoticons/smile3.png" />', $text);
		$text=str_replace(':(', '<img src="http://example.com/emoticons/smile4.png" />', $text);
	//	$text=str_replace(':F', '<img src="http://example.com/emoticons/smile5.png" alt="'.$youImgDesc.'" />', $text);
		// ...


		return $text;
		}



// example

echo BBCode("
[b]test[/b]  \n 
[img]http://example.com/images.png[/img] \n 
[color=23456] 12132132 [/color] \n
[a]http://google.pl[/a] \n
[a=http://example.com/]http://example.com/images.png[/a] \n
:D :P :) \n
");




?>

