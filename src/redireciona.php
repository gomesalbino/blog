<?php

 function redirecionaPagina(string $url): void
{
    header("Location: $url");
    die();
}