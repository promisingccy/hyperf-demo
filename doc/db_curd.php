<?php
/**
 * Created by PhpStorm.
 * User: ccy
 * Date: 2019/9/17
 * Time: 15:16
 */

/**
 *

//==============================执行原生sql
$users = Db::select('SELECT * FROM `user` WHERE gender = ?',[1]);  //  返回array

$sql = "INSERT INTO `prs_user` (`status`, `role`) VALUES (?, ?);";
$params = [1, 0];
$inserted = Db::insert($sql, $params); // 返回是否成功 bool

$inserted = Db::insert('INSERT INTO user (id, name) VALUES (?, ?)', [1, 'Hyperf']); // 返回是否成功 bool
$affected = Db::update('UPDATE user set name = ? WHERE id = ?', ['John', 1]); // 返回受影响的行数 int
$affected = Db::delete('DELETE FROM user WHERE id = ?', [1]); // 返回受影响的行数 int
$result = Db::statement("CALL pro_test(?, '?')", [1, 'your words']);  // 返回 bool  CALL pro_test(?，?) 为存储过程，属性为 MODIFIES SQL DATA


//==============================事务
//自动回滚提交
Db::transaction(function () {
    Db::table('user')->update(['votes' => 1]);
    ...
    Db::table('posts')->delete();
});
//手动控制回滚提交
Db::beginTransaction();
try{
    // Do something...
    Db::commit();
} catch(\Throwable $ex){
    Db::rollBack();
}


//============================== 查

$users = Db::select('SELECT * FROM user;');//返回一个array
$users = Db::table('user')->get();//返回 Hyperf\Utils\Collection
$users = Db::table('user')->select('name', 'gender as user_gender')->get();
foreach ($users as $user) {
    echo $user->name;
}

////获取一行的值
$row = Db::table('user')->first(); // sql 会自动加上 limit 1
//获取一个值
$id = Db::table('user')->value('id');
//获取一列的值
$names = Db::table('user')->pluck('name');

//返回的集合中指定字段的自定义键值：
$roles = Db::table('roles')->pluck('title', 'name');
foreach ($roles as $name => $title) {
    echo $title;
}

//判断记录是否存在
return Db::table('orders')->where('finalized', 1)->exists();
return Db::table('orders')->where('finalized', 1)->doesntExist();


//自定义一个 select 查询语句来查询指定的字段：
$users = Db::table('user')->select('name', 'email as user_email')->get();

//distinct 方法会强制让查询返回的结果不重复：
$users = Db::table('user')->distinct()->get();

//在现有的查询语句中加入一个字段
$query = Db::table('users')->select('name');
$users = $query->addSelect('age')->get();


//orderBy
$users = Db::table('users')
    ->orderBy('name', 'desc')  //asc 或 desc
    ->get();

//latest / oldest 通过日期排序。它默认使用 created_at 列作为排序依据。当然，你也可以传递自定义的列名：
$user = Db::table('users')->latest()->first();

//inRandomOrder
$randomUser = Db::table('users')->inRandomOrder()->first();

//sharedLock 防止选中的数据列被篡改，直到事务被提交为止
Db::table('users')->where('votes', '>', 100)->sharedLock()->get();















User::query()->where('id', $id)->first();//同条件取第一个

$user = User::query()->find(1);//获取一条数据
$freshUser = $user->fresh();//获取一条新的数据


$user = User::query()->where('name','Hyperf')->first();
$user->name = 'Hyperf2';
$user->refresh();
echo $user->name; // Hyperf  还是原数据

$user = User::query()->where('id', 1)->first();
$user = User::query()->find(1);
$users = User::query()->find([1, 2, 3]);


$count = User::query()->where('gender', 1)->count();  //count，sum, max

//==============================增
$user = new User();
$user->name = 'Hi Hyperf';
$user->save();

Db::table('users')->insert(
    ['email' => 'john@example.com', 'votes' => 0]
);

Db::table('users')->insert([
    ['email' => 'taylor@example.com', 'votes' => 0],
    ['email' => 'dayle@example.com', 'votes' => 0]
]);


//==============================改
$user = User::query()->find(1);
$user->name = 'Hi Hyperf';
$user->save();

Db::table('users')->where('id', 1)->update(['votes' => 1]);

//批量修改
User::query()->where('status', 1)->update(['status' => 1]);

protected $fillable = ['name'];
$user = User::create(['name' => 'Hyperf']);//返回保存的模型实例
$user->fill(['name' => 'Hyperf']);

Db::table('users')->increment('votes');
Db::table('users')->increment('votes', 5);
Db::table('users')->decrement('votes');
Db::table('users')->decrement('votes', 5);
Db::table('users')->increment('votes', 1, ['name' => 'John']);//增加name=John的记录里votes的值+1

//使用 insertGetId 方法来插入记录并返回 ID 值
$id = Db::table('users')->insertGetId(
    ['email' => 'john@example.com', 'votes' => 0]
);

//更新 JSON 字段
Db::table('users')->where('id', 1)->update(['options->enabled' => true]);//MySQL 5.7+：

//更新或者新增
Db::table('users')->updateOrInsert(
    ['email' => 'john@example.com', 'name' => 'John'], //条件
    ['votes' => '2']  //更改或写入内容
);


//==============================删
$user = User::query()->find(1);
$user->delete();

// 注意使用 delete 方法时必须建立在某些查询条件基础之上才能安全删除数据，不存在 where 条件，会导致删除整个数据表
User::query()->where('gender', 1)->delete();
User::destroy(1);//主键删除
User::destroy([1,2,3]);//主键批量删除

Db::table('users')->delete();
Db::table('users')->where('votes', '>', 100)->delete();

//删除所有行，并重置自增 ID 为零：
Db::table('users')->truncate();


//软删除
use Hyperf\Database\Model\SoftDeletes;
class User extends Model
{
    use SoftDeletes;
}





























 */