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

class Satisfy
{
	private $actual;
	
	public function __construct($actual)
	{
		$this->actual = $actual;
	}
	
	public function failure_message()
	{
		return "expected " . var_dump($this->actual) . " to satisfy the block";
	}
	
	public function match($block)
	{
		return $block($this->actual);
	}
}

\LimberSpec\Matcher::add_matcher("\\LimberSpec\\Matchers\\Satisfy");
