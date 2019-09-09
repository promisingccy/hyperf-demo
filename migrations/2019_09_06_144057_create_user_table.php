<?php

use Hyperf\Database\Schema\Schema;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user', function (Blueprint $table) {
            $table->engine = 'InnoDB';// 指定表存储引擎
            $table->charset = 'utf8';// 指定数据表的默认字符集
            $table->collation = 'utf8_unicode_ci';// 指定数据表默认的排序规则

            $table->increments('id');
            $table->string('username', 64)->comment('用户名');
            $table->string('password_hash', 64)->comment('密码hash');
            $table->string('nickname', 32)->comment('用户昵称');
            $table->string('email', 255)->comment('电子邮件');
            $table->string('mobile', 255)->default('')->comment('手机号');
            $table->tinyInteger('status')->default(0)->comment('用户状态，0:停用/1:正常');
            $table->tinyInteger('role')->default(0)->comment('用户状态，0:停用/1:正常');
            $table->string('access_token', 255)->comment('用户token');
            $table->timestamps();

            $table->unique('username');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
}
