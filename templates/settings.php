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
*/

?>
<div class="wrap">
    <h2>Instagallery</h2>
    <form method="post" action="options.php"> 
        <?php @settings_fields('Instagallery-group'); ?>
        <?php @do_settings_fields('Instagallery-group'); ?>

        <?php do_settings_sections('Instagallery'); ?>

        <?php @submit_button(); ?>
    </form>
</div>