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

class LimberSpec_Data
{
    private $data;
    
    public function __construct()
    {
        $this->data = array();
    }
    
    public function __get($property)
    {
        return isset($this->data[$property]) ? $this->data[$property] : null;
    }
    
    public function __set($property, $value)
    {
        $this->data[$property] = $value;
    }
}