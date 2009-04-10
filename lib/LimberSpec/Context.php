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

require_once dirname(__FILE__) . '/Spec.php';
require_once dirname(__FILE__) . '/Data.php';

class LimberSpec_Context
{
    private $description;
    private $block;
    private $specs;
    
    private $data;
    
    private $before_all;
    private $before_each;
    
    public function __construct($description, $block)
    {
        $this->description = $description;
        $this->block = $block;
        $this->specs = array();
        $this->data = new LimberSpec_Data();
        $this->before_all = array();
        $this->before_each = array();
    }
    
    public function before_all($block)
    {
        $this->before_all[] = $block;
    }
    
    public function before_each($block)
    {
        $this->before_each[] = $block;
    }
    
    public function it($description, $block = null)
    {
        $this->specs[] = new LimberSpec_Spec($description, $block, $this->data);
    }
    
    public function context($description, $block)
    {
        $this->specs[] = new LimberSpec_Context($description, $block);
    }
    
    public function run()
    {
        $block = $this->block;
        $block($this);
        
        $before_each = $this->before_each;
        $data = $this->data;
        
        foreach ($this->before_all as $before) {
            $before($data);
        }
        
        return array(
            "kind" => "context",
            "description" => $this->description,
            "items" => array_map(function($item) use ($before_each, &$data) {
                foreach ($before_each as $before) {
                    $before($data);
                }
                
                return $item->run();
            }, $this->specs)
        );
    }
}
