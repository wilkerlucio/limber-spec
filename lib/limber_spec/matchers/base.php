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

function var_dump($data)
{
	$type = gettype($data);
	
	switch ($type) {
		case "string":
			return "'{$data}'";
		case "boolean":
			return $data ? 'true' : 'false';
		case "NULL":
			return 'null';
		case "integer":
			return sprintf("%d", $data);
		case "double":
		case "float":
			return sprintf("%f", $data);
		case "array":
			return 'array(' . implode(', ', array_map('LimberSpec\\Matchers\\var_dump', $data)) . ')';
		case "object":
			return $data->toString();
		default:
			throw new Exception("Unknow type '$type' when dumping data");
	}
}
