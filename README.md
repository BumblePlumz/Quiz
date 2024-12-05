# DailyQuiz

DailyQuiz est une application qui permet de générer des quiz journaliers de 5 questions.

## Installation

### Installer le projet

Suivez les étapes ci-dessous pour installer et exécuter l'application :

1. Clonez le dépôt :

    ```bash
    git clone https://github.com/BumblePlumz/Quiz.git
    ```

2. Accédez au répertoire du projet :

    ```bash
    cd DailyQuiz
    ```

3. Installez les dépendances :

    ```bash
    composer install
    npm install
    ```

4. Construisez le projet :

    ```bash
    npm run build
    ```

5. Copier le fichier .env.exemple en .env  
   Ensuite configurer le fichier avec une base de donnée valide.  

6. Effectuer les migrations sur la base de données  
    ```bash  
    php artisan migrate:fresh --seed  
    ```  
L'utilisateur de base est :  
 - email : admin@ex.fr  
 - password : password  

7. Exécuter manuellement la commande pour générer un quiz  
    => app:daily-quiz {theme} {difficulté} --date='2024-12-2'  
    ```bash
    php artisan app:daily-quiz PHP moyen  
    ```  
   NB: Assurez-vous d'avoir Ollama d'installer  
    ```bash
    ollama run llama3.2
    ```  

8. Démarrez le serveur :
    ```bash
    php artisan serve
    ```

9. Ouvrez votre navigateur et accédez à l'adresse suivante :
    ```
    http://localhost:8000
    ```

### Ollama

Aller sur le site [ollama.com](https://ollama.com/)  
Télécharger et installer le client  
Ensuite exécuter la commande bash de l'étape précédente

## Fonctionnalités

-   Génération de quiz journaliers de 5 questions
-   Interface utilisateur intuitive
-   Suivi des scores

## Contribuer

Les contributions sont les bienvenues ! Veuillez soumettre une pull request ou ouvrir une issue pour discuter des modifications que vous souhaitez apporter.

## Licence

Ce projet est sous licence MIT. Voir le fichier [LICENSE](LICENSE) pour plus de détails.
