<?php

/*
 * Copyright 2009 Limber Framework
 * 
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * 
 *     http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License. 
 */

/**
 * LimberSpec_Console_Args class
 */

/**
 * This class gives the support for reading console user arguments
 */
class LimberSpec_Console_Args
{
    private $args;
    private $files;
    
    public function __construct()
    {
        $this->args = $_SERVER['argv'];
        $this->files = array();
        
        $this->parse();
    }
    
    /**
     * Get the list of files to parse specs
     *
     * @return array
     */
    public function files()
    {
        return $this->files;
    }
    
    /**
     * Get the formater to use when outputting results
     *
     * @return LimberSpec_Console_Format_Base formatter
     */
    public function formater($results)
    {
        require_once dirname(__FILE__) . "/Format/Specdoc.php";
        
        return new LimberSpec_Console_Format_Specdoc($results);
    }
    
    private function parse()
    {
        array_shift($this->args);
        
        foreach ($this->args as $arg) {
            $this->files[] = $arg;
        }
    }
}