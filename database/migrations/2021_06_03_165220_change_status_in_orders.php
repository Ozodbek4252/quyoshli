<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ChangeStatusInOrders extends Migration
{
    /**
     * Alter an enum field constraints
     * @param $table
     * @param $field
     * @param array $options
     */
    protected function alterEnum($table, $field, array $options) {

        $check = "${table}_${field}_check";

        $enumList = [];

        foreach($options as $option) {
            $enumList[] = sprintf("'%s'::CHARACTER VARYING", $option);
        }

        $enumString = implode(", ", $enumList);

        DB::transaction(function () use ($table, $field, $check, $options, $enumString) {
            DB::statement(sprintf('ALTER TABLE %s DROP CONSTRAINT %s;', $table, $check));
            DB::statement(sprintf('ALTER TABLE %s ADD CONSTRAINT %s CHECK (%s::TEXT = ANY (ARRAY[%s]::TEXT[]))', $table, $check, $field, $enumString));
        });

    }
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->alterEnum('orders', 'status', ['processing', 'collected', 'waiting_buyer', 'in_way', 'closed', 'cancelled', 'replacement', 'completed']);
//        Schema::table('orders', function (Blueprint $table) {
//            DB::statement('ALTER TABLE orders DROP CONSTRAINT status;');
//            DB::statement('ALTER TABLE orders ADD CONSTRAINT status CHECK (status::TEXT = ANY (ARRAY[\'processing\'::CHARACTER VARYING, \'collected\'::CHARACTER VARYING, \'waiting_buyer\'::CHARACTER VARYING, \'in_way\'::CHARACTER VARYING, \'closed\'::CHARACTER VARYING, \'canceled\'::CHARACTER VARYING, \'replacement\'::CHARACTER VARYING, \'completed\'::CHARACTER VARYING]::TEXT[]))');
//            $table->enum('status', [
//                'processing', 'collected', 'waiting_buyer', 'in_way', 'closed', 'cancelled', 'replacement', 'completed'
//            ])->change();
//            $table->enum('order_status', [
//                'processing', 'collected', 'waiting_buyer', 'in_way', 'closed', 'cancelled', 'replacement', 'completed'
//            ]);
//            $orders = \App\Models\Order::all();
//            foreach ($orders as $order) {
//                $order->update(['order_status' => $order->status]);
//            }
//            $table->dropColumn('status');
//            $table->renameColumn('order_status', 'status');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        DB::statement("ALTER TABLE `orders` ALTER COLUMN `status` ENUM('processing', 'collected', 'waiting_buyer', 'in_way', 'closed', 'cancelled', 'replacement')");
    }
}
