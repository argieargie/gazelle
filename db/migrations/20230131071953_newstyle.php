<?php

use Phinx\Db\Adapter\MysqlAdapter;

class Newstyle extends Phinx\Migration\AbstractMigration
{
    public function up()
    {
        $this->table('stylesheets')->insert([
            ['Name' => 'iAnon Apple 7', 'Description' => 'Apple 7 by iAnon']
        ])->save();
    }
    public function down(): void
    {
        $this->query("DELETE FROM stylesheets WHERE `Name` = 'iAnon Apple 7'");
    }
}
