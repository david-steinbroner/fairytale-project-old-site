<footer>
<?php
$page_content = get_page_content(3);
while($row = mysql_fetch_array($page_content))
  {
	echo "<div id='footer_ch'>" . $row['content_ch'] . "</div>";
	echo "<div id='footer_en'>" . $row['content_en'] . "</div>";
	echo "<div id='footer_de'>" . $row['content_de'] . "</div>";
}
?>

</footer>


<script>
$(document).ready(function() {
            $('.fancybox').fancybox({
            'width'         : 1000,
            'height'         : 600,
            'type' : 'iframe',
            });
            

        });
        
</script>
</body>

</html>
<?php
//Step 5. Close connection
if (isset($connection)) {
mysql_close($connection);
}
?>
