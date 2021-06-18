<?php
    class User extends Dbh
    {
        public function updateCoverImg($photo, $userId)
        {
            if (empty($userId) || empty($photo)) {
                $_SESSION['message'] = "Error occurred when uploading your image";
                return false;
            }
            try {
                $sql = "UPDATE `vartotojai` SET `Virselio_nuotrauka`=? WHERE Vartotojo_id = ?";

                $statement = $this->connect()->prepare($sql);
                $statement->execute([$photo, $userId]);  
                return true;
            } catch (Exception $e) {
                $_SESSION['message'] =  "Database connection lost.";
                return false;
            }
        }

        public function updateProfileImg($photo, $userId)
        {
            if (empty($userId) || empty($photo)) {
                $_SESSION['message'] = "Error occurred when uploading your image";
                return false;
            }
            try {
                $sql = "UPDATE `vartotojai` SET `Profilio_nuotrauka`=? WHERE Vartotojo_id = ?";

                $statement = $this->connect()->prepare($sql);
                $statement->execute([$photo, $userId]);
                return true;

            } catch (Exception $e) {
                $_SESSION['message'] =  "Database connection lost.";
                return false;
            }
        }

        public function updateBio($bio, $userId)
        {
            if (empty($userId) || empty($bio)) {
                $_SESSION['message'] = "Error occurred when uploading your image";
                return;
            }
            try {
                $sql = "UPDATE `vartotojai` SET `Bio`=? WHERE Vartotojo_id = ?";
                $statement = $this->connect()->prepare($sql);
                $statement->execute([$bio, $userId]);

            } catch (Exception $e) {
                $_SESSION['message'] =  "Database connection lost.";
            }
        }
    }