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

require_once dirname(__FILE__) . "/Base.php"; 

class LimberSpec_Matcher_Be extends LimberSpec_Matcher_Base
{
    public function failure_message()
    {
        return "The value should be " . $this->var_dump($this->expected) . ", got " . $this->var_dump($this->against);
    }
    
    public function match()
    {
        return ($this->against === $this->expected);
    }
}
