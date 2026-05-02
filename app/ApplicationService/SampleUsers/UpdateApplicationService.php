<?php

declare(strict_types=1);

namespace App\ApplicationService\SampleUsers;

use App\Domain\Models\SampleUser\SampleUser;
use App\Domain\Shared\Exception\ExceptionItem;
use App\Domain\Shared\Exception\NotFoundException;
use App\Infrastructure\SampleUsers\SampleUserRepository;

class UpdateApplicationService
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
     * @throws NotFoundException
     */
    public function handle(UpdateCommand $command): SampleUser
    {
        if (! $this->sampleUserRepository->isExistUser($command->id)) {
            throw new NotFoundException([new ExceptionItem('', '', 'サンプルユーザーが存在しません。')]);
        }

        $result = $this->sampleUserRepository->updateUser($command);

        return $result;
    }
}
