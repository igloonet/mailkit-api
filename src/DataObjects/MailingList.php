<?php
declare(strict_types=1);

namespace Igloonet\MailkitApi\DataObjects;

use Igloonet\MailkitApi\DataObjects\Enums\MailingListStatus;

class MailingList
{
	/** @var int|null */
	private $id = null;

	/** @var string|null */
	private $name = null;

	/** @var MailingListStatus|null */
	private $status = null;

	/** @var string|null */
	private $description = null;

	/**
	 * @param int|null $id
	 * @return $this
	 */
	public function setId(?int $id): self
	{
		$this->id = $id;

		return $this;
	}

	/**
	 * @return int|null
	 */
	public function getId(): ?int
	{
		return $this->id;
	}

	/**
	 * @param string|null $name
	 * @return $this
	 */
	public function setName(?string $name): self
	{
		$this->name = trim($name ?? '') === '' ? null : trim($name);

		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getName(): ?string
	{
		return $this->name;
	}

	/**
	 * @param string|null $status
	 * @return $this
	 */
	public function setStatus(?string $status): self
	{
		$this->status = $this->isValidStatus($status) ? $status : null;

		return $this;
	}

	/**
	 * @return MailingListStatus|null
	 */
	public function getStatus(): ?MailingListStatus
	{
		return $this->status;
	}

	/**
	 * @param string|null $status
	 * @return bool
	 */
	private function isValidStatus(?string $status): bool
	{
		return in_array($status, [MailingListStatus::STATUS_ENABLED, MailingListStatus::STATUS_DISABLED], true);
	}

	/**
	 * @param string|null $description
	 * @return $this
	 */
	public function setDescription(?string $description): self
	{
		$this->description = trim($description ?? '') === '' ? null : trim($description);

		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getDescription(): ?string
	{
		return $this->description;
	}

	/**
	 * @param int $id
	 * @param string $name
	 * @param string $status
	 * @param string $description
	 * @return MailingList
	 */
	public static function create(int $id, string $name, string $status, string $description): self
	{
		$mailingList = new static();

		$mailingList->setId($id);
		$mailingList->setName($name);
		$mailingList->setStatus($status);
		$mailingList->setDescription($description);

		return $mailingList;
	}
}
