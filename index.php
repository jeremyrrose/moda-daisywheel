<?php

if (isset($_GET['article'])) {
  include 'article.php';
} elseif (isset($_GET['section'])) {
  include 'section.php';
} else {
  include 'front.php';
}

?>
