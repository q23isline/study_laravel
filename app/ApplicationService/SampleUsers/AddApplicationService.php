<?php

declare(strict_types=1);

namespace App\ApplicationService\SampleUsers;

use App\Domain\Models\SampleUser\SampleUser;
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
     */
    public function handle(AddCommand $command): SampleUser
    {
        $result = $this->sampleUserRepository->saveUser($command);

        return $result;
    }
}
