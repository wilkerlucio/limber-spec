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

class LimberSpec_Console_Color
{
    private static $RESET = 0;
    
    private static $ATTRIBUTES = array(
        "bold"      => 1,
        "underline" => 4,
        "blink"     => 5,
        "reverse"   => 7,
        "invisible" => 8
    );
    
    private static $FGCOLORS = array(
        "black"   => 30,
        "red"     => 31,
        "green"   => 32,
        "yellow"  => 33,
        "blue"    => 34,
        "magneta" => 35,
        "cyan"    => 36,
        "white"   => 37
    );
    
    private static $BGCOLORS = array(
        "black"   => 40,
        "red"     => 41,
        "green"   => 42,
        "yellow"  => 43,
        "blue"    => 44,
        "magneta" => 45,
        "cyan"    => 46,
        "white"   => 47
    );
    
    private static function translate($symbol)
    {
        $translation_map = array(
            '0' => self::$RESET,
            'k' => self::$FGCOLORS['black'],
            'r' => self::$FGCOLORS['red'],
            'g' => self::$FGCOLORS['green'],
            'y' => self::$FGCOLORS['yellow'],
            'b' => self::$FGCOLORS['blue'],
            'm' => self::$FGCOLORS['magneta'],
            'c' => self::$FGCOLORS['cyan'],
            'w' => self::$FGCOLORS['white'],
            'K' => self::$BGCOLORS['black'],
            'R' => self::$BGCOLORS['red'],
            'G' => self::$BGCOLORS['green'],
            'Y' => self::$BGCOLORS['yellow'],
            'B' => self::$BGCOLORS['blue'],
            'M' => self::$BGCOLORS['magneta'],
            'C' => self::$BGCOLORS['cyan'],
            'W' => self::$BGCOLORS['white'],
            's' => self::$ATTRIBUTES['bold'],
            'u' => self::$ATTRIBUTES['underline']
        );
        
        if (!isset($translation_map[$symbol])) {
            throw new LimberSpec_Console_Color_Exception("Invalid symbol $symbol at parsing");
        }
        
        return $translation_map[$symbol];
    }
    
    /**
     * Parse string and return with respective ansi color codes
     *
     * The parser works with simpler codes preceded by % symbol,
     * the following list show respective codes for changes:
     * 
     * - %% = The percent symbol itself
     * - %0 = Reset formating
     * - %k = Black text color
     * - %r = Red text color
     * - %g = Green text color
     * - %y = Yellow text color
     * - %b = Blue text color
     * - %m = Magneta text color
     * - %c = Cyan text color
     * - %w = White text color
     * - %K = Black background color
     * - %R = Red background color
     * - %G = Green background color
     * - %Y = Yellow background color
     * - %B = Blue background color
     * - %M = Magneta background color
     * - %C = Cyan background color
     * - %W = White background color
     * - %s = Strong text (bold)
     * - %u = Underline
     *
     * Usage example:
     * <code>
     * $my_string = "I'm a %bblue%0, with %g100%%%0";
     * echo LimberSpec_Console_Color::parse($my_string);
     * </code>
     *
     * @param string $string The string to parse
     * @return string
     */
    public static function parse($string)
    {
        $buffer = "";
        
        for ($i = 0; $i < strlen($string); $i++) {
            $char = $string[$i];
            
            if ($char != "%") {
                $buffer .= $char;
                continue;
            }
            
            $char = $string[++$i];
            
            if ($char == '%') {
                $buffer .= "%";
                continue;
            }
            
            $ansi = self::translate($char);
            
            $buffer .= "\033[{$ansi}m";
        }
        
        return $buffer;
    }
}

class LimberSpec_Console_Color_Exception extends Exception {}
