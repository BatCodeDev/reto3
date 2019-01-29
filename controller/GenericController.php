<?php

class GenericController{

    public function run($action){
        try{
            $this->$action();
        }catch (Error $e){
            $this->index();
        }
    }

    public function view($view, $data){
        require_once __DIR__."/../vendor/autoload.php";
        $loader = new Twig_Loader_Filesystem(__DIR__."/../view");
        $twig = new Twig_Environment($loader);
        echo $twig->render($view."View.twig", $data);
    }
    public function mail_send($name, $mail, $url){
        //die($name);
        $myfile = fopen("sendmailTest.js", "w");
        $txt = "var Sendgrid = require('sendgrid')(
                process.env.SENDGRID_API_KEY || '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'
            );
            
            var request = Sendgrid.emptyRequest({
                method: 'POST',
                path: '/v3/mail/send',
                body: {
                    personalizations: [
                        {
                            to: [{email:'".$mail."'}],
                            subject: 'Sendgrid test email from Node.js on Google Cloud Platform',
                        },
                    ],
                    from: {email: 'batcodedev@gmail.com'},
                    content: [
                        {
                            type: 'text/plain',
                            value:
                                'Hola ".$name."! Haga click en el siguiente enlace para aceptar el pedido: ".$url."',
                        },
                    ],
                },
            });";
        fwrite($myfile, $txt);
        fclose($myfile);
    }
}