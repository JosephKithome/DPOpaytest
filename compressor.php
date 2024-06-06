<?php

class DataProcessor {
    private $filePath;

    public function __construct($filePath) {
        $this->filePath = $filePath;
    }

    public function processData() {
        try {
            $data = array();
            for ($i = 0; $i < 1500000; $i++) {
                $data[] = array(
                    'id' => $i,
                    'name' => 'Name' . $i,
                    'email' => 'email' . $i . 'josephkithome.jmk@gmail.com'
                );
            }

            $serializedData = serialize($data);

            $compressedData = gzcompress($serializedData);

            if (file_put_contents($this->filePath, $compressedData) === false) {
                throw new Exception("Failed to write to file: {$this->filePath}");
            }

            echo "Data has been serialized, compressed using zlib, and saved to {$this->filePath}.\n";

        } catch (Exception $e) {
            echo "Error: " . $e->getMessage() . "\n";
        }
    }

    public function retrieveData() {
        try {
            $readCompressedData = file_get_contents($this->filePath);
            if ($readCompressedData === false) {
                throw new Exception("Failed to read from file: {$this->filePath}");
            }
            $decompressedData = gzuncompress($readCompressedData);
            if ($decompressedData === false) {
                throw new Exception("Failed to decompress the data.");
            }
            $unserializedData = unserialize($decompressedData);
            if ($unserializedData === false) {
                throw new Exception("Failed to unserialize the data.");
            }

            echo "Data has been read from the file, decompressed, and unserialized.\n";
            echo "Sample Data: \n";
            print_r(array_slice($unserializedData, 0, 300)); 

        } catch (Exception $e) {
            echo "Error: " . $e->getMessage() . "\n";
        }
    }
}

// Usage example
$filePath = 'compressed_data.gz';
$dataProcessor = new DataProcessor($filePath);
$dataProcessor->processData();
$dataProcessor->retrieveData();

?>
