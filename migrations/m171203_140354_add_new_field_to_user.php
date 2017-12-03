<?php

use yii\db\Migration;

class m171203_140354_add_new_field_to_user extends Migration
{
    public function up()
    {
        $this->addColumn('{{%user}}', 'birthDate', $this->date());
    }

    public function down()
    {
        $this->dropColumn('{{%user}}', 'birthDate');
    }
}
