<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\UserManager;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    use Model\Managers\CategorieManager;
    
    class ForumController extends AbstractController implements ControllerInterface{

        public function index(){}

        public function listCategories(){
            
            $categorieManager = new CategorieManager();
            
            return [
                "view" => VIEW_DIR."forum/listCategories.php",
                "data" => [
                    "categories" => $categorieManager->findAll(["nomCategorie","ASC"])
                    ]
                ];
            }

        public function listTopics(){     
            
            $topicManager = new TopicManager();
            $topics = $topicManager->findTopicsByCategorie($id);

            return [
                "view" => VIEW_DIR."forum/listTopics.php",
                "data" => [
                    "topics" => $topics
                ]
            ];

        }

        public function listPosts(){

            $postManager = new PostManager();

        }
        
        

          

        

    }
