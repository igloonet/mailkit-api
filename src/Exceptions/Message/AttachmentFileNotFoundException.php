<?php
declare(strict_types=1);

namespace Igloonet\MailkitApi\Exceptions\Message;

use Igloonet\MailkitApi\Exceptions\IOException;
use Throwable;

class AttachmentFileNotFoundException extends IOException implements AttachmentException
{
	private $filePath = null;

	public function __construct(string $filePath, string $message = '', int $code = 0, Throwable $previous = null)
	{
		$this->filePath = $filePath;

		if (trim($message) === '') {
			$message = sprintf('File %s was not found!', $filePath);
		}

		parent::__construct($message, $code, $previous);
	}

	public function getFilePath(): string
	{
		return $this->filePath;
	}
}
