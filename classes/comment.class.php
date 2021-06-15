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
                $sql = "INSERT INTO `komentarai` VALUES (?, ?, ?, ?, ?, ?)";
                $statement = $this->connect()->prepare($sql);
                $statement->execute([$id, $comment, $datetime, $datetime, $postId, $userId]);
                echo "2";

            } catch (Exception $e) {
                $_SESSION['message'] =  "Database connection lost.";
            }
        }

        public function updateComment($msg, $datetime, $id)
        {
            if (empty($msg) && empty($photo)) {
                $_SESSION['message'] = "Post is required to contain message or image";
                return;
            }
            

            // $dsn = "mysql:host=".$this->host.";dbname=".$this->dbName;
            // $pdo = new PDO($dsn, $this->user, $this->pass);
            // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            try {
                    $sql = "UPDATE `komentarai` SET `Tekstas`=?,`Redagavimo_data`=? WHERE Komentaro_id =?";
    
                    $statement = $this->connect()->prepare($sql);
                    $statement->execute([$msg, $datetime, $id]);

            } catch (Exception $e) {
                $_SESSION['message'] =  "Database connection lost.";
            }
        }

        public function likeComment($id, $userId){
            if (empty($id)) {
                $_SESSION['message'] = "Post is required to contain message or image";
                return;
            }
            $emoji = 1;
            // $dsn = "mysql:host=".$this->host.";dbname=".$this->dbName;
            // $pdo = new PDO($dsn, $this->user, $this->pass);
            // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            try {
                $sql = "INSERT INTO `komentaru_reakcijos` VALUES (?, ?, ?)";

                $statement = $this->connect()->prepare($sql);
                $statement->execute([$emoji, $id, $userId]);  

            } catch (Exception $e) {
                $_SESSION['message'] =  "Database connection lost.";
            }
        }

        public function unlikeComment($id, $userId){
            if (empty($id)) {
                $_SESSION['message'] = "Post is required to contain message or image";
                return;
            }
            // $dsn = "mysql:host=".$this->host.";dbname=".$this->dbName;
            // $pdo = new PDO($dsn, $this->user, $this->pass);
            // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            try {
                $sql = "DELETE FROM `komentaru_reakcijos` WHERE Komentaro_id =? AND Vartotojas =?";
                $statement = $this->connect()->prepare($sql);
                $statement->execute([$id, $userId]);  

            } catch (Exception $e) {
                $_SESSION['message'] =  "Database connection lost.";
            }
        }

        public function deleteComment($id)
        {
            // $dsn = "mysql:host=".$this->host.";dbname=".$this->dbName;
            // $pdo = new PDO($dsn, $this->user, $this->pass);
            // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            try {
                    $sql = "DELETE FROM `komentarai` WHERE Komentaro_id =?";
    
                    $statement = $this->connect()->prepare($sql);
                    $statement->execute([$id]);

            } catch (Exception $e) {
                $_SESSION['message'] =  "Database connection lost.";
            }
        }
    }