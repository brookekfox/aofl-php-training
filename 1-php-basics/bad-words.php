<?php

  $BAD_WORDS = array();

  function bad_words_filter($string) {
    return in_array($string, $BAD_WORDS);
  }

?>