<?php
/**
 * Created by PhpStorm.
 * User: AHMED
 */

function get_stub($type)
{
    return file_get_contents(dirname(__DIR__) . '/../stubs/' . $type . '.stub');
}