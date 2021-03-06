<?php

require __DIR__.'/../vendor/autoload.php';

class AddUserDomainForMooc extends Migration
{
    public function description () {
        return 'add userdomain for (foreign) users participating in a mooc-course';
    }


    public function up () {
        $db = DBManager::get();
        $stmt = $db->prepare("INSERT INTO userdomains"
                . "(userdomain_id, name)"
                . "VALUES (:id, :id)");
        $stmt->bindValue(':id', \Mooc\USER_DOMAIN_NAME);
        $stmt->execute();

        SimpleORMap::expireTableScheme();
    }


    public function down () {
        $db = DBManager::get();
        $stmt = $db->prepare("DELETE FROM userdomains"
                . " WHERE userdomain_id = :id");
        $stmt->bindValue(':id', \Mooc\USER_DOMAIN_NAME);
        $stmt->execute();

        SimpleORMap::expireTableScheme();
    }
}
