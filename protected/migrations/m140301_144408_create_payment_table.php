<?php

class m140301_144408_create_payment_table extends CDbMigration
{
    public function safeUp()
    {
        $this->createTable('payment', array(
            'id'                    => 'pk',
            'payment_id'            => 'varchar(255) NOT NULL',
            'payment_card'          => 'varchar(255) NOT NULL',
            'payment_token'         => 'varchar(255) NOT NULL',
            'payment_amount'        => 'varchar(255) NOT NULL',
            'payment_created'       => 'varchar(255) NOT NULL',
            'payment_fullname'      => 'varchar(45) DEFAULT NULL',
            'payment_email'         => 'varchar(255) DEFAULT NULL',
            'payment_description'   => 'text DEFAULT NULL',
        ));

        $this->createIndex('uq_payment', 'payment', 'payment_id', true);
        $this->createIndex('uq_card', 'payment', 'payment_card', true);
        $this->createIndex('uq_token', 'payment', 'payment_token', true);
    }

    public function safeDown()
    {
        $this->dropTable('payment');
    }
}
