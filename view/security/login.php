<body>
    <main>
        <h1>Se connecter</h1>

        <form action="\forumplateau/index.php?ctrl=security&action=login" method="post">
            <label>
                Entrez votre E-mail : <br>
                <input type="text" name="mail" required>
            </label>
            <br>
            <label>
                Entrez votre mot de passe : <br>
                <input type="password" name="mdp" required>
            </label>
            <br>
            <input type="submit" name="connect" value="Se connecter">
        </form>
    </main>

</body>

</html>