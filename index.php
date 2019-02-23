<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $xml=simplexml_load_file('data.xml', 'SimpleXMLElement', LIBXML_NOCDATA) or die("Error: Cannot create object");
        //echo $xml->mibac[200]->luogodellacultura;
        //echo $xml->mibac[0]->luogodellacultura->denominazione->nomestandard;
        //print_r($xml);
        //echo $xml->mibac[0]->luogodellacultura->indirizzi->indirizzo->viapiazza ;
      
        
        $count = 0;
        foreach($xml->children() as $mibac) {
            $istat = $mibac->luogodellacultura->indirizzi->indirizzo->comune['istat'];
            $addr = $mibac->luogodellacultura->indirizzi->indirizzo->viapiazza;
            $cap = $mibac->luogodellacultura->indirizzi->indirizzo->cap;
            $lat = $mibac->luogodellacultura->indirizzi->indirizzo->cartografia->punto->latitudine;
            $lon = $mibac->luogodellacultura->indirizzi->indirizzo->cartografia->punto->longitudine;
            $name = $mibac->luogodellacultura->denominazione->nomestandard;
            $type = $mibac->luogodellacultura->tipologie['tipologiaPrevalente'];
        
        if ($count) echo $istat." || ".$addr." || ".$cap." || ".$lat." || ".$lon." || ".$name." || ".$type." <br />";
        

            $count++;
            
        }
?>
       
    </body>
</html>
