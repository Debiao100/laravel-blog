<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // 关联用户（作者）
            $table->string('title'); // 文章标题
            $table->text('content'); // 文章内容
            $table->timestamps(); // 创建时间/更新时间
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};