<?php
    
    /*******************************************************************\
    |* Author: Djordje Jocic                                           *|
    |* Year: 2019                                                      *|
    |* License: MIT License (MIT)                                      *|
    |* =============================================================== *|
    |* Personal Website: http://www.djordjejocic.com/                  *|
    |* =============================================================== *|
    |* Permission is hereby granted, free of charge, to any person     *|
    |* obtaining a copy of this software and associated documentation  *|
    |* files (the "Software"), to deal in the Software without         *|
    |* restriction, including without limitation the rights to use,    *|
    |* copy, modify, merge, publish, distribute, sublicense, and/or    *|
    |* sell copies of the Software, and to permit persons to whom the  *|
    |* Software is furnished to do so, subject to the following        *|
    |* conditions.                                                     *|
    |* --------------------------------------------------------------- *|
    |* The above copyright notice and this permission notice shall be  *|
    |* included in all copies or substantial portions of the Software. *|
    |* --------------------------------------------------------------- *|
    |* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, *|
    |* EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES *|
    |* OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND        *|
    |* NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT     *|
    |* HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,    *|
    |* WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, RISING     *|
    |* FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR   *|
    |* OTHER DEALINGS IN THE SOFTWARE.                                 *|
    \*******************************************************************/
    
    use PHPUnit\Framework\TestCase;
    
    use Jocic\QrCodes\QrCore;
    
    /**
     * <i>TestQrCore</i> class is used for testing methods located in the
     * project's <i>QRCore</i> class.
     * 
     * @author    Djordje Jocic <office@djordjejocic.com>
     * @copyright 2019 All Rights Reserved
     * @version   1.0.0
     */
    
    class TestQrCore extends TestCase
    {
        /*********************\
        |* GET & SET METHODS *|
        \*********************/
        
        /**
         * Tests <i>setQrCodeSize</i> & <i>getQrCodeSize</i> methods.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2019 All Rights Reserved
         * @version   1.0.0
         * 
         * @return void
         */
        
        public function testQrCodeSizeMethods()
        {
            // Core Variables
            
            $qrCore = new QrCore();
            
            // Step 1 - Set Valid Value
            
            $qrCore->setQrCodeSize(400);
            
            $this->assertSame(400, $qrCore->getQrCodeSize());
            
            // Step 2 - Set Invalid Value
            
            try
            {
                $qrCore->setQrCodeSize("#");
                
                $this->fail("Exception should've been thrown!");
            }
            catch (\Exception $e)
            {
                $this->assertEquals("Invalid value provided.", $e->getMessage());
            }
        }
        
        /**
         * Tests <i>setStorageDirectory</i> & <i>getStorageDirectory</i> methods.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2019 All Rights Reserved
         * @version   1.0.0
         * 
         * @return void
         */
        
        public function testStorageDirectoryMethods()
        {
            // Core Variables
            
            $qrCore = new QrCore();
            
            // Other Variables
            
            $tempDirectory = sys_get_temp_dir();
            
            // Step 1 - Set Valid Setting
            
            $qrCore->setStorageDirectory($tempDirectory);
            
            $this->assertSame($tempDirectory,
                $qrCore->getStorageDirectory());
            
            // Step 2 - Set Invalid Setting
            
            try
            {
                $qrCore->setStorageDirectory(1337);
                
                $this->fail("Exception should've been thrown!");
            }
            catch (\Exception $e)
            {
                $this->assertEquals("Invalid storage directory used.",
                    $e->getMessage());
            }
        }
        
        /**
         * Tests <i>getHashDigest</i> method.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2019 All Rights Reserved
         * @version   1.0.0
         * 
         * @return void
         */
        
        public function testHashDigestMethod()
        {
            // Core Variables
            
            $qrCore = new QrCore();
            
            // Other Variables
            
            $testCombinations = [[
                "hash"  => "7c4a8d09ca3762af61e59520943dc26494f8941b",
                "value" => "123456"
            ], [
                "hash"  => "a18f2484f0ce8c28b44d99f1288a2e5c3571e694",
                "value" => "CAKE IS A LIE"
            ]];
            
            // Step 1 - Valid Tests
            
            foreach ($testCombinations as $testCombination)
            {
                $this->assertSame($testCombination["hash"],
                    $qrCore->getHashDigest($testCombination["value"]));
            }
            
            // Step 2 - Invalid Test
            
            try
            {
                $qrCore->getHashDigest(1337);
                
                $this->fail("Exception should've been thrown!");
            }
            catch (\Exception $e)
            {
                $this->assertEquals("Invalid value provided.", $e->getMessage());
            }
        }
        
        /**
         * Tests <i>getFileName</i> method.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2019 All Rights Reserved
         * @version   1.0.0
         * 
         * @return void
         */
        
        public function testFileNameMethod()
        {
            // Core Variables
            
            $qrCore = new QrCore();
            
            // Other Variables
            
            $testCombinations = [[
                "value"     => "123456",
                "prefix"    => "generic",
                "extension" => "png",
                "codeSize"  => "300",
                "fileName"  => "generic-7c4a8d09ca3762af61e59520943dc26494f89" .
                    "41b-300.png"
            ], [
                "value"     => "CAKE IS A LIE!",
                "prefix"    => "remote",
                "extension" => "jpg",
                "codeSize"  => "400",
                "fileName"  => "remote-42b85546c3c2d993d214c758e4affb56401f21" .
                    "c7-400.jpg"
            ]];
            
            // Step 1 - Test Method Without Code Size
            
            try
            {
                $qrCore->getFileName("test");
                
                $this->fail("Exception should've been thrown!");
            }
            catch (\Exception $e)
            {
                $this->assertEquals("QR code size wasn't set.", $e->getMessage());
            }
            
            // Step 2 - Test Combinations
            
            foreach ($testCombinations as $testCombination)
            {
                $qrCore->setQrCodeSize($testCombination["codeSize"]);
                
                $this->assertEquals($testCombination["fileName"],
                    $qrCore->getFileName($testCombination["value"],
                        $testCombination["prefix"],
                        $testCombination["extension"]));
            }
        }
        
        /**
         * Tests <i>getFileLocation</i> method.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2019 All Rights Reserved
         * @version   1.0.0
         * 
         * @return void
         */
        
        public function testFileLocationMethod()
        {
            // Core Variables
            
            $qrCore = new QrCore();
            
            // Other Variables
            
            $testCombinations = [[
                "value"     => "123456",
                "directory" => "/a/b/c",
                "codeSize"  => "300",
                "location"  => "/a/b/c/generic-7c4a8d09ca3762af61e59520943dc2" .
                    "6494f8941b-300.png"
            ], [
                "value"     => "CAKE IS A LIE!",
                "directory" => "",
                "codeSize"  => "400",
                "location"  => "./generic-42b85546c3c2d993d214c758e4affb56401" .
                    "f21c7-400.png"
            ]];
            
            // Logic
            
            foreach ($testCombinations as $testCombination)
            {
                $qrCore->setQrCodeSize($testCombination["codeSize"]);
                $qrCore->setStorageDirectory($testCombination["directory"]);
                
                $this->assertEquals($testCombination["location"],
                    $qrCore->getFileLocation($testCombination["value"]));
            }
        }
        
        /*****************\
        |* CHECK METHODS *|
        \*****************/
        
        // CHECK METHODS GO HERE
        
        /*******************\
        |* PRIMARY METHODS *|
        \*******************/
        
        /**
         * Tests <i>saveToFile</i> & <i>loadFromFile</i> methods.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2018 All Rights Reserved
         * @version   1.0.0
         * 
         * @return void
         */
        
        public function testSaveLoadFunction()
        {
            // Core Variables
            
            $qrCore = new QrCore();
            
            // Other Variables
            
            $tempDirectory = sys_get_temp_dir();
            $tempLocation  = join(DIRECTORY_SEPARATOR, [
                $tempDirectory,
                "qr-codes-save-test"
            ]);
            
            // Step 1 - Test Saving & Loading (Valid)
            
            $qrCore->saveToFile($tempLocation, "...");
            
            $this->assertSame("...", $qrCore->loadFromFile($tempLocation));
            
            // Step 2 - Test Saving (Invalid)
            
            try
            {
                $qrCore->saveToFile("/cake/is/a/lie", "...");
                
                $this->fail("Exception should've been thrown!");
            }
            catch (\Exception $e)
            {
                $this->assertEquals("An unkown IO error occured.", $e->getMessage());
            }
            
            // Step 3 - Test Loading (Invalid)
            
            try
            {
                $qrCore->loadFromFile("/cake/is/a/lie", "...");
                
                $this->fail("Exception should've been thrown!");
            }
            catch (\Exception $e)
            {
                $this->assertEquals("An unkown IO error occured.", $e->getMessage());
            }
        }
        
        /*********************\
        |* SECONDARY METHODS *|
        \*********************/
        
        // SECONDARY METHODS GO HERE
        
        /*****************\
        |* OTHER METHODS *|
        \*****************/
        
        // OTHER METHODS GO HERE
    }
    
?>
