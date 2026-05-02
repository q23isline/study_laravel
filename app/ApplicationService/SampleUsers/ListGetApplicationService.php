<?php

declare(strict_types=1);

namespace App\ApplicationService\SampleUsers;

use App\Domain\Models\SampleUser\SampleUserCollection;
use App\Infrastructure\SampleUsers\SampleUserRepository;

class ListGetApplicationService
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
     * @return array{count: int, users: SampleUserCollection}
     */
    public function handle(ListGetCommand $command): array
    {
        $count = $this->sampleUserRepository->countUsers($command);
        $users = $this->sampleUserRepository->findUsers($command);

        $result = [
            'count' => $count,
            'users' => $users,
        ];

        return $result;
    }
}
