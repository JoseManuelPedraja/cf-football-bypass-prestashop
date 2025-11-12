<?php
/**
 * 2007-2025 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 *
 * @author    Jose Manuel Pedraja <tu@email.com>
 * @copyright 2007-2025 PrestaShop SA
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 */
// Include PrestaShop configuration
require_once(dirname(__FILE__) . '/../../config/config.inc.php');

// Security check
if (!defined('_PS_VERSION_')) {
    exit('No direct script access allowed');
}

// Verify token
$token = isset($_GET['token']) ? trim($_GET['token']) : '';
$stored_token = Configuration::get('CFB_CRON_SECRET');

if (empty($stored_token) || $token !== $stored_token) {
    http_response_code(403);
    die('CFB: token inválido');
}

// Log the cron execution
$log_message = 'Cron externo ejecutado desde IP: ' . ($_SERVER['REMOTE_ADDR'] ?? 'desconocida');

try {
    // Load module and execute check
    $module = Module::getInstanceByName('cffootballbypass');
    
    if (!$module || !$module->active) {
        http_response_code(500);
        die('CFB: módulo no disponible');
    }

    // Log the execution
    $module->logEvent('external_cron', $log_message);
    
    // Execute the main check
    $module->checkFootballAndManageCloudflare();
    
    // Success response
    $response = [
        'status' => 'success',
        'message' => 'CFB cron ejecutado correctamente',
        'timestamp' => date('Y-m-d H:i:s'),
        'ip' => $_SERVER['REMOTE_ADDR'] ?? 'desconocida'
    ];
    
    header('Content-Type: application/json');
    echo json_encode($response);
    
} catch (Exception $e) {
    http_response_code(500);
    
    $error_response = [
        'status' => 'error',
        'message' => 'Error ejecutando cron: ' . $e->getMessage(),
        'timestamp' => date('Y-m-d H:i:s')
    ];
    
    header('Content-Type: application/json');
    echo json_encode($error_response);
    
    // Log the error if possible
    if (isset($module) && $module) {
        $module->logEvent('external_cron_error', $e->getMessage(), [
            'ip' => $_SERVER['REMOTE_ADDR'] ?? 'desconocida',
            'trace' => $e->getTraceAsString()
        ]);
    }
}

exit;