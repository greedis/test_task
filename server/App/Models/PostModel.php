<?php

namespace App\Models;

use DolgoyAudiopunk\Framework\Models\Model;

class PostModel extends Model
{
    /**
     * @var string
     */
    protected string $table = 'posts';
    /**
     * @var boolean
     */
    protected bool $created_at = true;

    /**
     * @param array<string> $array
     * @return void
     */
    public static function created(array $array): void
    {
        $articleModel = new self;
        $articleModel->insert($array);
    }

    /**
     * @param string $column
     * @param string $order
     * @param array<int> $search
     * @param string $columns
     * @param string $join
     * @param string $operator
     * @param string $limit
     * @return array<array>
     */
    public static function getPosts(string $column, string $order, array $search, string $columns = '*', string $join = '', string $operator = '=', string $limit = ''): array
    {
        $postModel = new self;
        return $postModel->order($column, $order, $search, $columns, $join, $operator, $limit);
    }
}
