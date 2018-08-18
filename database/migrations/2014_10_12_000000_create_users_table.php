<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * 运行迁移时调用
     */
    public function up()
    {
        /* 创建users表 */
        Schema::create('users', function (Blueprint $table) {
            // 定义数据表字段
            $table->increments('id');           // 自增长id
            $table->string('name');             // 用户名
            $table->string('email')->unique();  // 邮箱 唯一值
            $table->string('password');         // 密码 最大长度60
            $table->rememberToken();            // 记住我相关信息
            $table->timestamps();               //created_at创建时间 updated_at更新时间
        });
    }

    /**
     * Reverse the migrations.
     * 回滚迁移时调用
     *
     * @return void
     */
    public function down()
    {
        /* 删除users表 */
        Schema::dropIfExists('users');
    }
}
