</body>
<body>
   <script>
        $(document).ready(function() {
            $('.fancybox').fancybox({
            'width'         : 1000
            });
            
        });
    </script>

</html>
<?php
//Step 5. Close connection
if (isset($connection)) {
mysql_close($connection);
}
?>
