<?php
    class Comment extends Dbh
    {
        public function createComment($comment, $datetime, $userId, $postId)
        {
            if (empty($comment)) {
                $_SESSION['message'] = "Comment is required to contain some characters";
                return;
            }
            echo "1";
            $id = mt_rand(10000000,99999999);

            // $dsn = "mysql:host=".$this->host.";dbname=".$this->dbName;
            // $pdo = new PDO($dsn, $this->user, $this->pass);
            // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            try {
                // $sql = "INSERT INTO `pranesimai` VALUES (?, ?, ?, ?, ?, ?)";
                $sql = "INSERT INTO `komentarai` VALUES (?, ?, ?, ?, ?)";
                $statement = $this->connect()->prepare($sql);
                $statement->execute([$id, $comment, $datetime, $postId, $userId]);

            } catch (Exception $e) {
                $_SESSION['message'] =  "Database connection lost.";
            }
        }
    }