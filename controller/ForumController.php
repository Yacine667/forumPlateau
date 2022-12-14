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


        public function editTopicForm($id){

            $topicManager = new TopicManager();
            $topic = $topicManager->findOneById($id);

            $postManager = new PostManager();
            $firstPost = $postManager->findFirstPostByTopic($id);

            return [
                "view" => VIEW_DIR."forum/editTopic.php",
                "data" => [
                    "topic" => $topic,
                    "firstPost" => $firstPost,
                ]
            ];
        }


        public function editTopic($id){

            $topicManager = new TopicManager();
            $userId = $topicManager->findOneById($id)->getUser()->getId();
            if(\App\Session::getUser()){
                if(\App\Session::getUser()->getId() == $userId || \App\Session::isAdmin()){
                    
                    $newTitle = filter_input(INPUT_POST, "newTitle", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                    $data=["title" => $newTitle];
                    $topicManager->editTopic($id, $data);

                    $postManager = new PostManager();
                    $firstPost = $postManager->findFirstPostByTopic($id);

                    $newMessage = filter_input(INPUT_POST, "newMessage", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    
                    $data=["message" => $newMessage];
                    

                    $firstPostId = $firstPost->getId();
                    $postManager->editPost($firstPostId, $data);
                    
                    Session::addFlash('success','Topic modifié avec succès');
                }
                else{
                    Session::addFlash('error','Action Impossible');
                }    
            }
            else{
                Session::addFlash('error','Action Impossible');
            }

            $this->redirectTo("forum", "listTopicByCat", $id);
        }


        public function lockTopic($id) {
            $topicManager = new TopicManager();

            $topicId=(isset($_GET["id"])) ? $_GET["id"] : null;
            $categorieId = $topicManager->findTopicById($topicId)->getnomCategorie();
            $topicManager->lockTopic($topicId);
            Session::addFlash('success','Sujet verouillé');
            self::redirectTo('forum','listTopicByCat',$categorieId);
        }


        public function unlockTopic($id) {

            $topicManager = new TopicManager();
            $topicId=(isset($_GET["id"])) ? $_GET["id"] : null;
            $categorieId = $topicManager->findTopicById($topicId)->getNomCategorie();
            $topicManager->unlockTopic($topicId);
            Session::addFlash('success','Sujet déverrouillé');
            self::redirectTo('forum','listTopicByCat',$categorieId);        

        }

        public function deleteTopic(){

            $sujetManager = new TopicManager();
            $messageManager = new PostManager();
            $sujetId=(isset($_GET["id"])) ? $_GET["id"] : null;
            $messageManager->deleteAllMessageTopic($sujetId);
            $sujetManager->delete($sujetId);
            Session::addFlash('success','Sujet supprimé');
            self::redirectTo('forum','listTopics');

        }

        public function editPost($id) {

            $postManager = new PostManager();
            $post = $postManager->findOneById($id);

            $message = filter_input(INPUT_POST, "message", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if($_SESSION['user']) {

                $userId = $_SESSION['user']->getId();

                if($userId == $post->getUser()->getId()) {

                    if($message) {

                        $postManager->editPost($id,$message);
                        $this->redirectTo("forum","listPosts", $post->getTopic()->getId());

                    }

                } 
                
                else {
                    Session::addFlash("error","vous n'êtes pas autorisé à modifier ce message");
                    $this->redirectTo("forum","listPosts", $post->getTopic()->getId());
                }

            } 
            
            else {
                Session::addFlash("error","vous n'êtes pas autorisé à modifier ce sujet");
                $this->redirectTo("forum","listPosts", $post->getTopic()->getId());
            }

            return [
                "view" => VIEW_DIR."forum/editPost.php",
                "data" => ["post" => $postManager->findOneById($id)]
            ];
        }

        public function deletePost($id) {

            $postManager = new PostManager();
            $post = $postManager->findOneById($id);

            $postManager->delete($id);

            $this->redirectTo("forum","listPosts", $post->getTopic()->getId());
        }

}