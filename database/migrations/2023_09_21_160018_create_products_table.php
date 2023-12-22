<?php

use App\Models\Admin\Auth\User;
use App\Models\Admin\Settings\Mastersettings\Productcategory;
use App\Models\Admin\Settings\Mastersettings\Uom;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->foreignIdFor(Productcategory::class);
            $table->string('sku')->nullable();
            $table->string('image')->nullable();

            $table->double('cgst', 8, 2)->nullable();
            $table->double('sgst', 8, 2)->nullable();
            $table->double('igst', 8, 2)->nullable();
            $table->double('cess', 8, 2)->nullable();
            $table->double('hsncode', 8, 2)->nullable();

            $table->double('purchaseprice', 8, 2)->default(0);
            $table->double('sellingprice', 8, 2)->default(0);
            $table->integer('stock')->default(0);
            $table->foreignIdFor(Uom::class);

            $table->text('note')->nullable();
            $table->string('sys_id')->unique();
            $table->string('uniqid')->unique();
            $table->uuid('uuid')->unique();
            $table->integer('sequence_id');
            $table->foreignIdFor(User::class);
            $table->unsignedBigInteger('updated_id')->nullable();
            $table->boolean('active', array(0, 1))->default(1);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
