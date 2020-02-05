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
                <div class="gap"></div>
                <div class="gap"></div>
                <div class="spacer"></div>
                <div class="moreImage $color" style="background-image: url('$article->image_url')"></div>
                <div class="moreInfo $color">
                    <a href="index.php?article=$article->id">$article->title</a>
                    <p>$article->dek</p>
                    <div class="moreByline">
                        <div>:: $author</div>
                        <div>$article->created_at</div>
                    </div>
                </div>
                <div class="spacer"></div>
                <div class="gap"></div>
FEATURE_ARTICLE;
        }
    } else {
        echo <<<LIST_HEAD
            <section class="moreArticles list">
                <div class="spacer purple"></div>
                <div class="more purple">$section->title</div>
                <div class="spacer purple"></div>
                <div class="smallArticles">
LIST_HEAD;
        $article_count = count($section->articles);
        for ( $i = 0; $i < $article_count; $i++ ) {
            $article = $section->articles[$i];
            if ($article->author == null) {
                $author = "Staff";
            } else {
                $author = $article->author->name;
            }
            if ( $i == 0 ) {
                echo "<div>";
            }
            if ( $i == round($article_count / 2) ) {
                echo "</div><div>";
            }
            echo <<<LIST_ARTICLE
            <div class='listArticle'>
            <a href='index.php?article=$article->id'>$article->title</a>
            <p class='listDek'>$article->dek</p>
            <p class='listByline'>$author :: $article->created_at</p>
            </div>
LIST_ARTICLE;
        }
        echo "</div></div></section>";         
    }
}
?>