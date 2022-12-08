<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;

    class PostManager extends Manager{

        protected $className = "Model\Entities\Post";
        protected $tableName = "post";


        public function __construct(){
            parent::connect();
        }

        public function findPostsByTopic($id) {

            parent::connect();
            $sql = "SELECT *
                    FROM $this->tableName
                    WHERE topic_id = :id
                    ORDER BY datePOST ASC"                    
                    ;

            return $this->getMultipleResults(
                DAO::select($sql,['id' => $id]),
                $this->className
            );
        }

        public function addPost($id) {
            $message = filter_input(INPUT_POST, "message", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $userId = 1;

            if($message && $id && $userId){
                $newPost=["message"=>$message, "topic_id"=>$id, "user_id"=>$userId];
                return $this->add($newPost);
            }
  
        }

        public function findLastUserPost($id){

            $sql = "SELECT *
                    FROM $this->tableName
                    WHERE user_id = :id";

            return $this->getOneOrNullResult(
                DAO::select($sql,['id' => $id], false),
                $this->className
             );
        }
    }