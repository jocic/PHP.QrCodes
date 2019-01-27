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
    
    use Jocic\QrCodes\FileSystem;
    
    /**
     * <i>TestFileSystem</i> class is used for testing core IO methods.
     * 
     * @author    Djordje Jocic <office@djordjejocic.com>
     * @copyright 2019 All Rights Reserved
     * @version   1.0.0
     */
    
    class TestFileSystem extends TestCase
    {
        /*********************\
        |* GET & SET METHODS *|
        \*********************/
        
        // GET & SET METHODS GO HERE
        
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
            
            $fileSystem = new FileSystem();
            
            // Other Variables
            
            $tempDirectory = sys_get_temp_dir();
            $tempLocation  = join(DIRECTORY_SEPARATOR, [
                $tempDirectory,
                "qr-codes-io-test"
            ]);
            
            // Step 1 - Test Saving & Loading (Valid)
            
            $fileSystem->saveToFile($tempLocation, "...");
            
            $this->assertSame("...", $fileSystem->loadFromFile($tempLocation));
            
            // Step 2 - Test Saving (Invalid)
            
            try
            {
                $fileSystem->saveToFile("/cake/is/a/lie", "...");
                
                $this->fail("Exception should've been thrown!");
            }
            catch (\Exception $e)
            {
                $this->assertEquals("An unkown IO error occured.", $e->getMessage());
            }
            
            // Step 3 - Test Loading (Invalid)
            
            try
            {
                $fileSystem->loadFromFile("/cake/is/a/lie", "...");
                
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
