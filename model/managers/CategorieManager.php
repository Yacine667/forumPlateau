<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;

    class CategorieManager extends Manager{

        protected $className = "Model\Entities\Categorie";
        protected $tableName = "categorie";


        public function __construct(){
            parent::connect();
        }

        public function findCategoriesByTopic($id) {

            $sql = "SELECT nomCategorie
                    FROM $this->tableName
                    WHERE topic_id = :id";

            return $this->getMultipleResults(
                DAO::select($sql,['id' => $id]),
                $this->className
            );
        }
    }