<?php
/**
 * Created by PhpStorm.
 * User: ccy
 * Date: 2019/9/6
 * Time: 11:50
 */

/************************ 生成模型
 *
php bin/hyperf.php db:model user  //生成user表的对应model类

参数 	类型 	默认值 	备注
connection 	string 	default 	数据库连接
table 	string 	无 	数据表名称
primaryKey 	string 	id 	模型主键
keyType 	string 	int 	主键类型
fillable 	array 	[] 	允许被批量复制的属性  可以看作批量赋值的「白名单」
guarded 	array 	[] 	从功能上将更像是一个「黑名单」（二选一）
casts 	string 	无 	数据格式化配置
timestamps 	bool 	true 	是否自动维护时间戳
incrementing 	bool 	true 	是否自增主键
 */


/************************ 迁移命令
 *
 *
php bin/hyperf.php migrate  //运行尚未完成的迁移
php bin/hyperf.php migrate --force  //强制执行迁移

//--table 选项指定表名为users
php bin/hyperf.php gen:migration create_users_table --table=users  //修改表的迁移文件
php bin/hyperf.php gen:migration create_users_table --create=users  //生成创建表的迁移文件



php bin/hyperf.php migrate:rollback  //回滚最后一次的迁移
php bin/hyperf.php migrate:rollback --step=5  //step 参数来设置回滚迁移的次数
php bin/hyperf.php migrate:reset  //回滚所有的迁移
php bin/hyperf.php migrate:refresh  //回滚并迁移 - 高效地重建某些迁移
php bin/hyperf.php migrate:refresh --step=5  //指定回滚和重建次数
php bin/hyperf.php migrate:fresh  //高效地重建整个数据库 - 先删除所有的数据库

php bin/hyperf.php migrate:refresh --seed  //重建数据库结构并执行数据填充
php bin/hyperf.php migrate:fresh --seed  // 重建数据库结构并执行数据填充
*/


