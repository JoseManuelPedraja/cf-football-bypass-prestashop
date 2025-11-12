<?php
/**
 * Upgrade to 1.5.5
 *
 * @author    Jose Manuel Pedraja
 * @copyright 2007-2025 PrestaShop SA
 * @license   https://opensource.org/licenses/AFL-3.0
 */

if (!defined('_PS_VERSION_')) {
    exit;
}

function upgrade_module_1_5_5($module)
{
    // Actualizar configuración si es necesario
    Configuration::updateValue('CFB_VERSION', '1.5.5');
    
    return true;
}