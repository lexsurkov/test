<?php

use console\migrations\Migration;

class m170606_193408_table_promo extends Migration
{
    public function up()
    {
        $this->createTable('{{%promo}}', [
            'id' => $this->primaryKey(),
            'date_begin' => $this->date()->notNull(),
            'date_end' => $this->date()->notNull(),
            'amount' => $this->float()->notNull(),
            'city_id' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'status' => $this->smallInteger()->notNull(),
        ], $this->tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%promo}}');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
