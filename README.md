
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

Pentru a rula testele se foloseste 
cd C:\xampp3\htdocs\projectTest
vendor\bin\phpunit tests/ AutentificareUtiliatorTest.php
![image](https://github.com/user-attachments/assets/2c3310df-58a3-4b35-8e38-4de2f14de1a9)

Diagrama Flux Logare
![image](https://github.com/user-attachments/assets/c66efadc-2fa1-471b-92da-a383f2a965b5)
![image](https://github.com/user-attachments/assets/f773fdbf-ffea-4ffb-8cef-0fd1ad89a953)
Raport despre folosirea unui tool de AI care ajută în timpul testării software (de
exemplu, GitHub Copilot, chatGPT, Microsoft Copilot). Comparați suita proprie de
teste cu cele autogenerate și evidențiați diferențele. Includeți prompt, răspuns, capturi
de ecran cu rulare cod autogenerat, interpretare, etc. și referințe bibliografice, citate
în text.
In momentul in care am folosit gemini pentru cerinta mea rezultatul a fost generat in limba engleza si nu in limba romana desi cerinta si continutul codului au fost in limba romana, codul generat a fost unul procedural si nu oop . In cazul codului furnizat de mine este prezent un amestec de teste unitare pure (DB mockat) și teste de integrare (DB real) iar in cazul codului generat de ai el se concentrează în primul rând pe testarea unitară prin mocking extins al funcțiilor globale și superglobalelor. In codul meu Injecția Dependențelor ($conexiune pasată în constructor) iar in codul generat de AI are loc utilizare directă a variabilelor globale și a includerilor; mai dificil de injectat dependențe. Nu sunt acoperite aceleasi cazuri, cele generate de AI sunt mai multe in prima etapa in python si dupa ce ii spun eu le genereaza si in php desi codul furnizat este in php .
![image](https://github.com/user-attachments/assets/028c7150-c15f-4579-addf-22fdc43cbb3f)
![image](https://github.com/user-attachments/assets/4121d8f0-b3ca-4ea3-9468-b854758d5cb2)
![image](https://github.com/user-attachments/assets/22c9a2c9-e03b-42b9-9b2c-0ee227d5a90c)
Codul generat de AI este in documentul login2TesteGenerateDeAI.php



 



