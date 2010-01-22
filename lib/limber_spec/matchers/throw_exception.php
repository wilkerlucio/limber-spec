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

class ThrowException extends Base
{
	private $got_exception;
	
	public function failure_message()
	{
		return "Should throw " . $this->var_dump($this->expected) . ", got " . $this->got_exception;
	}
	
	public function match()
	{
		try {
			$method = $this->against;
			$method();
		} catch (\Exception $e) {
			if (get_class($e) == $this->expected) {
				return true;
			} else {
				$this->got_exception = $this->var_dump(get_class($e));
				return false;
			}
		}
		
		$this->got_exception = "no exception";
		
		return false;
	}
}

\LimberSpec\Matcher::add_matcher("\\LimberSpec\\Matchers\\ThrowException");
