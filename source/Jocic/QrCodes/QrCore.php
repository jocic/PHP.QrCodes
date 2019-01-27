<?php
    
    /*******************************************************************\
    |* Author: Djordje Jocic                                           *|
    |* Year: 2018                                                      *|
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
    
    namespace Jocic\QrCodes;
    
    /**
     * <i>QrCore</i> class contains generic methods used for QR code creation.
     * 
     * @author    Djordje Jocic <office@djordjejocic.com>
     * @copyright 2019 All Rights Reserved
     * @version   1.0.0
     */
    
    class QrCore
    {
        /******************\
        |* CORE CONSTANTS *|
        \******************/
        
        /**
         * Encoding constant - for getting QR code image in <i>Base 16</i>.
         * 
         * @var    integer
         * @access public
         */
        
        public const E_BASE_16 = 0;
        
        /**
         * Encoding constant - for getting QR code image in <i>Base 32</i>.
         * 
         * @var    integer
         * @access public
         */
        
        public const E_BASE_32 = 1;
        
        /**
         * Encoding constant - for getting QR code image in <i>Base 64</i>.
         * 
         * @var    integer
         * @access public
         */
        
        public const E_BASE_64 = 2;
        
        /******************\
        |* CORE VARIABLES *|
        \******************/
        
        /**
         * Size of the generated QR codes - width & height.
         * 
         * @var    integer
         * @access protected
         */
        
        protected $qrCodeSize = null;
        
        /**
         * Directory location that should be used for storing the QR code.
         * 
         * @var    string
         * @access protected
         */
        
        protected $storageDirectory = null;
        
        /*******************\
        |* MAGIC FUNCTIONS *|
        \*******************/
        
        // MAGIC FUNCTIONS GO HERE
        
        /***************\
        |* GET METHODS *|
        \***************/
        
        /**
         * Returns set QR code size - width and height.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2019 All Rights Reserved
         * @version   1.0.0
         * 
         * @return integer
         *   Set QR code size.
         */
        
        public function getQrCodeSize()
        {
            // Logic
            
            return $this->qrCodeSize;
        }
        
        /**
         * Returns get directory used for storing generated QR codes.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2019 All Rights Reserved
         * @version   1.0.0
         * 
         * @return string
         *   Set storage directory.
         */
        
        public function getStorageDirectory()
        {
            // Logic
            
            return $this->storageDirectory;
        }
        
        /**
         * Generates & returns hash digest of a provided value.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2019 All Rights Reserved
         * @version   1.0.0
         * 
         * @param string $value
         *   Value that should be used for generating the QR code.
         * @return string
         *   Hash digest of a provided value.
         */
        
        public function getHashDigest($value)
        {
            // Step 1 - Check Value
            
            if (!is_string($value))
            {
                throw new \Exception("Invalid value provided.");
            }
            
            // Step 2 - Generate & Return Hash
            
            return sha1($value);
        }
        
        /**
         * Generates & returns a file name for a provided value.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2019 All Rights Reserved
         * @version   1.0.0
         * 
         * @param string $value
         *   Value that should be used for generating the QR code.
         * @param string $prefix
         *   Optional parameter that is used for specifying type of a QR code.
         * @param string $extension
         *   File extension, ex. <i>PNG</i> if QR code will be in that format.
         * @return string
         *   Hash digest of a provided value.
         */
        
        public function getFileName($value, $prefix = "generic",
            $extension = "png")
        {
            // Core Variables
            
            $hashDigest = $this->getHashDigest($value);
            $codeSize   = $this->getQrCodeSize();
            
            // Step 1 - Check Parameters
            
            if ($codeSize == null)
            {
                throw new \Exception("QR code size wasn't set.");
            }
            
            // Step 2 - Generate & Return File Name
            
            return $prefix . "-" . $hashDigest . "-" . $codeSize . "." .
                $extension;
        }
        
        /**
         * Generates & returns a file location for a provided value.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2019 All Rights Reserved
         * @version   1.0.0
         * 
         * @param string $value
         *   Value that should be used for generating the QR code.
         * @return string
         *   Hash digest of a provided value.
         */
        
        public function getFileLocation($value)
        {
            // Core Variables
            
            $fileName         = $this->getFileName($value);
            $storageDirectory = $this->getStorageDirectory();
            
            // Logic
            
            if ($storageDirectory == null)
            {
                return "." . DIRECTORY_SEPARATOR . $this->getFileName($value);
            }
            
            return join(DIRECTORY_SEPARATOR, [
                $storageDirectory,
                $fileName
            ]);
        }
        
        /**
         * Returns the encoded value of a generated QR code from a given value.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2019 All Rights Reserved
         * @version   1.0.0
         * 
         * @param string $value
         *   Value that was used to generate the QR code.
         * @param integer $encoding
         *   ID of an encoding that should be used.
         * @return string
         *   Encoded value of the QR code in a selected encoding format.
         */
        
        public function getEncodedValue($value, $encoding = 1)
        {
            // Core Variables
            
            $encoder      = null;
            $fileLocation = $this->getFileLocation($value);
            
            // Step 1 - 
            
            switch ($encoding)
            {
                case 0:
                    $encoder = new Base16();
                    break;
                
                case 1:
                    $encoder = new Base32();
                    break;
                
                case 2:
                    $encoder = new Base64();
                    break;
                
                default:
                    throw new \Exception("Invalid encoding ID provided.");
            }
            
            // Step 2 - Encode Generated Code
            
            return $encoder->encode($this->loadFromFile($fileLocation));
        }
        
        /***************\
        |* SET METHODS *|
        \***************/
        
        /**
         * Sets QR code size - width and height.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2019 All Rights Reserved
         * @version   1.0.0
         * 
         * @param integer $qrCodeSize
         *   Size of the QR codes that should be generated.
         * @return void
         */
        
        public function setQrCodeSize($qrCodeSize)
        {
            // Logic
            
            if (!is_numeric($qrCodeSize))
            {
                throw new \Exception("Invalid value provided.");
            }
            
            $this->qrCodeSize = $qrCodeSize;
        }
        
        /**
         * Sets directory used for storing generated QR codes.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2019 All Rights Reserved
         * @version   1.0.0
         * 
         * @param string $directory
         *   Directory for storing generated QR codes.
         * @return void
         */
        
        public function setStorageDirectory($storageDirectory)
        {
            // Logic
            
            if (!is_string($storageDirectory))
            {
                throw new \Exception("Invalid storage directory used.");
            }
            
            $this->storageDirectory = $storageDirectory;
        }
        
        /****************\
        |* CORE METHODS *|
        \****************/
        
        /**
         * Loads contents from a desired file.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2019 All Rights Reserved
         * @version   1.0.0
         * 
         * @param string $fileLocation
         *   File location that should be used for loading.
         * @param integer $bufferSize
         *   Buffer size in bytes that will be used for loading.
         * @param bool $suppressException
         *   Value <i>TRUE</i> if you want to suppress exception, and vice versa.
         * @return string
         *   Contents of a desired file.
         */
        
        public function loadFromFile($fileLocation, $bufferSize = 1024,
            $suppressException = false)
        {
            // Core Variables
            
            $fileHandler = null;
            $contents    = "";
            
            // Logic
            
            try
            {
                $fileHandler = fopen($fileLocation, "r");
                
                while (!feof($fileHandler))
                {
                    $contents .= fread($fileHandler, $bufferSize);
                }
            }
            catch (\Exception $e)
            {
                if (!$suppressException)
                {
                    throw new \Exception("An unkown IO error occured.");
                }
            }
            finally
            {
                if ($fileHandler != null)
                {
                    fclose($fileHandler);
                }
            }
            
            return $contents;
        }
        
        /**
         * Saves contents to a desired file location.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2019 All Rights Reserved
         * @version   1.0.0
         * 
         * @param string $fileLocation
         *   File location that should be used for saving.
         * @param mixed $contents
         *   Contents that should be saved to a desired file.
         * @param bool $suppressException
         *   Value <i>TRUE</i> if you want to suppress exception, and vice versa.
         * @return bool
         *   Value <i>TRUE</i> if data was saved, and vice versa.
         */
        
        public function saveToFile($fileLocation, $contents,
            $suppressException = false)
        {
            // Core Variables
            
            $fileHandler  = null;
            $bytesWritten = 0;
            
            // Logic
            
            try
            {
                $fileHandler  = fopen($fileLocation, "w");
                $bytesWritten = fwrite($fileHandler, $contents);
            }
            catch (\Exception $e)
            {
                if (!$suppressException)
                {
                    throw new \Exception("An unkown IO error occured.");
                }
            }
            finally
            {
                if ($fileHandler != null)
                {
                    fclose($fileHandler);
                }
            }
            
            return $bytesWritten > 0;
        }
        
        /**
         * Removes a file on the specified file location.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2019 All Rights Reserved
         * @version   1.0.0
         * 
         * @param string $fileLocation
         *   File location that should be used for saving.
         * @param bool $suppressException
         *   Value <i>TRUE</i> if you want to suppress exception, and vice versa.
         * @return bool
         *   Value <i>TRUE</i> if file was removed, and vice versa.
         */
        
        public function removeFile($fileLocation, $suppressException = false)
        {
            // Logic
            
            try
            {
                unlink($fileLocation);
            }
            catch (\Exception $e)
            {
                if (!$suppressException)
                {
                    throw new \Exception("An unkown IO error occured.");
                }
            }
        }
        
        /*****************\
        |* CHECK METHODS *|
        \*****************/
        
        /**
         * Checks if QR code was generated from a provided value.
         * 
         * @author    Djordje Jocic <office@djordjejocic.com>
         * @copyright 2019 All Rights Reserved
         * @version   1.0.0
         * 
         * @param string $value
         *   Value that was used to generate the QR code.
         * @return bool
         *   Value <i>TRUE</i> if QR code was generated, and vice versa.
         */
        
        public function isQrCodeGenerated($value)
        {
            // Core Variables
            
            $fileLocation = $this->getFileLocation($value);
            
            // Logic
            
            return is_file($fileLocation);
        }
        
        /*****************\
        |* OTHER METHODS *|
        \*****************/
        
        // OTHER METHODS GO HERE
    }
    
?>
