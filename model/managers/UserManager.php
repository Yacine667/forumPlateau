<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;

    class UserManager extends Manager{

        protected $className = "Model\Entities\User";
        protected $tableName = "user";


        public function __construct(){
            parent::connect();
        }

        public function checkPseudo($pseudo){
            $sql = "
                SELECT pseudo 
                FROM user
                WHERE pseudo = :pseudo
                ";
            return(DAO::select($sql,['pseudo' => $pseudo]));
        }
  
        public function checkMail($mail){
            $sql = "
                SELECT mail 
                FROM user 
                WHERE mail = :mail
            ";
            return(DAO::select($sql,['mail' => $mail]));
        }

        public function getMdpUser($mail){
            $sql = "
                SELECT mdp 
                FROM ".$this->tableName." 
                WHERE mail = :mail
            ";
            return($this->getSingleScalarResult(DAO::select($sql,['mail' => $mail])));
        }

        public function getUser($mail){
            $sql = "
                SELECT * 
                FROM ".$this->tableName." 
                WHERE mail = :mail
            ";
            return($this->getOneOrNullResult(DAO::select($sql,['mail' => $mail],false),$this->className));
            
        }
    }



    