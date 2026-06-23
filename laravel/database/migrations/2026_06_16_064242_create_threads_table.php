<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('threads', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // タイトル (Title)
            $table->string('type'); // 提供 (Offer) or 募集 (Request)
            $table->string('category'); // 種類 (教科書, 参考書, スキル)
            $table->string('grade_year')->nullable(); // 学年 (1年~5年)
            $table->string('department')->nullable(); // コース (機械, 知能, 電気, 情報, 化学)
            $table->string('course_type')->nullable(); // 種別 (一般, 専門, 選択)
            $table->json('conditions')->nullable(); // 状態 (未使用に近い, 傷・汚れ有 など。複数選択のためJSON)
            $table->text('description')->nullable(); // 詳細説明 (Description)
            $table->string('image_path')->nullable(); // 画像パス
            $table->unsignedBigInteger('user_id')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('threads');
    }
};
