<?php
    class Post extends Dbh
    {
        // private $host = "localhost_db";
        // private $pass = "nera";
        // private $host = "localhost";
        // private $user = "root";
        // private $pass = "";
        // private $dbName = "projektas";

        public function createPost($msg, $datetime, $userId, $photo)
        {
            if (empty($msg) && empty($photo)) {
                $_SESSION['message'] = "Post is required to contain message or image";
                return;
            }
            
            $id = $this->getUniqueId();
            try {
                $sql = "INSERT INTO `pranesimai` VALUES (?, ?, ?, ?, ?, ?)";

                $statement = $this->connect()->prepare($sql);
                $statement->execute([$id, $userId, $msg, $datetime, $datetime, $photo]);  

            } catch (Exception $e) {
                $_SESSION['message'] =  "Database connection lost.";
            }
        }

        public function updatePost($msg, $datetime, $photo, $id)
        {
            if (empty($msg) && empty($photo)) {
                $_SESSION['message'] = "Post is required to contain message or image";
                return;
            }
            try {
                if($this->isPhotoUpdated($photo))
                {
                    $sql = "UPDATE `pranesimai` SET `Tekstas`=?, `Redagavimo_data`=?, `Nuotrauka`=? WHERE Pranesimo_id =?";
    
                    $statement = $this->connect()->prepare($sql);
                    $statement->execute([$msg, $datetime, $photo, $id]);
                }else{
                    $sql = "UPDATE `pranesimai` SET `Tekstas`=?, `Redagavimo_data`=? WHERE Pranesimo_id =?";
    
                    $statement = $this->connect()->prepare($sql);
                    $statement->execute([$msg, $datetime, $id]);
                }

            } catch (Exception $e) {
                $_SESSION['message'] =  "Database connection lost.";
            }
        }

        public function deletePost($id, $user)
        {
            $hostDb = "localhost";
            $userDb = "root";
            $passDb = "";
            $nameDb = "faceboek";
            try{
                $dsn = "mysql:host=".$hostDb.";dbname=".$nameDb;
                $pdo = new PDO($dsn, $userDb, $passDb);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $pdo->beginTransaction();
                try {
                    $likes = "DELETE FROM `pranesimu_reakcijos` WHERE Pranesimo_id =? AND Vartotojo_id =?";
                    $comments = "DELETE FROM `komentarai` WHERE Pranesimas =? AND Autorius =?";
                    $post = "DELETE FROM `pranesimai` WHERE Pranesimo_id =? AND Autorius =?";
        
                    $statement = $pdo->prepare($likes);
                    $statement->execute([$id, $user]);

                    $statement2 = $pdo->prepare($comments);
                    $statement2->execute([$id, $user]);

                    $statement3 = $pdo->prepare($post);
                    $statement3->execute([$id, $user]);
                    $pdo->commit();
                } catch (Exception $e) {
                    $pdo->rollBack();
                    $_SESSION['message'] =  "Database connection lost.";
                }
            }catch(Exception $e){
                $_SESSION['message'] =  "Database connection lost.";
            }
        }

        public function likePost($id, $userId){
            if (empty($id)) {
                $_SESSION['message'] = "Post is required to contain message or image";
                return;
            }
            $emoji = 1;
            // $dsn = "mysql:host=".$this->host.";dbname=".$this->dbName;
            // $pdo = new PDO($dsn, $this->user, $this->pass);
            // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            try {
                $sql = "INSERT INTO `pranesimu_reakcijos` VALUES (?, ?, ?)";

                $statement = $this->connect()->prepare($sql);
                $statement->execute([$emoji, $id, $userId]);  

            } catch (Exception $e) {
                $_SESSION['message'] =  "Database connection lost.";
            }
        }

        public function unlikePost($id, $userId){
            if (empty($id)) {
                $_SESSION['message'] = "Post is required to contain message or image";
                return;
            }
            // $dsn = "mysql:host=".$this->host.";dbname=".$this->dbName;
            // $pdo = new PDO($dsn, $this->user, $this->pass);
            // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            try {
                $sql = "DELETE FROM `pranesimu_reakcijos` WHERE Pranesimo_id =? AND Vartotojo_id =?";
                $statement = $this->connect()->prepare($sql);
                $statement->execute([$id, $userId]);  

            } catch (Exception $e) {
                $_SESSION['message'] =  "Database connection lost.";
            }
        }

        private function getUniqueId()
        {
            $id = rand(100000000, 999999999);
            if ($this->checkIfIdExists($id)) {
                $this->getUniqueId();
            }
            return $id;
        }

        private function checkIfIdExists($id)
        {
            $sql = "SELECT * FROM pranesimai WHERE Pranesimo_id = ?";
            $statement = $this->connect()->prepare($sql);
            $statement->execute([$id]);
            $count = $statement->rowCount();
            if ($count > 0) {
                return true;
            } else {
                return false;
            }
        }

        private function isPhotoUpdated($photo){
            return $photo == 0 ? false : true;
        }
    }