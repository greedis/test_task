<?php

namespace App\Models;

use DolgoyAudiopunk\Framework\Models\Model;

class CommentModel extends Model
{
    /**
     * @var string
     */
    protected string $table = 'comments';
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
        $userModel = new self;
        $userModel->insert($array);
    }

    /**
     * @param string $column
     * @param string $order
     * @param array<string|int> $search
     * @param string $columns
     * @param string $join
     * @param string $operator
     * @return array<array>
     */
    public static function getComments(string $column, string $order, array $search, string $columns = '*', string $join = '', string $operator = '='): array
    {
        $commentModel = new self;
        return $commentModel->order($column, $order, $search, $columns, $join, $operator);
    }
}
