<?php

namespace CarlosCGO\LaravelTwitterStreaming\Test;

use TwitterStreaming;
use CarlosCGO\TwitterStreaming\UserStream;
use CarlosCGO\TwitterStreaming\PublicStream;

class FacadeTest extends TestCase
{
    /** @test */
    public function it_can_return_a_public_stream()
    {
        $this->assertInstanceOf(PublicStream::class, TwitterStreaming::publicStream());
    }

    /** @test */
    public function it_can_return_a_user_stream()
    {
        $this->assertInstanceOf(UserStream::class, TwitterStreaming::userStream());
    }
}
