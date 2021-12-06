<?php
class CommentsController
{
    private $connection;

    public function __construct($db) {
        $this->connection = $db->getConnect();
    }




}