/************************ 迁移文件

//************ 管理多个数据库 ---- 这里对应 config/autoload/databases.php 内的连接 key
protected $connection = 'foo';


//************ 表属性
$table->engine = 'InnoDB';// 指定表存储引擎
$table->charset = 'utf8';// 指定数据表的默认字符集
$table->collation = 'utf8_unicode_ci';// 指定数据表默认的排序规则
$table->temporary();// 创建临时表


//************ 创建字段
 * *** INT
$table->tinyIncrements('id'); 	相当于自动递增 UNSIGNED TINYINT
$table->smallIncrements('id'); 	递增 ID (主键) ，相当于「UNSIGNED SMALL INTEGER」
$table->mediumIncrements('id'); 	递增 ID (主键) ，相当于「UNSIGNED MEDIUM INTEGER」
$table->increments('id'); 	递增的 ID (主键)，相当于「UNSIGNED INTEGER」
$table->bigIncrements('id'); 	递增 ID（主键），相当于「UNSIGNED BIG INTEGER」

$table->tinyInteger('votes'); 	相当于 TINYINT
$table->smallInteger('votes'); 	相当于 SMALLINT
$table->mediumInteger('votes'); 	相当于 MEDIUMINT
$table->integer('votes'); 	相当于 INTEGER
$table->bigInteger('votes'); 	相当于 BIGINT

$table->unsignedBigInteger('votes'); 	相当于 Unsigned BIGINT
$table->unsignedInteger('votes'); 	相当于 Unsigned INT
$table->unsignedMediumInteger('votes'); 	相当于 Unsigned MEDIUMINT
$table->unsignedSmallInteger('votes'); 	相当于 Unsigned SMALLINT
$table->unsignedTinyInteger('votes'); 	相当于 Unsigned TINYINT

 * *** DOUBLE
$table->float('amount', 8, 2); 	相当于带有精度与基数 FLOAT
$table->decimal('amount', 8, 2); 	相当于带有精度与基数 DECIMAL
$table->double('amount', 8, 2); 	相当于带有精度与基数 DOUBLE
$table->unsignedDecimal('amount', 8, 2); 	相当于带有精度和基数的 UNSIGNED DECIMAL

 * *** STRING
$table->char('name', 100); 	相当于带有长度的 CHAR
$table->string('name', 100); 	相当于带长度的 VARCHAR
$table->text('description'); 	相当于 TEXT

 * *** DATA
$table->binary('data'); 	相当于 BLOB
$table->mediumText('description'); 	相当于 MEDIUMTEXT
$table->longText('description'); 	相当于 LONGTEXT

 * *** BOOL
$table->boolean('confirmed'); 	相当于 BOOLEAN

 * *** ENUM
$table->enum('level', ['easy', 'hard']); 	相当于 ENUM

 * *** TIME
$table->time('sunrise'); 	相当于 TIME
$table->timestamp('added_on'); 	相当于 TIMESTAMP
$table->timestamps(); 	相当于可空的 created_at 和 updated_at TIMESTAMP

$table->date('created_at'); 	相当于 DATE
$table->dateTime('created_at'); 	相当于 DATETIME
$table->year('birth_year'); 	相当于 YEAR

$table->dateTimeTz('created_at'); 	相当于带时区 DATETIME
$table->timeTz('sunrise'); 	相当于带时区的 TIME
$table->timestampTz('added_on'); 	相当于带时区的 TIMESTAMP
$table->timestampsTz(); 	相当于可空且带时区的 created_at 和 updated_at TIMESTAMP

$table->softDeletes(); 	相当于为软删除添加一个可空的 deleted_at 字段
$table->softDeletesTz(); 	相当于为软删除添加一个可空的 带时区的 deleted_at 字段

 * *** UUID
$table->uuid('id'); 	相当于 UUID

 * *** GEO
$table->geometry('positions'); 	相当于 GEOMETRY
$table->geometryCollection('positions'); 	相当于 GEOMETRYCOLLECTION

 * *** IP
$table->ipAddress('visitor'); 	相当于 IP 地址

 * *** OTHERS
$table->json('options'); 	相当于 JSON
$table->jsonb('options'); 	相当于 JSONB
$table->lineString('positions'); 	相当于 LINESTRING
$table->macAddress('device'); 	相当于 MAC 地址
$table->morphs('taggable'); 	相当于加入递增的 taggable_id 与字符串 taggable_type
$table->multiLineString('positions'); 	相当于 MULTILINESTRING
$table->multiPoint('positions'); 	相当于 MULTIPOINT
$table->multiPolygon('positions'); 	相当于 MULTIPOLYGON
$table->nullableMorphs('taggable'); 	相当于可空版本的 morphs() 字段
$table->nullableTimestamps(); 	相当于可空版本的 timestamps() 字段
$table->point('position'); 	相当于 POINT
$table->polygon('positions'); 	相当于 POLYGON
$table->rememberToken(); 	相当于可空版本的 VARCHAR (100) 的 remember_token 字段


//************ 修改字段 （composer require doctrine/dbal）

 * 只有下面的字段类型能被 "修改"：
 * bigInteger、 binary、 boolean、date、dateTime、dateTimeTz、decimal、
 * integer、json、 longText、mediumText、smallInteger、string、text、time、
 * unsignedBigInteger、unsignedInteger and unsignedSmallInteger。

$table->string('name', 50)->change();  // 将字段的长度修改为 50
$table->string('name', 50)->nullable()->change();  // 将字段的长度修改为 50 并允许为空
$table->renameColumn('from', 'to')->change();  // 将字段从 from 重命名为 to
$table->dropColumn('name');  // 删除 name 字段
$table->dropColumn(['name', 'age']);  // 删除多个字段


//************ 索引

//唯一索引 unique()
$table->string('name')->unique();  // 在定义时创建索引
$table->unique('name');  // 在定义完字段之后创建索引

//复合索引
$table->index(['account_id', 'created_at'], 'index_account_id_and_created_at');  // 创建一个复合索引

//定义索引名称
$table->unique('name', 'unique_name');  // 定义唯一索引名称为 unique_name
$table->index(['account_id', 'created_at'], '');  // 定义一个复合索引名称为 index_account_id_and_created_at

//可用的索引类型
$table->primary('id'); 	//添加主键
$table->primary(['id', 'parent_id']); 	//添加复合键
$table->unique('email'); 	//添加唯一索引
$table->index('state'); 	//添加普通索引
$table->spatialIndex('location'); 	//添加空间索引

//重命名索引
$table->renameIndex('from', 'to');

//删除索引
$table->dropPrimary('users_id_primary'); 	从 users 表中删除主键
$table->dropUnique('users_email_unique'); 	从 users 表中删除唯一索引
$table->dropIndex('geo_state_index'); 	从 geo 表中删除基本索引
$table->dropSpatialIndex('geo_location_spatialindex'); 	从 geo 表中删除空间索引
$table->dropIndex(['account_id', 'created_at']);  //删除复合索引




//************ 外键约束

//创建外键约束
Schema::table('posts', function (Blueprint $table) {
    $table->unsignedInteger('user_id');
    $table->foreign('user_id')->references('id')->on('users'); //定义一个引用 users 表的 id 字段的 user_id 字段
});

还可以为 on delete 和 on update 属性指定所需的操作：

$table->foreign('user_id')
    ->references('id')
    ->on('users')
    ->onDelete('cascade');

 * RESTRICT(默认值)|NO ACTION:不能删除或更新父表中子表有相应信息的记录
 * CASCADE级联: 父表删除或更新，子表也删除或更新相应的信息
 * SET NULL： 父表删除或更新，子表相应的信息设置为NULL，子表字段不能是NOT NULL类型


//删除外键
$table->dropForeign('posts_user_id_foreign');  //外键约束采用的命名方式与索引相同，然后加上 _foreign 后缀

//外键约束的开启和关闭
Schema::enableForeignKeyConstraints();  // 开启外键约束
Schema::disableForeignKeyConstraints();  // 禁用外键约束


























 *
 * */
