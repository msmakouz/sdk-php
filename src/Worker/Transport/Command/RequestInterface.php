<?php

/**
 * This file is part of Temporal package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Temporal\Worker\Transport\Command;

use Temporal\DataConverter\ValuesInterface;
use Temporal\Interceptor\HeaderInterface;
use Temporal\Internal\Interceptor\HeaderCarrier;

/**
 * @psalm-immutable
 * @psalm-type RequestOptions = array<non-empty-string, mixed>
 */
interface RequestInterface extends CommandInterface, HeaderCarrier
{
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return RequestOptions
     */
    public function getOptions(): array;

    /**
     * @return ValuesInterface
     */
    public function getPayloads(): ValuesInterface;

    /**
     * Optional failure.
     *
     * @return \Throwable|null
     */
    public function getFailure(): ?\Throwable;

    /**
     * @psalm-external-mutation-free
     */
    public function withHeader(HeaderInterface $header): self;

    public function getHistoryLength(): int;
}
