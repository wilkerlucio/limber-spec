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

namespace LimberSpec;

class Matcher
{
	private static $matchers = array();
	private $current;
	private $matcher;
	private $negate;
	private $args;
	
	public function __construct($current)
	{
		$this->current = $current;
		$this->negate = false;
	}
	
	public static function add_matcher($matcher, $names = null)
	{
		if ($names === null) $names = str_underscore(str_demodulize($matcher));
		if (!is_array($names)) $names = array($names);
		
		foreach ($names as $name) {
			self::$matchers[$name] = $matcher;
		}
	}
	
	public function match()
	{
		$result = call_user_func_array(array($this->matcher, "match"), $this->args);
		
		return $this->negate ? !$result : $result;
	}
	
	public function failure_message()
	{
		if ($this->negate) {
			if (method_exists($this->matcher, "failure_message_for_should_not")) {
				return $this->matcher->failure_message_for_should_not();
			} else {
				return "don't " . $this->matcher->failure_message();
			}
		} else {
			return $this->matcher->failure_message();
		}
	}
	
	public function __get($property)
	{
		if ($property == 'should') {
			return $this;
		}
		
		if ($property == 'should_not') {
			$this->negate = true;
			return $this;
		}
	}
	
	public function __call($method, $args)
	{
		if (isset(self::$matchers[$method])) {
			$class_name = self::$matchers[$method];
			$class = new $class_name($this->current);
			
			$this->args = $args;
			$this->matcher = $class;
			
			return $class;
		} else {
			throw new MatcherNotFoundException("Matcher '{$method}' was not found");
		}
	}
}

class MatcherNotFoundException extends \Exception {}

require_dir(__DIR__ . "/matchers");
