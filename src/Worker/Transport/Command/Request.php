<?php

/**
 * This file is part of Temporal package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Temporal\Worker\Transport\Command;

use Temporal\DataConverter\EncodedValues;
use Temporal\DataConverter\ValuesInterface;
use Temporal\Interceptor\Header;
use Temporal\Interceptor\HeaderInterface;

/**
 * Carries request to perform host action with payloads and failure as context. Can be cancelled if allows
 *
 * @psalm-import-type RequestOptions from RequestInterface
 * @psalm-immutable
 */
class Request extends Command implements RequestInterface
{
    protected ValuesInterface $payloads;
    protected ?HeaderInterface $header = null;
    protected ?\Throwable $failure = null;

    /**
     * @param string $name
     * @param RequestOptions $options
     * @param ValuesInterface|null $payloads
     * @param int|null $id
     * @param HeaderInterface|null $header
     * @param int<0, max> $historyLength
     */
    public function __construct(
        protected string $name,
        protected array $options = [],
        ValuesInterface $payloads = null,
        int $id = null,
        ?HeaderInterface $header = null,
        private int $historyLength = 0,
    ) {
        $this->payloads = $payloads ?? EncodedValues::empty();
        $this->header = $header ?? Header::empty();

        parent::__construct($id);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return RequestOptions
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @return ValuesInterface
     */
    public function getPayloads(): ValuesInterface
    {
        return $this->payloads;
    }

    /**
     * @param \Throwable|null $failure
     */
    public function setFailure(?\Throwable $failure): void
    {
        $this->failure = $failure;
    }

    /**
     * @return \Throwable|null
     */
    public function getFailure(): ?\Throwable
    {
        return $this->failure;
    }

    /**
     * @return Header
     */
    public function getHeader(): Header
    {
        return $this->header;
    }

    public function withHeader(HeaderInterface $header): self
    {
        $clone = clone $this;
        $clone->header = $header;
        return $clone;
    }

    /**
     * @return int<0, max>
     */
    public function getHistoryLength(): int
    {
        return $this->historyLength;
    }
}
