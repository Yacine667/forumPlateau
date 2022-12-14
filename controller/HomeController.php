<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\UserManager;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    
    class HomeController extends AbstractController implements ControllerInterface{

        public function index(){
            
           
                return [
                    "view" => VIEW_DIR."home.php"
                ];
            }
            
        
   
        public function users(){

            $this->restrictTo("admin");
    
            $manager = new UserManager();
            $users = $manager->findAll(['dateInscription', 'DESC']);
    
            return [
                "view" => VIEW_DIR."security/listUsers.php",
                "data" => [
                "users" => $users
                ]
            ];
            
            }


        public function viewprofils($id){

            $manager = new UserManager();
            $profils = $manager->findOneById($id);
            return [
                "view" => VIEW_DIR."security/viewProfil.php",
                "data" => [
                "profils" => $profils
                ]
            ];
        }

        public function forumRules(){
            
            return [
                "view" => VIEW_DIR."rules.php"
            ];
        }

        /*public function ajax(){
            $nb = $_GET['nb'];
            $nb++;
            include(VIEW_DIR."ajax.php");
        }*/
    }
