<?php
    // Ia data curenta si salveaza in variabilele $zi_curenta $luna_curenta $an_curent
    $date = getDate();
    //foreach foloseste pentru a adauga 0 in fata zilelor/lunilor mai mici decat 10 (adica au o singura cifra)
    foreach($date as $item=>$value)
      {
        if ($value < 10)
          $date[$item] = "0" . $value;
      }

    $data_curenta = $date['year'] . "-" . $date['mon'] . "-" . $date['mday'];
    $data_si_ora_curenta = $date['year'] . "-" . $date['mon'] . "-" . $date['mday'] . " " . $date['hours'].":".$date['minutes'].":".$date['seconds'];

    $an_curent = $date['year'];
    $luna_curenta = $date['mon'];
    $zi_curenta = $date['mday'];

    $ora_curenta = $date['hours'];
    $minut_curent = $date['minutes'];

    // print "Data curenta: " . $data_curenta . "<br />";
    // print "An curenta: " . $an_curent . "<br />";
    // print "Luna curenta: " . $luna_curenta . "<br />";
    // print "Zi curenta: " . $zi_curenta . "<br />";
?>
