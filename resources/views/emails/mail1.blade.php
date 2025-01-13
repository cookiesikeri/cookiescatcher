<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adobe Acrobat Sign</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        /* Custom Styles */
        .custom-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            text-align: center;
        }
        .logo {
            height: 60px;
        }
        .adobe-icon {
            height: 50px;
        }
        .btn-review {
            display: inline-block;
            background-color: #f5b400;
            color: black;
            font-weight: bold;
            text-transform: uppercase;
            text-decoration: none;
            padding: 12px 25px;
            border-radius: 5px;
            border: 1px solid #e0a800;
            font-size: 18px; /* Bigger font for the button */
            transition: all 0.3s ease;
        }
        .btn-review:hover {
            background-color: #d99e00;
            border-color: #d99e00;
            color: black;
        }
        .content-text {
            font-size: 18px; /* Larger font for body text */
            line-height: 1.6;
        }
        .file-info {
            font-weight: bold;
            font-size: 20px; /* Bigger font for file information */
            margin: 20px 0;
        }
        .footer a {
            color: #0078d4;
            text-decoration: none;
            font-size: 14px;
        }
        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container custom-container rounded">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <img src="{{ asset('apc.png') }}" alt="Adobe Acrobat Sign Logo" class="logo" height="50" width="60">
            <img src="{{ asset('hfhgh.png') }}" alt="Adobe Icon" class="adobe-icon">
        </div>

        <!-- Content -->
        <p class="text-primary mb-3">
            <a href="mailto:noah.guilleux@sa-sl.fr" class="text-decoration-none">noah.guilleux@sa-sl.fr</a> vous a envoyé un fichier partagé
        </p>
        <p class="fw-bold mb-2 content-text">Bonjour,</p>
        <p class="content-text mb-3">
            Le message vous est adressé et contient un document Adobe I accessible en ligne sous forme de PDF ; veuillez suivre les instructions à l'écran pour accéder au document.
        </p>

        <div class="file-info">
            FICHIER : Accord juridique et Bon de commande .pdf
        </div>

        <!-- Button -->
        <div class="mb-4">
            <a href="#" class="btn-review">DOCUMENT DE RÉVISION</a>
        </div>
<br>
<br>
<hr>
        <!-- Footer -->
        <div class="footer small">
            <a href="#">Manage Your Account</a> |
            <a href="#">Customer Support</a> |
            <a href="#">Forums</a> |
            <a href="#">Terms of Use</a>
        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
