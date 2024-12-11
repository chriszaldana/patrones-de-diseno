<?php

// Interfaz para abrir archivos
interface Archivo {
    public function abrir(): void;
}

// Implementación para archivos de Windows 7
class ArchivoWindows7 implements Archivo {
    private string $nombre;

    public function __construct(string $nombre) {
        $this->nombre = $nombre;
    }

    public function abrir(): void {
        echo "Abriendo archivo '{$this->nombre}' en Windows 7.\n";
    }
}

// Implementación para archivos de Windows 10
class ArchivoWindows10 implements Archivo {
    private string $nombre;

    public function __construct(string $nombre) {
        $this->nombre = $nombre;
    }

    public function abrir(): void {
        echo "Abriendo archivo '{$this->nombre}' en Windows 10.\n";
    }
}

// Adapter para hacer compatibles archivos de Windows 7 con Windows 10
class AdaptadorWindows10 implements Archivo {
    private ArchivoWindows7 $archivoWindows7;

    public function __construct(ArchivoWindows7 $archivoWindows7) {
        $this->archivoWindows7 = $archivoWindows7;
    }

    public function abrir(): void {
        echo "Adaptando archivo de Windows 7 para ser compatible con Windows 10...\n";
        $this->archivoWindows7->abrir();
    }
}

// Simulación del programa
function abrirArchivo(Archivo $archivo): void {
    $archivo->abrir();
}

// Pruebas
echo "=== Prueba con archivo de Windows 10 ===\n";
$archivoWin10 = new ArchivoWindows10("documento_win10.docx");
abrirArchivo($archivoWin10);

echo "\n=== Prueba con archivo de Windows 7 en Windows 10 (usando Adaptador) ===\n";
$archivoWin7 = new ArchivoWindows7("documento_win7.docx");
$adaptador = new AdaptadorWindows10($archivoWin7);
abrirArchivo($adaptador);

?>
