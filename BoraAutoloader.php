<?php
/*
 * The MIT License (MIT)
 *
 * Copyright (c) 2023 ILEBORA
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

/**
 * ILEBORA Bora Autoloader
 * 
 * A simple autoloader that loads class files from Bora folder structure
 *
 * @package Autoloader
 * @license http://opensource.org/licenses/MIT  MIT License
 * @author  ILEBORA <info@ilebora.com>
 */

class BoraAutoloader{
    /**
     * File extension as a string. Defaults to ".php".
     */
    protected static $sourcesFolder = 'src/';
    protected static $fileExt = '.php';

    public static function loader($className){
        $filename = static::$sourcesFolder.$className . static::$fileExt;
        $filename = str_replace("/" , DIRECTORY_SEPARATOR, $filename);
        $filename = str_replace("\\" , DIRECTORY_SEPARATOR, $filename);

        $filename = __DIR__.DIRECTORY_SEPARATOR.$filename;
        // print_r(__DIR__.DIRECTORY_SEPARATOR.''.$filename);

        if(file_exists($filename)){
            // print_r('test');
            require($filename);
        }
    }

    public static function setFileExt($fileExt){
        static::$fileExt = $fileExt;
    }


}
function reqToVar($file = null, $args = []){
    ob_start();

    extract($args);
    
    if($file){
        require($file);
        return ob_get_clean();
    }
}


BoraAutoloader::setFileExt('.php');
spl_autoload_register('BoraAutoloader::loader');

// EOF
