<?php
$api_url = 'https://daisywheel.herokuapp.com/front/magazines';
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
            <div class="submenu">
<?php 
foreach ($zine->menu->sections as $section) { 
    $link = "<a href='index.php?section=$section->url'>$section->title</a>"; 
    echo $link;
}
?>
                <a href="category.html">Pulvinar</a>
                <a href="category.html">Quisque</a>
                <a href="category.html" class="subcat">Consequat</a>
                <a href="category.html" class="subcat">Scelerisque</a>
                <a href="category.html">Eget Lorem</a>
                <a href="category.html" class="subcat">Posuere</a>
                <a href="category.html" class="subcat">Morbi</a>
                <a href="category.html" class="subcat">Tincidunt</a>
            </div>
            <div class="additionalMenu">
<?php 
foreach ($zine->menu->pages as $page) { 
    $link = "<a href='index.php?article=$page->id'>$page->title</a>"; 
    echo $link;
}
?>
                <a href="article.html">Ipsum Dolor</a>
                <a href="article.html">Matrenum</a>
                <a href="article.html">Ullamcorper</a>
                <a href="article.html">Lectus</a>
            </div>
            <div class="extraMenu">
                <a href="index.php">Home</a>
                <a href="index.php">Contact</a>
            </div>
            <div class="chillSidebar">
                Feugiat:<br>
                Phasellus morbi dapibus nisi urna, at iaculis elit maximus placerat. Donec sed semper ligula.
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
    $link = "<div><a href='index.php?article=$page->id'>$page->title</a></div>"; 
    echo $link;
}
?>
                    <div><a href="category.html">Labore</a></div>
                    <div><a href="category.html">Mentum</a></div>
                    <div><a href="category.html">Lacus</a></div>
                    <div><a href="category.html">Ultrices</a></div>
                </div>
            </div>
        </header>

        <main>

<?php

$sections = $zine->sections;
foreach ($sections as $key => $section) {
    if ($section->type == "feature" && $section->title == "Top Stories") {
        for ( $i = 0; $i < 3; $i++ ) {
            if (isset($section->articles[$i])) {
                $article = $section->articles[$i];
                $author = "STAFF";
                if (isset($article->author)) {
                    $author = strtoupper($article->author->name);
                }
                if ($i % 3 == 0) {
                    $color = "teal";
                } elseif ($i % 3 == 1) {
                    $color = "yellow";
                } else {
                    $color = "pink";
                }
                if ( $i % 2 == 0 ) {
                    echo <<<FEATURE
                        <section class="homebar grid">
                            <div class="spacer purple"></div>
                            <div class="category">$author // $article->created_at</div>
                            <div class="photo right" style="background-image: url('$article->image_url');"></div>
                            <div class="spacer $color"></div>
                            <div class="title left $color"><a href="index.php?article=$article->id">$article->title</a></div>
                        </section>
FEATURE;
                } else {
                    echo <<<FEATURE
                        <section class="homebar grid">
                            <div class="photo left" style="background-image: url('$article->image_url');"></div>
                            <div class="category">$author // $article->created_at</div>
                            <div class="spacer purple"></div>
                            <div class="title right $color"><a href="index.php?article=$article->id">$article->title</a></div>
                            <div class="spacer $color"></div>
                        </section>
FEATURE;
                }
            }
        }
    } elseif ($section->type == "feature") {
        echo <<<FEATURE_HEAD
            <section class="moreArticles bigList">
                <div class="spacer purple"></div>
                <div class="more purple">$section->title</div>
                <div class="spacer purple"></div>
FEATURE_HEAD;
        for ( $i = 0; $i < count($section->articles); $i++ ) {
            $article = $section->articles[$i];
            if ($i % 3 == 0) {
                $color = "yellow";
            } elseif ($i % 3 == 1) {
                $color = "teal";
            } else {
                $color = "pink";
            }

            if ($article->author == null) {
                $author = "Staff";
            } else {
                $author = $article->author->name;
            }
            echo <<<FEATURE_ARTICLE
                <div class="gap pink"></div>
                <div class="gap"></div>
                <div class="spacer"></div>
                <div class="moreImage $color" style="background-image: url('$article->image_url')"></div>
                <div class="moreInfo $color">
                    <a href="index.php?article=$article->id">$article->title</a>
                    <p>$article->dek</p>
                    <div class="moreByline">
                        <div>:: $author</div>
                        <div>$article->updated_at</div>
                    </div>
                </div>
                <div class="spacer"></div>
                <div class="gap"></div>
FEATURE_ARTICLE;
        }
    } else {
        echo <<<LIST_HEAD
            <div class="list">
            <div class="listTitle"><h3>$section->title</h3></div>
LIST_HEAD;

        for ( $i = 0; $i < count($section->articles); $i++ ) {
            $article = $section->articles[$i];
            if ($article->author == null) {
                $author = "Staff";
            } else {
                $author = $article->author->name;
            }
            echo <<<LIST_ARTICLE
            <div class='listArticle'>
            <a href='index.php?article=$article->id'>$article->title</a>
            <p class='listDek'>$article->dek</p>
            <p class='listByline'>$author :: $article->created_at</p>
            </div>
LIST_ARTICLE;
        }
        echo "</div>";         
    }
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
                    <div class="bottomLogo">Mo<img src="images/DWhite.svg">A</div>
                    <div>&copy; 2020 pellentesque nec nam aliquam</div>
                </div>
            </section>
        </footer>
    </div>
    
    <script src="main.js"></script>    
</body>
</html>