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

require_once "limber_support.php";
add_include_path(dirname(__FILE__));

require_once 'limber_spec/context.php';

function describe($description, $block)
{
	new LimberSpec($description, $block);
}

class LimberSpec
{
	private $main_context;
	private static $suites = array();
	
	public function __construct($description, $block)
	{
		$this->main_context = new LimberSpec\Context($description, $block);
		
		self::$suites[] = $this;
	}
	
	public function run()
	{
		return $this->main_context->run();
	}
	
	public static function run_all()
	{
		return array_invoke(self::$suites, 'run');
	}
}
