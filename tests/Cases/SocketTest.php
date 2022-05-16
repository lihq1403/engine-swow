<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace HyperfTest\Cases;

use Hyperf\Engine\Socket;

/**
 * @internal
 * @coversNothing
 */
class SocketTest extends AbstractTestCase
{
    /**
     * @group Server
     */
    public function testSocketSendAndRecvAll()
    {
        $socket = (new Socket\SocketFactory())->make(new Socket\SocketOption('127.0.0.1', 9502));
        $socket->sendAll('ping');
        $res = $socket->recvAll(4);
        $this->assertSame('pong', $res);
        usleep(1000);
        $socket->sendAll('Hello World.');
        $res = $socket->recvAll(18);
        $this->assertSame('recv: Hello World.', $res);
    }
}
