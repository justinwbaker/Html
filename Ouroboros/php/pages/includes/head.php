<title><?php 
        session_start();echo($title); ?></title>
<meta name="description" value="<?php echo($metaTags); ?>"><!-- note that this code is wrong -->
<link rel="stylesheet" type="text/css" href=
	<?php
		if(strcmp($currentPage, 'Home') == 0) {
            echo "\"css/main.css\"";
        }else {
			echo "\"../../css/main.css\"";
        }
	?>
><!--"css/main.css" -->