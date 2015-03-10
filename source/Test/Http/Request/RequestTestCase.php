<?php

namespace Protocol\Test\Http\Request;

use Protocol\Http\Request\File;
use Protocol\Http\Request\Request;
use Protocol\Test\AbstractTestCase;

class RequestTestCase extends AbstractTestCase
{

    /**
     * @covers \Protocol\Http\Request\Request::getFiles
     * @covers \Protocol\Http\Request\Request::setFiles
     */
    public function testGetSetFiles()
    {
        $request = new Request();

        $request->setFiles($files = [
            'foo' => $foo = [
                'bar' => $bar = [
                    new File('bar1'),
                    new File('bar2'),
                    new File('bar3')
                ],
                'baz' => $baz = new File('baz')
            ],
            'qux' => $qux = [
                'a' => new File('quxA'),
                'b' => new File('quxB'),
                'c' => new File('quxC')
            ]
        ]);

        // Verify getting files works as expected.

        $this->assertSame($files, $request->getFiles());
        $this->assertSame(array_merge($bar, [$baz], array_values($qux)), $request->getFiles(null, true));

        $this->assertSame($foo, $request->getFiles('foo', false));
        $this->assertSame(array_merge($bar, [$baz]), $request->getFiles('foo'));
        $this->assertSame(array_merge($bar, [$baz]), $request->getFiles('foo', true));

        $this->assertSame($bar, $request->getFiles(['foo', 'bar'], false));
        $this->assertSame($bar, $request->getFiles(['foo', 'bar']));
        $this->assertSame($bar, $request->getFiles(['foo', 'bar'], true));

        // Verify setting files also works as expected.

        $request->setFiles($qux = ['a' => ['b' => ['c' => $quxC = new File('quxC')]]], 'qux');

        $this->assertSame($qux, $request->getFiles('qux', false));
        $this->assertSame([$quxC], $request->getFiles('qux'));
        $this->assertSame([$quxC], $request->getFiles('qux', true));

        // Verify the empty file tree gets removed all the way to the top.

        $request->setFiles([], ['qux', 'a', 'b', 'c']);

        $this->assertSame([], $request->getFiles('qux', false));
        $this->assertSame([], $request->getFiles('qux'));
        $this->assertSame([], $request->getFiles('qux', true));
    }
}