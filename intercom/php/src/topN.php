<?php
error_reporting(-1);
ini_set('display_errors', 'On');



class TopN {


    function __construct() {
        $this->filename = "../output.txt";
        $this->n = 10;

        // Size (in bytes) of tiles chunk
        $this->chunkSize = 1024*1024;
    }

    public function getTopNIntegersFromChunk(array $numbers, $n) {
        $maxHeap = new SplMaxHeap;
        foreach($numbers as $number) {
            $maxHeap->insert($number);
        }
        return iterator_to_array(
            new LimitIterator($maxHeap, 0, $n)
        );
    }


    public function returnTopN($filteredArr, $i) {

        if ($i !== 0) {
            $temp = array_merge($filteredArr, $_SESSION['filteredArr']);
            $topN = $this->getTopNIntegersFromChunk($temp, $this->n);
        } else {
            $topN = $filteredArr;
        }

        $_SESSION['filteredArr'] = $topN;
        $i++;

        return $topN;

    }

    // Read a file and display its content chunk by chunk
    /**
    * function 
    *
    */

    public function readfileInChunks($retbytes) {
        $buffer = "";

        $handle = fopen($this->filename, "rb");
        if ($handle === false) {
          return false;
        }

        $i = 0;
        while (!feof($handle)) {
            $buffer = fread($handle, $this->chunkSize);
        
            //send the collected data on in one batch to be processed.
            ob_flush();
            flush();

            $array = explode(PHP_EOL, $buffer);

            $filteredArr = $this->getTopNIntegersFromChunk($array, $this->n);

            $topN = $this->returnTopN($filteredArr, $i);
            $i++;

            echo "<pre>";
            echo 'topN';
            print_r($topN);
            echo "</pre>";
            
      }
      
      $status = fclose($handle);
    }
}

$TopN = new TopN();
$TopN->readfileInChunks(TRUE);

