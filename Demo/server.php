<?php
  if(isset($_GET["value"]) || isset($_GET["name"])) {
    if($_GET["value"] == "showSystemGroup") {
      $ip = "127.0.0.1";
      $table = array(
        "Name"        => snmp2_get($ip, "public", ".1.3.6.1.2.1.1.5.0"),
        "Desctiption" => snmp2_get($ip, "public", ".1.3.6.1.2.1.1.1.0"),
        "Up Time"     => snmp2_get($ip, "public", ".1.3.6.1.2.1.1.3.0"),
        "Object ID"   => snmp2_get($ip, "public", ".1.3.6.1.2.1.1.2.0"),
        "Location"   => snmp2_get($ip, "public", ".1.3.6.1.2.1.1.6.0"),
        "Services"   => snmp2_get($ip, "public", ".1.3.6.1.2.1.1.7.0"),
        "Contact"     => snmp2_get($ip, "public", ".1.3.6.1.2.1.1.4.0")
      );
      echo "<table>";
        foreach ($table as $key => $value)
        echo "<tr><td>$key</td><td>$value</td></tr>";
      echo "</table>";
      return;
    }
    
    else if($_GET["value"] == "showInterfacesGroup") {
      $ip = "127.0.0.1";
      $cm = "public";
      $rt = ".1.3.6.1.2.1.2.2.1";
      $n  = 8;
      
      echo "<table>";
      echo "<tr>";
      for ($j = 0; $j <= $n; $j++) echo "<td> $j </td>";
      echo "</tr>";
      
      $array = array();
      for ($j = 1; $j <= $n; $j++) $array[$j - 1] = snmp2_walk($ip, $cm, $rt."."."$j");
      
      for ($i = 0; $i < count($array[0]); $i++) {
        echo "<tr>";
        echo "<td> $i </td>";
        for ($j = 0; $j < $n; $j++) {
          $a = $array[$j][$i];
          echo "<td> $a </td>";
        }
        echo "<tr>";
      }
      echo "</table>";
      return;
    }
    
    else if($_GET["value"] == "showUDPTable") {
      $ip = "127.0.0.1";
      $cm = "public";
      $rt = ".1.3.6.1.2.1.7.5.1";
      $n  = 2;
      
      echo "<table>";
      echo "<tr>";
      for ($j = 0; $j <= $n; $j++) echo "<td> $j </td>";
      echo "</tr>";
      
      $array = array();
      for ($j = 1; $j <= $n; $j++) $array[$j - 1] = snmp2_walk($ip, $cm, $rt."."."$j");
      
      for ($i = 0; $i < count($array[0]); $i++) {
        echo "<tr>";
        echo "<td> $i </td>";
        for ($j = 0; $j < $n; $j++) {
          $a = $array[$j][$i];
          echo "<td> $a </td>";
        }
        echo "<tr>";
      }
      echo "</table>";
      return;
    }
    else if($_GET["value"] == "showSNMPGroup") {
        $ip = "127.0.0.1";
        $cm = "public";
        $rt = ".1.3.6.1.2.1.11";
        $n  = 2;

        echo "<table>";
        echo "<tr>";
        for ($j = 0; $j <= $n; $j++) echo "<td> $j </td>";
        echo "</tr>";

        $array = array();
        for ($j = 1; $j <= $n; $j++) $array[$j - 1] = snmp2_walk($ip, $cm, $rt."."."$j");

        for ($i = 0; $i < count($array[0]); $i++) {
            echo "<tr>";
            echo "<td> $i </td>";
            for ($j = 0; $j < $n; $j++) {
                $a = $array[$j][$i];
                echo "<td> $a </td>";
            }
            echo "<tr>";
        }
        echo "</table>";
        return;
    }
    else if($_GET["name"] == "contact"){
      $ip = "127.0.0.1";
      snmp2_set($ip, "public", ".1.3.6.1.2.1.1.4.0", 's', $_GET["value"]);
      return;
    }
    else if($_GET["name"] == "name"){
        $ip = "127.0.0.1";
        snmp2_set($ip, "public", ".1.3.6.1.2.1.1.5.0", 's', $_GET["value"]);
        return;
    }
    else if($_GET["name"] == "Location"){
        $ip = "127.0.0.1";
        snmp2_set($ip, "public", ".1.3.6.1.2.1.1.6.0", 's', $_GET["value"]);
        return;
    }
    else{
        return;
    }
  }
?>