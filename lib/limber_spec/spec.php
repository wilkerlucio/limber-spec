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

require_once 'limber_spec/matcher.php';

class Spec
{
	private $description;
	private $spec;
	private $matchers;
	private $data;
	
	public function __construct($description, $block = null, $data = null)
	{
		$this->description = $description;
		$this->spec = $block;
		$this->matchers = array();
		$this->data = $data;
	}
	
	public function run()
	{
		$spec = $this->spec;
		
		if ($spec === null) {
			return array(
				"kind" => "pending",
				"description" => $this->description
			);
		}
		
		try {
			$spec($this, $this->data);
		
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
		} catch (Exception $e) {
			return array(
				"kind" => "spec",
				"pass" => false,
				"description" => $this->description,
				"failure_message" => $e->getMessage()
			);
		}
	}
	
	public function __invoke($current)
	{
		$matcher = new Matcher($current);
		$this->matchers[] = $matcher;
		
		return $matcher;
	}
}
