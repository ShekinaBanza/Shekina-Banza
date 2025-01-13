<!-- <div class="col-lg-7 ms-auto">
  <div class="form-container">
    <form method="post" id="messageForm">
      <div class="mb-4">
        <label for="name" class="form-label">Nom</label>
        <input type="text" name="name" class="form-control" id="name" required>
      </div>

      <div class="mb-4">
        <label for="email" class="form-label">Adresse Email</label>
        <input type="email" name="email" class="form-control" id="email" required>
      </div>

      <div class="mb-4">
        <label for="phone" class="form-label">Numéro téléphone</label>
        <input type="tel" name="phone" class="form-control" id="phone" required>
      </div>

      <div class="mb-4">
        <label for="message" class="form-label">Message</label>
        <textarea class="form-control" name="message" id="message" rows="3" required></textarea>
      </div>

      <div class="mb-4 form-check ps-0">
        <input type="checkbox" class="form-check-input" id="agree" name="agree" required>
        <label for="agree" class="form-check-label">En envoyant le formulaire, vous acceptez les Conditions &amp; Conditions et politique de confidentialité.</label>
      </div>

      <div class="position-relative">
        <button type="button" id="sendButton" class="link link-xxl text-body-color">
          <span>Envoyer</span>
        </button>
        <div class="loading" style="display: none;">Envoi en cours...</div>
      </div>
    </form>

    <div class="messgaeOutput" id="messgaeOutput" style="display: none;">
      <div id="success" style="display: none;">
        <h4>Merci!</h4>
        <p>Votre message a été envoyé avec succès ! Je vous contacterai dès que possible.</p>
      </div>
      <div id="error" style="display: none;">
        <h4>Oups... Désolé !</h4>
        <p>Quelque chose s'est mal passé. Essayez à nouveau.</p>
      </div>
    </div>
  </div>
</div>

<script>
  document.getElementById('sendButton').addEventListener('click', function () {
    const form = document.getElementById('messageForm');
    const formData = new FormData(form);
    const output = document.getElementById('messgaeOutput');
    const loading = document.querySelector('.loading');

    // Afficher le chargement
    loading.style.display = 'block';

    // Envoyer la requête AJAX
    fetch('send_email.php', {
      method: 'POST',
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        loading.style.display = 'none';
        if (data.success) {
          document.getElementById('success').style.display = 'block';
          document.getElementById('error').style.display = 'none';
        } else {
          document.getElementById('error').style.display = 'block';
          document.getElementById('success').style.display = 'none';
        }
        output.style.display = 'block';
      })
      .catch((error) => {
        loading.style.display = 'none';
        document.getElementById('error').style.display = 'block';
        document.getElementById('success').style.display = 'none';
        output.style.display = 'block';
      });
  });
</script> -->



<?php
header('Content-Type: application/json');

// Vérifier si les données POST sont disponibles
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $message = htmlspecialchars($_POST['message']);

    // Adresse de destination
    $to = 'shekina646@gmail.com';
    $subject = "Nouveau message de $name";
    $body = "
        Vous avez reçu un nouveau message :\n
        Nom : $name\n
        Email : $email\n
        Téléphone : $phone\n
        Message :\n$message\n
    ";
    $headers = "From: $email";

    // Envoyer l'email
    if (mail($to, $subject, $body, $headers)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Méthode non autorisée']);
}
