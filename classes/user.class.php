<?php
    class User extends Dbh
    {
        public function updateCover($photo, $userId)
        {
            if (empty($userId) || empty($photo)) {
                $_SESSION['message'] = "Error occurred when uploading your image";
                return;
            }
            

            // $dsn = "mysql:host=".$this->host.";dbname=".$this->dbName;
            // $pdo = new PDO($dsn, $this->user, $this->pass);
            // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            try {
                $sql = "UPDATE `vartotojai` SET `Virselio_nuotrauka`=? WHERE Vartotojo_id = ?";

                $statement = $this->connect()->prepare($sql);
                $statement->execute([$photo, $userId]);  

            } catch (Exception $e) {
                $_SESSION['message'] =  "Database connection lost.";
            }
        }
    }