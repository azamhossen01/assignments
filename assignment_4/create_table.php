<?php 

class Migration 
{
    private $table_name;
    public function getTableName()
    {
        $this->table_name = readline('Enter table name : ');
    }

    public function createMigration()
    {
        
    }
}