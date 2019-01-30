var Sendgrid = require('sendgrid')(
                process.env.SENDGRID_API_KEY || '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'
            );
            
            var request = Sendgrid.emptyRequest({
                method: 'POST',
                path: '/v3/mail/send',
                body: {
                    personalizations: [
                        {
                            to: [{email:'alexddo122@gmail.com'}],
                            subject: 'Sendgrid test email from Node.js on Google Cloud Platform',
                        },
                    ],
                    from: {email: 'batcodedev@gmail.com'},
                    content: [
                        {
                            type: 'text/plain',
                            value:
                                'Hola Alejandro! Haga click en el siguiente enlace para aceptar el pedido: http://batcodedev.tk/confirm/2',
                        },
                    ],
                },
            });