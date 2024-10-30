<?php
/*
Instagallery is a wordpress plugin to show your last photos uploaded on instagram
Copyright (C) 2014  http://www.evilripper.net (email : gigarimini@gmail.com)

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.

Best experience with monospaced font! (
	       /\
	     /||;		
             ;||||;
           ;||||; |;
         ;|||||'   |;
        ;|||||;     ;.
       ,|||||'  O o  ;           1O1\
       ||||||;       ;          O101O1\
       ;|||||;       ;         0101O1O1\
      ,;||||||;     ;'         / O1O1O11\
    ;|||||||||`. ,,,;.        /  / 1O10O1\
  .';|||||||||||||||||;,     /  /     01O1\
 ,||||||;||||||;;;;||||;,   /  /        110\
;`||||||`'||||||;;;||||| ,#/  /          1O1|
|`|||||||`;||||||;;||| ;||#  /            1O1
||`|||||||`;|||||||| ;||||# /              11O
`|`|||||||`;|||||| ;||||||#/               1OO
 |||`|||||||`;; ;|||||||||##                11
 ||||`|||||||`;||||||||;|||#                OO
 `|||||`||||||||||||;'`|;||#                1
  `|||||`||||||||;' /  / `|#
   ||||||`|||||;'  /  /   `#
Reaper modded by www.evilripper.net (C) 2014
Power by scite, eclipse, aptana and php! 
 

thanks to:
http://stackoverflow.com/questions/17373886/how-can-i-get-a-users-media-from-instagram-without-authenticating-as-a-user

*/

class InstagalleryApi {

	var $maxPictureWidth = 0;
	var $showImageDivider = TRUE;
	var $showHeader = TRUE;
	var $MaxDisplayedImages = "5";

	var $ApiUrlUserInfo = "";
	var $ApiUrlUserRecentPhotos = "";
	//Application id --> http://instagram.com/developer/clients/manage/
	var $ClientId = "";
	//retrive userid from username
	//var $UserId = "";
	var $Username = "";

	

	function __construct($_clientId, $_username) {
		$this -> ClientId = $_clientId;
		$this -> Username = $_username;
	}

	function getUserId() {
		$this -> ApiUrlUserInfo = "https://api.instagram.com/v1/users/search?q=" . $this -> Username . "&client_id=" . $this -> ClientId;
		$content = @file_get_contents($this -> ApiUrlUserInfo);
		if ($content === FALSE) 
		{
			return "";
		}
		$jsonObj = json_decode($content );
		//print_r($jsonObj);
		//print_r($jsonObj->data);
		//print_r($jsonObj->data[0]->website);
		//print_r($jsonObj->data[0]->id);
		//print_r($jsonObj->data[0]->username);
		return $jsonObj -> data[0] -> id;
	}

	function getJsonLastPhotos() {

		$userId = $this -> getUserId();
		//$this->ApiUrlUserRecentPhotos = $userId;
		$this -> ApiUrlUserRecentPhotos = "https://api.instagram.com/v1/users/" . $userId . "/media/recent/?client_id=" . $this -> ClientId;
		$content = @file_get_contents($this -> ApiUrlUserRecentPhotos);
		
		if ($content === FALSE) 
		{
			return  json_decode("{}");
		}
		
		$jsonObj = json_decode($content);
		return $jsonObj;
		//print_r($jsonObj);
		/*$arr = $jsonObj->data;
		 foreach ($arr as &$value) {
		 //$value = $value * 2;
		 echo $value->created_time . "<br />";
		 echo urldecode($value->link) . "<br />";
		 echo $value->likes->count . "<br />";
		 echo "<img  class=\"imgBorder\" src=\"" . urldecode($value->images->standard_resolution->url) . "\" />";
		 }

		 unset($value); // break the reference with the last element
		 return "";
		 */
		//return $this->ApiUrlUserRecentPhotos;
	}

	function getHtmlGallery() {
		$jsonObj = $this -> getJsonLastPhotos();
		$arr = $jsonObj -> data;
		$htmlGallery = "<!-- Power by Instagallery plugin  -->";
		$counter = 1;
		
		if ($jsonObj -> data == "")
		{
			$htmlGallery = $htmlGallery . "<strong>[Instagallery]:</strong> Some errors to retrive data please check Client Id and Username. PHP function allow_url_fopen = On is required!";
			return  $htmlGallery;
		}
		
	
		if ($this -> maxPictureWidth > 0) {
			$imgStyle = 'style="width:' . $this -> maxPictureWidth . 'px;heigth:' . $this -> maxPictureWidth . '"';
		}

		$divider = "<div class='instagalleryHeader'><h1>Instagallery</h1><p>Recent Instagram photos of <a href='http://instagram.com/" . $this -> Username . "' >" . $this -> Username . "</a></p></div>";

		if (!$this -> showHeader) {
			$divider = "";
		}

		foreach ($arr as &$value) {
			
			$imageUrl = urldecode($value -> images -> standard_resolution -> url);

			$singleImage = $divider . '<div class="instagalleryImageContainer">' . '<img   class="instagalleryCaptioned" src="' . $imageUrl . '" alt=" " >' . '<p><a href="' . urldecode($value -> link) . '" target="_blank"> View on Instagram</a> <strong>Likes </strong> <span class="instagalleryHeart">♥</span> ' . $value -> likes -> count . '</p> ' . '</div>';

			$htmlGallery = $htmlGallery . $singleImage;
			//shit code pfffffffff
			$divider = '<div class="instagallerySeparator"> </div>';
			if (!$this -> showImageDivider) {
				$divider = "";
			}
			
			if ($counter == $this -> MaxDisplayedImages) {
				break;
			}
			
			$counter++;
		}
		unset($value);
		// break the reference with the last element
		return $htmlGallery; // . '<p><a href="http://wordpress.org/plugins/instagallery/" style="text-align:right;font-size:12px;color:#gray">Power by Instagallery</a></p>';
	}

}
?>