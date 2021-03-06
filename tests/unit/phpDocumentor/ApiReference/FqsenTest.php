<?php
/**
 * phpDocumentor
 *
 * PHP Version 5.5
 *
 * @copyright 2010-2015 Mike van Riel / Naenius (http://www.naenius.com)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      http://phpdoc.org
 */

namespace phpDocumentor\ApiReference;

/**
 * Class FqsenTest
 * @coversDefaultClass phpDocumentor\ApiReference\Fqsen
 */
class FqsenTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param string $fqsen
     * @covers ::__construct
     * @dataProvider validFqsenProvider
     */
    public function testValidFormats($fqsen)
    {
        new Fqsen($fqsen);
    }

    /**
     * Data provider for ValidFormats test. Contains a complete list from psr-5 draft.
     *
     * @return array
     */
    public function validFqsenProvider()
    {
        return [
            ['\My\Space'],
            ['\My\Space\myFunction()'],
            ['\My\Space\MY_CONSTANT'],
            ['\My\Space\MyClass'],
            ['\My\Space\MyInterface'],
            ['\My\Space\MyTrait'],
            ['\My\Space\MyClass::myMethod()'],
            ['\My\Space\MyClass::$my_property'],
            ['\My\Space\MyClass::MY_CONSTANT'],
        ];
    }

    /**
     * @param string $fqsen
     * @covers ::__construct
     * @dataProvider invalidFqsenProvider
     * @expectedException \InvalidArgumentException
     */
    public function testInValidFormats($fqsen)
    {
        new Fqsen($fqsen);
    }

    /**
     * Data provider for invalidFormats test. Contains a complete list from psr-5 draft.
     *
     * @return array
     */
    public function invalidFqsenProvider()
    {
        return [
            ['\My\*'],
            ['\My\Space\.()'],
            ['My\Space'],
        ];
    }

    /**
     * @covers ::__construct
     * @covers ::__toString
     */
    public function testToString()
    {
        $className = new Fqsen('\\phpDocumentor\\Application');

        $this->assertEquals('\\phpDocumentor\\Application', (string)$className);
    }
}
