<?php
declare(strict_types=1);

namespace Igloonet\MailkitApi\DataObjects;


class MailingListStatus extends \Consistence\Enum\Enum
{
	const STATUS_ENABLED = 'enabled';
	const STATUS_DISABLED = 'disabled';
}