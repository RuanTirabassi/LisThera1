<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Roles
        DB::table('roles')->insertOrIgnore([
            ['id' => 1, 'name' => 'admin',      'description' => 'Administrador'],
            ['id' => 2, 'name' => 'recepcao',   'description' => 'Recep\u00e7\u00e3o'],
            ['id' => 3, 'name' => 'terapeuta',  'description' => 'Terapeuta'],
            ['id' => 4, 'name' => 'gestor',     'description' => 'Gestor'],
        ]);

        // Arenas
        DB::table('arenas')->insertOrIgnore([
            ['id' => 1, 'name' => 'Arena Principal', 'description' => 'Arena coberta principal', 'capacity' => 6],
            ['id' => 2, 'name' => 'Arena Secund\u00e1ria', 'description' => 'Arena externa', 'capacity' => 4],
        ]);

        // Cavalos
        DB::table('horses')->insertOrIgnore([
            ['id' => 1, 'name' => 'Trovador', 'breed' => 'Quarto de Milha', 'birthdate' => '2015-03-10', 'rfidtoken' => 'RFID-H001'],
            ['id' => 2, 'name' => 'Estrela',  'breed' => 'Mangalarga',      'birthdate' => '2017-06-22', 'rfidtoken' => 'RFID-H002'],
            ['id' => 3, 'name' => 'Brioso',   'breed' => 'Paint Horse',     'birthdate' => '2016-11-05', 'rfidtoken' => 'RFID-H003'],
        ]);

        // Tipos de montaria
        DB::table('mounttypes')->insertOrIgnore([
            ['id' => 1, 'name' => 'Dorso nu',          'description' => 'Sem sela'],
            ['id' => 2, 'name' => 'Com sela',          'description' => 'Sela convencional'],
            ['id' => 3, 'name' => 'Cangaça',           'description' => 'Manta com alarça'],
            ['id' => 4, 'name' => 'Hipótese lateral', 'description' => 'Postura lateral'],
        ]);

        // Diagnósticos de referência
        DB::table('diagnosisreference')->insertOrIgnore([
            ['id' => 1, 'code' => 'G80',   'name' => 'Paralisia Cerebral',           'description' => null],
            ['id' => 2, 'code' => 'F84.0', 'name' => 'Autismo',                      'description' => null],
            ['id' => 3, 'code' => 'G35',   'name' => 'Esclerose M\u00faltipla',           'description' => null],
            ['id' => 4, 'code' => 'Q90',   'name' => 'S\u00edndrome de Down',            'description' => null],
            ['id' => 5, 'code' => 'F90',   'name' => 'TDAH',                         'description' => null],
            ['id' => 6, 'code' => 'F20',   'name' => 'Esquizofrenia',                'description' => null],
            ['id' => 7, 'code' => 'M47',   'name' => 'Espondiloartrose',             'description' => null],
        ]);

        // Terapeutas
        DB::table('therapists')->insertOrIgnore([
            ['id' => 1, 'fullname' => 'Dra. Ana Lima',      'specialization' => 'Fisioterapeuta', 'registrationnumber' => 'CREFITO-123', 'phonenumber' => '(15) 99001-0001', 'email' => 'ana@listhera.dev'],
            ['id' => 2, 'fullname' => 'Dr. Carlos Souza',  'specialization' => 'Psic\u00f3logo',     'registrationnumber' => 'CRP-456',    'phonenumber' => '(15) 99001-0002', 'email' => 'carlos@listhera.dev'],
            ['id' => 3, 'fullname' => 'Dra. Beatriz Melo', 'specialization' => 'Pedagoga',      'registrationnumber' => 'MEC-789',    'phonenumber' => '(15) 99001-0003', 'email' => 'beatriz@listhera.dev'],
        ]);

        // Praticantes
        DB::table('practitioners')->insertOrIgnore([
            ['id' => 1, 'fullname' => 'Jo\u00e3o Pedro Alves',   'birthdate' => '2010-04-15', 'rfidtoken' => 'RFID-P001', 'phonenumber' => '(15) 99100-0001', 'address' => 'Rua das Flores, 10', 'notes' => null],
            ['id' => 2, 'fullname' => 'Maria Clara Santos', 'birthdate' => '2008-09-22', 'rfidtoken' => 'RFID-P002', 'phonenumber' => '(15) 99100-0002', 'address' => 'Av. Brasil, 55',    'notes' => null],
            ['id' => 3, 'fullname' => 'Lucas Ferreira',     'birthdate' => '2015-01-30', 'rfidtoken' => 'RFID-P003', 'phonenumber' => '(15) 99100-0003', 'address' => 'Rua Ipiranga, 77', 'notes' => 'Hiperativo'],
            ['id' => 4, 'fullname' => 'Sofia Oliveira',     'birthdate' => '2012-07-08', 'rfidtoken' => 'RFID-P004', 'phonenumber' => '(15) 99100-0004', 'address' => 'Rua do Campo, 3',  'notes' => null],
        ]);

        // Diagnósticos dos praticantes
        DB::table('practitionerdiagnosis')->insertOrIgnore([
            ['practitionerid' => 1, 'diagnosisreferenceid' => 1, 'diagnoseddate' => '2011-06-01', 'notes' => null],
            ['practitionerid' => 2, 'diagnosisreferenceid' => 2, 'diagnoseddate' => '2010-03-15', 'notes' => null],
            ['practitionerid' => 3, 'diagnosisreferenceid' => 5, 'diagnoseddate' => '2018-08-20', 'notes' => null],
            ['practitionerid' => 4, 'diagnosisreferenceid' => 4, 'diagnoseddate' => '2012-09-10', 'notes' => null],
        ]);

        // Responsáveis
        DB::table('practitionerguardians')->insertOrIgnore([
            ['practitionerid' => 1, 'fullname' => 'Roberto Alves',   'relationship' => 'Pai',    'phonenumber' => '(15) 98800-0001', 'email' => null],
            ['practitionerid' => 2, 'fullname' => 'Fernanda Santos', 'relationship' => 'M\u00e3e',    'phonenumber' => '(15) 98800-0002', 'email' => null],
            ['practitionerid' => 3, 'fullname' => 'Paulo Ferreira',  'relationship' => 'Pai',    'phonenumber' => '(15) 98800-0003', 'email' => null],
            ['practitionerid' => 4, 'fullname' => 'Cl\u00e1udia Oliveira','relationship' => 'M\u00e3e',    'phonenumber' => '(15) 98800-0004', 'email' => null],
        ]);

        // Memory Cue Templates
        DB::table('memorycuetemplates')->insertOrIgnore([
            ['id' => 1,  'label' => 'Equil\u00edbrio est\u00e1tico',    'category' => 'Postura',      'hotkey' => 'q', 'description' => null],
            ['id' => 2,  'label' => 'Equil\u00edbrio din\u00e2mico',   'category' => 'Postura',      'hotkey' => 'w', 'description' => null],
            ['id' => 3,  'label' => 'Tonus muscular',          'category' => 'Postura',      'hotkey' => 'e', 'description' => null],
            ['id' => 4,  'label' => 'Aten\u00e7\u00e3o sustentada',    'category' => 'Cognitivo',    'hotkey' => 'a', 'description' => null],
            ['id' => 5,  'label' => 'Seguimento de ordens',    'category' => 'Cognitivo',    'hotkey' => 's', 'description' => null],
            ['id' => 6,  'label' => 'Comunica\u00e7\u00e3o verbal',    'category' => 'Cognitivo',    'hotkey' => 'd', 'description' => null],
            ['id' => 7,  'label' => 'Engajamento',             'category' => 'Comportamental','hotkey' => 'z', 'description' => null],
            ['id' => 8,  'label' => 'Resist\u00eancia',               'category' => 'Comportamental','hotkey' => 'x', 'description' => null],
            ['id' => 9,  'label' => 'Agita\u00e7\u00e3o',             'category' => 'Comportamental','hotkey' => 'c', 'description' => null],
            ['id' => 10, 'label' => 'Dor observada',           'category' => 'Cl\u00ednico',      'hotkey' => '1', 'description' => null],
            ['id' => 11, 'label' => 'Queda de risco',          'category' => 'Cl\u00ednico',      'hotkey' => '2', 'description' => null],
            ['id' => 12, 'label' => 'Resposta positiva',       'category' => 'Cl\u00ednico',      'hotkey' => '3', 'description' => null],
        ]);

        // Check-ins de triagem
        DB::table('sessioncheckins')->insertOrIgnore([
            ['practitionerid' => 1, 'checkedat' => '2026-07-20 08:00:00', 'bloodpressuresys' => 110, 'bloodpressuredia' => 70, 'heartrate' => 75, 'temperature' => 36.5, 'oxygensaturation' => 98, 'painlevel' => 1, 'mobilityrating' => 4, 'moodrating' => 5, 'sessionauthorized' => 1, 'authorizationnotes' => null],
            ['practitionerid' => 2, 'checkedat' => '2026-07-20 08:15:00', 'bloodpressuresys' => 105, 'bloodpressuredia' => 68, 'heartrate' => 80, 'temperature' => 36.8, 'oxygensaturation' => 97, 'painlevel' => 0, 'mobilityrating' => 3, 'moodrating' => 4, 'sessionauthorized' => 1, 'authorizationnotes' => null],
            ['practitionerid' => 3, 'checkedat' => '2026-07-20 08:30:00', 'bloodpressuresys' => 115, 'bloodpressuredia' => 75, 'heartrate' => 88, 'temperature' => 37.0, 'oxygensaturation' => 96, 'painlevel' => 3, 'mobilityrating' => 3, 'moodrating' => 3, 'sessionauthorized' => 0, 'authorizationnotes' => 'Dor relatada no quadril'],
        ]);

        // Sessões de arena
        DB::table('arenasessions')->insertOrIgnore([
            ['id' => 1, 'practitionerid' => 1, 'therapistid' => 1, 'arenaid' => 1, 'startedat' => '2026-07-20 09:00:00', 'endedat' => '2026-07-20 09:45:00', 'notes' => 'Sessão de rotina'],
            ['id' => 2, 'practitionerid' => 2, 'therapistid' => 2, 'arenaid' => 1, 'startedat' => '2026-07-20 10:00:00', 'endedat' => null,                    'notes' => 'Em andamento'],
        ]);

        // Montarias
        DB::table('arenasessionmounts')->insertOrIgnore([
            ['arenasessionid' => 1, 'horseid' => 1, 'mounttypeid' => 2, 'mountedat' => '2026-07-20 09:05:00', 'dismountedat' => '2026-07-20 09:40:00', 'notes' => null],
            ['arenasessionid' => 2, 'horseid' => 2, 'mounttypeid' => 1, 'mountedat' => '2026-07-20 10:05:00', 'dismountedat' => null,                    'notes' => null],
        ]);

        // Eventos de Memory Cue
        DB::table('sessionmemorycueevents')->insertOrIgnore([
            ['arenasessionid' => 1, 'memorycuetemplateid' => 1,  'recordedat' => '2026-07-20 09:10:00', 'notes' => null],
            ['arenasessionid' => 1, 'memorycuetemplateid' => 4,  'recordedat' => '2026-07-20 09:20:00', 'notes' => null],
            ['arenasessionid' => 1, 'memorycuetemplateid' => 7,  'recordedat' => '2026-07-20 09:30:00', 'notes' => 'Engajamento excelente'],
            ['arenasessionid' => 2, 'memorycuetemplateid' => 2,  'recordedat' => '2026-07-20 10:10:00', 'notes' => null],
            ['arenasessionid' => 2, 'memorycuetemplateid' => 12, 'recordedat' => '2026-07-20 10:20:00', 'notes' => 'Muito positivo'],
        ]);
    }
}
