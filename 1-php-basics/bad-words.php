<?php

  $BAD_WORDS = array(
    "these",
    "are",
    "the",
    "bad",
    "words"
  );

  function bad_words_filter($string, $bad_words) {
    foreach ($bad_words as $w) {
      if (strpos($string, $w) !== false) {
        echo "bad word found: " . $w . "\n";
        return true;
      }
    }
    echo "no bad words\n";
    return false;
  }

  bad_words_filter("brooke fox", $BAD_WORDS); // should be false
  bad_words_filter("are there any bad words?", $BAD_WORDS); // should be true

?>