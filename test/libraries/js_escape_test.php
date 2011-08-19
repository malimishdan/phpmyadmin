<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * tests for JS variable formatting
 *
 * @package phpMyAdmin-test
 */

/*
 * Include to test.
 */
require_once 'libraries/js_escape.lib.php';

class PMA_File_test extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider variables
     */
    public function testFormat($key, $value, $expected)
    {
        $arr = new PMA_File($file);
        $this->assertEquals($expected, PMA_getJsValue($key, $value));
    }

    public function variables() {
        return array(
            array('foo', true, "foo = true;\n"),
            array('foo', false, "foo = false;\n"),
            array('foo', 100, "foo = 100;\n"),
            array('foo', 0, "foo = 0;\n"),
            array('foo', 'text', "foo = \"text\";\n"),
            array('foo', 'quote"', "foo = \"quote\\\"\";\n"),
            array('foo', 'apostroph\'', "foo = \"apostroph\\'\";\n"),
            );
    }
}
?>
