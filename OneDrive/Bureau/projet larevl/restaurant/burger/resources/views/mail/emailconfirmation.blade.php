<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture ISI Burger</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            padding: 20px;
        }
        .container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }
        h2 {
            color: #d9534f;
        }
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #666;
        }
        .button {
            background-color: #d9534f;
            color: #fff;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin-top: 15px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Merci pour votre commande chez ISI Burger 🍔 !</h2>
        <p>Bonjour <strong>{{ $user->name }}</strong>,</p>
        <p>Nous vous remercions pour votre commande chez ISI Burger. Vous trouverez ci-joint votre facture.</p>

        <p><strong>Détails de votre commande :</strong></p>
        <ul>
            @foreach($commandes as $commande)
                <li>{{ $commande->produit->nom }} x{{ $commande->quantite }} - {{ number_format($commande->prix, 2, ',', ' ') }} FCFA</li>
            @endforeach
        </ul>

        <p><strong>Total payé :</strong> {{ number_format($prix_total, 2, ',', ' ') }} FCFA</p>

        <p>Vous pouvez télécharger votre facture en pièce jointe.</p>

        <p>À bientôt chez <strong>ISI Burger</strong> !</p>

        <div class="footer">
            <p>ISI Burger - Votre restaurant préféré 🍔</p>
            <p>Contact : contact@isiburger.com</p>
            <p>📍 Adresse : Dakar, Sénégal</p>
        </div>
    </div>

</body>
</html>
