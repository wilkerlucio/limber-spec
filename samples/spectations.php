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

describe("Limber-Spec", function($spec) {
    $spec->it("should show as pending when there is no given function");
    
    $spec->context("testing 'be' spectations", function($spec) {
        $spec->it("should test for true value", function($spec) {
            $spec(true)->should->be(true);
        });
        
        $spec->it("should fail when comparing false to be true", function($spec) {
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
        
        $spec->it("should pass when comparing arrays with equal data", function($spec) {
            $spec(array("one", "two", "three"))->should->be(array("one", "two", "three"));
        });
        
        $spec->it("should fail when comparing arrays with different data", function($spec) {
            $spec(array("one", "two", "three"))->should->be(array("one", "two", "three", "four"));
        });
    });
    
    $spec->context("testing 'include' spectations", function ($spec) {
        $spec->it("should pass if the array contains the element", function($spec) {
            $spec(array("one", "two", "three"))->should->include("two");
        });
        
        $spec->it("should fail if the array don't contains the element", function($spec) {
            $spec(array("one", "two", "three"))->should->include("four");
        });
        
        $spec->it("should pass if multiple elements are contained at array", function($spec) {
            $spec(array("one", "two", "three"))->should->include(array("one", "three"));
        });
    });
    
    $spec->context("testing 'rematch' spectations", function($spec) {
        $spec->it("should pass when matching a valid regular expression", function($spec) {
            $spec("limber spec is cool")->should->rematch("/co{2}l$/");
        });
        
        $spec->it("should fail when don't match with an valid regular expression", function($spec) {
            $spec("limber spec is cool")->should->rematch("/ca{2}l$/");
        });
    });
});
