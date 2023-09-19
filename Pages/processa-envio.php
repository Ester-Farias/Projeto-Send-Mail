<?php

    require "../PHPMailer-php-8.2/PHPMailer/Exception.php";
    require "../PHPMailer-php-8.2/PHPMailer/OAuthTokenProvider.php";
    require "../PHPMailer-php-8.2/PHPMailer/OAuth.php";
    require "../PHPMailer-php-8.2/PHPMailer/PHPMailer.php";
    require "../PHPMailer-php-8.2/PHPMailer/POP3.php";
    require "../PHPMailer-php-8.2/PHPMailer/SMTP.php";
    //Namespace
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    class Mensagem {
        private $para = null;
        private $assunto = null;
        private $mensagem = null;
        public $status = array('codigo_status' => null, 'descricao_status' => '');

        public function __get($atributo){
            return $this->$atributo;
        }
        public function __set($atributo, $valor){
            $this->$atributo = $valor;
        }
        public function mensagemValida(){
            if(empty($this->para) || empty($this->assunto) || empty($this->mensagem)){
                return false;
            }
            return true;
        }
    }
    
    $mensagem = new Mensagem();
    $mensagem->__set('para', $_POST['para']);
    $mensagem->__set('assunto', $_POST['assunto']);
    $mensagem->__set('mensagem', $_POST['mensagem']);

    
    if(!$mensagem->mensagemValida()){
        echo 'Mensagem não é válida';
        header('Location: ../index.php');
    }

        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = false;                        //Enable verbose debug output
            $mail->isSMTP();                                 //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';            //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                        //Enable SMTP authentication
            $mail->Username   = 'Seu_email_aqui@gmail.com';  //SMTP username
            $mail->Password   = 'Sua_Senha_Aqui';            //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
            $mail->Port       = 465;                         //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom('Seu_email_aqui@gmail.com', 'Remetente do E-mail');
            $mail->addAddress($mensagem->__get('para'));     //Add a recipient
            //$mail->addReplyTo('info@example.com', 'Information');
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');
        
            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
        
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $mensagem->__get('assunto');
            $mail->Body    = $mensagem->__get('mensagem');
            $mail->AltBody = 'É necessário utilizar um client que suporte HTML para ter acesso total ao conteúdo dessa mensagem.';
        
            $mail->send();
            $mensagem->status['codigo_status'] = 1;
            $mensagem->status['descricao_status'] = 'E-mail enviado com sucesso';

        } catch (Exception $e) {
            $mensagem->status['codigo_status'] = 2;
            $mensagem->status['descricao_status'] = "Não foi possivel enviar este e-mail. Por favor tente mais tarde. Tipo do erro: {$mail->ErrorInfo}";
        }
?><html>
<head>
    <meta charset="utf-8" />
    <title>App Mail Send</title>
    <!-- FontAwesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--Bootstrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        html body{
            scroll-behavior: smooth;
            box-shadow: inset 0 0 9rem rgb(252, 197, 197);
            color: rgba(0, 0, 0, 0.747);
            background-color: #ffffff;	
        }
        /* Estilizando o ScrollBar*/

        /* Trilho */
        ::-webkit-scrollbar{
            background: rgba(252, 197, 197, 0.473);
            width: 0.9vw;
        }

        /* ScrollBar*/
        ::-webkit-scrollbar-thumb{
            background-color: #dc3545;
            border-radius: 6px;
        }
        .fa-solid {
            font-size: 58px;
        }
    </style>
</head>
<body>
<div class="container">  
    <div class="text-center">
        <i class="fa-solid fa-comments text-danger my-3"></i>
            <h3>Send Mail</h3>
            <p>Seu app de envio de e-mails particular!</p>
        </div>
          <div class="row justify-content-center">
              <div class="col-md-6">
                <div class="card-body font-weight-bold">
                    <?php if($mensagem->status['codigo_status'] == 1) { ?>

                        <h4 class="display-4 text-success">
                            Sucesso
                        </h4>
                        <p><?= $mensagem->status['descricao_status']?></p>
                        <a href="../index.php" class="btn btn-danger">Voltar</a>
                    <?php } ?>



                    <?php if($mensagem->status['codigo_status'] == 2) { ?>
                        <h4 class="display-4 text-danger">
                            Ops!
                        </h4>
                        <p><?= $mensagem->status['descricao_status']?></p>
                        <div class="d-flex justify-content-center">
                        <a href="../index.php" class="btn btn-danger">Voltar</a>
                        </div>
                    <?php } ?>
                    
            </div>
          </div>
    </div>
</body>
</html>