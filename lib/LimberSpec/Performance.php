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

/**
 * LimberSpec_Performance Class
 */

/**
 * This class provides helper methods for performance calculations
 */
class LimberSpec_Performance
{
    /**
     * Calculate the time spended by a given block
     *
     * <code>
     * $elapsed = LimberSpec_Performance::beenchmark(function() {
     *     for ($i = 0; $i < 1000; $i++) {
     *         $a[] = $i * 123;
     *     }
     * });
     *
     * echo "Executed block in {$elapsed} seconds";
     * </code>
     *
     * @param function $block The block to beenchmark
     * @return double Spended time
     */
    public static function beenchmark($block)
    {
        $start_time = microtime(true);
        
        $block();
        
        $end_time = microtime(true);
        
        return $end_time - $start_time;
    }
}
