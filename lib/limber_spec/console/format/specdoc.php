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

namespace LimberSpec\Console\Format;

require_once "limber_spec/console/format/base.php";
require_once "limber_spec/console/color.php";

class Specdoc extends Base
{
	const LEVEL_SIZE = 2;
	
	private $passing;
	private $failing;
	private $pending;
	
	private $failure_details;
	
	private $buffer;
	
	public function __construct($results)
	{
		parent::__construct($results);
		
		$this->passing = $this->failing = $this->pending = 0;
		$this->failure_details = array();
		$this->buffer = "";
	}
	
	public function output()
	{
		foreach ($this->results as $suite) {
			$this->print_context($suite);
		}

		$this->buffer .= "\n%r";

		foreach ($this->failure_details as $key => $spec) {
			$n = $key + 1;

			$this->buffer .= "{$n}: {$spec["description"]}\n";
			$this->buffer .= "  " . $spec["failure_message"] . "\n";
		}

		$this->buffer .= "%0";

		$total = $this->passing + $this->failing + $this->pending;

		$this->buffer .= "\n";
		$this->buffer .= "%b%s$total examples%0, %g%s$this->passing success%0";
		if ($this->failing > 0) $this->buffer .= ", %r%s$this->failing failures%0";
		if ($this->pending > 0) $this->buffer .= ", %y%s$this->pending pending%0";
		$this->buffer .= "\n";
		
		return \LimberSpec\Console\Color::parse($this->buffer);
	}
	
	private function indent($level = 0)
	{
		$this->buffer .= str_repeat(" ", $level * self::LEVEL_SIZE);
	}
	
	private function print_context($context, $level = 0)
	{
		$this->indent($level);
		
		$this->buffer .= "%c{$context["description"]}%0";
		$this->buffer .= "\n";

		foreach ($context["items"] as $item) {
			$fn = "print_" . $item["kind"];
			call_user_func(array($this, $fn), $item, $level + 1);
		}
	}

	private function print_spec($spec, $level = 0)
	{
		$this->indent($level);

		if ($spec["pass"]) {
			$this->passing++;
		} else {
			$this->failing++;
		}

		$this->buffer .= $spec["pass"] ? '%g' : '%r';
		$this->buffer .= $spec["description"];

		if (!$spec["pass"]) {
			$this->failure_details[] = $spec;
			$this->buffer .= " (FAILED)";
		}

		$this->buffer .= "%0\n";
	}

	private function print_pending($spec, $level = 0)
	{
		$this->pending++;

		$this->indent($level);

		$this->buffer .= "%y";
		$this->buffer .= $spec["description"] . " (PENDING)";
		$this->buffer .= "%0\n";
	}
}
