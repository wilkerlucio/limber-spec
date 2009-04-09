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

require_once dirname(__FILE__) . '/Matcher.php';

class LimberSpec_Spec
{
    private $description;
    private $spec;
    private $matchers;
    
    public function __construct($description, $block)
    {
        $this->description = $description;
        $this->spec = $block;
        $this->matchers = array();
    }
    
    public function run()
    {
        $spec = $this->spec;
        $spec($this);
        
        $pass = true;
        $failure_message = null;
        
        foreach ($this->matchers as $matcher) {
            if (!$matcher->match()) {
                $pass = false;
                $failure_message = $matcher->failure_message();
                break;
            }
        }
        
        return array(
            "kind" => "spec",
            "pass" => $pass,
            "description" => $this->description,
            "failure_message" => $failure_message
        );
    }
    
    public function __invoke($current)
    {
        $matcher = new LimberSpec_Matcher($current);
        $this->matchers[] = $matcher;
        
        return $matcher;
    }
}
