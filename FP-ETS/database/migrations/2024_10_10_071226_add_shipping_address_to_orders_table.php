<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddShippingAddressToOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'shipping_address')) {
                $table->text('shipping_address')->after('status');
            }
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('shipping_address');
        });
    }
}