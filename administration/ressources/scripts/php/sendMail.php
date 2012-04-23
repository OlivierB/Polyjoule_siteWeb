<?php  
    class EMail
    {  
        private $DestMail ;
        private $SrcMail;
        private $objet ;
        private $message;
        private $boundary;
        private $_header;   

        public function __construct($dMail, $obj, $mess)
        {

            $this->DestMail = $dMail;
            $this->SrcMail = "administration@polyjoule.org";
            $this->objet = $obj;
            $this->message = $mess; 
            $this->boundary= "-----=".md5(rand());
            $passage_ligne = "\n"; 
            $this->_header="From: \"administration@polyjoule.org\"<administration@polyjoule.org>".$passage_ligne;
			$this->_header.= "Reply-to: \"administration@polyjoule.org\"<administration@polyjoule.org>".$passage_ligne;
			$this->_header.= "MIME-Version: 1.0".$passage_ligne;
			$this->_header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"".$this->boundary."\"".$passage_ligne;          
        }


        public function sendMail() 
        {
			$passage_ligne = "\n";
			$message = $passage_ligne."--".$this->boundary.$passage_ligne;
			//=====Ajout du message au format texte.
			$message.= "Content-Type: text/html; charset=\"UTF8\"".$passage_ligne;
			$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
			$message.= $passage_ligne.$this->message.$passage_ligne;
			//==========
			$message.= $passage_ligne."--".$this->boundary.$passage_ligne;
			//==========
			$message.= $passage_ligne."--".$this->boundary."--".$passage_ligne;
			$message.= $passage_ligne."--".$this->boundary."--".$passage_ligne;
			//==========
			$this->message = $message;
 
			//=====Envoi de l'e-mail.
			return mail($this->DestMail,$this->objet,$this->message,$this->_header);
        }
        

    }
    
    ?>