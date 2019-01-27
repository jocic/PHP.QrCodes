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
    
    use Jocic\QrCodes\Remote\RemoteQrCore;
    
    /**
     * <i>TestRemoteQrCore</i> class is used for testing methods located in the
     * project's <i>RemoteQRCore</i> class.
     * 
     * @author    Djordje Jocic <office@djordjejocic.com>
     * @copyright 2019 All Rights Reserved
     * @version   1.0.0
     */
    
    class TestRemoteQrCore extends TestCase
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
            
            $remoteQrCore = new RemoteQrCore();
            
            // Step 1 - Set Valid Setting
            
            $remoteQrCore->setApiKey("abcdef");
            
            $this->assertSame("abcdef", $remoteQrCore->getApiKey());
            
            // Step 2 - Set Invalid Setting
            
            try
            {
                $remoteQrCore->setApiKey(1337);
                
                $this->fail("Exception should've been thrown!");
            }
            catch (\Exception $e)
            {
                $this->assertEquals("Invalid API key used.", $e->getMessage());
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
            
            $remoteQrCore = null;
            
            // Other Variables
            
            $testValues = [[
                "key"       => null,
                "size"      => null,
                "directory" => null
            ], [
                "key"       => "abcde",
                "size"      => 400,
                "directory" => sys_get_temp_dir()
            ]];
            
            // Logic
            
            foreach ($testValues as $testValue)
            {
                $remoteQrCore = new RemoteQrCore($testValue["key"],
                    $testValue["size"], $testValue["directory"]);
                
                $this->assertSame($testValue["key"],
                    $remoteQrCore->getApiKey());
                
                $this->assertSame($testValue["size"],
                    $remoteQrCore->getQrCodeSize());
                
                $this->assertSame($testValue["directory"],
                        $remoteQrCore->getStorageDirectory());
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
