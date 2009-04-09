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

describe("Some test spectations", function($spec) {
    $spec->context("testing some assertions", function($spec) {
        $spec->it("should test for true value", function($spec) {
            $spec(true)->should->be(true);
        });
        
        $spec->it("should give an error for false be true", function($spec) {
            $spec(false)->should->be(true);
        });
    });
});
