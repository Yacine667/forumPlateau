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

        
        public function deleteCategorie($id) {

            $categorieManager = new CategorieManager();

            $categorieManager->delete($id);
            $this->redirectTo("forum","listCategories");
        }


        public function editCategorie($id) {
            $categorieManager = new CategorieManager();

            $nomCategorie = filter_input(INPUT_POST, "nomCategorie", FILTER_SANITIZE_SPECIAL_CHARS);

            if($nomCategorie) {
            
                $categorieManager->editCategorie($id, $nomCategorie);
                $this->redirectTo("forum","listCategories");
            }

            return [
                "view" => VIEW_DIR."forum/editCategorie.php",
                "data" => ["categorie" => $categorieManager->findOneById($id)]
            ];
        }


        public function editTopicForm($id) {
            $topicManager = new TopicManager();
            $topic = $topicManager->findOneById($id);

            return [
                "view" => VIEW_DIR."forum/editTopic.php",
                "data" => ["topic" => $topicManager->findOneById($id)]
            ];
        }


        public function editTopic($id) {
        $topicManager = new TopicManager();
        $topic = $topicManager->findOneById($id)->getUser()->getId();
    
            
            if(\App\Session::getUser()) {

                $userId =\App\Session::getUser()->getId();

                if($userId==$topic->getUser()->getId()) {

                    $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    
                    
                    if($title) {

                        $topicManager->editTopic($id,$title);
                        $this->redirectTo("forum","listTopicByCat",$topic->getNomCategorie()->getId());

                    } else {
                        Session::addFlash("error","Renseigner un titre");
                        $this->redirectTo("forum","listTopicByCat", $topic->getNomCategorie()->getId());
                    }
                 
                }
                
                else {
                    Session::addFlash("error","Vous n'êtes pas autorisé à modifier ce sujet");
                    $this->redirectTo("forum","listTopicByCat", $topic->getNomCategorie()->getId());
                }
                

            } 
            
            else {
                Session::addFlash("error","Veuillez vous connecter");
                $this->redirectTo("forum","listTopicByCat", $topic->getNomCategorie());
            }            
        }


        public function lockTopic($id) {
            $topicManager = new TopicManager();
            $topic = $topicManager->findOneById($id);

            if($_SESSION['user']) {

                $userId = $_SESSION['user']->getId();

                if($userId==$topic->getUser()->getId()) {

                    $topicManager->lockTopic($id);
                    $this->redirectTo("forum","listTopicByCat", $topic->getNomCategorie()->getId());
                }
                
                else {

                    Session::addFlash("error","Vous n'êtes pas autorisé à modifier ce sujet");
                    $this->redirectTo("forum","listTopicByCat", $topic->getNomCategorie()->getId());
                }

            } 
            
            else {

                Session::addFlash("error","Vous n'êtes pas autorisé à modifier ce sujet");
                    $this->redirectTo("forum","listTopicByCat", $topic->getNomCategorie()->getId());
            }
        }


        public function unlockTopic($id) {
            $topicManager = new TopicManager();
            $topic = $topicManager->findOneById($id);

            if($_SESSION['user']) {

                $userId = $_SESSION['user']->getId();

                if($userId==$topic->getUser()->getId()) {

                    $topicManager->unlockTopic($id);
                    $this->redirectTo("forum","listTopicByCat", $topic->getNomCategorie()->getId());
                }
                
                else {

                    Session::addFlash("error","Vous n'êtes pas autorisé à modifier ce sujet");
                    $this->redirectTo("forum","listTopicByCat", $topic->getNomCategorie()->getId());
                }

            } else {

                Session::addFlash("error","vous n'êtes pas autorisé à modifier ce sujet");
                $this->redirectTo("forum","listTopicByCat", $topic->getNomCategorie()->getId());
            }
        }

            

            

            

    }
