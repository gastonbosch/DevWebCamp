<?php

    namespace Classes;

    use Brevo\Client\Api\TransactionalEmailsApi as ApiTransactionalEmailsApi;
    use Brevo\Client\Configuration as ClientConfiguration;
    use Brevo\Client\Model\SendSmtpEmail as ModelSendSmtpEmail;
    
    use Exception;
    use GuzzleHttp;

    class Email {
        
        protected $email;
        protected $nombre;
        protected $token;
    
        public function __construct($email, $nombre, $token)
        {
            $this->email = $email;
            $this->nombre = $nombre;
            $this->token = $token;
    
        }

        public function sendConfirmation(){
            try {
                $config = ClientConfiguration::getDefaultConfiguration()->setApiKey('api-key', $_ENV['API_KEY_BREVO']);

                $apiInstance = new ApiTransactionalEmailsApi(
                    new GuzzleHttp\Client(),
                    $config
                );

                $sendSmtpEmail = new ModelSendSmtpEmail([
                    'subject' => 'Confirma tu Cuenta',
                    'sender' => ['name' => 'Gaston', 'email' => 'gastonbosch@hotmail.com'],
                    //'replyTo' => ['name' => 'Sendinblue', 'email' => 'contact@sendinblue.com'],
                    //'to' => [[ 'name' => $this->nombre, 'email' => $this->email]],
                    'to' => [[ 'name' => $this->nombre, 'email' => $this->email]],
                    'htmlContent' => '<html><body><p>Hola <strong>{{params.nombre}}.</strong> Has Registrado Correctamente tu cuenta en DevWebCamp, pero es necesario confirmarla</p>
                    Click aqui <a href="{{params.dominio}}/confirmar-cuenta?token={{params.token}}">confirmar cuenta</a>
                    <p>Si usted no solicito es cambio, ignore este mensaje</p>
                    </body></html>',
                    'params' => ['nombre' => $this->nombre, 'token'=>$this->token, 'dominio'=>$_ENV['APP_URL']]
                ]); 
                
                $result = $apiInstance->sendTransacEmail($sendSmtpEmail);

            } catch (Exception $e) {
                echo 'Exception when calling TransactionalEmailsApi->sendTransacEmail: ', $e->getMessage(), PHP_EOL;
            }
        }

        public function sendInstructions(){

            try {
                $config = ClientConfiguration::getDefaultConfiguration()->setApiKey('api-key', $_ENV['API_KEY_BREVO']);

                $apiInstance = new ApiTransactionalEmailsApi(
                    new GuzzleHttp\Client(),
                    $config
                );

                $sendSmtpEmail = new ModelSendSmtpEmail([
                    'subject' => 'Reestablecer contraseña',
                    'sender' => ['name' => 'Gaston', 'email' => 'gastonbosch@hotmail.com'],
                    'to' => [[ 'name' => $this->nombre, 'email' => $this->email]],
                    'htmlContent' => '<html><body><p>Hola <strong>{{params.nombre}}</strong> 
                    Usted ha solicitado reestablecer su contraseña, siga el siguiente enlace para hacerlo.</p>
                    Click aqui <a href="{{params.dominio}}/reestablecer?token={{params.token}}">
                    Reestablecer contraseña</a><p>Si usted no solicito es cambio, ignore este mensaje</p>
                    </body></html',
                    'params' => ['nombre' => $this->nombre, 'token'=>$this->token, 'dominio'=>$_ENV['APP_URL']]
                ]); 

                $result = $apiInstance->sendTransacEmail($sendSmtpEmail);
                
            } catch (Exception $e) {
                echo 'Exception when calling TransactionalEmailsApi->sendTransacEmail: ', $e->getMessage(), PHP_EOL;
            }
        }
    }

/*namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {

    public $email;
    public $nombre;
    public $token;
    
    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion() {

         // create a new object
         $mail = new PHPMailer();
         $mail->isSMTP();
         $mail->Host = $_ENV['EMAIL_HOST'];
         $mail->SMTPAuth = true;
         $mail->Port = $_ENV['EMAIL_PORT'];
         $mail->Username = $_ENV['EMAIL_USER'];
         $mail->Password = $_ENV['EMAIL_PASS'];
     
         $mail->setFrom('cuentas@devwebcamp.com');
         $mail->addAddress($this->email, $this->nombre);
         $mail->Subject = 'Confirma tu Cuenta';

         // Set HTML
         $mail->isHTML(TRUE);
         $mail->CharSet = 'UTF-8';

         $contenido = '<html>';
         $contenido .= "<p><strong>Hola " . $this->nombre .  "</strong> Has Registrado Correctamente tu cuenta en DevWebCamp; pero es necesario confirmarla</p>";
         $contenido .= "<p>Presiona aquí: <a href='" . $_ENV['HOST'] . "/confirmar-cuenta?token=" . $this->token . "'>Confirmar Cuenta</a>";       
         $contenido .= "<p>Si tu no creaste esta cuenta; puedes ignorar el mensaje</p>";
         $contenido .= '</html>';
         $mail->Body = $contenido;

         //Enviar el mail
         $mail->send();

    }

    public function enviarInstrucciones() {

        // create a new object
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];
    
        $mail->setFrom('cuentas@devwebcamp.com');
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Reestablece tu password';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= "<p><strong>Hola " . $this->nombre .  "</strong> Has solicitado reestablecer tu password, sigue el siguiente enlace para hacerlo.</p>";
        $contenido .= "<p>Presiona aquí: <a href='" . $_ENV['HOST'] . "/reestablecer?token=" . $this->token . "'>Reestablecer Password</a>";        
        $contenido .= "<p>Si tu no solicitaste este cambio, puedes ignorar el mensaje</p>";
        $contenido .= '</html>';
        $mail->Body = $contenido;

        //Enviar el mail
        $mail->send();
    }
}
*/
?>