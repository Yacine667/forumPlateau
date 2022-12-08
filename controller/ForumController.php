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

            return [
                "view" => VIEW_DIR . "forum/listTopics.php",
                "data" => [
                    "topics" => $topicManager->findAll(["creationDate", "DESC"])
                ]
            ];

        }

        public function listPosts($id){

            $postManager = new PostManager();

            return [
                "view" => VIEW_DIR . "forum/listPosts.php",
                "data" => [
                    "posts" => $postManager->findPostsByTopic($id)
                ]
            ];

        }

        public function listTopicByCat($id){     
            
            $topicManager = new TopicManager();

            return [
                "view" => VIEW_DIR . "forum/listTopicByCat.php",
                "data" => [
                    "topics" => $topicManager->findTopicsByCategorie($id)
                ]
            ];

        }        

        public function addTopic($id) {

            $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $message = filter_input(INPUT_POST, "message", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $userId = $_SESSION['user'] -> getId();
            $topicManager = new TopicManager();
            $postManager = new PostManager();

            if($title && $message ) {

                $newTopic=["title"=>$title,"categorie_id"=>$id, "user_id"=>$userId];
                $topicId = $topicManager->add($newTopic);
                $newPost=["message"=>$message,"topic_id"=>$topicId ,"user_id"=>$userId];
                $postManager->add($newPost);

                $this->redirectTo("forum","listTopicByCat",$id);
            }   
    }

        public function addPost($id) {

            $message = filter_input(INPUT_POST, "message", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $userId=  $_SESSION['user'] -> getId();
            $postManager = new PostManager();

            if($message) {

                $newPost=["message"=>$message,"topic_id"=>$id ,"user_id"=>$userId];
                $postManager->add($newPost);

                $this->redirectTo("forum","listPosts",$id);
            }
    }


    public function addCategorie() {

        $nomCategorie= filter_input(INPUT_POST, "nomCategorie", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
        $categorieManager = new CategorieManager();
    
        if($nomCategorie) {

            $newCategorie=["nomCategorie"=>$nomCategorie];
            $categorieManager->add($newCategorie);
    
            $this->redirectTo("forum","listCategories");
        }
    }

        
        

          

        

    }
