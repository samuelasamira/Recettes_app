<?php

// ============================================================
// SCRIPT : Traduction française des messages d'erreur
// ============================================================

// 1. Créer le dossier lang/fr si inexistant
if (!is_dir('lang/fr')) {
    mkdir('lang/fr', 0755, true);
    echo "✅ Dossier lang/fr créé\n";
}

// 2. auth.php FR
file_put_contents('lang/fr/auth.php', '<?php
return [
    "failed"   => "Ces identifiants ne correspondent pas à nos enregistrements.",
    "password" => "Le mot de passe fourni est incorrect.",
    "throttle" => "Trop de tentatives de connexion. Réessayez dans :seconds secondes.",
];');
echo "✅ lang/fr/auth.php créé\n";

// 3. validation.php FR
file_put_contents('lang/fr/validation.php', '<?php
return [
    "accepted"             => "Le champ :attribute doit être accepté.",
    "active_url"           => "Le champ :attribute n\'est pas une URL valide.",
    "after"                => "Le champ :attribute doit être une date postérieure au :date.",
    "after_or_equal"       => "Le champ :attribute doit être une date postérieure ou égale au :date.",
    "alpha"                => "Le champ :attribute doit contenir uniquement des lettres.",
    "alpha_dash"           => "Le champ :attribute doit contenir uniquement des lettres, chiffres, tirets et underscores.",
    "alpha_num"            => "Le champ :attribute doit contenir uniquement des chiffres et des lettres.",
    "array"                => "Le champ :attribute doit être un tableau.",
    "before"               => "Le champ :attribute doit être une date antérieure au :date.",
    "before_or_equal"      => "Le champ :attribute doit être une date antérieure ou égale au :date.",
    "between"              => [
        "numeric" => "La valeur de :attribute doit être comprise entre :min et :max.",
        "file"    => "La taille du fichier de :attribute doit être comprise entre :min et :max kilo-octets.",
        "string"  => "Le texte :attribute doit contenir entre :min et :max caractères.",
        "array"   => "Le tableau :attribute doit contenir entre :min et :max éléments.",
    ],
    "boolean"              => "Le champ :attribute doit être vrai ou faux.",
    "confirmed"            => "Le champ de confirmation :attribute ne correspond pas.",
    "date"                 => "Le champ :attribute n\'est pas une date valide.",
    "date_equals"          => "Le champ :attribute doit être une date égale à :date.",
    "date_format"          => "Le champ :attribute ne correspond pas au format :format.",
    "different"            => "Les champs :attribute et :other doivent être différents.",
    "digits"               => "Le champ :attribute doit contenir :digits chiffres.",
    "digits_between"       => "Le champ :attribute doit contenir entre :min et :max chiffres.",
    "dimensions"           => "La taille de l\'image :attribute n\'est pas conforme.",
    "distinct"             => "Le champ :attribute a une valeur en double.",
    "email"                => "Le champ :attribute doit être une adresse e-mail valide.",
    "ends_with"            => "Le champ :attribute doit se terminer par une des valeurs suivantes : :values.",
    "exists"               => "Le champ :attribute sélectionné est invalide.",
    "file"                 => "Le champ :attribute doit être un fichier.",
    "filled"               => "Le champ :attribute doit avoir une valeur.",
    "gt"                   => [
        "numeric" => "La valeur de :attribute doit être supérieure à :value.",
        "file"    => "La taille du fichier de :attribute doit être supérieure à :value kilo-octets.",
        "string"  => "Le texte :attribute doit contenir plus de :value caractères.",
        "array"   => "Le tableau :attribute doit contenir plus de :value éléments.",
    ],
    "gte"                  => [
        "numeric" => "La valeur de :attribute doit être supérieure ou égale à :value.",
        "file"    => "La taille du fichier de :attribute doit être supérieure ou égale à :value kilo-octets.",
        "string"  => "Le texte :attribute doit contenir au moins :value caractères.",
        "array"   => "Le tableau :attribute doit contenir au moins :value éléments.",
    ],
    "image"                => "Le champ :attribute doit être une image.",
    "in"                   => "Le champ :attribute est invalide.",
    "in_array"             => "Le champ :attribute n\'existe pas dans :other.",
    "integer"              => "Le champ :attribute doit être un entier.",
    "ip"                   => "Le champ :attribute doit être une adresse IP valide.",
    "ipv4"                 => "Le champ :attribute doit être une adresse IPv4 valide.",
    "ipv6"                 => "Le champ :attribute doit être une adresse IPv6 valide.",
    "json"                 => "Le champ :attribute doit être un JSON valide.",
    "lt"                   => [
        "numeric" => "La valeur de :attribute doit être inférieure à :value.",
        "file"    => "La taille du fichier de :attribute doit être inférieure à :value kilo-octets.",
        "string"  => "Le texte :attribute doit contenir moins de :value caractères.",
        "array"   => "Le tableau :attribute doit contenir moins de :value éléments.",
    ],
    "lte"                  => [
        "numeric" => "La valeur de :attribute doit être inférieure ou égale à :value.",
        "file"    => "La taille du fichier de :attribute doit être inférieure ou égale à :value kilo-octets.",
        "string"  => "Le texte :attribute doit contenir au plus :value caractères.",
        "array"   => "Le tableau :attribute doit contenir au plus :value éléments.",
    ],
    "max"                  => [
        "numeric" => "La valeur de :attribute ne peut être supérieure à :max.",
        "file"    => "La taille du fichier de :attribute ne peut pas dépasser :max kilo-octets.",
        "string"  => "Le texte de :attribute ne peut contenir plus de :max caractères.",
        "array"   => "Le tableau :attribute ne peut contenir plus de :max éléments.",
    ],
    "mimes"                => "Le champ :attribute doit être un fichier de type : :values.",
    "mimetypes"            => "Le champ :attribute doit être un fichier de type : :values.",
    "min"                  => [
        "numeric" => "La valeur de :attribute doit être supérieure ou égale à :min.",
        "file"    => "La taille du fichier de :attribute doit être supérieure à :min kilo-octets.",
        "string"  => "Le texte de :attribute doit contenir au moins :min caractères.",
        "array"   => "Le tableau :attribute doit contenir au moins :min éléments.",
    ],
    "not_in"               => "Le champ :attribute sélectionné n\'est pas valide.",
    "not_regex"            => "Le format du champ :attribute n\'est pas valide.",
    "numeric"              => "Le champ :attribute doit contenir un nombre.",
    "password"             => "Le mot de passe est incorrect.",
    "present"              => "Le champ :attribute doit être présent.",
    "regex"                => "Le format du champ :attribute est invalide.",
    "required"             => "Le champ :attribute est obligatoire.",
    "required_if"          => "Le champ :attribute est obligatoire quand :other a la valeur :value.",
    "required_unless"      => "Le champ :attribute est obligatoire sauf si :other est :values.",
    "required_with"        => "Le champ :attribute est obligatoire quand :values est présent.",
    "required_with_all"    => "Le champ :attribute est obligatoire quand :values sont présents.",
    "required_without"     => "Le champ :attribute est obligatoire quand :values n\'est pas présent.",
    "required_without_all" => "Le champ :attribute est obligatoire quand aucun de :values n\'est présent.",
    "same"                 => "Les champs :attribute et :other doivent être identiques.",
    "size"                 => [
        "numeric" => "La valeur de :attribute doit être :size.",
        "file"    => "La taille du fichier de :attribute doit être de :size kilo-octets.",
        "string"  => "Le texte de :attribute doit contenir :size caractères.",
        "array"   => "Le tableau :attribute doit contenir :size éléments.",
    ],
    "starts_with"          => "Le champ :attribute doit commencer par une des valeurs suivantes : :values.",
    "string"               => "Le champ :attribute doit être une chaîne de caractères.",
    "timezone"             => "Le champ :attribute doit être un fuseau horaire valide.",
    "unique"               => "La valeur du champ :attribute est déjà utilisée.",
    "uploaded"             => "Le fichier du champ :attribute n\'a pas pu être téléversé.",
    "url"                  => "Le format de l\'URL de :attribute n\'est pas valide.",
    "uuid"                 => "Le champ :attribute doit être un UUID valide.",
    "custom" => [
        "attribute-name" => [
            "rule-name" => "custom-message",
        ],
    ],
    "attributes" => [
        "name"                  => "nom",
        "email"                 => "adresse e-mail",
        "password"              => "mot de passe",
        "password_confirmation" => "confirmation du mot de passe",
        "title"                 => "titre",
        "description"           => "description",
        "instructions"          => "instructions",
        "prep_time"             => "temps de préparation",
        "cook_time"             => "temps de cuisson",
        "servings"              => "nombre de portions",
        "cuisine_type"          => "type de cuisine",
        "difficulty"            => "difficulté",
        "image"                 => "image",
        "content"               => "contenu",
        "rating"                => "note",
        "review"                => "avis",
    ],
];');
echo "✅ lang/fr/validation.php créé\n";

// 4. passwords.php FR
file_put_contents('lang/fr/passwords.php', '<?php
return [
    "reset"     => "Votre mot de passe a été réinitialisé.",
    "sent"      => "Nous vous avons envoyé par e-mail le lien de réinitialisation du mot de passe.",
    "throttled" => "Veuillez patienter avant de réessayer.",
    "token"     => "Ce jeton de réinitialisation du mot de passe n\'est pas valide.",
    "user"      => "Aucun utilisateur trouvé avec cette adresse e-mail.",
];');
echo "✅ lang/fr/passwords.php créé\n";

// 5. Modifier .env pour APP_LOCALE=fr
$env = file_get_contents('.env');
$env = preg_replace('/APP_LOCALE=.*/', 'APP_LOCALE=fr', $env);
$env = preg_replace('/APP_FALLBACK_LOCALE=.*/', 'APP_FALLBACK_LOCALE=fr', $env);
file_put_contents('.env', $env);
echo "✅ .env mis à jour (APP_LOCALE=fr)\n";

// 6. Vider le cache
echo "\n🔄 Nettoyage du cache...\n";
shell_exec('php artisan cache:clear');
shell_exec('php artisan config:clear');
shell_exec('php artisan view:clear');

echo "\n🎉 Tout est en français maintenant !\n";
echo "👉 Teste la connexion sur http://localhost:8000/login\n";