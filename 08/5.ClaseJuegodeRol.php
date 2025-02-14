<?php
/*
Crea una clase Personaje con las propiedades nombre, nivel, puntosVida y puntosAtaque.
Agrega los métodos:
atacar(Personaje $objetivo): Resta puntos de vida al personaje objetivo en función de los puntos de ataque.
curarse(): Restaura puntos de vida al personaje.
subirNivel(): Incrementa el nivel y mejora los puntos de ataque y vida.
Crea varios personajes y simula una pequeña batalla con ataques y curaciones.
*/


class Personaje
{
    private $nombre;
    private $nivel;
    public $puntosVida;
    public $puntosAtaque;

    public function __construct($newnombre, $newnivel, $newpuntosVida, $newpuntosAtaque)
    {
        $this->nombre = $newnombre;
        $this->nivel = $newnivel;
        $this->puntosVida = $newpuntosVida;
        $this->puntosAtaque = $newpuntosAtaque;
    }

    public function setnombre($newnombre)
    {
        $this->nombre = $newnombre;
    }

    public function getnombre()
    {
        return $this->nombre;
    }

    public function setnivel($newnivel)
    {
        $this->nivel = $newnivel;
    }

    public function getnivel()
    {
        return $this->nivel;
    }

    public function setpuntosVida($newpuntosVida)
    {
        $this->puntosVida = $newpuntosVida;
    }

    public function getpuntosVida()
    {
        return $this->puntosVida;
    }

    public function setpuntosAtaque($newpuntosAtaque)
    {
        $this->puntosAtaque = $newpuntosAtaque;
    }

    public function getpuntosAtaque()
    {
        return $this->puntosAtaque;
    }

    public function atacar(Personaje $objetivo)
    {
        echo "{$this->getnombre()} ataca a {$objetivo->getnombre()} y le causa {$this->puntosAtaque} puntos de daño.\n";
        $objetivo->puntosVida -= $this->puntosAtaque;
        if ($objetivo->puntosVida < 0) {
            $objetivo->puntosVida = 0;
        }
        echo "{$objetivo->getnombre()} tiene ahora {$objetivo->puntosVida} puntos de vida.\n";
    }

    public function curarse()
    {
        $curacion = rand(20, 50);
        $this->puntosVida += $curacion;
        echo "{$this->getnombre()} se cura $curacion puntos de vida. Vida actual: {$this->puntosVida}.\n";
    }

    public function subirNivel()
    {
        $nivelmejorado = rand(1, 5);
        echo "Has subido un total de $nivelmejorado niveles\n";
        echo "Tu vida sube de {$this->puntosVida} a " . $this->puntosVida * (0.5 * $nivelmejorado) . "\n";
        echo "Tu daño sube de {$this->puntosAtaque} a " . $this->puntosAtaque * (0.5 * $nivelmejorado) . "\n";
        $this->puntosVida += $nivelmejorado;
        $this->puntosAtaque += $nivelmejorado;
    }
}

$guerrero = new Personaje("Jose el Berserker", 15, 500, 150);
$mago = new Personaje("Paco el Mago", 17, 350, 300);

// Simulación de batalla

echo "¡Comienza la batalla entre {$guerrero->getnombre()} y {$mago->getnombre()}!\n\n";

$turno = 1;
while ($guerrero->puntosVida > 0 && $mago->puntosVida > 0) {
    echo "Turno $turno:\n";

    if (rand(0, 1) === 0) {
        $guerrero->atacar($mago);
    } else {
        $guerrero->curarse();
    }

    if ($mago->puntosVida > 0) {
        if (rand(0, 1) === 0) {
            $mago->atacar($guerrero);
        } else {
            $mago->curarse();
        }
    }

    $turno++;
    echo "\n";
    sleep(3);
}


if ($guerrero->puntosVida > 0) {
    echo "¡{$guerrero->getnombre()} ha ganado la batalla!\n";
    $guerrero->subirNivel();
} elseif ($mago->puntosVida > 0) {
    echo "¡{$mago->getnombre()} ha ganado la batalla!\n";
    $mago->subirNivel();
} else {
    echo "¡Ambos han caído en la batalla!\n";
}
