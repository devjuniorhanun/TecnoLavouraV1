<?php
function extenso($value, $uppercase = 0)
{
    if (strpos($value, ",") > 0) {
        $value = str_replace(".", "", $value);
        $value = str_replace(",", ".", $value);
    }
    $singular = ["Centavo", "Real", "Mil", "Milhão", "Bilhão", "Trilhão", "Quatrilhão"];
    $plural = ["Centavos", "Reais", "Mil", "Milhões", "Bilhões", "Trilhões", "Quatrilhões"];

    $c = ["", "Cem", "Duzentos", "Trezentos", "Quatrocentos", "Quinhentos", "Seiscentos", "Setecentos", "Oitocentos", "Novecentos"];
    $d = ["", "Dez", "Vinte", "Trinta", "Quarenta", "Cinquenta", "Sessenta", "Setenta", "Oitenta", "Noventa"];
    $d10 = ["Dez", "Onze", "Doze", "Treze", "Quatorze", "Quinze", "Dezesseis", "Dezesete", "Dezoito", "Dezenove"];
    $u = ["", "Um", "Dois", "Três", "Quatro", "Cinco", "Seis", "Sete", "Oito", "Nove"];

    $z = 0;

    $value = number_format($value, 2, ".", ".");
    $integer = explode(".", $value);
    $cont = count($integer);
    for ($i = 0; $i < $cont; $i++)
        for ($ii = strlen($integer[$i]); $ii < 3; $ii++)
            $integer[$i] = "0" . $integer[$i];

    $fim = $cont - ($integer[$cont - 1] > 0 ? 1 : 2);
    $rt = '';
    for ($i = 0; $i < $cont; $i++) {
        $value = $integer[$i];
        $rc = (($value > 100) && ($value < 200)) ? "cento" : $c[$value[0]];
        $rd = ($value[1] < 2) ? "" : $d[$value[1]];
        $ru = ($value > 0) ? (($value[1] == 1) ? $d10[$value[2]] : $u[$value[2]]) : "";

        $r = $rc . (($rc && ($rd || $ru)) ? " e " : "") . $rd . (($rd &&
            $ru) ? " e " : "") . $ru;
        $t = $cont - 1 - $i;
        $r .= $r ? " " . ($value > 1 ? $plural[$t] : $singular[$t]) : "";
        if (
            $value == "000"
        )
            $z++;
        elseif ($z > 0)
            $z--;
        if (($t == 1) && ($z > 0) && ($integer[0] > 0))
            $r .= (($z > 1) ? " de " : "") . $plural[$t];
        if ($r)
            $rt = $rt . ((($i > 0) && ($i <= $fim) &&
                ($integer[0] > 0) && ($z < 1)) ? (($i < $fim) ? ", " : " e ") : " ") . $r;
    }

    if (!$uppercase) {
        return trim($rt ? $rt : "zero");
    } elseif ($uppercase == "2") {
        return trim(strtoupper($rt) ? strtoupper(strtoupper($rt)) : "Zero");
    } else {
        return trim(ucwords($rt) ? ucwords($rt) : "Zero");
    }
}

