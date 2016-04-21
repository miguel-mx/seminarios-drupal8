<?php

namespace Drupal\seminarios\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class SeminariosController.
 *
 * @package Drupal\seminarios\Controller
 */
class SeminariosController extends ControllerBase {
    /**
     * Semana.
     *
     * @return string
     *   Return Hello string.
     */
    public function semana() {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "132.248.196.44/seminarios-CCM/web/app.php/evento/semana.xml");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/xml'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($ch);
        $data = new \SimpleXMLElement($response);

        $seminarios = (array) $data;

        return [
            '#theme' => 'seminarios_ccm',   // Defined in .module
            '#seminarios' => $seminarios,   // twig paramenters
            '#attached' => [
                'library' => [
                    'seminarios/seminarios-styles', //include our custom library for this response
                ]
            ]
        ];

//    return [
//      '#type' => 'markup',
//      '#markup' => $this->t('Implement method: index')
//    ];
    }

}
