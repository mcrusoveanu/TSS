<?php
class AutentificareUtilizator {
    private $conexiune;

    public function __construct($conexiune) {
        $this->conexiune = $conexiune;
    }

    public function logareUtilizator($numeUtilizator, $parolaUtilizator) {
        if (!isset($numeUtilizator) || !isset($parolaUtilizator)) { 
            return false;
        }

        $numeUtilizator = trim($numeUtilizator);
        $parolaUtilizator = trim($parolaUtilizator);

        if (!$this->InputValid($numeUtilizator) || !$this->InputValid($parolaUtilizator)) {
            return false;
        }

        $numeUtilizator = htmlspecialchars($numeUtilizator);
        $parolaUtilizator = md5($parolaUtilizator); 

        $sir = "SELECT * FROM utilizatori WHERE username='$numeUtilizator' AND parola='$parolaUtilizator' LIMIT 1";

        if (!$this->sirValid($sir)) {
            return false;
        }

        $solutie = mysqli_query($this->conexiune, $sir);
        return $solutie && mysqli_num_rows($solutie) === 1;
    }

   private function InputValid($text) {
    return !empty($text) && strlen($text) > 2;
}

  private function sirValid($sir) {
    return strpos(strtolower($sir), "drop") === false;
}
}