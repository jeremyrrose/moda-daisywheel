<?php
$api_url = "$api/sections/$section_id";
$curl = curl_init($api_url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, [
  'Content-Type: application/json'
]);
$response = curl_exec($curl);
curl_close($curl);

$section = json_decode($response);
?>

    <main class="article">

      <section class="moreArticles bigList" style="margin-top: 0px;">
          <div class="spacer purple"></div>
          <div class="more purple"><?php echo $section->section->title ?></div>
          <div class="spacer purple"></div>
          <div class="gap max"></div>
<?php

$article = $section->top_story_object;
$author = (isset($article->author)) ? strtoupper($article->author->name) : "STAFF";

    $color = "teal";
    echo <<<FEATURE
  <section class="homebar grid">
      <div class="photo left" style="background-image: url('$article->image_url');"></div>
      <div class="category">$author // $article->created_at</div>
      <div class="spacer purple"></div>
      <div class="title right $color"><a href="index.php?article=$article->id">$article->title</a></div>
      <div class="spacer $color"></div>
  </section>
FEATURE;

          for ( $i = 0; $i < count($section->features); $i++ ) {
            $article = $section->features[$i];
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
?>
      </section>
  </main>