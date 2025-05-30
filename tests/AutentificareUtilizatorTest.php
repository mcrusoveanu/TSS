<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../AutentificareUtilizator.php';

class AutentificareUtilizatorTest extends TestCase {
    private $conexiune;
    private $autentificare;

    protected function setUp() {
        $this->conexiune = $this->createMock('mysqli'); 
        $this->autentificare = new AutentificareUtilizator($this->conexiune);
    }

    public function test_Logare_Utilizator_Fail_Fara_numeUtilizator() {
        $this->assertFalse($this->autentificare->logareUtilizator('','parola93'));
    }

    public function test_Logare_Utilizator_Fail_faraParola() {
        $this->assertFalse($this->autentificare->logareUtilizator('numeUtilizator', ''));
    }

    public function test_logare_Utilizator_Pass_dateValide() {
        $this->conexiune = new mysqli('localhost', 'root', '', 'magazin');

        if ($this->conexiune->connect_error) {
            $this->fail("A crapat baza: " . $this->conexiune->connect_error);
        }

        $this->autentificare = new AutentificareUtilizator($this->conexiune);

        $this->assertTrue($this->autentificare->logareUtilizator('testuser', 'testpass'));
    }

    public function test_logare_Utilizator_Esueaza_ParolaGresita() {
    $this->conexiune = new mysqli('localhost', 'root', '', 'magazin');
    if ($this->conexiune->connect_error) {
        $this->fail("Eroare conexiune DB: " . $this->conexiune->connect_error);
    }
    $this->autentificare = new AutentificareUtilizator($this->conexiune);

    $this->assertFalse($this->autentificare->logareUtilizator('testuser', 'gresita'));
}

public function test_logare_Utilizator_Esueaza_NumeUtilizatorGresit() {
    $this->conexiune = new mysqli('localhost', 'root', '', 'magazin');
    if ($this->conexiune->connect_error) {
        $this->fail("Eroare conexiune DB: " . $this->conexiune->connect_error);
    }
    $this->autentificare = new AutentificareUtilizator($this->conexiune);

    $this->assertFalse($this->autentificare->logareUtilizator('gresituser', 'testpass'));
}

}
