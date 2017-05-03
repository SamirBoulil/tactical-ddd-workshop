<?php
declare(strict_types=1);

namespace MeetupOrganizing\Domain\Model\Meetup;

use Common\DomainModel\AggregateRoot;
use MeetupOrganizing\Domain\Model\MeetupGroup\MeetupGroup;
use MeetupOrganizing\Domain\Model\MeetupGroup\MeetupGroupId;

final class Meetup
{
    use AggregateRoot;

    /**
     * @var MeetupId
     */
    private $meetupId;

    /**
     * @var MeetupGroup
     */
    private $meetupGroupId;

    /**
     * @var OrganizerId
     */
    private $organizerId;

    /**
     * @var WorkingTitle
     */
    private $workingTitle;

    /**
     * @var ScheduledDate
     */
    private $scheduledFor;

    private function __construct(
        MeetupId $meetupId,
        MeetupGroupId $meetupGroupId,
        OrganizerId $organizerId,
        WorkingTitle $workingTitle,
        ScheduledDate $scheduledFor
    ) {
        $this->meetupGroupId = $meetupGroupId;
        $this->organizerId = $organizerId;
        $this->workingTitle = $workingTitle;
        $this->scheduledFor = $scheduledFor;
        $this->meetupId = $meetupId;
    }

    public static function schedule(
        MeetupId $meetupId,
        MeetupGroupId $meetupGroupId,
        OrganizerId $organizerId,
        WorkingTitle $workingTitle,
        ScheduledDate $scheduledFor
    ): Meetup {
        $meetup = new self($meetupId, $meetupGroupId, $organizerId, $workingTitle, $scheduledFor);

        $meetup->recordThat(new MeetupScheduled($meetupId, $meetupGroupId, $organizerId, $workingTitle, $scheduledFor));

        return $meetup;
    }
}