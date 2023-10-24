<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Application de gestion financière</title>
</head>
<body>

    Bonjour {{ $mailData['user']->fname }}  {{ $mailData['user']->lname }}, <br><br>

    <p>Votre compte sur la plateforme de gestion financière a été créé</p>
    <p>Ci-dessous vos identifiants de connexion</p>
    <p><strong>Email: </strong> {{ $mailData['user']->email }}</p>
    <p><strong> Mot de passe:</strong>  password</p>
    <br>

    <p>
        <a href="{{ url('http://supportdaf.bfclimited.com:8060/users/profile/', $mailData['user']->id) }}">
            Cliquer ici pour vous connecter à l'application et modifier<br>
            votre mot de passe et votre numéro de téléphone
        </a>
    </p>
</body>
</html>
