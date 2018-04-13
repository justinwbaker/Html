<ul>
    <?php
        $PathToPHP = "../";

        if(strcmp($currentPage, 'Home') == 0) {
            $PathToPHP = "php/";
        }

        $urls = array(
            'Home' => '/Ouroboros/index.php',
            'Profile' => $PathToPHP . 'pages/profile.php',
            'Games' => $PathToPHP .'pages/games.php'
            // …
        );
        echo "<br>";
        if(isset($_SESSION['admin']) == "admin") {
            $urls["Games"] = $PathToPHP . "pages/games-admin.php";
        }

        $urls['Login'] = $PathToPHP . "pages/login.php";
        $urls['Register'] = $PathToPHP . "pages/register.php";
        $urls['Logout'] = $PathToPHP . "user/logout.php";

        echo "<li><a class=\"title\"\">Menu</a><li/><br><br>";

        if(isset($_SESSION['username'])){

            foreach ($urls as $name => $url) {
                $item = "<li> <a ";
                if(strcmp($currentPage, $name) == 0) {
                    $item.= "class=\"active\" ";
                }
                $item .= "href=\"" . $url . "\">" . $name . "</a></li>";
                if($name == "Login" || $name == "Register") continue;
                if(strcmp($name, "Logout") == 0) echo "<div class=\"bottomSpacing\">";
                echo $item;
                if(strcmp($name, "Logout") == 0) echo "<div>";
            }

        }else {
            foreach ($urls as $name => $url) {
                $item = "<li> <a ";
                if(strcmp($currentPage, $name) == 0) {
                    $item.= "class=\"active\" ";
                }
                $item .= "href=\"" . $url . "\">" . $name . "</a></li>";
                if($name == "Login" || $name == "Register")
                    echo $item;
            }
        }
    ?>
</ul>

