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

class Includes
{
	private $actual;
	private $expected;
	
	public function __construct($actual)
	{
		$this->actual = $actual;
	}
	
	public function failure_message()
	{
		return "expected " . var_dump($this->actual) . " to include " . implode(", ", array_map("LimberSpec\\Matchers\\var_dump", $this->expected));
	}
	
	public function failure_message_for_should_not()
	{
		return "expected " . var_dump($this->actual) . " to exclude " . implode(", ", array_map("LimberSpec\\Matchers\\var_dump", $this->expected));
	}
	
	public function match()
	{
		$this->expected = func_get_args();
		
		if (is_array($this->expected)) {
			$actual = $this->actual;
			
			if (!is_array($actual)) return false;
			
			return array_all($this->expected, function($item) use ($actual) {
				return in_array($item, $actual);
			});
		} else {
			return in_array($this->expected, $this->actual);
		}
	}
}

\LimberSpec\Matcher::add_matcher("\\LimberSpec\\Matchers\\Includes", array("includes", "include"));
