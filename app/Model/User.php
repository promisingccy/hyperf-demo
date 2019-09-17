<?php

declare (strict_types=1);
namespace App\Model;

use Hyperf\DbConnection\Model\Model;
/**
 * @property int $id
 * @property string $username
 * @property string $password_hash
 * @property string $nickname
 * @property string $email
 * @property string $mobile
 * @property int $status
 * @property int $role
 * @property string $access_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class User extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user';
    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'default';
    /**
     * The attributes that are mass assignable.
     * 允许被批量复制的属性
     * @var array
     */
    protected $fillable = ['id', 'username', 'password_hash', 'nickname', 'email', 'mobile', 'status', 'role', 'access_token', 'created_at', 'updated_at'];
    /**
     * The attributes that should be cast to native types.
     * 数据格式化配置
     * @var array
     */
    protected $casts = ['id' => 'int', 'status' => 'integer', 'role' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}