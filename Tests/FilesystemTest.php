<?php
/**
 * Created by Canan Etaigbenu
 * User: canaan5
 * Date: 4/13/16
 * Time: 2:49 AM.
 */
use Innovating\Filesystem;

class FilesystemTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->filesystem = new Filesystem();

        $this->filesystem->delete(__DIR__.'/stubs/test.txt');
        $this->filesystem->put(__DIR__.'/stubs/test.txt', 'hello');

        $this->file = __DIR__.'/stubs/test.txt';
    }

    public function testInstance()
    {
        $this->assertInstanceOf('\\Innovating\\Filesystem', $this->filesystem);
    }

    public function testIsFile()
    {
        $this->assertTrue($this->filesystem->isFile($this->file));
    }

    public function testIsDir()
    {
        $this->assertTrue($this->filesystem->isDir(__DIR__));
    }

    public function testMakeDirectory()
    {
        $this->assertTrue($this->filesystem->makeDir(__DIR__.'/test'));
    }

    public function testDeleteDirectory()
    {
        $this->assertTrue($this->filesystem->deleteDir(__DIR__.'/test'));
    }

    public function testgetContent()
    {
        $this->assertEquals('hello', $this->filesystem->get($this->file));
    }

    public function testPutContent()
    {
        $this->filesystem->append($this->file, ' world');
        $this->assertEquals('hello world', $this->filesystem->get($this->file, ' world'));
    }

    public function testTimeFileWasLastModified()
    {
        $this->assertTrue(time() > $this->filesystem->timeModified(__DIR__.'/stubs/test2'));
        $this->assertLessThan(time(), $this->filesystem->timeModified(__DIR__.'/stubs/test2'));
    }
}
