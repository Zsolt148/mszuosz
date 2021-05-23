<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //TODO CHECK TEAM NAMES
        $teams = [
            [
                'name' => 'Algyői Úszó és Vízisport Egyesület',
                'SA' => '35',
                'address' => '6750 Algyő, Sport u. 9.',
                'webpage' => '',
            ],
            [
                'name' => 'BÁCSVÍZ Kecskeméti Vízmű Sport Club',
                'SA' => '31',
                'address' => '6000 Kecskemét, Izsáki út 13.',
                'webpage' => 'http://kvsc.info',
            ],
            [
                'name' => 'Balaton Úszó Klub',
                'SA' => '94',
                'address' => '8200 Veszprém, Veszprémvölgyi út 3.',
                'webpage' => '',
            ],
            [
                'name' => 'Budapesti Egyetemi Atlétikai Club Sportegyesület',
                'SA' => '71',
                'address' => '1112 Budapest, Bogdánffy Ödön u. 10',
                'webpage' => 'https://www.beac.hu/',
            ],
            [
                'name' => 'Békéscsabai Senior Úszó Egyesület',
                'SA' => '3',
                'address' => '5600 Békéscsaba, Bánát u 34.',
                'webpage' => '',
            ],
            [ //missing
                'name' => 'Berettyó Cápák SE',
                'SA' => '86',
                'address' => '4100 Berettyóújfalu, Bocskai utca 84.',
                'webpage' => '',
            ],
            [
                'name' => 'Bohóchal Egyesület',
                'SA' => '40',
                'address' => '1163 Budapest, Bányai Elemér u.12.',
                'webpage' => '',
            ],
            [
                'name' => 'Budafóka XXII. SE',
                'SA' => '58',
                'address' => '1222 Budapest, Nagytétényi út 31-33',
                'webpage' => 'http://www.budafokase.hu',
            ],
            [
                'name' => 'Budapesti Delfinek',
                'SA' => '2',
                'address' => '1138 Budapest, Népfürdő utca 35. II/5',
                'webpage' => 'http://budapestidelfinek.hu',
            ],
            [
                'name' => 'Delfin Sportegyesület',
                'SA' => '97',
                'address' => '1138 Budapest, Népfürdő utca 35. II/5',
                'webpage' => '',
            ],
            [ //missing
                'name' => 'Budapesti Honvéd SE',
                'SA' => '75',
                'address' => '1134 Budapest, Dózsa György út 53.',
                'webpage' => '',
            ],
            [
                'name' => 'Budapesti Vasutas Sport Club-Zugló',
                'SA' => '49',
                'address' => '1142 Budapest, Szőnyi út 2.',
                'webpage' => 'www.bvsc.hu',
            ],
            [
                'name' => 'Csobogó 17 Egyesület',
                'SA' => '50',
                'address' => '1174 Budapest, Ady Endre u. 67.',
                'webpage' => 'http://www.uszasoktatas17.hu',
            ],
            [
                'name' => 'Csongrádi Senior Úszó és Szabadidősport Egyesület',
                'SA' => '17',
                'address' => '6640 Csongrád, Tanya 827/A',
                'webpage' => 'www.senior.csongrad.hu',
            ],
            [
                'name' => 'Debreceni Szenior Úszó Klub',
                'SA' => '4',
                'address' => '4800 Debrecen, Zoltai Lajos u. 11',
                'webpage' => 'http://www.dszuk.hu',
            ],
            [ //missing
                'name' => 'Délzalai Vízmű Sportegyesület',
                'SA' => '?',
                'address' => '8800 Nagykanizsa, Zrínyi M. utca 21.',
                'webpage' => '',
            ],
            [
                'name' => 'Dombóvári SI',
                'SA' => '87',
                'address' => '7200 Dombóvár, Ivanich Antal u. 76.',
                'webpage' => 'http://uszasdsi.gportal.hu',
            ],
            [
                'name' => 'Dr. Regele Károly Szenior Úszóklub',
                'SA' => '5',
                'address' => '5700 Gyula, Bocskai u. 13',
                'webpage' => 'http://www.magyar.sport.hu/uszas/regele/',
            ],
            [
                'name' => 'Dunakanyar Szabadidősport és Kulturális Egyesület',
                'SA' => '65',
                'address' => '2000 Szentendre, Rózsa köz 4/2 fsz.1	',
                'webpage' => '',
            ],
            [
                'name' => 'Eger Városi Úszóklub',
                'SA' => '36',
                'address' => '3300 Eger, Frank Tivadar utca 5.',
                'webpage' => '',
            ],
            [
                'name' => 'Egri Senior Úszó-Klub',
                'SA' => '11',
                'address' => '3300 Eger, Szvorényi u.5.',
                'webpage' => '',
            ],
            [
                'name' => 'Első Tököli Diák Úszóegylet',
                'SA' => '93',
                'address' => '2310 Halásztelek, Hajnal utca 10.',
                'webpage' => 'www.zuboruszosuli.hu',
            ],
            [
                'name' => 'Esztergomi Úszó Klub',
                'SA' => '85',
                'address' => '2500 Esztergom, Basa utca 13/4.',
                'webpage' => '',
            ],
            [
                'name' => 'Family Tree Triatlon és Szabadidő Sportegyesület',
                'SA' => '89',
                'address' => '8000 Székesfehérvár, Szedreskerti lakónegyed 30. fszt. 2.',
                'webpage' => '',
            ],
            [
                'name' => 'Ferencvárosi Torna Club',
                'SA' => '24',
                'address' => '1091 Budapest, Üllői út 129.',
                'webpage' => 'http://www.ftcswimmasters.hu',
            ],
            [
                'name' => 'Győri Zabolátlan Sportegyesület',
                'SA' => '37',
                'address' => '9012 Győr, Hegyalja u. 78.',
                'webpage' => '',
            ],
            [
                //'name' => 'Hatvani Úszó, Vízilabda és Szabadidősport Klub Egyesület',
                'name' => 'Hatvani Úszó Klub SE',
                'SA' => '96',
                'address' => '3000 Hatvan, Hajós A. u. 10. 2/8.',
                'webpage' => '',
            ],
            [
                'name' => 'Herceghalmi Sportegyesület',
                'SA' => '63',
                'address' => '2053 Herceghalom, Liget utca 2.',
                'webpage' => 'http://www.herceghalmise.hu',
            ],
            [
                'name' => 'HÓD Úszó Sport Egyesület',
                'SA' => '53',
                'address' => '6800 Hódmezővásárhely, Ady Endre u. 1.',
                'webpage' => 'http://www.hoduszo.hu',
            ],
            [
                'name' => 'Herpály Sportúszó Egyesület',
                'SA' => '78',
                'address' => '4100 Berettyóújfalu József Attila utca 35.',
                'webpage' => '',
            ],
            [
                'name' => 'Hód-Triatlon és Öttusa SE',
                'SA' => '90',
                'address' => '6800 Hódmezővásárhely, Garzó Imre u. 4/b',
                'webpage' => '',
            ],
            [
                'name' => 'Invictus Úszó és Vízilabda SC Kft.-Mezőtúr',
                'SA' => '25',
                'address' => '5000 Szolnok, Vitéz Szathmári József u. 2.',
                'webpage' => 'invictussc.hu',
            ],
            [
                'name' => "Hullám '91 Úszó és Vízilabda Egyesület",
                'SA' => '52',
                'address' => '8000 Székesfehérvár, Kadocsa u. 23',
                'webpage' => '',
            ],
            [
                'name' => 'Iron Swim',
                'SA' => '66',
                'address' => '1025 Budapest, Mandula utca 28 fsz.2',
                'webpage' => '',
            ],
            [
                'name' => 'Kaposvári Arena Senior VÚKE',
                'SA' => '74',
                'address' => '7400 Kaposvár Irányi Dániel u.5.',
                'webpage' => '',
            ],
            [
                'name' => 'Kiskun- Vizi és Szabadidő SE',
                'SA' => '60',
                'address' => '6100 Kiskunfélegyháza Attila u. 33.',
                'webpage' => '',
            ],
            [
                'name' => 'Kistarcsa VRC',
                'SA' => '69',
                'address' => '2143 Kistarcsa, Széchenyi u. 33	',
                'webpage' => '',
            ],
            [
                'name' => 'KisTri Balatonman Team',
                'SA' => '68',
                'address' => '2931 Almásfüzitő, Petőfi tér 1.',
                'webpage' => 'www.kistriteam.hu',
            ],
            [
                'name' => 'Kőbánya Sport Club',
                'SA' => '?',
                'address' => '1105 Budapest Ihász u. 24.',
                'webpage' => 'www.kobanysc.hu',
            ],
            [
                'name' => 'Magyar Nemzeti Bank Sportköre',
                'SA' => '76',
                'address' => '1050 Budapest, Szabdság tér 8-9.',
                'webpage' => '',
            ],
            [
                'name' => 'Megathlon Sport Egyesület',
                'SA' => '84',
                'address' => '1119 Budapest, Fehérvári út 63. 2/2',
                'webpage' => 'http://megathlon.hu',
            ],
            [
                'name' => 'Mezőtúri Szenior',
                'SA' => '25',
                'address' => '5400 Mezőtúr, Táncsics u. 6.',
                'webpage' => '',
            ],
            [
                'name' => 'Miskolci Vízművek Sport Club',
                'SA' => '38',
                'address' => '3530 Miskolc, Széchenyi u. 6/B.2/6',
                'webpage' => '',
            ],
            [
                'name' => 'NYÍR-SENIOR Sportegyesület',
                'SA' => '12',
                'address' => '4400 NYÍREGYHÁZA, KORÁNYI U. 127.',
                'webpage' => '',
            ],
            [
                'name' => 'NICS-Hódmezővásárhelyi Senior Úszó-Vizilabda Club',
                'SA' => '1',
                'address' => '6800 Hódmezővásárhely, Ady E. u. 1.',
                'webpage' => '',
            ],
            [
                'name' => 'Nyíregyházi Fókák SE',
                'SA' => '82',
                'address' => '4400 Nyíregyháza, Széchenyi u. 17.',
                'webpage' => 'http://www.fokak.hu',
            ],
            [
                'name' => 'Nyírsenior 97 SE',
                'SA' => '12',
                'address' => '4400 Nyíregyháza, Korányi u. 127.',
                'webpage' => '',
            ],
            [
                'name' => 'Nyíregyházi Sportcentrum Nonprofit Kft.',
                'SA' => '92',
                'address' => '4400 Nyíregyháza, Géza utca 8-16.',
                'webpage' => 'https://nyiregyhazisc.hu/',
            ],
            [
                'name' => 'Orvosegyetem Sport Club',
                'SA' => '56',
                'address' => '1052 Budapest, Semmelweis u. 2',
                'webpage' => 'http://www.osc.hu/index.html ',
            ],
            [
                'name' => 'Parafa Úszó Klub Gyöngyös',
                'SA' => '95',
                'address' => '3200 Gyöngyös, Epreskert u. 47.',
                'webpage' => '',
            ],
            [
                'name' => 'Pécs-Baranyai Szenior Úszók és Vízisportolók Klubja',
                'SA' => '16',
                'address' => '7624 Pécs, Szent István tér 17.',
                'webpage' => 'http://szenioruszok.uw.hu',
            ],
            [
                'name' => 'Pécsi Sport Nonprofit Zrt.',
                'SA' => '39',
                'address' => '7633 Pécs, Dr. Veress Endre utca 10.',
                'webpage' => '',
            ],
            [
                'name' => 'Pécsi Vörös Meteor Sportkör',
                'SA' => '54',
                'address' => '7627 Pécs, Alajos u. 2/2',
                'webpage' => '',
            ],
            [
                'name' => 'Pénzügyőr SE',
                'SA' => '42',
                'address' => '1103 Budapest, Kőér u. 2/B.',
                'webpage' => 'http://www.penzugyorse.hu',
            ],
            [
                'name' => 'Rév és társai SC',
                'SA' => '45',
                'address' => '1101 Budapest, Kőbányai út 49/b',
                'webpage' => '',
            ],
            [
                'name' => 'SPURI Futó és Triatlon Sportklub',
                'SA' => '45',
                'address' => '1114 Budapest, Eszék u. 6/b IV. 1.',
                'webpage' => 'spurisc.com',
            ],
            [
                'name' => 'Swim Life SE',
                'SA' => '64',
                'address' => '1033 Budapest, Szérűskert utca 19. IV/15.',
                'webpage' => 'www.swimlife.hu',
            ],
            [
                'name' => 'Szarvasi Úszó és Vizilabda Sportegyesület',
                'SA' => '22',
                'address' => '5540 Szarvas, Kossuth utca 23.',
                'webpage' => 'http://www.szuse.hu',
            ],
            [
                'name' => 'Százhalombattai VUK SE',
                'SA' => '41',
                'address' => '2440 Százhalombatta, Kertész u. 42',
                'webpage' => 'http://www.vuk-se.hu',
            ],
            [
                'name' => 'Széchy Tamás Sportiskola Sopron',
                'SA' => '33',
                'address' => '9400 Sopron, Bécsi u. 2. 1/6.',
                'webpage' => '',
            ],
            [
                //'name' => 'Szegedi Deres Szenior és Tömegsport Egyesület (SZEDER SE)',
                'name' => 'SZEDER SE',
                'SA' => '70',
                'address' => '6724 Szeged, Jakab László u. 14. fsz. 13.',
                'webpage' => 'szederse.simlesite.com',
            ],
            [
                'name' => 'Szentesi Delfin Egészségmegőrző Sport Club',
                'SA' => '6',
                'address' => '6600 Szentes, Koszta József u. 2.	',
                'webpage' => '',
            ],
            [
                'name' => 'Szombathelyi Sportközpont és Sportiskola Nonprofit Kft.',
                'SA' => '83',
                'address' => '9700 Szombathely, Sugár út 18.',
                'webpage' => 'http://www.szombathelyisport.hu',
            ],
            [
                'name' => 'Szombathelyi Vízmű SC',
                'SA' => '?',
                'address' => '9700, Szombathely, Bartók Béla krt. 41.',
                'webpage' => '',
            ],
            [
                'name' => 'Tatabányai Vízmű Sport Egyesület',
                'SA' => '47',
                'address' => '2800 Tatabánya, Ságvári E. u. 9.',
                'webpage' => 'www.tatabanyaivizilabda.hu',
            ],
            [
                'name' => 'Törökbálinti Senior Úszó Club',
                'SA' => '13',
                'address' => '2040 Budaörs, Hortenzia u.3',
                'webpage' => 'http://www.ujbudasenior.hu',
            ],
            [
                'name' => 'Tótkomlósi Rozmár Szenior Úszó Klub Egyesület',
                'SA' => '20',
                'address' => '5940 Tótkomlós, Zamenhof utca 5.',
                'webpage' => 'http://www.totkomlosirozmarok.hu',
            ],
            [
                'name' => 'Tovafutók Sportegyesület',
                'SA' => '77',
                'address' => '8400 Ajka, Szabadság tér 4/A	',
                'webpage' => '',
            ],
            [
                'name' => 'Triton Sport Egyesület',
                'SA' => '28',
                'address' => '5700 Gyula, Vásárhelyi Pál u. 4.',
                'webpage' => '',
            ],
            [
                'name' => 'Újpesti Torna Egylet',
                'SA' => '73',
                'address' => '1044 Budapest, Megyeri út 13.',
                'webpage' => '',
            ],
            [
                'name' => 'Váci Vízmű SE',
                'SA' => '59',
                'address' => '2600 Vác, Ady Endre Sétány 16.',
                'webpage' => 'http://www.vvse.hu',
            ],
            [
                'name' => 'Veszprémi RSE',
                'SA' => '79',
                'address' => '8200 Veszprém, Bajcsy-Zsilinszky utca 2.',
                'webpage' => '',
            ],
            [
                'name' => 'Vidám Vidrakölykök SE',
                'SA' => '90',
                'address' => '1042 Budapest, József Attila utca 72',
                'webpage' => 'www.uszasoktatas.hu',
            ],
            [
                'name' => 'Team Tri-Trend SE',
                'SA' => '99',
                'address' => '1239 Budapest, Csendes utca 115/a',
                'webpage' => '',
            ],
            [
                'name' => 'Darnyi Tamás Sport Club',
                'SA' => '100',
                'address' => '1036 Budapest, Árpád fejedelem útja 62.',
                'webpage' => '',
            ],
            [
                'name' => 'II. kerületi Sport és Szabadidősport Nkft.',
                'SA' => '98',
                'address' => '-',
                'webpage' => '',
            ],
            [
                'name' => 'Pro-Harmony',
                'SA' => '88',
                'address' => '-',
                'webpage' => '',
            ],
            [
                'name' => 'Suncity Triathlon Team Egyesület',
                'SA' => '81',
                'address' => '-',
                'webpage' => '',
            ],
            [
                'name' => 'Siketek Sport Klubja',
                'SA' => '101',
                'address' => '1097 Budapest, Könyves Kálmán körút 28.',
                'webpage' => '',
            ],
            [
                'name' => 'Buborék 1991 Szabadidő és Sportegyesület',
                'SA' => '102',
                'address' => '1022 Budapest, Ribáry utca 6.',
                'webpage' => '',
            ],
            [
                'name' => 'Invictus Úszó és Vízilabda SC Kft.-Szolnok',
                'SA' => '103',
                'address' => '-',
                'webpage' => ''
            ],

        ];

        foreach($teams as $team) {
            DB::table('teams')->insert([
                'name' => $team['name'],
                'SA' => $team['SA'],
                'address' => $team['address'],
                'webpage' => $team['webpage'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