function extensoSc($value, $uppercase = 0)
{
    if (strpos($value, ",") > 0) {
        $value = str_replace(".", "", $value);
        $value = str_replace(",", ".", $value);
    }
    $singular = ["", "Saco", "Mil", "Milhão", "Bilhão", "Trilhão", "Quatrilhão"];
    $plural = ["", "Sacas", "Mil", "Milhões", "Bilhões", "Trilhões", "Quatrilhões"];

    $c = ["", "Cem", "Duzentos", "Trezentos", "Quatrocentos", "Quinhentos", "Seiscentos", "Setecentos", "Oitocentos", "Novecentos"];
    $d = ["", "Dez", "Vinte", "Trinta", "Quarenta", "Cinquenta", "Sessenta", "Setenta", "Oitenta", "Noventa"];
    $d10 = ["Dez", "Onze", "Doze", "Treze", "Quatorze", "Quinze", "Dezesseis", "Dezesete", "Dezoito", "Dezenove"];
    $u = ["", "Um", "Dois", "Três", "Quatro", "Cinco", "Seis", "Sete", "Oito", "Nove"];

    $z = 0;

    $value = number_format($value, 2, ".", ".");
    $integer = explode(".", $value);
    $cont = count($integer);
    for ($i = 0; $i < $cont; $i++)
        for ($ii = strlen($integer[$i]); $ii < 3; $ii++)
            $integer[$i] = "0" . $integer[$i];

    $fim = $cont - ($integer[$cont - 1] > 0 ? 1 : 2);
    $rt = '';
    for ($i = 0; $i < $cont; $i++) {
        $value = $integer[$i];
        $rc = (($value > 100) && ($value < 200)) ? "cento" : $c[$value[0]];
        $rd = ($value[1] < 2) ? "" : $d[$value[1]];
        $ru = ($value > 0) ? (($value[1] == 1) ? $d10[$value[2]] : $u[$value[2]]) : "";

        $r = $rc . (($rc && ($rd || $ru)) ? " e " : "") . $rd . (($rd &&
            $ru) ? " e " : "") . $ru;
        $t = $cont - 1 - $i;
        $r .= $r ? " " . ($value > 1 ? $plural[$t] : $singular[$t]) : "";
        if (
            $value == "000"
        )
            $z++;
        elseif ($z > 0)
            $z--;
        if (($t == 1) && ($z > 0) && ($integer[0] > 0))
            $r .= (($z > 1) ? " de " : "") . $plural[$t];
        if ($r)
            $rt = $rt . ((($i > 0) && ($i <= $fim) &&
                ($integer[0] > 0) && ($z < 1)) ? (($i < $fim) ? ", " : " e ") : " ") . $r;
    }

    if (!$uppercase) {
        return trim($rt ? $rt : "zero");
    } elseif ($uppercase == "2") {
        return trim(strtoupper($rt) ? strtoupper(strtoupper($rt)) : "Zero");
    } else {
        return trim(ucwords($rt) ? ucwords($rt) : "Zero");
    }

    
}

function extensoNumero($value, $uppercase = 0)
    {
        if (strpos($value, ",") > 0) {
            $value = str_replace(".", "", $value);
            $value = str_replace(",", ".", $value);
        }
        
        $c = ["", "Cem", "Duzentos", "Trezentos", "Quatrocentos", "Quinhentos", "Seiscentos", "Setecentos", "Oitocentos", "Novecentos"];
        $d = ["", "Dez", "Vinte", "Trinta", "Quarenta", "Cinquenta", "Sessenta", "Setenta", "Oitenta", "Noventa"];
        $d10 = ["Dez", "Onze", "Doze", "Treze", "Quatorze", "Quinze", "Dezesseis", "Dezesete", "Dezoito", "Dezenove"];
        $u = ["", "Uma", "Duas", "Três", "Quatro", "Cinco", "Seis", "Sete", "Oito", "Nove"];

        $z = 0;

        $value = number_format($value, 2, ".", ".");
        $integer = explode(".", $value);
        $cont = count($integer);
        for ($i = 0; $i < $cont; $i++)
            for ($ii = strlen($integer[$i]); $ii < 3; $ii++)
                $integer[$i] = "0" . $integer[$i];

        $fim = $cont - ($integer[$cont - 1] > 0 ? 1 : 2);
        $rt = '';
        for ($i = 0; $i < $cont; $i++) {
            $value = $integer[$i];
            $rc = (($value > 100) && ($value < 200)) ? "cento" : $c[$value[0]];
            $rd = ($value[1] < 2) ? "" : $d[$value[1]];
            $ru = ($value > 0) ? (($value[1] == 1) ? $d10[$value[2]] : $u[$value[2]]) : "";

            $r = $rc . (($rc && ($rd || $ru)) ? " e " : "") . $rd . (($rd &&
                $ru) ? " e " : "") . $ru;
            $t = $cont - 1 - $i;
            //$r .= $r ? " " . ($value > 1 ? $plural[$t] : $singular[$t]) : "";
            if (
                $value == "000"
            )
                $z++;
            elseif ($z > 0)
                $z--;
            if (($t == 1) && ($z > 0) && ($integer[0] > 0))
                $r .= (($z > 1) ? " de " : "") ;
            if ($r)
                $rt = $rt . ((($i > 0) && ($i <= $fim) &&
                    ($integer[0] > 0) && ($z < 1)) ? (($i < $fim) ? ", " : " e ") : " ") . $r;
        }

        if (!$uppercase) {
            return trim($rt ? $rt : "zero");
        } elseif ($uppercase == "2") {
            return trim(strtoupper($rt) ? strtoupper(strtoupper($rt)) : "Zero");
        } else {
            return trim(ucwords($rt) ? ucwords($rt) : "Zero");
        }
    }