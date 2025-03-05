<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Form Using PHPMailer & Gmail SMTP</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.1/css/bootstrap.min.css' />
</head>

<body class="bg-dark-subtle">
  <div class="container">
    <div class="row min-vh-100 justify-content-center align-items-center">
      <div class="col-lg-5">
        <div class="card shadow-lg">
          <div class="card-header">
            <h3 class="text-center fw-bold">Contact Us</h3>
          </div>
          <div class="card-body p-5">
            <div class="alert d-none" id="alertMessage">
            </div>
            <form method="post" id="contactForm" autocomplete="off">
              <div class="form-floating mb-3">
                <input class="form-control" id="inputName" type="text" name="name" placeholder="Name" required />
                <label for="inputName">Name</label>
              </div>
              <div class="form-floating mb-3">
                <input class="form-control" id="inputEmail" type="email" name="email" placeholder="Email address" required />
                <label for="inputEmail">Email address</label>
              </div>
              <div class="form-floating mb-3">
                <input class="form-control" id="inputPhone" type="tel" name="phone" placeholder="Phone number" required />
                <label for="inputPhone">Phone number</label>
              </div>
              <div class="form-floating mb-3">
                <textarea class="form-control" id="inputMessage" name="message" placeholder="Message" style="height: 10rem" required></textarea>
                <label for="inputMessage">Message</label>
              </div>
              <div class="mt-4 mb-0">
                <button class="btn btn-primary" id="btn" type="submit">Send Message</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    const contactForm = document.querySelector('#contactForm');
    const btn = document.querySelector('#btn');
    const alertMessage = document.querySelector('#alertMessage');

    contactForm.addEventListener('submit', function(e) {
      btn.textContent = 'Sending...';
      btn.disabled = true;
      e.preventDefault();
      const formData = new FormData(this);
      fetch('sendmail.php', {
          method: 'post',
          body: formData
        })
        .then(function(response) {
          return response.text();
        })
        .then(function(text) {
          if (text === 'success') {
            btn.textContent = 'Send Message';
            btn.disabled = false;
            alertMessage.classList.remove('d-none');
            alertMessage.classList.add('alert-success');
            alertMessage.innerHTML = 'Your message has been sent!';
          } else {
            btn.textContent = 'Send Message';
            btn.disabled = false;
            alertMessage.classList.remove('d-none');
            alertMessage.classList.add('alert-danger');
            alertMessage.innerHTML = 'Something went wrong!';
          }
        })
        .catch(function(error) {
          console.error(error);
        })
    });
  </script>
</body>

</html>