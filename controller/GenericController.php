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
    public function mail_send($name, $mail, $url, $id, $cart){
        $body = '<!DOCTYPE html><html><head><title></title></head><body><h3>¡Hola '.$name.'!</h3><table><tr><td><b>Producto</b></td><td></td><td></td><td></td><td></td><td></td><td><b>Unidades</b></td><td></td><td></td><td></td><td></td><td></td><td><b>Precio</b></td></tr>';
        $total = 0;
        foreach ($cart as $c){
            $body.= '<tr><td>'.$c["name"].'</td><td></td><td></td><td></td><td></td><td></td><td>'.$c["quantity"].'</td><td></td><td></td><td></td><td></td><td></td><td>'.$c["prize"].' €</td></tr>';
            $total += floatval($c["prize"]*$c["quantity"]);
        }
        $body .= '<tr><td></td><td></td><td></td><td></td><td></td><td></td><td><b>Total</b></td><td></td><td></td><td></td><td></td><td></td><td><b>'.$total.' €</b></td></tr></table><p>Haga click aqui para confirmar su pedido</p><a href="'.$url.'" style="color: #82005E; text-decoration: none; font-weight: bold;">Confirmar</a></body></html>';
        $myfile = fopen("nodejs-compute/samples/send_mail.js", "w");
        $txt = "var Sendgrid = require('sendgrid')(
                process.env.SENDGRID_API_KEY || ''
            );
            
            var request = Sendgrid.emptyRequest({
                method: 'POST',
                path: '/v3/mail/send',
                body: {
                    personalizations: [
                        {
                            to: [{email:'".$mail."'}],
                            subject: 'Nº de pedido: ".$id."',
                        },
                    ],
                    from: {email: 'escueladecocina@batcodedev.com'},
                    content: [
                        {
                            type: 'text/html',
                            value:
                                '".$body."', 
                        },
                    ],
                },
            });
            Sendgrid.API(request, function(error, response) {
              if (error) {
                console.log('Mail not sent; see error message below.');
              } else {
                console.log('Mail sent successfully!');
              }
              console.log(response);
            });";
        fwrite($myfile, $txt);
        fclose($myfile);
        exec("node nodejs-compute/samples/send_mail.js");
    }
}
