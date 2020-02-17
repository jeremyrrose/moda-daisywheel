<?php 
$api_url = "$api/front/articles/$article_id";
$curl = curl_init($api_url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, [
  'Content-Type: application/json'
]);
$response = curl_exec($curl);
curl_close($curl);

$article = json_decode($response);
$date_info = date_parse_from_format("Y-n-jT", $article->updated_at);
$image_url = json_decode($response)->image_url;
$author = (isset($article->author) ? $article->author : null);
$hero_class = isset($image_url) ? "" : " noHero";

echo <<<ARTICLE
<main class="article">
        <div class="hero$hero_class" style="background-image: url($image_url);">
            <div class="spacer pink"></div>
            <div class="issue pink">$article->section_title</div>
            <div class="spacer purple"></div>
            <div class="issue purple">$article->publication_date</div>
            <div class="articleTitle teal">$article->title</div>
            <div class="spacer teal"></div>
        </div>
        <section class="gap"></section>

        <section class="spacer"></section>
        <article>
            <section class="dek">
                $article->dek 
            </section>
            <section class="byline">
                <div>By <span>$author->name</span></div>
            </section>

            <div>$article->content</div>
ARTICLE;

if (isset($author)) {
    echo <<<AUTHOR
            <section class="author">
                <p>
                    <span>$author->name</span><br>
                    $author->bio
                </p>
            </section>
AUTHOR;
}

echo "</article><section class='spacer'></section>";

if (isset($article->section_title)) {
echo <<<MORE_ARTICLES
        <section class="moreArticles">
            <div class="spacer purple"></div>
            <div class="more purple">Other articles in $article->section_title</div>
            <div class="spacer purple"></div>
            <div class="gap"></div>
            <div class="gap"></div>
MORE_ARTICLES;

    for ( $i = 0; $i < count($article->related); $i++) {
        $rel_article = $article->related[$i];
        $color = ($i == 0) ? 'yellow' : ($i == 1) ? 'teal' : 'pink';
        // $color = 'teal';
        $rel_article_author = $article->author->name;
        $date_info = date_parse_from_format("Y-n-jT", $article->updated_at);
        echo <<<REL_ARTICLE
            <div class="spacer"></div>
            <div class="moreImage $color" style="background-image: url('$rel_article->image_url');"></div>
            <div class="moreInfo $color">
                <a href="index.php?article=$rel_article->id">$rel_article->title</a>
                <p>$rel_article->dek</p>
                <div class="moreByline">
                    <div>:: $rel_article_author</div>
                    <div>$date_info[month]-$date_info[day]-$date_info[year]</div>
                </div>
            </div>
            <div class="spacer"></div>
            <div class="gap"></div>
REL_ARTICLE;
    }

        echo "</section>";
}
echo "</main>";
?>