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

namespace LimberSpec\Console;

/**
 * LimberSpec_Console_Args class
 */

/**
 * This class gives the support for reading console user arguments
 */
class Args
{
	private $args;
	private $files;
	private $options;
	
	private static $options_arity = array(
		
	);
	
	public function __construct()
	{
		$this->args = $_SERVER['argv'];
		$this->files = array();
		$this->options = array();
		
		$this->parse();
	}
	
	/**
	 * Get the list of files to parse specs
	 *
	 * @return array
	 */
	public function files()
	{
		return $this->files;
	}
	
	/**
	 * Get the formater to use when outputting results
	 *
	 * @return LimberSpec_Console_Format_Base formatter
	 */
	public function formater($results)
	{
		$formater = $this->option("format", "simple");
		$class_name = "\\LimberSpec\\Console\\Format\\" . ucfirst($formater);
		
		require_once dirname(__FILE__) . "/format/{$formater}.php";
		
		return new $class_name($results);
	}
	
	public function option($name, $default = false)
	{
		return isset($this->options[$name]) ? $this->options[$name] : $default;
	}
	
	private function parse()
	{
		array_shift($this->args);
		
		foreach ($this->args as $arg) {
			if ($arg[0] == '-') {
				$this->options[$arg] = true;
			} elseif (is_dir($arg)) {
				$this->scan_dir($arg);
			} else {
				$this->files[] = $arg;
			}
		}
	}

	private function scan_dir($path)
	{
		$dir = opendir($path);
		
		while ($file = readdir($dir)) {
			if ($file == '.' || $file == '..') continue;
			
			$fullpath = $path . '/' . $file;
			
			if (is_dir($fullpath) && $this->option("-r")) {
				$this->scan_dir($fullpath);
				continue;
			}
			
			if (preg_match("/_spec\.php$/i", $file)) {
				$this->files[] = $fullpath;
			}
		}
	}
}
