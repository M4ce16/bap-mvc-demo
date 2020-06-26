<?php

namespace Website\Controllers;

/**
 * Class LoginController
 *
 * Deze handelt de logica van het inloggen en uitloggen af
 *
 */
class EmailController {


  public function sendTestEmail() {
      $mailer  = getSwiftMailer();

      $message = createEmailMessage('Hallo@hoi.com', 'Dit is een test e-mail', 'Mika Vos', '28471@ma-web.nl');
      $message->setBody('Dit is de inhoud van mijn test bericht');

      $aantal_verstuurd = $mailer->send($message);
      echo "Aantal = " . $aantal_verstuurd;
		}
}
