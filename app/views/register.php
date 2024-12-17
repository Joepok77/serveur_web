<main class="main-content">
        <h2>Inscription</h2>
        <form action="#" method="post" class="register-form">
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" placeholder="Votre nom" required>
            </div>
            
            <div class="form-group">
                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" name="prenom" placeholder="Votre prénom" required>
            </div>
            
            <div class="form-group">
                <label for="telephone">Téléphone :</label>
                <input type="tel" id="telephone" name="telephone" placeholder="06XXXXXXXX" required>
            </div>
            
            <div class="form-group">
                <label for="date_naissance">Date de naissance :</label>
                <input type="date" id="date_naissance" name="date_naissance" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" placeholder="exemple@domaine.com" required>
            </div>
            
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" placeholder="Mot de passe" required>
            </div>
            
            <div class="form-group">
                <label for="adresse">Adresse de livraison :</label>
                <input type="text" id="adresse" name="adresse" placeholder="Votre adresse" required>
            </div>
            
            <div class="form-group">
                <label for="code_postal">Code postal :</label>
                <input type="text" id="code_postal" name="code_postal" placeholder="Votre code postal" required>
            </div>

            <button type="submit" class="btn">S'inscrire</button>
        </form>
        <p>Déjà inscrit ? <a href="/login">Se connecter</a></p>
    </main>

</body>
</html>
