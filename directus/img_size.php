<?php
list($width, $height, $type, $attr)= getimagesize('media/thumbnails/0386_2007_portrait.jpg?w=100&h=100&c=false'); 
echo "Image width " .$width;
echo "<BR>";
echo "Image height " .$height;
echo "<BR>";
echo "Image type " .$type;
echo "<BR>";
echo "Attribute " .$attr;

?>