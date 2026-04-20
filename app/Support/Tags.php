<?php

namespace App\Support;

class Tags
{
    public const WORK = 1;
    public const SCHOOL = 2;
    public const PERSONAL = 3;
    public const URGENT = 4;
    public const CODING = 5;

    /**
     * @return array<int, string>
     */
    public static function all(): array
    {
        return [
            self::WORK => 'Work',
            self::SCHOOL => 'School',
            self::PERSONAL => 'Personal',
            self::URGENT => 'Urgent',
            self::CODING => 'Coding',
        ];
    }

    public static function name(int|string|null $id): string
    {
        return self::all()[(int) $id] ?? 'Unknown';
    }

    public static function color(int|string|null $id): string
    {
        return self::details((int) $id)['color'] ?? '#64748b';
    }

    public static function weight(int|string|null $id): int
    {
        return self::details((int) $id)['weight'] ?? 0;
    }

    /**
     * @return array{id:int,name:string,color:string,weight:int}|array{}
     */
    public static function details(int|string|null $id): array
    {
        $id = (int) $id;

        $details = [
            self::WORK => [
                'id' => self::WORK,
                'name' => self::name(self::WORK),
                'color' => '#2563eb',
                'weight' => 3,
            ],
            self::SCHOOL => [
                'id' => self::SCHOOL,
                'name' => self::name(self::SCHOOL),
                'color' => '#059669',
                'weight' => 2,
            ],
            self::PERSONAL => [
                'id' => self::PERSONAL,
                'name' => self::name(self::PERSONAL),
                'color' => '#7c3aed',
                'weight' => 1,
            ],
            self::URGENT => [
                'id' => self::URGENT,
                'name' => self::name(self::URGENT),
                'color' => '#dc2626',
                'weight' => 5,
            ],
            self::CODING => [
                'id' => self::CODING,
                'name' => self::name(self::CODING),
                'color' => '#ea580c',
                'weight' => 4,
            ],
        ];

        return $details[$id] ?? [];
    }

    /**
     * @return list<int>
     */
    public static function ids(): array
    {
        return array_keys(self::all());
    }

    public static function exists(int|string|null $id): bool
    {
        return in_array((int) $id, self::ids(), true);
    }

    /**
     * @param  array<int, int|string>|null  $ids
     * @return list<int>
     */
    public static function normalize(?array $ids): array
    {
        if ($ids === null) {
            return [];
        }

        $normalized = array_map(static fn ($id) => (int) $id, $ids);
        $filtered = array_values(array_filter(
            $normalized,
            static fn (int $id) => self::exists($id)
        ));

        return array_values(array_unique($filtered));
    }
}
