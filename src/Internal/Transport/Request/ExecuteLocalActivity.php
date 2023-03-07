<?php

/**
 * This file is part of Temporal package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Temporal\Internal\Transport\Request;

use Temporal\DataConverter\HeaderInterface;
use Temporal\DataConverter\ValuesInterface;
use Temporal\Worker\Transport\Command\Request;
use Temporal\Worker\Transport\Command\RequestInterface;

/**
 * @psalm-import-type RequestOptions from RequestInterface
 * @psalm-immutable
 */
final class ExecuteLocalActivity extends Request
{
    public const NAME = 'ExecuteLocalActivity';

    /**
     * @var non-empty-string
     */
    private string $activityName;

    /**
     * @param non-empty-string $name Activity name
     * @param ValuesInterface $args
     * @param RequestOptions $options
     * @param HeaderInterface $header
     */
    public function __construct(string $name, ValuesInterface $args, array $options, HeaderInterface $header)
    {
        $this->activityName = $name;
        parent::__construct(self::NAME, ['name' => $name, 'options' => $options], $args, header: $header);
    }

    /**
     * @return non-empty-string
     */
    public function getActivityName(): string
    {
        return $this->activityName;
    }
}
