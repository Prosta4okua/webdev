<?php

class Comment
{
    private $commentID;
    private string $authorID;
    private string $commentText;
    private string $pageID;
    private string $dateTime;

    /**
     * @param $commentID        - ідентифікатор коментаря
     * @param $authorID         - ідентифікатор автора
     * @param $commentText      - текст коментаря
     * @param $pageID           - ідентифікатор сторінки, на якій був написаний коментар
     * @param $dateTime         - час створення коментаря
     */
    public function __construct($authorID='', $commentText='', $pageID='', $dateTime='')
    {
        $this->authorID = $authorID;
        $this->commentText = $commentText;
        $this->pageID = $pageID;
        $this->dateTime = $dateTime;
    }

    /**
     * @param $connection - з'єднання
     * @param $id - ідентифікатор сторінки користувача
     * @return  - всі коментарі зі сторінки або null
     */
    public static function allCommentsByID($connection, $id)
    {
        $command = "SELECT * FROM comments WHERE pageID=$id";
        $result = $connection->query($command);
        if ($result->num_rows > 0) {
            $arr = [];
            while ( $db_field = $result->fetch_assoc() ) {
                $arr[] = $db_field;
            }
            return $arr;
        } else {
            return [];
        }
    }

    public static function deleteCommentByID($connection, $id)
    {
        $command = "DELETE FROM comments WHERE commentID=$id";
        $result = mysqli_query($connection, $command);
        if ($result) {
            return true;
        }
        return false;
    }

    public static function editCommentByID($connection, $data)
    {
//        TODO:
//        $sql = "UPDATE `users` SET `email`='$data->email',`commentText`='$newText', ";
    }

}