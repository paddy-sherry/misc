<?php

require('src/topN.php');

class TopNTest extends PHPUnit_Framework_TestCase {
    
    protected function setUp() {
      
        //set up the mock class and stub the openFile an readfileInChunks methods as they cant be tested due to sessions and opening files.
        $this->topN = $this->getMockBuilder('\TopN')
        ->setMethods(array('openFile', 'readfileInChunks'))
        ->getMock();

        //set up the test array
        $this->testArr = array (
            0 => '33333333',
            1 => '799550',
            2 => '761525',
            3 => '288213',
            4 => '726579',
            5 => '311968',
            6 => '900098',
            7 => '632262',
            8 => '982397',
            9 => '943575',
            10 => '799200',
            11 => '349241',
            12 => '167391',
            13 => '197382',
            14 => '150795',
            15 => '22222222',
            16 => '528474',
            17 => '109617',
            18 => '600557',
            19 => '351425',
            20 => '268253',
            21 => '357',
            22 => '635109',
            23 => '239611',
            24 => '118508',
            25 => '106755',
            26 => '57377',
            27 => '621306',
            28 => '724748',
            29 => '211500',
            30 => '286604',
            31 => '660572',
            32 => '758223',
            33 => '522535',
            34 => '228048',
            35 => '876935',
            36 => '581840',
            37 => '664292',
            38 => '661840',
            39 => '983624',
            40 => '734283',
            41 => '218081',
            42 => '171085',
            43 => '796555',
            44 => '584599',
            45 => '287856',
            46 => '809265',
            47 => '383297',
            48 => '743825',
            49 => '591552',
            50 => '854044',
            51 => '975943',
            52 => '343459',
            53 => '117133',
            54 => '789788',
            55 => '235800',
            56 => '419544',
            57 => '174577',
            58 => '466307',
            59 => '317293',
            60 => '866198',
            61 => '426614',
            62 => '740327',
            63 => '184201',
            64 => '661064',
            65 => '897254',
            66 => '691468',
            67 => '288407',
            68 => '640128',
            69 => '472837',
            70 => '188493',
            71 => '75155',
            72 => '580335',
            73 => '699123',
            74 => '176095',
            75 => '38042',
            76 => '52457',
            77 => '958114',
            78 => '37084',
            79 => '856691',
            80 => '248134',
            81 => '832668',
            82 => '942524',
            83 => '591810',
            84 => '759784',
            85 => '461482',
            86 => '845164',
            87 => '102663',
            88 => '974153',
            89 => '450894',
            90 => '21284',
            91 => '897763',
            92 => '639590',
            93 => '912468',
            94 => '921937',
            95 => '61776',
            96 => '220630',
            97 => '304415',
            98 => '374755',
            99 => '877339',
            100 => '340797',
            101 => '707566',
            102 => '217091',
            103 => '867322',
            104 => '385506',
            105 => '265279',
            106 => '280772',
            107 => '414857',
            108 => '162154',
            109 => '123405',
            110 => '768258',
            111 => '132364',
            112 => '99503',
            113 => '702376',
            114 => '28793',
            115 => '414323',
            116 => '522004',
            117 => '408426',
            118 => '589772',
            119 => '277134',
            120 => '537116',
            121 => '685628',
            122 => '856552',
            123 => '168188',
            124 => '691325',
            125 => '259092',
            126 => '332038',
            127 => '549914',
            128 => '567667',
            129 => '77992',
            130 => '857375',
            131 => '651847',
            132 => '815510',
            133 => '366477',
            134 => '247786',
            135 => '744242',
            136 => '840040',
            137 => '224608',
            138 => '548636',
            139 => '145612',
            140 => '197910',
            141 => '775653',
            142 => '47928',
            143 => '86237',
            144 => '192308',
            145 => '346280',
            146 => '78784',
            147 => '169040',
            148 => '551116',
            149 => '508083',
            150 => '823581',
            151 => '341245',
            152 => '726445',
            153 => '501522',
            154 => '742169',
            155 => '534296',
            156 => '747818',
            157 => '880155',
            158 => '760449',
            159 => '455215',
            160 => '449962',
            161 => '459874',
            162 => '556098',
            163 => '147035',
            164 => '298374',
            165 => '909572',
            166 => '141433',
            167 => '604276',
            168 => '854363',
            169 => '594636',
            170 => '66337',
            171 => '603935',
            172 => '946765',
            173 => '484814',
            174 => '704434',
            175 => '93160',
            176 => '145209',
            177 => '754730',
            178 => '423083',
            179 => '115553',
            180 => '982491',
            181 => '982783',
            182 => '174942',
            183 => '791174',
            184 => '777977',
            185 => '765381',
            186 => '7884',
            187 => '976931',
            188 => '254287',
            189 => '684437',
            190 => '655444',
            191 => '800119',
            192 => '264515',
            193 => '395689',
            194 => '817378',
            195 => '207136',
            196 => '80129',
            197 => '348456',
            198 => '623979',
            199 => '417589',
            200 => '792886'
        );

        $this->testN = 10;

        $this->session = array (
        
            152202 => '33333333',
            152201 => '22222222',
            152200 => '999998',
            152199 => '999996',
            152198 => '999993',
            152197 => '999984',
            152196 => '999981',
            152195 => '999978',
            152194 => '999977',
            152193 => '999975'
        );
    }

    /**
    * function testIntegersReturnedInFilteredArray
    * Tests the values returned from the function that filters the chunks
    */
    public function testIntegersReturnedInFilteredArray() {
        
        //run the function to get the data for testing.
        $filteredArr = $this->topN->getTopNIntegersFromChunk($this->testArr, $this->testN);
        
        //assert that there are 10 integers in the array as we want to get the top ten numbers from each chunk
        $this->assertCount(10, $filteredArr);

        //assert that 11 elements are not returned in array. This confirms that N is returned. N is the number we specify.
        $this->assertNotEquals(11, count($filteredArr));

        //assert that 22222222 is in the returned array. This confirms the highest ten numbers are being returned
        $this->assertContains(22222222, $filteredArr);

        //assert that 123 is not in the returned array. This confirms that low numbers are being filtered out
        $this->assertNotContains(123, $filteredArr);


        //set the expected return value
        $expectedArr = array (
            200 => 33333333,
            199 => 22222222,
            198 => 983624,
            197 => 982783,
            196 => 982491,
            195 => 982397,
            194 => 976931,
            193 => 975943,
            192 => 974153,
            191 => 958114
        );
        //assert that the array we expect matches the one that comes out. This confirms the top ten numbers are returned.
        $this->assertEquals($expectedArr, $filteredArr);
    }

    /**
    * function testIfTopTenIntegersAreRetainedOnEachLoop
    * Tests if the highest numbers are still in the array after merging with the previous top 10.
    */
    public function testIfTopTenIntegersAreRetainedOnEachLoop() {

        //run the function to get the data for testing.
        $filteredArr = $this->topN->returnTopN($this->session, 0, $this->testArr, $this->testN);
      
        //assert that there are 10 integers in the array as we want to get the top ten numbers after comparing against the previous top 10
        $this->assertCount(10, $filteredArr);

        //assert that 11 elements are not returned in array. This confirms that N is returned. N is the number we specify.
        $this->assertNotEquals(11, count($filteredArr));

        //assert that 22222222 is in the returned array. This confirms the highest ten numbers are being returned
        $this->assertContains(22222222, $filteredArr);
    }
}