# Installation

1. Clone the repository
2. Run `composer install` to install PHPMailer dependency

```bash
  composer install
```

# Configuration

1. Open `sendmail.php` file
2. Change the following lines with your own credentials

```php
  $mail->Username = ''; // Your Gmail address
  $mail->Password = ''; // Your Gmail App password
  $mail->setFrom(''); // Your Gmail address (again)
  $mail->addAddress(''); // Your recipient, where the email will be sent
```
