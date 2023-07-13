<?php

use PHPUnit\Framework\TestCase;
use FurkanAlkan\UTS;

class UTSTest extends TestCase
{
    private $uts;

    protected function setUp(): void
    {
        $this->uts = new UTS(['token' => 'test-token', 'test' => true]);
    }

    public function testSetAndGetErrorReporting()
    {
        $this->uts->setErrorReporting('E_ALL');
        $this->assertSame('E_ALL', $this->uts->getErrorReporting());
    }

    public function testSetAndGetDisplayErrors()
    {
        $this->uts->setDisplayErrors(1);
        $this->assertSame(1, $this->uts->getDisplayErrors());
    }

    // Test other methods here...

    protected function tearDown(): void
    {
        $this->uts = NULL;
    }
}