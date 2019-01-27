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
    
    namespace Jocic\QrCodes\Remote;
    
    use Jocic\Encoders\Base\Base16;
    use Jocic\Encoders\Base\Base32;
    use Jocic\Encoders\Base\Base64;
    use Jocic\QrCodes\QrInterface;
    use Jocic\QrCodes\QrCore;
    
    /**
     * <i>RemoteQrCore</i> class contains core methods used for remote QR code
     * creation - as in by utilizing online APIs.
     * 
     * @author    Djordje Jocic <office@djordjejocic.com>
     * @copyright 2019 All Rights Reserved
     * @version   1.0.0
     */
    
    class RemoteQrCore extends QrCore
    {
        /******************\
        |* CORE CONSTANTS *|
        \******************/
        
        // CORE CONSTANTS GO HERE
        
        /******************\
        |* CORE VARIABLES *|
        \******************/
        
        /**
         * API key that should be used for generating QR codes.
         * 
         * @var    string
         * @access protected
         */
        
        protected $apiKey = null;
        
        /*******************\
        |* MAGIC FUNCTIONS *|
        \*******************/
        
        /**
         * Constructor for the class <i>RemoteQrCore</i>. It's used for setting
         * core class parameters upon object instantiation.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2019 All Rights Reserved
         * @version   1.0.0
         * 
         * @param string $apiKey
         *   API key that should be set.
         * @param integer $qrCodeSize
         *   Size of the QR codes that should be generated.
         * @param string $storageDirectory
         *   Storage directory that should be set.
         * @return void
         */
        
        public function __construct($apiKey = null, $qrCodeSize = null,
            $storageDirectory = null)
        {
            // Step 1 - Handle API Key
            
            if ($apiKey != null)
            {
                $this->setApiKey($apiKey);
            }
            
            // Step 2 - Handle QR Code Size
            
            if ($qrCodeSize != null)
            {
                $this->setQrCodeSize($qrCodeSize);
            }
            
            // Step 3 - Handle Storage Directory
            
            if ($storageDirectory != null)
            {
                $this->setStorageDirectory($storageDirectory);
            }
        }
        
        /***************\
        |* GET METHODS *|
        \***************/
        
        /**
         * Returns API key used for generating QR codes.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2019 All Rights Reserved
         * @version   1.0.0
         * 
         * @return string
         *   API key used for generating QR codes.
         */
        
        public function getApiKey()
        {
            // Logic
            
            return $this->apiKey;
        }
        
        /***************\
        |* SET METHODS *|
        \***************/
        
        /**
         * Sets API key used for generating QR codes.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2019 All Rights Reserved
         * @version   1.0.0
         * 
         * @param string $apiKey
         *   API key that should be set.
         * @return void
         */
        
        public function setApiKey($apiKey)
        {
            // Logic
            
            if (!is_string($apiKey))
            {
                throw new \Exception("Invalid API key used.");
            }
            
            $this->apiKey = $apiKey;
        }
        
        /****************\
        |* CORE METHODS *|
        \****************/
        
        /**
         * Generates a QR code based on the set value.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2019 All Rights Reserved
         * @version   1.0.0
         * 
         * @param string $value
         *   Value that should be used for generating the QR code.
         * @return string
         *   Filename of a generated QR code.
         */
        
        public function generate($value)
        {
            // Core Variables
            
            $directory    = $this->getStorageDirectory();
            $requestUrl   = $this->getUrl($value);
            $fileLocation = $this->getFileLocation($value);
            
            // Other Variables
            
            $codeData = null;
            
            // Logic
            
            if (!$this->isQrCodeGenerated($value))
            {
                // Get QR Code
                
                $codeData = $this->loadFromFile($requestUrl, 1024, true);
                
                // Save QR Code
                
                $this->saveToFile($fileLocation, $codeData);
            }
            
            return $filename;
        }
        
        /**
         * Regenerates a QR code based on the set value.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2019 All Rights Reserved
         * @version   1.0.0
         * 
         * @param string $value
         *   Value that should be used for generating the QR code.
         * @return string
         *   Filename of a regenerated QR code.
         */
    
        public function regenerate($value)
        {
            // Logic
            
            if ($this->isQrCodeGenerated($value))
            {
                $this->removeFile($fileLocation);
            }
            
            return $this->generate($value);
        }
        
        /*****************\
        |* CHECK METHODS *|
        \*****************/
        
        // CHECK METHODS GO HERE
        
        /*****************\
        |* OTHER METHODS *|
        \*****************/
        
        // OTHER METHODS GO HERE
    }
    
?>
