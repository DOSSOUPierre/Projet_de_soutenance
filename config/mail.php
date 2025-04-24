<?php

return [

    /*
    |----------------------------------------------------------------------
    | Default Mailer
    |----------------------------------------------------------------------
    |
    | Cette option définit le mailer par défaut utilisé pour envoyer des emails.
    |
    */
    'default' => env('MAIL_MAILER', 'smtp'),

    /*
    |----------------------------------------------------------------------
    | Mailer Configurations
    |----------------------------------------------------------------------
    |
    | Configurez tous les mailers que vous souhaitez utiliser pour envoyer
    | vos emails. Par défaut, Laravel fournit des configurations pour
    | plusieurs services de transport.
    |
    */
    'mailers' => [
        'smtp' => [
            'transport' => 'smtp',
            'host' => env('MAIL_HOST', 'smtp.mailgun.org'),
            'port' => env('MAIL_PORT', 587),
            'encryption' => env('MAIL_ENCRYPTION', 'tls'),
            'username' => env('MAIL_USERNAME'),
            'password' => env('MAIL_PASSWORD'),
            'timeout' => null,
            'local_domain' => env('MAIL_EHLO_DOMAIN'),
        ],

        // Autres configurations de mailers...

    ],

    /*
    |----------------------------------------------------------------------
    | Vues de Markdown
    |----------------------------------------------------------------------
    |
    | Si vous utilisez des emails en Markdown, vous pouvez configurer les
    | chemins des vues HTML et texte ici. Laravel générera automatiquement
    | des emails en Markdown à partir de ces vues.
    |
    */
    'markdown' => [
        'theme' => 'default',  // Choisir un thème (par défaut)
        'paths' => [
            resource_path('views/vendor/mail'),  // Emplacement des vues Markdown
        ],
    ],

    /*
    |----------------------------------------------------------------------
    | Adresse "From" globale
    |----------------------------------------------------------------------
    |
    | Vous pouvez définir une adresse d'expéditeur par défaut pour tous
    | les emails envoyés par votre application.
    |
    */
    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'hello@example.com'),
        'name' => env('MAIL_FROM_NAME', 'Example'),
    ],

    /*
    |----------------------------------------------------------------------
    | Configuration des Vues
    |----------------------------------------------------------------------
    |
    | Voici la configuration des vues pour le format HTML et texte
    | utilisé par Laravel pour envoyer des emails.
    |
    */
    'views' => [
        'html' => 'vendor.mail.html',
        'text' => 'vendor.mail.text',
    ],
];
