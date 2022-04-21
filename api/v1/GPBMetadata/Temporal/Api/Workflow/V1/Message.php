<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: temporal/api/workflow/v1/message.proto

namespace GPBMetadata\Temporal\Api\Workflow\V1;

class Message
{
    public static $is_initialized = false;

    public static function initOnce() {
        $pool = \Google\Protobuf\Internal\DescriptorPool::getGeneratedPool();

        if (static::$is_initialized == true) {
          return;
        }
        \GPBMetadata\Google\Protobuf\Duration::initOnce();
        \GPBMetadata\Google\Protobuf\Timestamp::initOnce();
        \GPBMetadata\Dependencies\Gogoproto\Gogo::initOnce();
        \GPBMetadata\Temporal\Api\Enums\V1\Workflow::initOnce();
        \GPBMetadata\Temporal\Api\Common\V1\Message::initOnce();
        \GPBMetadata\Temporal\Api\Failure\V1\Message::initOnce();
        \GPBMetadata\Temporal\Api\Taskqueue\V1\Message::initOnce();
        $pool->internalAddGeneratedFile(
            '
�
&temporal/api/workflow/v1/message.prototemporal.api.workflow.v1google/protobuf/timestamp.proto!dependencies/gogoproto/gogo.proto$temporal/api/enums/v1/workflow.proto$temporal/api/common/v1/message.proto%temporal/api/failure/v1/message.proto\'temporal/api/taskqueue/v1/message.proto"�
WorkflowExecutionInfo<
	execution (2).temporal.api.common.v1.WorkflowExecution2
type (2$.temporal.api.common.v1.WorkflowType4

start_time (2.google.protobuf.TimestampB��4

close_time (2.google.protobuf.TimestampB��>
status (2..temporal.api.enums.v1.WorkflowExecutionStatus
history_length (
parent_namespace_id (	C
parent_execution (2).temporal.api.common.v1.WorkflowExecution8
execution_time	 (2.google.protobuf.TimestampB��*
memo
 (2.temporal.api.common.v1.MemoC
search_attributes (2(.temporal.api.common.v1.SearchAttributes@
auto_reset_points (2%.temporal.api.workflow.v1.ResetPoints

task_queue
state_transition_count ("�
WorkflowExecutionConfig8

task_queue (2$.temporal.api.taskqueue.v1.TaskQueueC
workflow_execution_timeout (2.google.protobuf.DurationB��=
workflow_run_timeout (2.google.protobuf.DurationB��F
default_workflow_task_timeout (2.google.protobuf.DurationB��"�
PendingActivityInfo
activity_id (	;

state (2+.temporal.api.enums.v1.PendingActivityState;
heartbeat_details (2 .temporal.api.common.v1.Payloads=
last_heartbeat_time (2.google.protobuf.TimestampB��;
last_started_time (2.google.protobuf.TimestampB��
attempt (
maximum_attempts (8
scheduled_time	 (2.google.protobuf.TimestampB��9
expiration_time
 (2.google.protobuf.TimestampB��6
last_failure (2 .temporal.api.failure.v1.Failure
last_worker_identity (	"�
PendingChildExecutionInfo
workflow_id (	
run_id (	
workflow_type_name (	
initiated_id (E
parent_close_policy (2(.temporal.api.enums.v1.ParentClosePolicy"�
PendingWorkflowTaskInfo>
state (2/.temporal.api.enums.v1.PendingWorkflowTaskState8
scheduled_time (2.google.protobuf.TimestampB��A
original_scheduled_time (2.google.protobuf.TimestampB��6
started_time (2.google.protobuf.TimestampB��
attempt ("G
ResetPoints8
points (2(.temporal.api.workflow.v1.ResetPointInfo"�
ResetPointInfo
binary_checksum (	
run_id (	(
 first_workflow_task_completed_id (5
create_time (2.google.protobuf.TimestampB��5
expire_time (2.google.protobuf.TimestampB��

resettable (B�
io.temporal.api.workflow.v1BMessageProtoPZ\'go.temporal.io/api/workflow/v1;workflow�Temporal.Api.Workflow.V1�Temporal::Api::Workflow::V1bproto3'
        , true);

        static::$is_initialized = true;
    }
}
