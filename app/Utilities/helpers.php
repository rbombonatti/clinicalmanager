<?php
declare(strict_types=1);

if (! function_exists('real_to_float')) {
    /**
     * Trasforma um valor em real em float.
     *
     * @param $string
     * @param $multiply
     *
     * @return float
     */
    function real_to_float($string, $multiply = 1): float
    {
        $string = preg_replace('/[^0-9,]/', '', $string);

        return (float) preg_replace('/,/', '.', $string) * $multiply;
    }
}
