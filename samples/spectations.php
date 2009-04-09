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
    $spec->context("testing 'be' spectations", function($spec) {
        $spec->it("should test for true value", function($spec) {
            $spec(true)->should->be(true);
        });
        
        $spec->it("should give an error for false be true", function($spec) {
            $spec(false)->should->be(true);
        });
        
        $spec->it("should pass when comparing equal strings", function($spec) {
            $spec("im the string")->should->be("im the string");
        });
        
        $spec->it("should fail when comparing different strings", function($spec) {
            $spec("im the string")->should->be("im the different string");
        });
        
        $spec->it("should fail when comparing strings and numbers (with same string result)", function($spec) {
            $spec("30")->should->be(30);
        });
        
        $spec->it("should pass when comparing equal numbers", function($spec) {
            $spec(30)->should->be(30);
        });
        
        $spec->it("should fail when comparing different numbers", function($spec) {
            $spec(30)->should->be(31);
        });
        
        $spec->it("should fail when comparing same numbers with different types", function($spec) {
            $spec(30)->should->be(30.0);
        });
    });
});
