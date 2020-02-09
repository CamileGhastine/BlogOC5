<?php


namespace CamileApp\Core\Mail;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mailer
{
    private $host;
    private $username;
    private $password;

    public function __construct($config)
    {
        $this->host = $config['host'];
        $this->username = $config['username'];
        $this->password = $config['password'];
    }

    public function send($mailDetails, $from='camile@ghastine.com', $name='Camile')
    {
        $mail = new PHPMailer;

        try
        {
            extract($this->formatForFrench($mail, $mailDetails['subject'], $mailDetails['body'] ));

            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host = $this->host;
            $mail->SMTPAuth = true;
            $mail->Username = $this->username;
            $mail->Password = $this->password;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            //Recipients
            $mail->setFrom($from, $name);
            $mail->addAddress($mailDetails['adress']);
            $mail->addBCC('copy@ghastine.com', 'contact'); // storage adress for sent emails

            // Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;

            $mail->send();
            return 'ok';
        }
        catch (Exception $e)
        {
            return "Le message n\'a pu être envoyé. Erreur : {$mail->ErrorInfo}";
        }
    }

    private function formatForFrench($mail, $subject, $body)
    {
        $mail->setLanguage('fr');
        $mail->Charset = 'utf-8';

        $body = htmlentities($body,ENT_NOQUOTES,'UTF-8',false);
        $body = str_replace(array('&lt;','&gt;'),array('<','>'), $body);
        $body = str_replace(array('&amp;lt;','&amp;gt'),array('&lt;','&gt;'), $body);

        $subject = mb_encode_mimeheader($subject,"UTF-8");

        return compact('subject', 'body');
    }

    public function answerFormContact($post)
    {
        return $mailDetails =[
            'adress' => $post['email'],
            'subject' =>'Réponse automatique : Formulaire de contact',
            'body' => '
Bonjour '.ucfirst($post['first_name']).',<br/>
Merci de m\'avoir contacté.<br/>
Je vous répondrai dans les plus brefs délais.<br/>
<B>Camile Ghastine</B>'
        ];
    }

    public function unlock($user, $newPass)
    {
        return $mailDetails =[
            'adress' => $user->getEmail(),
            'subject' =>'Réinialisation du mot de passe',
            'body' => '
Bonjour '.ucfirst($user->getPseudo()).',<br/>
Votre compte à été débloqué avec succès.<br/>
Reconnectez-vous avec le mot de passe suivant : '.$newPass.'<br/>
Une fois connecté, cliquez dans le menu sur compte de '.ucfirst($user->getPseudo()).' pour changer votre mot de passe<br/>
<B>Camile Ghastine</B>
'];

    }
}