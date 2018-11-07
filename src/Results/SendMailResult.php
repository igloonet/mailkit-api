<?php
declare(strict_types=1);

namespace Igloonet\MailkitApi\Results;

use Igloonet\MailkitApi\Exceptions\InvalidResponseException;
use Igloonet\MailkitApi\RPC\Responses\IRpcResponse;

class SendMailResult implements IApiMethodResult
{
	public const STATUS_UPDATE = 0;
	public const STATUS_INSERT = 1;
	public const STATUS_INSERT_UNSUBSCRIBE = 2;
	public const STATUS_UPDATE_UNSUBSCRIBE = 3;
	public const STATUS_FAULT = 4;
	public const STATUS_UPDATE_NOT_SENT = 6;
	public const STATUS_INSERT_NOT_SENT = 7;

	/** @var int|null */
	private $emailId = null;

	/** @var int|null */
	private $sendingId = null;

	/** @var int|null */
	private $messageId = null;

	/** @var int|null */
	private $status = null;


	public function __construct(?int $emailId, ?int $sendingId, ?int $messageId, ?int $status)
	{
		$this->emailId = $emailId;
		$this->sendingId = $sendingId;
		$this->messageId = $messageId;
		$this->status = $status;
	}

	/**
	 * @return int|null
	 */
	public function getEmailId(): ?int
	{
		return $this->emailId;
	}

	/**
	 * @return int|null
	 */
	public function getSendingId(): ?int
	{
		return $this->sendingId;
	}

	/**
	 * @return int|null
	 */
	public function getMessageId(): ?int
	{
		return $this->messageId;
	}

	/**
	 * @return int|null
	 */
	public function getStatus(): ?int
	{
		return $this->status;
	}

	/**
	 * @param IRpcResponse $rpcResponse
	 * @return $this
	 */
	public static function fromRpcResponse(IRpcResponse $rpcResponse): self
	{
		$value = $rpcResponse->getArrayValue();

		foreach (['data', 'data2', 'data3', 'status'] as $field) {
			if (!array_key_exists($field, $value)) {
				throw new InvalidResponseException($rpcResponse, sprintf('Missing %s in RPC response!', $field));
			}
		}

		$emailId = is_numeric($value['data']) && (int)$value['data'] > 0 ? (int)$value['data'] : null;
		$sendingId = is_numeric($value['data2']) && (int)$value['data2'] > 0 ? (int)$value['data2'] : null;
		$messageId = is_numeric($value['data3']) && (int)$value['data3'] > 0 ? (int)$value['data3'] : null;
		$status = is_numeric($value['status']) ? (int)$value['status'] : null;

		return new static($emailId, $sendingId, $messageId, $status);
	}
}
