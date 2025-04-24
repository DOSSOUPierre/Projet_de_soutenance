@component('mail::message')
# Réinitialisation de votre mot de passe

Vous recevez cet e-mail parce que nous avons reçu une demande de réinitialisation de mot de passe pour votre compte.

@component('mail::button', ['url' => $url])
Réinitialiser le mot de passe
@endcomponent

Ce lien de réinitialisation de mot de passe expirera dans 60 minutes.

Si vous n'avez pas demandé de réinitialisation de mot de passe, aucune autre action n'est requise.

Cordialement,<br>
{{ config('app.name') }}
@endcomponent