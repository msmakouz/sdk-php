<?php

/**
 * This file is part of Temporal package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Temporal\Tests\Unit\Interceptor;

use Temporal\DataConverter\DataConverter;
use Temporal\DataConverter\DataConverterInterface;
use Temporal\Interceptor\Header;
use Temporal\Tests\Unit\UnitTestCase;

/**
 * @group unit
 * @group interceptor
 */
class HeaderTestCase extends UnitTestCase
{
    public function testToHeaderFromValuesWithoutConverterException(): void
    {
        $header = Header::empty()->withValue('foo', 'bar');

        $this->assertCount(1, $header);
        $this->assertSame('bar', $header->getValue('foo'));

        $this->expectException(\LogicException::class);
        $header->toHeader();
    }

    public function testToHeaderFromValuesWithConverter(): void
    {
        $converter = $this->getDataConverter();
        $header = Header::empty()->withValue('foo', 'bar');
        $header->setDataConverter($converter);

        $this->assertCount(1, $header);
        $this->assertSame('bar', $header->getValue('foo'));

        $header->toHeader();
        $collection = $header->toHeader()->getFields();
        $this->assertCount(1, $collection);
        $this->assertSame('bar', $converter->fromPayload($collection->offsetGet('foo'), null));
    }

    public function testWithValueImmutability(): void
    {
        $source = Header::empty();

        $collection = $source->withValue('foo', 'bar');

        $this->assertCount(1, $collection);
        $this->assertSame('bar', $collection->getValue('foo'));
        // Immutability
        $this->assertNotSame($collection, $source);
    }

    /**
     * @dataProvider fromValuesProvider()
     */
    public function testFromValues(array $input, array $output): void
    {
        $collection = Header::fromValues($input);

        $this->assertSame($output, \iterator_to_array($collection->getIterator()));
    }

    public function testOverwriteProtoWithValue(): void
    {
        $header = Header::fromValues(['foo' => 'bar']);
        $header->setDataConverter($this->getDataConverter());
        $protoCollection = $header->toHeader()->getFields();

        $header = Header::fromPayloadCollection($protoCollection, $this->getDataConverter());

        // Check
        $this->assertSame('bar', $header->getValue('foo'));

        // Overwrite `foo` value
        $this->assertCount(1, $header);
        $header = $header->withValue('foo', 'baz');

        $this->assertCount(1, $header);
        $this->assertSame('baz', $header->getValue('foo'));
    }

    public function testProtoWithValue(): void
    {
        $header = Header::fromValues(['foo' => 'bar']);
        $header->setDataConverter($this->getDataConverter());
        $protoCollection = $header->toHeader()->getFields();

        $header = Header::fromPayloadCollection($protoCollection, $this->getDataConverter())
            ->withValue('baz', 'qux');

        // Overwrite `foo` value
        $this->assertCount(2, $header);
        $this->assertSame('bar', $header->getValue('foo'));
        $this->assertSame('qux', $header->getValue('baz'));
    }

    public function testEmptyHeaderToProtoPackable(): void
    {
        $collection = Header::empty();

        $header = $collection->toHeader();
        $header->serializeToString();
        // There is no exception
        $this->assertTrue(true);
    }

    public function testHeaderFromValuesToProtoPackable(): void
    {
        $converter = $this->getDataConverter();
        $header = Header::fromValues(['foo' => 'bar']);
        $header->setDataConverter($converter);

        $collection = $header->toHeader()->getFields();
        $this->assertCount(1, $collection);
        $this->assertSame('bar', $converter->fromPayload($collection->offsetGet('foo'), null));
    }

    public function fromValuesProvider(): iterable
    {
        yield [
            ['foo' => 'bar', 'bar' => 'baz', 'baz' => 'foo'],
            ['foo' => 'bar', 'bar' => 'baz', 'baz' => 'foo'],
        ];

        yield [
            [1 => 'bar', 2 => 4, 3 => 0.5],
            [1 => 'bar', 2 => '4', 3 => '0.5'],
        ];

        yield [
            ['foo' => null, 'bar' => new class implements \Stringable {
                public function __toString(): string
                {
                    return 'baz';
                }
            }, 'baz' => false],
            ['foo' => '', 'bar' => 'baz', 'baz' => ''],
        ];
    }

    private function getDataConverter(): DataConverterInterface
    {
        return DataConverter::createDefault();
    }
}
