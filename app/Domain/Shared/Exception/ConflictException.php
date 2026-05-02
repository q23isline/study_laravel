<?php

declare(strict_types=1);

namespace App\Domain\Shared\Exception;

use Exception;

/**
 * class ConflictException
 */
final class ConflictException extends Exception
{
    /**
     * constructor
     *
     * @param  array<ExceptionItem>  $errors  errors
     * @param  Exception|null  $previous  previous
     */
    public function __construct(
        protected array $errors = [],
        ?Exception $previous = null
    ) {
        $this->errors = $errors;

        $message = 'Conflict';
        $code = 409;

        parent::__construct($message, $code, $previous);
    }

    /**
     * 整形する
     *
     * @return array{errors: array{source: array{pointer: string}, title: string, detail: string}[]}
     */
    public function format(): array
    {
        $errors = [];
        foreach ($this->getErrors() as $error) {
            $errors[] = [
                'source' => [
                    'pointer' => $error->pointer,
                ],
                'title' => $error->title,
                'detail' => $error->detail,
            ];
        }

        $result = [
            'errors' => $errors,
        ];

        return $result;
    }

    /**
     * Get the value of errors
     *
     * @return array<ExceptionItem>
     */
    private function getErrors(): array
    {
        return $this->errors;
    }
}
