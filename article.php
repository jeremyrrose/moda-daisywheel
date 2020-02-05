<?php 
$api_url = "$api/articles/$article_id";
$curl = curl_init($api_url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, [
  'Content-Type: application/json'
]);
$response = curl_exec($curl);
curl_close($curl);

$article = json_decode($response);
$author = (isset($article->author) ? $article->author : null);

echo <<<ARTICLE_HEADER
<main class="article">
        <div class="hero" style="background-image: url($article->image_url);">
            <div class="spacer pink"></div>
            <div class="issue pink">$article->section_id</div>
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


            <section class="author">
                <p>$author->bio Jeremy Rose lives in Brooklyn, New York, with a three-legged cat and a lot of plants.</p>
            </section>
        </article>
        <section class="spacer"></section>

        <section class="moreArticles">
            <div class="spacer purple"></div>
            <div class="more purple">Other articles in $article->section_id</div>
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
    </main>
ARTICLE_HEADER;
?>