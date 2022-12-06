<body>
    <main>
        <h1>S'inscrire</h1>
    
        <form action="\forumplateau/index.php?ctrl=security&action=addUser" method="post">
            <p>
                <label >
                    Pseudo : <br>
                </label>
                <input type="text" name="pseudo" required>
            </p>
            <p>
                <label >
                    E-mail : <br>
                    <input type="email" name="mail" required>
                </label>
            </p>
            <p>
                <label >
                    Mot de passe : <br>
                    <input type="password" name="mdp" required>
                </label>
            </p>
            <p>
                <label >
                    Confirmer le mot de passe : <br>
                    <input type="password" name="mdp2" required>
                </label>
            </p>
            <p>
                <input id="button" type="submit" name="register" value="S'inscrire">
            </p>
        </form>
    </main>

</body>
</html>
