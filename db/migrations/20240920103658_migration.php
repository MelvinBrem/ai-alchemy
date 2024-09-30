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
        $table = $this->table('items', [
            'id' => false,
            'primary_key' => 'slug',
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci'
        ]);
        $table
            ->addColumn('id', 'integer')
            ->addColumn('slug', 'string', ['limit' => 64, 'null' => false])
            ->addColumn('emoji', 'string', ['limit' => 64])
            ->addColumn('name', 'string', ['limit' => 64])
            ->addColumn('description', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('unlocked', 'boolean', ['default' => false])
            ->create();

        $this->execute('ALTER TABLE items MODIFY COLUMN id INT NOT NULL AUTO_INCREMENT, ADD UNIQUE (id)');


        $table = $this->table('combinations', [
            'id' => false,
            'primary_key' => ['item_a', 'item_b'],
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci'
        ]);
        $table
            ->addColumn('id', 'integer')
            ->addColumn('item_a', 'string', ['limit' => 64, 'null' => false])
            ->addColumn('item_b', 'string', ['limit' => 64, 'null' => false])
            ->addColumn('result', 'string', ['limit' => 64])
            ->addForeignKey('item_a', 'items', 'slug', ['delete' => 'NO_ACTION', 'update' => 'NO_ACTION'])
            ->addForeignKey('item_b', 'items', 'slug', ['delete' => 'NO_ACTION', 'update' => 'NO_ACTION'])
            ->addForeignKey('result', 'items', 'slug', ['delete' => 'NO_ACTION', 'update' => 'NO_ACTION'])
            ->create();

        $this->execute('ALTER TABLE combinations MODIFY COLUMN id INT NOT NULL AUTO_INCREMENT, ADD UNIQUE (id)');
    }
}
