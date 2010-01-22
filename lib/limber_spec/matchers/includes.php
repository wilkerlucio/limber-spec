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

namespace LimberSpec\Matchers;

require_once "limber_spec/matchers/base.php";

class Includes extends Base
{
	public function failure_message()
	{
		return "The array " . $this->var_dump($this->expected) . ", don't include " . $this->var_dump($this->against);
	}
	
	public function match()
	{
		if (is_array($this->against)) {
			$pass = true;
			
			foreach ($this->against as $item) {
				if (!in_array($item, $this->expected)) $pass = false;
			}
			
			return $pass;
		} else {
			return in_array($this->against, $this->expected);
		}
	}
}

\LimberSpec\Matcher::add_matcher("\\LimberSpec\\Matchers\\Includes");
