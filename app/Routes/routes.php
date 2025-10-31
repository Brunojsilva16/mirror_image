<?php

use App\Controllers\PageController;
use App\Controllers\AuthController;

/**
 * --- ROTAS DE AUTENTICAÇÃO ---
 */
$router->get('login', [AuthController::class, 'loginForm']);
$router->post('login', [AuthController::class, 'login']);
$router->get('logout', [AuthController::class, 'logout']);

// NOVAS ROTAS DE CADASTRO
$router->get('cadastro', [AuthController::class, 'registerForm']);
$router->post('cadastro', [AuthController::class, 'register']);

// ROTAS PARA ESQUECI A SENHA (CORRIGIDAS)
$router->get('esqueci-a-senha', [AuthController::class, 'forgotPasswordForm']);
$router->post('esqueci-a-senha', [AuthController::class, 'sendPasswordResetLink']);
// Rota para exibir o formulário de nova senha
$router->get('resetar-senha', [AuthController::class, 'resetPassword']);
// Rota para processar a nova senha
$router->post('resetar-senha', [AuthController::class, 'resetPassword']);

/**
 * --- ROTAS DE PÁGINAS ESTÁTICAS ---
 */
$router->get('', [PageController::class, 'index']);
$router->get('home', [PageController::class, 'index']);
$router->get('planos', [PageController::class, 'plans']);

// Rota 404 de fallback (usando GET na última posição)
$router->get('{any}', [PageController::class, 'notFound']);