<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Plateforme de gestion financière et budgétaire d'entreprise</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f0f2f5;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .container {
      max-width: 900px;
      background-color: #ffffff;
      padding: 50px 40px;
      border-radius: 25px;
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
      text-align: center;
    }

    h1 {
      font-size: 2.6em;
      color: #003366;
      margin-bottom: 30px;
      line-height: 1.3em;
    }

    .marquee-block {
      height: 140px;
      position: relative;
      overflow: hidden;
      margin-bottom: 40px;
    }

    .message-block {
      position: absolute;
      top: 0;
      left: 50%;
      transform: translateX(-50%) scale(0.95);
      background-color: #e8f4fc;
      color: #003366;
      padding: 20px 30px;
      border-radius: 16px;
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
      opacity: 0;
      transition: opacity 1s ease, transform 1s ease;
      width: 100%;
      max-width: 700px;
      font-size: 1.2em;
    }

    .message-block.active {
      opacity: 1;
      transform: translateX(-50%) scale(1);
    }

    .btn {
      background-color: #00A8E8;
      color: white;
      padding: 15px 35px;
      border: none;
      border-radius: 30px;
      font-size: 1.1em;
      text-decoration: none;
      transition: background 0.3s, transform 0.3s;
      cursor: pointer;
    }

    .btn:hover {
      background-color: #007bb5;
      transform: translateY(-3px);
    }

    @media (max-width: 600px) {
      h1 {
        font-size: 2em;
      }

      .message-block {
        font-size: 1em;
      }

      .btn {
        font-size: 1em;
        padding: 12px 25px;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Plateforme de gestion financière<br>et budgétaire d'entreprise</h1>

    <div class="marquee-block" id="marquee">
      <!-- JS injecte les blocs ici -->
    </div>

    <a href="{{ route('login') }}" class="btn">Accéder à la plateforme</a>
  </div>

  <script>
    const messages = [
      "💼 FinanciaPro vous aide à maîtriser vos budgets et vos dépenses efficacement.",
      "📊 Suivez en temps réel vos finances avec des tableaux de bord intelligents.",
      "🔒 Profitez d’une sécurité avancée pour toutes vos données sensibles.",
      "🚀 Optimisez votre gestion financière et accélérez la croissance de votre entreprise.",
      "📈 Générez des rapports automatiques pour prendre des décisions éclairées."
    ];

    const marquee = document.getElementById("marquee");
    let currentIndex = 0;
    let block;

    function showMessage() {
      if (block) block.remove();

      block = document.createElement("div");
      block.className = "message-block active";
      block.textContent = messages[currentIndex];
      marquee.appendChild(block);

      currentIndex = (currentIndex + 1) % messages.length;
    }

    showMessage();
    setInterval(showMessage, 4000); // Change toutes les 4 secondes
  </script>
</body>
</html>
