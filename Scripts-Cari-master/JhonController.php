<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controllers;

use App\Utils\StaticExecuteServicePreproduccion;
use App\Controllers\SoundlutionsUtilsController;

/**
 * Description of CariController
 *
 * @author JhonB19
 */
class JhonController
{
  public $nameLog = "JhonController";

  public function process(\Phalcon\Mvc\Micro $app)
  {
    header('Access-Control-Allow-Origin: *');
    $nameController = "JhonController";
    $chat_id = $_POST['chat_identification'];
    $params_error_report = [
      'enterprise_id' => $_POST['enterprise_id'],
      'session_id' => $_POST['session_id'],
      'bot_id' => $_POST['bot_id'],
      'convesartion_id' => $_POST['convesartion_id'],
    ];
    $operation = $_POST['operation'];
    $useProduction = $_POST['useProduction'];
    $token = $_POST['token'];
    $url = $_POST["url"];

    if ($useProduction && md5($token) == 'da0c25bc1d54b8961680edf08ab03ea6') {
      switch ($operation) {
        case "test":
          $response = "El controlador de preprod ya funciona";
          echo $response;
          break;

        case "getSwapiAPI":
          $response = $this->getSwapiAPI();
          echo $response;
          break;

        case "bookAppointment":
          $response = $this->bookAppointment($app, $params_error_report, $nameController, $chat_id);
          echo $response;
          break;

        default:
          $response = "Es necesario indicar el operation";
          echo $response;
          break;
      }
    } else {
      $response = "Faltan useProduction o token. Ambos parámetros son obligatorios";
      echo $response;
    }
  }

  public function getSwapiAPI()
  {
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://swapi.dev/api/people/?page=2',
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_RETURNTRANSFER => true
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    $data = json_decode($response, true);

    $results = $data["results"];

    print_r($results);
  }

