<?php
class WordCounter {

  public function countWordsInFile($filePath) {
    try {
      if (!file_exists($filePath)) {
        throw new Exception("File not found.");
      }
      $content = file_get_contents($filePath);
      if ($content === false) {
        throw new Exception("Could not read file.");
      }
      $wordCount = str_word_count($content);
      return $wordCount;
    } catch (Exception $e) {
      return "Error: " . $e->getMessage();
    }
  }
}

$counter = new WordCounter();
echo $counter->countWordsInFile('words.txt');
?>
