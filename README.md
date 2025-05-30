
Proiect testare unitara in PHP

![image](https://github.com/user-attachments/assets/2258f068-a37c-4e2a-a5b3-d0438b380b90)
Testarea unitară reprezintă o componentă fundamentală a asigurării calității software-ului, având rolul de a valida individual, în izolare, cele mai mici unități de cod sursă. În contextul aplicațiilor web, procesele de login (autentificare) și înregistrare (creare cont) ale utilizatorilor sunt critice și necesită o testare riguroasă pentru a garanta securitatea si buna functionare .

Pentru a putea implementa testare unitara pe procesele de logare si de creare cont a trebuit sa instalez PHPUnit cu ajutorul composer 

Funcționalități:

1 Pentru a se putea conecta la site un utilizator trebuie sa completeze atat parola cat si numele de utilizator in mod corect altfel se afiseaza un mesaj de eroare.
a) utilizatorul introduce datele corect -> are loc conectarea la site
![image](https://github.com/user-attachments/assets/95a8b9c5-09e0-4596-9237-ae39802c5a5a)
![image](https://github.com/user-attachments/assets/a3860601-ce34-4d0f-a535-3ab9da5e0289)
b) daca un utilizator introduce doar numele de utilizator sau doar parola rezulta un mesaj de eroare 
![image](https://github.com/user-attachments/assets/69d5c682-444c-4bf8-b5f3-a52c735b6bfe)
![image](https://github.com/user-attachments/assets/9fc2dbff-648e-4a74-a013-1debc7cd9b83)


"Eroare! Nu ati introdus date corecte!"

