<?php

declare(strict_types=1);

namespace App\Infrastructure\SampleUsers;

use App\ApplicationService\SampleUsers\AddCommand;
use App\ApplicationService\SampleUsers\ListGetCommand;
use App\ApplicationService\SampleUsers\UpdateCommand;
use App\Domain\Models\SampleUser\SampleUser as SampleUserDomain;
use App\Domain\Models\SampleUser\SampleUserCollection;
use App\Domain\Models\SampleUser\Type\Gender;
use App\Domain\Models\SampleUser\Type\Height;
use App\Models\SampleUser;
use DateTime;

final class SampleUserRepository
{
    /**
     * DB からユーザー件数取得
     */
    public function countUsers(ListGetCommand $command): int
    {
        $count = SampleUser::query()
            ->when($command->filterName, fn ($q, $v) => $q->whereLike('name', "%{$v}%"))
            ->count();

        return $count;
    }

    /**
     * DB からユーザー取得
     */
    public function findUsers(ListGetCommand $command): SampleUserCollection
    {
        $query = SampleUser::query()
            ->when($command->filterName, fn ($q, $v) => $q->whereLike('name', "%{$v}%"));

        if ($command->sort !== null) {
            $sortColumn = $this->removeLeadingHyphen($command->sort);
            $order = $this->startsWithHyphen($command->sort) ? 'desc' : 'asc';
            $query->orderBy($sortColumn, $order);
        }

        // 並び順が一定になるように ID をつけとく
        $records = $query->orderBy('id', 'asc')
            ->paginate(perPage: $command->pageSize->value, page: $command->pageNumber->value);

        $collection = new SampleUserCollection;
        foreach ($records as $record) {
            $collection->add($this->buildEntity($record));
        }

        return $collection;
    }

    /**
     * ユーザーが存在するか
     */
    public function isExistUser(int $id): bool
    {
        return SampleUser::where('id', $id)->exists();
    }

    /**
     * DB へユーザー取得
     */
    public function findUser(int $id): SampleUserDomain
    {
        $record = SampleUser::findOrFail($id);

        return $this->buildEntity($record);
    }

    /**
     * DB へユーザー保存
     */
    public function saveUser(AddCommand $command): SampleUserDomain
    {
        $entity = new SampleUser;
        $entity->name = $command->name;
        $entity->birth_day = $command->birthDay->format('Y-m-d');
        $entity->height = (float) $command->height;
        $entity->gender = Gender::from($command->gender)->value;
        $entity->saveOrFail();

        return $this->buildEntity($entity);
    }

    /**
     * DB へユーザー更新
     */
    public function updateUser(UpdateCommand $command): SampleUserDomain
    {
        $entity = SampleUser::findOrFail($command->id);
        $entity->name = $command->name;
        $entity->birth_day = $command->birthDay->format('Y-m-d');
        $entity->height = (float) $command->height;
        $entity->gender = Gender::from($command->gender)->value;
        $entity->saveOrFail();

        return $this->buildEntity($entity);
    }

    /**
     * DB へユーザー削除
     */
    public function deleteUser(int $id): void
    {
        $entity = SampleUser::findOrFail($id);
        $entity->deleteOrFail();
    }

    /**
     * エンティティを組み立てる
     */
    private function buildEntity(SampleUser $entity): SampleUserDomain
    {
        return new SampleUserDomain(
            $entity->id,
            $entity->name,
            new DateTime($entity->birth_day),
            new Height((float) $entity->height),
            Gender::from($entity->gender)
        );
    }

    /**
     * 先頭がハイフンかどうか
     */
    private function startsWithHyphen(string $str): bool
    {
        return isset($str[0]) && $str[0] === '-';
    }

    /**
     * 先頭のハイフンを除いた文字列を取得する
     */
    private function removeLeadingHyphen(string $str): string
    {
        return $this->startsWithHyphen($str) ? substr($str, 1) : $str;
    }
}
