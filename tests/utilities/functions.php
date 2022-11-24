<?php

/**
 *
 * @param [type] $class
 * @param array $atributes
 * @param [type] $times
 * @return void
 */
function create($class, $atributes = [], $times = null)
{
    return factory($class, $times)->create($atributes);
}

/**
 *
 * @param $class
 * @param array $atributes
 * @param $times
 * @return void
 */
function make($class, $atributes = [], $times = null)
{
    return factory($class, $times)->make($atributes);
}
