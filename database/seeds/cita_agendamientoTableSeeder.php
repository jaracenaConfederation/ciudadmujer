<?php

use Illuminate\Database\Seeder;
use App\Cita_Agendamiento;

class cita_agendamientoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
//
//            ['id_cm'=>2,'id_centrocm_servicio_prestadora'=>1,
//             'id_estado_cita'=>2,'fecha_cita'=>'20171023','hora_inicio_cita'=>'11:00',
//             'hora_termino_cita'=>'11:30','observaciones'=>'En ayunas','solicitantes'=>'Esposo',
//             'hora_atencion_inicio'=>'11:15','hora_atencion_termino'=>'11:35',
//             'id_user_registro'=>'001','fecha_registro'=>'20171031',
//            ],
//
//            ['id_cm'=>2,'id_centrocm_servicio_prestadora'=>12,
//                'id_estado_cita'=>2,'fecha_cita'=>'20171023','hora_inicio_cita'=>'09:30',
//                'hora_termino_cita'=>'10:00','observaciones'=>'','solicitantes'=>'Esposo',
//                'hora_atencion_inicio'=>'11:15','hora_atencion_termino'=>'11:35',
//                'id_user_registro'=>'001','fecha_registro'=>'20171030',
//            ],
//            ['id_cm'=>1,'id_centrocm_servicio_prestadora'=>19,
//                'id_estado_cita'=>2,'fecha_cita'=>'20171025','hora_inicio_cita'=>'14:30',
//                'hora_termino_cita'=>'15:00','observaciones'=>'','solicitantes'=>'Mamá',
//                'hora_atencion_inicio'=>'14:35','hora_atencion_termino'=>'14:55',
//                'id_user_registro'=>'001','fecha_registro'=>'20171027',
//            ],
//            ['id_cm'=>1,'id_centrocm_servicio_prestadora'=>10,
//                'id_estado_cita'=>2,'fecha_cita'=>'20171027','hora_inicio_cita'=>'09:30',
//                'hora_termino_cita'=>'10:00','observaciones'=>'','solicitantes'=>'Esposo',
//                'hora_atencion_inicio'=>'11:15','hora_atencion_termino'=>'11:35',
//                'id_user_registro'=>'001','fecha_registro'=>'20171028',
//            ],
//            ['id_cm'=>3,'id_centrocm_servicio_prestadora'=>78,
//                'id_estado_cita'=>2,'fecha_cita'=>'20171026','hora_inicio_cita'=>'11:00',
//                'hora_termino_cita'=>'11:30','observaciones'=>'En ayunas','solicitantes'=>'Esposo',
//                'hora_atencion_inicio'=>'11:15','hora_atencion_termino'=>'11:35',
//                'id_user_registro'=>'001','fecha_registro'=>'20171028',
//            ],
//
//            ['id_cm'=>3,'id_centrocm_servicio_prestadora'=>40,
//                'id_estado_cita'=>2,'fecha_cita'=>'20171031','hora_inicio_cita'=>'09:30',
//                'hora_termino_cita'=>'10:00','observaciones'=>'','solicitantes'=>'Esposo',
//                'hora_atencion_inicio'=>'11:15','hora_atencion_termino'=>'11:35',
//                'id_user_registro'=>'001','fecha_registro'=>'20171021',
//            ],
//            ['id_cm'=>3,'id_centrocm_servicio_prestadora'=>43,
//                'id_estado_cita'=>2,'fecha_cita'=>'20171024','hora_inicio_cita'=>'14:30',
//                'hora_termino_cita'=>'15:00','observaciones'=>'','solicitantes'=>'Mamá',
//                'hora_atencion_inicio'=>'14:35','hora_atencion_termino'=>'14:55',
//                'id_user_registro'=>'001','fecha_registro'=>'20170921',
//            ],
//            ['id_cm'=>3,'id_centrocm_servicio_prestadora'=>49,
//                'id_estado_cita'=>2,'fecha_cita'=>'20171025','hora_inicio_cita'=>'09:30',
//                'hora_termino_cita'=>'10:00','observaciones'=>'','solicitantes'=>'Esposo',
//                'hora_atencion_inicio'=>'11:15','hora_atencion_termino'=>'11:35',
//                'id_user_registro'=>'001','fecha_registro'=>'20170921',
//            ],
//            ['id_cm'=>4,'id_centrocm_servicio_prestadora'=>1,
//                'id_estado_cita'=>2,'fecha_cita'=>'20171023','hora_inicio_cita'=>'11:00',
//                'hora_termino_cita'=>'11:30','observaciones'=>'En ayunas','solicitantes'=>'Esposo',
//                'hora_atencion_inicio'=>'11:15','hora_atencion_termino'=>'11:35',
//                'id_user_registro'=>'001','fecha_registro'=>'20171113',
//            ],
//
//            ['id_cm'=>4,'id_centrocm_servicio_prestadora'=>14,
//                'id_estado_cita'=>2,'fecha_cita'=>'20171013','hora_inicio_cita'=>'09:30',
//                'hora_termino_cita'=>'10:00','observaciones'=>'','solicitantes'=>'Esposo',
//                'hora_atencion_inicio'=>'11:15','hora_atencion_termino'=>'11:35',
//                'id_user_registro'=>'001','fecha_registro'=>'20171103',
//            ],
//            ['id_cm'=>1,'id_centrocm_servicio_prestadora'=>18,
//                'id_estado_cita'=>2,'fecha_cita'=>'20171106','hora_inicio_cita'=>'14:30',
//                'hora_termino_cita'=>'15:00','observaciones'=>'','solicitantes'=>'Mamá',
//                'hora_atencion_inicio'=>'14:35','hora_atencion_termino'=>'14:55',
//                'id_user_registro'=>'001','fecha_registro'=>'20171106',
//            ],
//            ['id_cm'=>1,'id_centrocm_servicio_prestadora'=>11,
//                'id_estado_cita'=>2,'fecha_cita'=>'20171107','hora_inicio_cita'=>'09:30',
//                'hora_termino_cita'=>'10:00','observaciones'=>'','solicitantes'=>'Esposo',
//                'hora_atencion_inicio'=>'11:15','hora_atencion_termino'=>'11:35',
//                'id_user_registro'=>'001','fecha_registro'=>'20171105',
//            ],
//            ['id_cm'=>3,'id_centrocm_servicio_prestadora'=>71,
//                'id_estado_cita'=>2,'fecha_cita'=>'20171108','hora_inicio_cita'=>'11:00',
//                'hora_termino_cita'=>'11:30','observaciones'=>'En ayunas','solicitantes'=>'Esposo',
//                'hora_atencion_inicio'=>'11:15','hora_atencion_termino'=>'11:35',
//                'id_user_registro'=>'001','fecha_registro'=>'20171104',
//            ],
//
//            ['id_cm'=>3,'id_centrocm_servicio_prestadora'=>39,
//                'id_estado_cita'=>2,'fecha_cita'=>'20171106','hora_inicio_cita'=>'09:30',
//                'hora_termino_cita'=>'10:00','observaciones'=>'','solicitantes'=>'Esposo',
//                'hora_atencion_inicio'=>'11:15','hora_atencion_termino'=>'11:35',
//                'id_user_registro'=>'001','fecha_registro'=>'20171021',
//            ],
//            ['id_cm'=>3,'id_centrocm_servicio_prestadora'=>23,
//                'id_estado_cita'=>2,'fecha_cita'=>'20171024','hora_inicio_cita'=>'14:30',
//                'hora_termino_cita'=>'15:00','observaciones'=>'','solicitantes'=>'Mamá',
//                'hora_atencion_inicio'=>'14:35','hora_atencion_termino'=>'14:55',
//                'id_user_registro'=>'001','fecha_registro'=>'20170921',
//            ],
//            ['id_cm'=>3,'id_centrocm_servicio_prestadora'=>69,
//                'id_estado_cita'=>2,'fecha_cita'=>'20171024','hora_inicio_cita'=>'09:30',
//                'hora_termino_cita'=>'10:00','observaciones'=>'','solicitantes'=>'Esposo',
//                'hora_atencion_inicio'=>'11:15','hora_atencion_termino'=>'11:35',
//                'id_user_registro'=>'001','fecha_registro'=>'20170921',
//            ],
        ];
        foreach ($data as $key => $value) {

            Cita_Agendamiento::create($value);

        }
    }
}
