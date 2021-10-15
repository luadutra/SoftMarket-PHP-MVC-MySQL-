<?php

function formato_decimal($value) {
    return number_format($value, 2, ',', '.'); 
}

function formato_moeda($value) {
    return str_replace(',', '.', str_replace('.', '', $value));

}