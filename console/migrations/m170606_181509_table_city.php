<?php

use console\migrations\Migration;

class m170606_181509_table_city extends Migration
{
    public function up()
    {
        $this->createTable('{{%city}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
        ], $this->tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%city}}');
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
