<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Helpers\TimeHelper;
use Ramsey\Uuid\Type\Time;

class TimeHelperTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_fail_with_too_much_seconds()
    {
        $this->expectException(\Exception::class);
        new TimeHelper(25 * 3600);
    }

    public function test_fail_wrong_time()
    {
        $this->expectException(\Exception::class);
        new TimeHelper('25:00');
    }

    public function test_good_seconds()
    {
        $helper = new TimeHelper(24 * 3599);
        $this->assertEquals('23:59', $helper->getHumanReadable());
    }

    public function test_good_time()
    {
        $helper = new TimeHelper('11:04');
        $this->assertEquals((11 * 3600) + (4 * 60), $helper->getDatabaseTime());
    }
}
