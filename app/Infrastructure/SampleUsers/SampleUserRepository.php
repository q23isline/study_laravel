<?php

declare(strict_types=1);

namespace App\Infrastructure\SampleUsers;

use App\Models\SampleUser;
use DateTime;

final class SampleUserRepository
{
    /**
     * DB からユーザー件数取得
     *
     * @param  array{filterName: null|string, sort: null|string, pageNumber: int, pageSize: int}  $command
     */
    public function countUsers(array $command): int
    {
        $count = SampleUser::query()
            ->when($command['filterName'], fn ($q, $v) => $q->whereLike('name', "%{$v}%"))
            ->count();

        return $count;
    }

    /**
     * DB からユーザー取得
     *
     * @param  array{filterName: null|string, sort: null|string, pageNumber: int, pageSize: int}  $command
     * @return array<array{id: int, name: string, birthDay: DateTime, height: string, gender: '1'|'2'}>
     */
    public function findUsers(array $command): array
    {
        $query = SampleUser::query()
            ->when($command['filterName'], fn ($q, $v) => $q->whereLike('name', "%{$v}%"));

        if ($command['sort'] !== null) {
            $sortColumn = $this->removeLeadingHyphen($command['sort']);
            $order = $this->startsWithHyphen($command['sort']) ? 'desc' : 'asc';
            $query->orderBy($sortColumn, $order);
        }

        // 並び順が一定になるように ID をつけとく
        $records = $query->orderBy('id', 'asc')
            ->paginate(perPage: $command['pageSize'], page: $command['pageNumber']);

        $result = [];
        foreach ($records as $record) {
            $result[] = $this->buildEntity($record);
        }

        return $result;
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
     *
     * @return array{id: int, name: string, birthDay: DateTime, height: string, gender: '1'|'2'}
     */
    public function findUser(int $id): array
    {
        $record = SampleUser::findOrFail($id);

        return $this->buildEntity($record);
    }

    /**
     * DB へユーザー保存
     *
     * @param  array{type: string, name: string, birthDay: DateTime, height: string, gender: '1'|'2'}  $command
     * @return array{id: int, name: string, birthDay: DateTime, height: string, gender: '1'|'2'}
     */
    public function saveUser(array $command): array
    {
        $entity = new SampleUser;
        $entity->name = $command['name'];
        $entity->birth_day = $command['birthDay']->format('Y-m-d');
        $entity->height = (float) $command['height'];
        $entity->gender = $command['gender'];
        $entity->saveOrFail();

        return $this->buildEntity($entity);
    }

    /**
     * DB へユーザー更新
     *
     * @param  array{type: string, id: int, name: string, birthDay: DateTime, height: string, gender: '1'|'2'}  $command
     * @return array{id: int, name: string, birthDay: DateTime, height: string, gender: '1'|'2'}
     */
    public function updateUser(array $command): array
    {
        $entity = SampleUser::findOrFail($command['id']);
        $entity->name = $command['name'];
        $entity->birth_day = $command['birthDay']->format('Y-m-d');
        $entity->height = (float) $command['height'];
        $entity->gender = $command['gender'];
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
     *
     * @return array{id: int, name: string, birthDay: DateTime, height: string, gender: '1'|'2'}
     */
    private function buildEntity(SampleUser $entity): array
    {
        $result = [
            'id' => $entity->id,
            'name' => $entity->name,
            'birthDay' => new DateTime($entity->birth_day),
            'height' => (string) $entity->height,
            'gender' => $entity->gender,
        ];

        return $result;
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