  //Función para reservar una cita médica
  public function bookAppointment($app, $params_error_report, $nameController, $chat_id)
  {
    $nameController = "JhonController";
    $nameFunction = "bookAppointment()";
    $partnerCode = $_POST['partnerCode'];
    $hashKey = $_POST['hashKey'];
    $url = 'https://dev.34-149-116-245.nip.io/v1/appointments/postPreBooking';
    $auth = $_POST['auth'];

    $headers = [
      'Authorization: Bearer ' . $auth,
      'Content-Type: application/json',
      'UUID: 123',
      'partnerCode: ' . $partnerCode,
      'hashKey: ' . $hashKey
    ];

    $datos = [
      'partnerCode: ' . $partnerCode,
      'hashKey: ' . $hashKey,
      'auth: ' . $auth,
      'url: ' . $url
    ];

    /*$body = [
            'resourceType' => 'Bundle',
            'id' => 'bundle-update-appointment',
            'type' => 'batch',
            'entry' => [
                [
                    'request' => [
                        'method' => 'GET',
                        'url' => 'Location/10299'
                    ]
                ],
                [
                    'request' => [
                        'method' => 'PUT',
                        'url' => 'Appointment/7043520'
                    ],
                    'resource' => [
                        'resourceType' => 'Appointment',
                        'id' => '173108',
                        'status' => 'prebooked',
                        'start' => '2023-11-03T11:40:00.000Z', 
                        'end' => '2023-11-03T11:40:00.000Z',  
                        'participant' => [
                            [
                                'type' => [
                                    ['text' => 'Patient']
                                ],
                                'status' => 'accepted',
                                'actor' => [
                                    'reference' => 'Patient/CC-1013583710', 
                                    'extension' => [
                                        ['url' => 'telefono', 'valueString' => '3045384743'],
                                        ['url' => 'email', 'valueString' => 'jfnoy@keralty.com']
                                    ]
                                ]
                            ],
                            [
                                'actor' => [
                                    'reference' => 'Practitioner/1026291549' 
                                ],
                                'type' => [
                                    ['text' => 'Practitioner']
                                ],
                                'status' => 'accepted'
                            ],
                            [
                                'actor' => [
                                    'reference' => 'Location/10299' 
                                ],
                                'type' => [
                                    ['text' => 'Location']
                                ],
                                'status' => 'accepted'
                            ]
                        ],
                        'specialty' => [
                            'coding' => [
                                ['system' => 'Bukeala', 'code' => '004'] 
                            ]
                        ],
                        'appointmentType' => [
                            'coding' => [['code' => 'Presencial']],
                            'text' => 'true' 
                        ],
                        'extension' => [
                            ['url' => 'attachmentUrl', 'valueUrl' => 'http://misdocumentos/ordenmedica.pdf']
                        ],
                        'basedOn' => [
                            ['reference' => 'ServiceRequest/7034059']
                        ],
                        'supportingInformation' => [
                            [
                                'identifier' => [
                                    ['value' => '30', 'system' => 'Bukeala/Producto']
                                ]
                            ],
                            [
                                'identifier' => [
                                    ['value' => '10', 'system' => 'Bukeala/Plan']
                                ]
                            ],
                            [
                                'identifier' => [
                                    'system' => 'Bukeala/codigoPais',
                                    'value' => 'co'
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $body = json_encode($body);*/

    $body = '
        {
    "resourceType": "Bundle",
    "id": "bundle-update-appointment",
    "type": "batch",
    "entry": [
      {
        "request": {
          "method": "GET",
          "url": "Location/10299"
        }
      },
      {
        "request": {
          "method": "PUT",
          "url": "Appointment/7043520"
        },
        "resource": {
          "resourceType": "Appointment",
          "id": "173108",
          "status": "prebooked",
          "start": "2023-11-03T11:40:00.000Z",
          "end": "2023-11-03T11:40:00.000Z",
          "participant": [
            {
              "type": [
                {
                  "text": "Patient"
                }
              ],
              "status": "accepted",
              "actor": {
                "reference": "Patient/CC-1013583710", 
                "extension": [
                  {
                    "url": "telefono",
                    "valueString": "3045384743" 
                  },
                  {
                    "url": "email",
                    "valueString": "jfnoy@keralty.com" 
                  }
                ]
              }
            },
            {
              "actor": {
                "reference": "Practitioner/1026291549" 
              },
              "type": [
                {
                  "text": "Practitioner"
                }
              ],
              "status": "accepted"
            },
            {
              "actor": {
                "reference": "Location/10299" 
              },
              "type": [
                {
                  "text": "Location"
                }
              ],
              "status": "accepted"
            }
          ],
          "specialty": [
            {
              "coding": [
                {
                  "system": "Bukeala",
                  "code": "004" 
                }
              ]
            }
          ],
          "appointmentType": {
            "coding": [
              {
                "code": "Presencial" 
              }
            ],
            "text": "true" 
          },
          "extension": [
            {
              "url": "attachmentUrl",
              "valueUrl": "http://misdocumentos/ordenmedica.pdf"
            }
          ],
          "basedOn": [
            {
              "reference": "ServiceRequest/7034059"
            }
          ],
          "supportingInformation": [
            {
              "identifier": [
                {
                  "value": "30", 
                  "system": "Bukeala/Producto"
                }
              ]
            },
            {
              "identifier": [
                {
                  "value": "10", 
                  "system": "Bukeala/Plan"
                }
              ]
            },
            {
              "identifier": [
                {
                  "system": "Bukeala/codigoPais",
                  "value": "co" 
                }
              ]
            }
          ]
        }
      },
      {
        "request": {
          "method": "PUT",
          "url": "Patient/CC-1013583710" 
        },
        "resource": {
          "resourceType": "Patient",
          "id": "CC-1013583710",
          "contact": [ 
            {
              "address": {
                "city": "1101",
                "text": "Calle 100 N. 05 - 23",
                "extension": [
                  {
                    "url": "barrio",
                    "valueString": "La Idependencia"
                  }
                ]
              }
            }
          ]
        }
      }
    ]
  }
  
      ';

    $response_object = StaticExecuteServicePreproduccion::executeCurlRestPreproduccion($chat_id, $nameController, $nameFunction, $app, $url, $headers, 'POST', $body, $this->nameLog, $datos);

    $data = json_decode($response_object, true);

    $entry = $data["entry"];

    return $entry;

    //print_r($body);

    /*$curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_POST => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_POSTFIELDS => $body,
            CURLOPT_RETURNTRANSFER => true
        ]);

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        print_r($response);
        print_r($httpCode);

        if ($httpCode == 200) {
            return $response;
        } else {
            throw new \Exception("Error en la reserva de la cita: " . $response);
        }*/
  }

  //Función para consultar citas médicas
  public function getBooking($app, $params_error_report, $nameController, $chat_id)
  {
    $nameController = "JhonController";
    $nameFunction = "getBooking()";
    $partnerCode = $_POST['partnerCode'];
    $hashKey = $_POST['hashKey'];
    $url = 'https://dev.34-149-116-245.nip.io/v1/appointments/getBookings';
    $auth = $_POST['auth'];

    $headers = [
      'Authorization: Bearer ' . $auth,
      'Content-Type: application/json',
      'UUID: 123',
      'partnerCode: ' . $partnerCode,
      'hashKey: ' . $hashKey
    ];

    $datos = [
      'partnerCode: ' . $partnerCode,
      'hashKey: ' . $hashKey,
      'auth: ' . $auth,
      'url: ' . $url
    ];

    $body = '
      {
        "resourceType": "Bundle",
        "id": "bundle-request-appointment",
        "type": "batch",
        "entry": [
          {
            "request": {
              "method": "GET",
              "url": "Appointment?_filter=patient.identifier%3Aof-type%20eq%20Bukeala%7CCC%7C63347750&date=gt2024-01-01&date=lt2024-02-15"
            }
          }
        ]
      }
    ';

    $response_object = StaticExecuteServicePreproduccion::executeCurlRestPreproduccion($chat_id, $nameController, $nameFunction, $app, $url, $headers, 'POST', $body, $this->nameLog, $datos);

    $data = json_decode($response_object, true);

    $entry = $data["entry"];

    return $entry;
  }
}
