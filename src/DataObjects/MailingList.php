<?php
declare(strict_types=1);

namespace Igloonet\MailkitApi\DataObjects;

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
	 * @param MailingListStatus|null $status
	 * @return $this
	 */
	public function setStatus(?MailingListStatus $status): self
	{
		$this->status = $this->isValidStatus($status) ? $status : null;

		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getStatus(): ?string
	{
		return $this->status;
	}

	/**
	 * @param MailingListStatus|null $status
	 * @return bool
	 */
	private function isValidStatus(?MailingListStatus $status): bool
	{
		return in_array($status, [MailingListStatus::STATUS_ENABLED, MailingListStatus::STATUS_DISABLED]);
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
	 * @param MailingListStatus $status
	 * @param string $description
	 * @return MailingList
	 */
	public static function create(int $id, string $name, MailingListStatus $status, string $description): self
	{
		$mailingList = new static();

		$mailingList->setId($id);
		$mailingList->setName($name);
		$mailingList->setStatus($status);
		$mailingList->setDescription($description);

		return $mailingList;
	}
}
