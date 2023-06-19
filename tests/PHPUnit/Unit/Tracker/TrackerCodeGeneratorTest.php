<?php
/**
 * Matomo - free/libre analytics platform
 *
 * @link https://matomo.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Tests\Unit\Tracker;

use Piwik\Tests\Framework\TestCase\UnitTestCase;
use Piwik\Tracker\TrackerCodeGenerator;

class TrackerCodeGeneratorTest extends UnitTestCase
{
    public function test_getDomainName_with_single_tld()
    {
        $this->assertEquals('foobar.com', TrackerCodeGenerator::getDomainName('foobar.com'));
        $this->assertEquals('foobar.com', TrackerCodeGenerator::getDomainName('www.foobar.com'));
        $this->assertEquals('foobar.com', TrackerCodeGenerator::getDomainName('hello.foobar.com'));
        $this->assertEquals('foobar.com', TrackerCodeGenerator::getDomainName('hello.world.foobar.com'));
    }

    public function test_getDomainName_with_two_tld()
    {
        $this->assertEquals('foobar.co.jp', TrackerCodeGenerator::getDomainName('foobar.co.jp'));
        $this->assertEquals('foobar.co.jp', TrackerCodeGenerator::getDomainName('www.foobar.co.jp'));
        $this->assertEquals('foobar.co.jp', TrackerCodeGenerator::getDomainName('hello.foobar.co.jp'));
        $this->assertEquals('foobar.co.jp', TrackerCodeGenerator::getDomainName('hello.world.foobar.co.jp'));
    }
}
