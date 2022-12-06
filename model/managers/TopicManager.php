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
        
        

    }