<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Migration extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $table = $this->table('items', ['id' => false, 'primary_key' => ['slug']]);
        $table
            ->addColumn('slug', 'string', ['limit' => 64, 'null' => false])
            ->addColumn('name', 'string', ['limit' => 64])
            ->create();

        $table = $this->table('combinations');
        $table->addColumn('item_a', 'string', ['limit' => 64])
            ->addForeignKey('item_a', 'items', 'slug', ['delete' => 'NO_ACTION', 'update' => 'NO_ACTION'])
            ->addColumn('item_b', 'string', ['limit' => 64])
            ->addForeignKey('item_b', 'items', 'slug', ['delete' => 'NO_ACTION', 'update' => 'NO_ACTION'])
            ->addColumn('result', 'string', ['limit' => 64])
            ->addForeignKey('result', 'items', 'slug', ['delete' => 'NO_ACTION', 'update' => 'NO_ACTION'])
            ->create();
    }
}
