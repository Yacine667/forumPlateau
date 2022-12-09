<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;

    class TopicManager extends Manager{

        protected $className = "Model\Entities\Topic";
        protected $tableName = "topic";


        public function __construct(){
            parent::connect();
        }

        public function findTopicsByCategorie($id) {

            parent::connect();
            $sql = "SELECT *
                    FROM $this->tableName
                    WHERE categorie_id = :id
                    ORDER BY creationDate DESC";

            return $this->getMultipleResults(
                DAO::select($sql,['id' => $id]),
                $this->className
            );
        }
        
        
        public function editTopic($id, $title) {
            parent::connect();

             $sql = "
             UPDATE topic
             SET title = :title
             WHERE id_topic = :id
             ";

             DAO::update($sql, ["id"=>$id,"title"=>$title]);
        }
        

        public function lockTopic($id) {
            parent::connect();

            $sql = "
            UPDATE topic
            SET closed = 1
            WHERE id_topic = :id
            ";

            DAO::update($sql, ["id"=>$id]);
        }


        public function unlockTopic($id) {
            parent::connect();

            $sql = "
            UPDATE topic
            SET closed = 0
            WHERE id_topic = :id
            ";

            DAO::update($sql, ["id"=>$id]);
        }

    }