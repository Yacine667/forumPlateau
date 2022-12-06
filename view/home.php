<h1>BIENVENUE SUR LE FORUM</h1>

<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit ut nemo quia voluptas numquam, itaque ipsa soluta ratione eum temporibus aliquid, facere rerum in laborum debitis labore aliquam ullam cumque.</p>

<?php
                        
                        if(App\Session::getUser()){
                            ?>
                            <a href="/security/viewProfile.html"> <i class="fa-regular fa-user"></i></span>&nbsp;<?= App\Session::getUser()?></a>
                            <a href="index.php?ctrl=security&action=logout">Déconnexion </a>
                            <?php
                        }
                        else{
                            ?>
                            <a href="index.php?ctrl=security&action=login">Connexion </a>
                            <a href="index.php?ctrl=security&action=addUser"> Inscription </a>
                            
                        <?php
                        }                
                        
                    ?>