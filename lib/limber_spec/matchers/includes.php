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
	public static function name()
	{
		return array("includes", "include");
	}
	
	public function failure_message()
	{
		return "expected " . $this->var_dump($this->actual) . " to include " . $this->var_dump($this->expected);
	}
	
	public function failure_message_for_should_not()
	{
		return "expected " . $this->var_dump($this->actual) . " to exclude " . $this->var_dump($this->expected);
	}
	
	public function set_args()
	{
		$args = func_get_args();
		
		$this->expected = count($args) > 1 ? array_flatten($args) : $args[0];
	}
	
	public function match()
	{
		if (is_array($this->expected)) {
			$actual = $this->actual;
			
			return array_all($this->expected, function($item) use ($actual) {
				return in_array($item, $actual);
			});
		} else {
			return in_array($this->expected, $this->actual);
		}
	}
}

\LimberSpec\Matcher::add_matcher("\\LimberSpec\\Matchers\\Includes");
