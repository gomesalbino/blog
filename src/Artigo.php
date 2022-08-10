<?php

class Artigo 
{
    private $mysql;

    public function __construct(mysqli $mysql)
    {
        $this->mysql = $mysql;
    }
    public function exibirTodos(): array 
    {
    $resultado = $this->mysql->query('SELECT id, titulo, conteudo FROM artigos');
    $artigos = $resultado->fetch_all(MYSQLI_ASSOC);
      
    return $artigos;
    }

    public function recuperaArtigo(string $id): array
    {
        $selecionaArtigo = $this->mysql->prepare("SELECT id, titulo, conteudo FROM artigos WHERE id = ?");
        $selecionaArtigo->bind_param("s", $id);
        $selecionaArtigo->execute();
        $artigo = $selecionaArtigo->get_result()->fetch_assoc();
        return $artigo;
    }

    public function adicionaArtigo(string $titulo, string $conteudo): void
    {
        $insereArtigo = $this->mysql->prepare("INSERT INTO artigos (titulo, conteudo) VALUES (?, ?);" );  
        $insereArtigo->bind_param("ss", $titulo, $conteudo);
        $insereArtigo->execute();
    }

    public function removeArtigo(string $id): void
    {
        $apagaArtigo = $this->mysql->prepare("DELETE FROM artigos WHERE id = ?");
        $apagaArtigo->bind_param("s", $id);
        $apagaArtigo->execute();
    }

    public function editaArtigo(string $id, string $titulo, string $conteudo): void 
    {
        $modificaArtigo = $this->mysql->prepare('UPDATE artigos SET titulo = ?, conteudo = ? WHERE id = ?');
        $modificaArtigo->bind_param('sss', $titulo, $conteudo, $id);
        $modificaArtigo->execute();
    }
}

