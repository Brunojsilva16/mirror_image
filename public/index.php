<?php
// Ativa exibição de erros (em desenvolvimento)
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// --- MODIFICAÇÃO IMPORTANTE ---
// O 'index.php' agora está em /public_html/app.assistaconecta.com.br/
// O ROOT_PATH (onde estão 'app' e 'vendor') está dois níveis acima.
// Usamos dirname(__DIR__, 2) para subir dois diretórios.
define('ROOT_PATH', __DIR__);

use App\Core\Router;

// =======================
// Definição do BASE_URL
// =======================
// Isso irá definir BASE_URL como '/app.assistaconecta.com.br' (ou o caminho correto)
$baseUrl = str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']);
define("BASE_URL", $baseUrl);

// O VIEWS_PATH agora usará o ROOT_PATH correto (dois níveis acima)
define("VIEWS_PATH", ROOT_PATH . '/app/views');

// --- NOVA CONSTANTE ---
// Define o caminho ABSOLUTO para a pasta pública da aplicação (esta pasta)
// Usaremos isso para uploads e verificações de file_exists()
define("PUBLIC_APP_PATH", __DIR__);

// =======================
// Autoload (Composer)
// =======================
// Isso agora buscará /vendor/autoload.php (dois níveis acima)
require_once ROOT_PATH . '/vendor/autoload.php';

// O .env também deve estar no ROOT_PATH
$dotenv = Dotenv\Dotenv::createImmutable(ROOT_PATH);
$dotenv->load();

// =======================
// Definição das rotas
// =======================
$router = new Router();
// Isso agora buscará /app/Routes/routes.php (dois níveis acima)
require ROOT_PATH . '/app/Routes/routes.php';

// =======================
// Despacho da rota
// =======================
$url    = $_GET['url'] ?? '/';
$method = $_SERVER['REQUEST_METHOD'];

$router->dispatch($url, $method);