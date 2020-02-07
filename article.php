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
$image_url = json_decode($response)->image_url;
$author = (isset($article->author) ? $article->author : null);
$hero_class = isset($image_url) ? "" : " noHero";

echo <<<ARTICLE
<main class="article">
        <div class="hero$hero_class" style="background-image: url($image_url);">
            <div class="spacer pink"></div>
            <div class="issue pink">$article->section_title</div>
            <div class="spacer purple"></div>
            <div class="issue purple">$article->created_at</div>
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
                <div>01/01/2020 at 3:21 AM</div>
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

            <div class="spacer"></div>
            <div class="moreImage yellow"></div>
            <div class="moreInfo yellow">
                <a href="article.html">Erat nam at lectus urna duis convallis convallis</a>
                <p>Volutpat commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend. Mi ipsum faucibus vitae aliquet nec.</p>
                <div class="moreByline">
                    <div>:: Pulvinar Elementum</div>
                    <div>01/01/2020</div>
                </div>
            </div>
            <div class="spacer"></div>
            <div class="gap"></div>

            <div class="spacer"></div>
            <div class="moreImage teal"></div>
            <div class="moreInfo teal">
                <a href="article.html">Odio facilisis mauris sit amet massa</a>
                <p>Morbi blandit cursus risus at ultrices mi tempus. Mattis enim ut tellus elementum sagittis vitae et leo duis.</p>
                <div class="moreByline">
                    <div>:: Lacinia Quis Vel</div>
                    <div>01/01/2020</div>
                </div>
            </div>
            <div class="spacer"></div>
            <div class="gap"></div>

            <div class="spacer"></div>
            <div class="moreImage pink"></div>
            <div class="moreInfo pink">
                <a href="article.html">Neque laoreet suspendisse interdum consectetur libero</a>
                <p>Tortor condimentum lacinia quis vel. Tincidunt tortor aliquam nulla facilisi cras. Rhoncus urna neque viverra justo nec ultrices dui sapien.</p>
                <div class="moreByline">
                    <div>:: Volutpat Commodo</div>
                    <div>01/01/2020</div>
                </div>
            </div>
            <div class="spacer"></div>
            <div class="gap"></div>

        </section>
MORE_ARTICLES;
}
echo "</main>";
?>