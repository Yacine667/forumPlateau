<?php
 
    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use App\DAO;

    use Model\Managers\UserManager;
    use Model\Managers\PostManager;
    use Model\Managers\TopicManager;
    use Model\Managers\CategorieManager;

    class SecurityController extends AbstractController implements ControllerInterface {

        public function index() {

        }

public function addUser() {

    if (isset($_POST['register'])) {
        var_dump($_POST);die;
        $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $mail = filter_input(INPUT_POST, "mail", FILTER_SANITIZE_EMAIL);

        $mdp = $_POST['mdp'];
        $mdp2 =  $_POST['mdp2'];

        if($pseudo && $mail && $mdp && $mdp2 && ($mdp == $mdp2)) {

            $userManager = new UserManager();

            $passwordHash = password_hash($mdp, PASSWORD_DEFAULT);


                $newUser=[
                    "pseudo"=>$pseudo,
                    "mail"=>$mail,
                    "mdp"=>$passwordHash
                ];

                $userManager->add($newUser); 

                $this->redirectTo('home');  


            } 
    
             return ["view" => VIEW_DIR. "security/register.php"];
        }


    }

}