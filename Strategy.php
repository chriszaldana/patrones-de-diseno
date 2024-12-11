<?php

// Interfaz de estrategia para salida
interface EstrategiaSalida {
    public function mostrarMensaje(string $mensaje): void;
}

// Estrategia concreta: Salida por consola
class SalidaConsola implements EstrategiaSalida {
    public function mostrarMensaje(string $mensaje): void {
        echo "Mensaje en consola: $mensaje\n";
    }
}

// Estrategia concreta: Salida en formato JSON
class SalidaJSON implements EstrategiaSalida {
    public function mostrarMensaje(string $mensaje): void {
        echo json_encode(["mensaje" => $mensaje], JSON_PRETTY_PRINT) . "\n";
    }
}

// Estrategia concreta: Salida a archivo TXT
class SalidaArchivoTXT implements EstrategiaSalida {
    private string $archivo;

    public function __construct(string $archivo) {
        $this->archivo = $archivo;
    }

    public function mostrarMensaje(string $mensaje): void {
        file_put_contents($this->archivo, $mensaje . PHP_EOL, FILE_APPEND);
        echo "Mensaje guardado en el archivo '{$this->archivo}'.\n";
    }
}

// Contexto para manejar la salida
class Mensajero {
    private EstrategiaSalida $estrategia;

    public function __construct(EstrategiaSalida $estrategia) {
        $this->estrategia = $estrategia;
    }

    public function setEstrategia(EstrategiaSalida $estrategia): void {
        $this->estrategia = $estrategia;
    }

    public function enviarMensaje(string $mensaje): void {
        $this->estrategia->mostrarMensaje($mensaje);
    }
}

// Simulación del programa
$mensaje = "Hola, este es un mensaje de prueba.";

// Salida por consola
echo "=== Salida por consola ===\n";
$mensajero = new Mensajero(new SalidaConsola());
$mensajero->enviarMensaje($mensaje);

// Salida en formato JSON
echo "\n=== Salida en formato JSON ===\n";
$mensajero->setEstrategia(new SalidaJSON());
$mensajero->enviarMensaje($mensaje);

// Salida a archivo TXT
echo "\n=== Salida a archivo TXT ===\n";
$archivo = "salida.txt";
$mensajero->setEstrategia(new SalidaArchivoTXT($archivo));
$mensajero->enviarMensaje($mensaje);

?>
