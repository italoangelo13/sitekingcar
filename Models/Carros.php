<?php

class Carros{
    public function SelecionarListaCarros(){
        $pdo = new PDO(server, user, senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $smtp = $pdo->prepare("SELECT CARCOD,
        MARDESCRICAO,
        MODDESCRICAO,
        CARPRECO,
        CARANO,
        CARFOTO,
        CARPORTAS,
        COMDESCRICAO,
        CORDESCRICAO,
        CORCODHEXADECIMAL,
        CARDESTAQUE,
        CONCAT('#',CARCOD,' - ',MARDESCRICAO,' ',MODDESCRICAO,' ',CARANO) AS CARNOME
        FROM kgctblcar
        INNER JOIN kgctblmar
        ON CARCODMARCA = MARCOD
        INNER JOIN kgctblMOD
        ON CARCODMODELO = MODCOD
        INNER JOIN kgctblCOR
        ON CARCODCOR = CORCOD
        INNER JOIN kgctblcom
        ON CARCODCOMBUSTIVEL = comCOD");
        $smtp->execute();

        if ($smtp->rowCount() > 0) {
            return $result = $smtp->fetchAll(PDO::FETCH_CLASS);
        }
    }  

}