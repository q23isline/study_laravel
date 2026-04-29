<?php

declare(strict_types=1);

namespace App\ApplicationService\SampleUsers;

use App\Infrastructure\SampleUsers\SampleUserRepository;

class AddApplicationService
{
    private SampleUserRepository $sampleUserRepository;

    /**
     * constructor
     */
    public function __construct()
    {
        $this->sampleUserRepository = new SampleUserRepository;
    }

    /**
     * ユースケースを表現する
     *
     * @param  array{type: string, name: string, birthDay: \DateTime, height: string, gender: '1'|'2'}  $command
     * @return array{id: int, name: string, birthDay: \DateTime, height: string, gender: '1'|'2'}
     */
    public function handle(array $command): array
    {
        $result = $this->sampleUserRepository->saveUser($command);

        return $result;
    }
}
