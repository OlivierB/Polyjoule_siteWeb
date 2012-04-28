<?php  
    class EMail
    {  
        private $DestMail ;
        private $objet ;
        private $message;
        private $_header;   

        public function __construct($dMail, $obj, $mess)
        {

			// on génère une chaîne de caractères aléatoire qui sera utilisée comme frontière
			$boundary = "-----=" . md5( uniqid ( rand() ) );

			$this->_header = "From: \"administration@polyjoule.org\" <administration@polyjoule.org>\n";
			// on indique qu'on a affaire à un email au format html et texte et
			// on spécifie la frontière (boundary) qui servira à séparer les deux parties
			// ainsi que la version mime
			$this->_header .= "MIME-Version: 1.0\n";
			$this->_header  .= "Content-Type: multipart/alternative; boundary=\"$boundary\"";

			$this->DestMail = $dMail;
			$this->objet = $obj;
			
			$this->message .= "\n\n";
			$this->message .= "--" . $boundary . "\n";
			$this->message .= "Content-Type: text/html; charset=\"utf-8\"\n";
			$this->message .= "Content-Transfer-Encoding: quoted-printable\n\n";
			$this->message .= $mess;
			$this->message .= "\n\n";
			$this->message .= "--" . $boundary . "--\n";
        }


        public function sendMail() 
        {
			//=====Envoi de l'e-mail.
			return mail($this->DestMail,$this->objet,$this->message,$this->_header);
			
			
        }
        

    }
    
    ?>