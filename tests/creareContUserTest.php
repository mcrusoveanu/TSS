<?php
use PHPUnit\Framework\TestCase;
require 'creareContUser.php';

class ValidareContUtilizatorTest extends TestCase {

    public function testNumePreaScurt() {
        $this->assertEquals(
            "Numele trebuie să conțină cel puțin 3 caractere.",
           validareContUtilizator("io", "parola123")

        );
    }

    public function testParolaPreaScurtaSiFaraCifra() {
        $this->assertEquals(
            "Parola trebuie să aibă cel puțin 6 caractere și să conțină cel puțin o cifră.",
           validareContUtilizator("Ionel", "abck")
        );
    }

    public function testUtilizatorExistent() {
        $this->assertEquals(
            "Numele de utilizator este deja folosit.",
            validareContUtilizator("Ana", "ana1234")
        );
    }

    public function testParolaContineNume() {
        $this->assertEquals(
            "Parola nu trebuie să conțină numele de utilizator.",
           validareContUtilizator("Robert", "Robert2024")
        );
    }

    public function testCreareContSucces() {
        $this->assertEquals(
            "Cont valid",
            validareContUtilizator("iosif", "parola123")
        );
    }
}
?>
 