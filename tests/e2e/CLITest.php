<?php

namespace Utopia\Tests;

use PHPUnit\Framework\TestCase;
use Utopia\CLI\CLI;
use Utopia\Platform\Service;

class CLITest extends TestCase
{
    public function setUp(): void
    {
    }

    public function tearDown(): void
    {
    }

    public function testCLISetup()
    {
        ob_start();

        $cli = new CLI(['test.php', 'build', '--email=me@example.com', '--list=item1', '--list=item2']); // Mock command request

        $platform = new TestPlatform();
        $platform->setCli($cli);
        $platform->init(Service::TYPE_CLI);

        $cli = $platform->getCli();
        $cli->run();

        $result = ob_get_clean();

        $this->assertEquals('me@example.com-item1-item2', $result);
        $this->assertCount(2, $cli->getTasks());
    }
}
