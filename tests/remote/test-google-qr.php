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
    
    use Jocic\QrCodes\Remote\GoogleQr;
    
    /**
     * <i>TestGoogleQr</i> class is used for testing method implementation of
     * the class <i>GoogleQr</i>.
     * 
     * @author    Djordje Jocic <office@djordjejocic.com>
     * @copyright 2019 All Rights Reserved
     * @version   1.0.0
     */
    
    class TestGoogleQr extends TestCase
    {
        /*********************\
        |* GET & SET METHODS *|
        \*********************/
        
        /**
         * Tests <i>setApiKey</i> & <i>getApiKey</i> methods.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2019 All Rights Reserved
         * @version   1.0.0
         * 
         * @return void
         */
        
        public function testApiKeyMethods()
        {
            // Core Variables
            
            $googleQr = new GoogleQr();
            
            // Step 1 - Test Setting
            
            try
            {
                $googleQr->setApiKey("The cake is a lie!");
                
                $this->fail("Exception should've been thrown!");
            }
            catch (\Exception $e)
            {
                $this->assertEquals("Google's API doesn't require a key: " .
                    "The cake is a lie!", $e->getMessage());
            }
            
            // Step 2 - Test Getting
            
            try
            {
                $googleQr->getApiKey();
                
                $this->fail("Exception should've been thrown!");
            }
            catch (\Exception $e)
            {
                $this->assertEquals("Google's API doesn't require a key.",
                    $e->getMessage());
            }
        }
        
        /**
         * Tests <i>getUrl</i> method.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2019 All Rights Reserved
         * @version   1.0.0
         * 
         * @return void
         */
        
        public function testUrlMethtod()
        {
            // Core Variables
            
            $googleQr = new GoogleQr();
            
            // Other Variables
            
            $tempDirectory = sys_get_temp_dir();
            
            // Other Variables
            
            $testCombinations = [[
                "value" => "123456",
                "size"  => "200",
                "url"   => "https://chart.googleapis.com/chart?chs=200x200" .
                    "&chld=M|0&cht=qr&chl=123456"
            ], [
                "value" => "CAKE IS A LIE",
                "size"  => "300",
                "url"   => "https://chart.googleapis.com/chart?chs=300x300" .
                    "&chld=M|0&cht=qr&chl=CAKE+IS+A+LIE"
            ], [
                "value" => "http://www.google.com",
                "size"  => "400",
                "url"   => "https://chart.googleapis.com/chart?chs=400x400" .
                    "&chld=M|0&cht=qr&chl=http%3A%2F%2Fwww.google.com"
            ]];
            
            // Step 1 - Valid Tests
            
            foreach ($testCombinations as $testCombination)
            {
                $googleQr->setQrCodeSize($testCombination["size"]);
                
                $this->assertSame($testCombination["url"],
                    $googleQr->getUrl($testCombination["value"]));
            }
            
            // Step 2 - Invalid Test
            
            try
            {
                $googleQr->getUrl(1337);
                
                $this->fail("Exception should've been thrown!");
            }
            catch (\Exception $e)
            {
                $this->assertEquals("Invalid value provided.", $e->getMessage());
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
         * Tests constructor of the class.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2019 All Rights Reserved
         * @version   1.0.0
         * 
         * @return void
         */
        
        public function testConstructor()
        {
            // Core Variables
            
            $googleQr = null;
            
            // Other Variables
            
            $testValues = [[
                "size"      => null,
                "directory" => null
            ], [
                "size"      => 400,
                "directory" => sys_get_temp_dir()
            ]];
            
            // Logic
            
            foreach ($testValues as $testValue)
            {
                $googleQr = new GoogleQr($testValue["size"],
                    $testValue["directory"]);
                
                $this->assertSame($testValue["size"],
                    $googleQr->getQrCodeSize());
                
                $this->assertSame($testValue["directory"],
                        $googleQr->getStorageDirectory());
            }
        }
        
        /*********************\
        |* SECONDARY METHODS *|
        \*********************/
        
        // SECODARY METHODS GO HERE
        
        /*****************\
        |* OTHER METHODS *|
        \*****************/
        
        // OTHER METHODS GO HERE
    }
    
?>
