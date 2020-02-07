<?php
$api = 'http://localhost:3000'; 
// change to 'https://daisywheel.herokuapp.com'
$api_url = "$api/front/magazines";
$curl = curl_init($api_url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, [
  'Content-Type: application/json'
]);
$response = curl_exec($curl);
curl_close($curl);

$zine = json_decode($response);
$colors = $zine->configuration->colors;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="article.css">
    <title><?php echo $zine->configuration->title ?></title>
</head>
<body>
    <div class="menuframe">
        <div class="burgermenu">
            <div class="menuBurger">
                <div>
                    <img class="burgerButton" src="images/hamburger.svg">
                </div>
                <div>
                    <img class="arrow" src="images/arrow.svg">
                </div>
            </div>

<?php 
if (isset($zine->menu->sections[0])) {
  echo "<div class='submenu'><h3>Sections</h3>";
  foreach ($zine->menu->sections as $section) { 
    $link = "<a href='index.php?section=$section->url'>$section->title</a>"; 
    echo $link;
  }
  echo "</div>";
}
if (isset($zine->menu->pages[0])) {
  echo "<div class='additionalMenu'><h3>Information</h3>";
  foreach ($zine->menu->pages as $page) { 
    $link = "<a href='index.php?article=$page->url'>$page->title</a>"; 
    echo $link;
  }
  echo "</div>";
}
?>
            <div class="extraMenu">
                <a href="index.php">Home</a>
                <a href="index.php">Contact</a>
            </div>
        </div>
    </div>
    <div class="container">
        <header class="grid">
            <div class="logo">
                <img class="mobileBurger" src="images/hamburger.svg">
                <span class="logoClick"><?php echo $zine->configuration->title ?></span>
            </div>
            <div class="subtitle"><?php echo $zine->configuration->description ?></div>
            <div class="menu">
                <div class="hamburger"><img class="mainBurger" src="images/hamburger.svg"></div>
                <div class="menuItems">
<?php 
foreach ($zine->menu->pages as $page) { 
    $link = "<div><a href='index.php?article=$page->url'>$page->title</a></div>"; 
    echo $link;
}
?>
                </div>
            </div>
        </header>

<?php

if (isset($_GET['article'])) {
  $article_id = $_GET['article'];
  include 'article.php';
} elseif (isset($_GET['section'])) {
  $section_id = $_GET['section'];
  include 'section.php';
} else {
  include 'front.php';
}

?>

</main>
        
        <footer class="grid">
            <section class="footerContent">
                <div class="iterationInfo">
                    <span>faucibus vitae:</span><br>
                    666 Broadway<br>
                    Brooklyn NY 11221<br>
                </div>
                <div class="connect">
                    <div class="input">
                        <input name="email" type="text" required autocomplete="off" />
                        <label for="email">
                            <div class="signup">Get updates via email</div>
                            <div><img class="icon" src="images/mail icon.png"></div>
                        </label>
                    </div>
                    <div>
                        <img src="images/fb white.png">
                        <img src="images/instagramwhite.png">
                        <img src="images/twitterwhite.png">
                        <img src="images/tiktokwhite.png">
                    </div>
                </div>
                <div class="footerBottom">
                    <div class="bottomLogo">
                      Moda Reader View<br>
                      <span>powered by <a href="http://github.com/jeremyrrose/daisywheel" target="_blank">Daisywheel CMS</a></span>
                      </div>
                    <div>&copy; 2020 <?php echo $zine->configuration->title ?></div>
                </div>
            </section>
        </footer>
    </div>
    
    <script src="main.js"></script>    
</body>
</html>
