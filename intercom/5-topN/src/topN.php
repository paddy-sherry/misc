<?php
error_reporting(-1);
ini_set('display_errors', 'On');



class TopN {

    function __construct() {
        
        $this->filename = "../output.txt";

        // Size (in bytes) of tiles chunk
        $this->chunkSize = 1024*1024;
    }

    
    /**
    * function - openFile
    * Open the file containing the data
    *
    * @return - a handle to the file.
    */
    public function openFile() {

        $handle = fopen($this->filename, "rb");
        if ($handle === false) {
          return false;
        }

        return $handle;
    }

    /**
    * function - getTopNIntegersFromChunk
    * Loops over every integer in the chunk and pulls out the top N. N is specified in the constructor.
    * @param - $numbers - the chunk containing the numbers
    * @param - $n - the number of integers we want to get back. This is set in the constructor
    *
    * @return - array - the N highest numbers from the chunk
    */
    public function getTopNIntegersFromChunk(array $numbers, $n) {
        $maxHeap = new SplMaxHeap;
        foreach($numbers as $number) {
            $maxHeap->insert($number);
        }
        return iterator_to_array(
            new LimitIterator($maxHeap, 0, $n)
        );
    }

    /**
    * function - returnTopN
    * Merges the previous top N numbers with the new top N and then pulls out the fresh top N
    * @param - $filteredArr - the new top N numbers from the loop in progress
    * @param - $i - the iterator
    * @param - $sessionFilteredArr - the top N numbers from the previous loop that have been stored in the session
    *
    * @return - array - the top N afters after merging with the previous N
    */
    public function returnTopN($filteredArr, $i, $sessionFilteredArr, $n) {

        if ($i !== 0) {
            $temp = array_merge($filteredArr, $sessionFilteredArr);
            $topN = $this->getTopNIntegersFromChunk($temp, $n);
        } else {
            $topN = $filteredArr;
        }    
        $i++;

        return $topN;
    }

    
    /**
    * function - readfileInChunks
    * Reads the file and display its content chunk by chunk
    *
    * @return - null.
    */

    public function readfileInChunks($retbytes, $n) {
        $buffer = "";

        $handle = $this->openFile();

        $i = 0;
        while (!feof($handle)) {
            $buffer = fread($handle, $this->chunkSize);
        
            //send the collected data on in one batch to be processed.
            flush();

            $array = explode(PHP_EOL, $buffer);
           
            $filteredArr = $this->getTopNIntegersFromChunk($array, $n);

          
            if ($i !== 0) {
                $sessionFilteredArr = $_SESSION['filteredArr'];
            } else {
                $sessionFilteredArr = '';
            };

            $topN = $this->returnTopN($filteredArr, $i, $sessionFilteredArr, $n);
            $_SESSION['filteredArr'] = $topN;
            $i++; 
        }

        echo "<pre>";
        print_r($topN);
        echo "</pre>";
      
        $status = fclose($handle);
    }
}
