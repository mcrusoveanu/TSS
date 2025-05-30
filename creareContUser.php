<?php

function validareContUtilizator($nume, $parola) {
    // 1. Verificare: numele trebuie să aibă cel puțin 3 caractere
    if (strlen($nume) < 3) {
        return "Numele trebuie să conțină cel puțin 3 caractere.";
    }

    //2. Verificare: parola trebuie să aibă cel puțin 6 caractere și cel puțin o cifră
    if (strlen($parola) < 6 || !preg_match('/[0-9]/', $parola)) {
        return "Parola trebuie să aibă cel puțin 6 caractere și să conțină cel puțin o cifră.";
    }

    //3. Verificare: numele nu trebuie să fie deja folosit
    $utilizatoriExistenti = ["ana", "ion", "maria"];
    foreach ($utilizatoriExistenti as $utilizator) {
        if (strtolower($nume) === strtolower($utilizator)) {
            return "Numele de utilizator este deja folosit.";
        }
    }

   // 4. Verificare: parola nu trebuie să conțină numele utilizatorului
    if (stripos($parola, $nume) !== false) {
        return "Parola nu trebuie să conțină numele de utilizator.";
    }

   // Dacă toate verificările au trecut
    return "Cont valid";
}
