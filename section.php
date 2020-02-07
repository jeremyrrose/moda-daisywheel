<?php
$api_url = "$api/front/sections/$section_id";
$curl = curl_init($api_url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, [
  'Content-Type: application/json'
]);
$response = curl_exec($curl);
curl_close($curl);

$section_info = json_decode($response);
$section = $section_info->section;
$features = $section_info->features;
$articles = $section_info->articles;
?>

    <main class="article">

      <section class="moreArticles bigList" style="margin-top: 0px;">
          <div class="spacer purple"></div>
          <div class="more purple"><?php echo $section->title ?></div>
          <div class="spacer purple"></div>
          <div class="gap max"></div>
<?php

if (isset($section_info->top_story_object)) {
  $article = $section_info->top_story_object;
  $author = (isset($article->author)) ? strtoupper($article->author->name) : "STAFF";

      $color = "teal";
      echo <<<FEATURE
    <section class="homebar grid">
        <div class="photo left" style="background-image: url('$article->image_url');"></div>
        <div class="category">$author // $article->publication_date</div>
        <div class="spacer purple"></div>
        <div class="title right $color"><a href="index.php?article=$article->id">$article->title</a></div>
        <div class="spacer $color"></div>
    </section>
FEATURE;
}

if (isset($features[0])) {

          for ( $i = 0; $i < count($features); $i++ ) {
            $article = $features[$i];
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
                        <div>$author :: $article->publication_date</div>
                    </div>
                </div>
                <div class="spacer"></div>
                <div class="gap"></div>
FEATURE_ARTICLE;
        }
      }

      echo <<<LIST_HEAD
        <section class="moreArticles list">
            <div class="spacer purple"></div>
            <div class="more purple small">More from $section->title</div>
            <div class="spacer purple"></div>
            <div class="smallArticles">
LIST_HEAD;
if (isset($articles[0])) {
    $article_count = count($articles);
    for ( $i = 0; $i < $article_count; $i++ ) {
        $article = $articles[$i];
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
        <p class='listByline'>$author :: $article->publication_date</p>
        </div>
LIST_ARTICLE;
    }
  } else {
        echo <<<LIST_ARTICLE
        <div>
          <div class='listArticle'>
            <a href="/">No more articles are available in "$section->title."</a>
            <p class='listDek'>Please use the menu at left to see other sections, or click the heading directly above to return to our front page.</p>
          </div>
        </div>
LIST_ARTICLE;
  }
    echo "</div></div></section>";         
?>
      </section>
  </main>