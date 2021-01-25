<?php

/**
 * This file is part of Temporal package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Temporal\Common;

use Carbon\CarbonInterval;
use Cron\CronExpression;
use JetBrains\PhpStorm\Immutable;
use Spiral\Attributes\NamedArgumentConstructorAttribute;
use Temporal\Internal\Support\DateInterval;

/**
 * CronSchedule - Optional cron schedule for workflow. If a cron schedule is
 * specified, the workflow will run as a cron based on the schedule. The
 * scheduling will be based on UTC time. Schedule for next run only happen
 * after the current run is completed/failed/timeout. If a {@see RetryPolicy} is
 * also supplied, and the workflow failed or timeout, the workflow will be
 * retried based on the retry policy. While the workflow is retrying, it won't
 * schedule its next run. If next schedule is due while workflow is running
 * (or retrying), then it will skip that schedule. Cron workflow will not stop
 * until it is terminated or canceled.
 *
 * @psalm-import-type DateIntervalValue from DateInterval
 *
 * @Annotation
 * @Target({ "METHOD" })
 */
#[\Attribute(\Attribute::TARGET_METHOD)]
final class CronSchedule implements NamedArgumentConstructorAttribute, \Stringable
{
    /**
     * @var CronExpression
     */
    #[Immutable]
    public CronExpression $interval;

    /**
     * @param string $interval
     */
    public function __construct(string $interval)
    {
        $this->interval = new CronExpression($interval);
    }

    /**
     * {@inheritDoc}
     */
    public function __toString(): string
    {
        return (string)$this->interval->getExpression();
    }
}