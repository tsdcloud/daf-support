<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MotifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('motifs')->insert([
            [
                'motif'=>'Saisie érronée des données',
            ],
            [
                'motif'=>'Transmission des données/documents erronés ou inexploitables',
            ],
            [
                'motif'=>'Non transmission des livrables, de reporting dans les délais',
            ],
            [
                'motif'=>'Non remontée d\'informations sur l\'activité',
            ],
            [
                'motif'=>'Violation des consignes/procédures/procédés opérationnels',
            ],
            [
                'motif'=>'Non port des EPI',
            ],
            [
                'motif'=>'Absences injustifiées',
            ],
            [
                'motif'=>'Absences de longue durée',
            ],
            [
                'motif'=>'Absence du reporting des activités',
            ],
            [
                'motif'=>'Acte de violence physique/verbale/psychologique',
            ],
            [
                'motif'=>'Non respect du planning de Maintenance',
            ],
            [
                'motif'=>'Négligence/Détérioration/Destruction/Perte du matériel de travail',
            ],
            [
                'motif'=>'Violation du planning de travail',
            ],
            
            [
                'motif'=>'Problème de ponctualité au travail',
            ],
            [
                'motif'=>'Manquant sur versement des recettes',
            ],
            
            [
                'motif'=>'Vol/Détournement',
            ],
            [
                'motif'=>'Dissimulation des recettes',
            ],
            [
                'motif'=>'Problème d\'assiduité au travail',
            ],
            [
                'motif'=>'Rejet des factures/chèques/courriers émis',
            ],
            [
                'motif'=>'Dénigrement de l\'intégrité/image de l\'entreprise ou des salariés',
            ],
            [
                'motif'=>'Manquement à la déontologie et à l\'éthique',
            ],
            [
                'motif'=>'Mauvaise gestion des équipes/collaborateurs',
            ],
            
            [
                'motif'=>'Etat d\'ébriété aux heures de service',
            ],
            [
                'motif'=>'Contreperformances professionnelles',
            ],
            [
                'motif'=>'Harcèlement',
            ],
            [
                'motif'=>'Abus du droit de grève',
            ],
            [
                'motif'=>'Indiscrétion/Divulgation des données de l\'entreprise',
            ],
            [
                'motif'=>'Utilisation des outils, du temps de travail à des fins personnelles',
            ],
            [
                'motif'=>'Refus volontaire de s\'impliquer dans les tâches/missions/projets',
            ],
            [
                'motif'=>'Négligence des sollicitations des partenaires/fournisseurs',
            ],
            [
                'motif'=>'Concurrence déloyale',
            ],
            [
                'motif'=>'Tenue vestimentaire inapropriée à la fonction',
            ],
        ]);

        DB::table('motif_outdates')->insert([
            
            // 23
            [
                'motif_id'=>23,
                'motif_outdate'=>'Mauvaise organisation de la guérite, et non-respect des stratégie opérationnelles',
            ],
            [
                'motif_id'=>23,
                'motif_outdate'=>'Mauvaise repartition des équipes et organisation des des flux durant votre service',
            ],
            [
                'motif_id'=>23,
                'motif_outdate'=>'Frustration des collaborateurs',
            ],
            [
                'motif_id'=>23,
                'motif_outdate'=>'Mauvaise qualité manageriale et attitude',
            ],

            // 21
            [
                'motif_id'=>21,
                'motif_outdate'=>'Diffamation de nom',
            ],
            [
                'motif_id'=>21,
                'motif_outdate'=>'Ternir l\'image de l\'entreprise ainsi que celles de ses dirigeants',
            ],

            // 19
            [
                'motif_id'=>19,
                'motif_outdate'=>'Autorisation de reprise des opérations par un client débiteur',
            ],
            [
                'motif_id'=>19,
                'motif_outdate'=>'Priorisation des intérêts personnels à ceux de l\'entreprise',
            ],
            [
                'motif_id'=>19,
                'motif_outdate'=>'Négligence dans le contrôle des opérations ',
            ],
            [
                'motif_id'=>19,
                'motif_outdate'=>'Désinvolture dans la rédaction des rapports',
            ],
            [
                'motif_id'=>19,
                'motif_outdate'=>'Manque d\'assiduité et de concentration',
            ],
            [
                'motif_id'=>19,
                'motif_outdate'=>'Nonchallance et non-application des mesures opérationnelles',
            ],
            [
                'motif_id'=>19,
                'motif_outdate'=>'Absent au poste de travail',
            ],
            [
                'motif_id'=>19,
                'motif_outdate'=>'Abandon de poste',
            ],
            [
                'motif_id'=>19,
                'motif_outdate'=>'Désinvolture dans l\'exercice de vos fonctions ',
            ],
            [
                'motif_id'=>19,
                'motif_outdate'=>'Laxisme et manque d\'assiduté dans l\'execice de vos fonctions',
            ],
            [
                'motif_id'=>19,
                'motif_outdate'=>'Incompétence et d\’incapacité dans l\’application des tâches confiées',
            ],
            [
                'motif_id'=>19,
                'motif_outdate'=>'Perte des déharge des factures',
            ],
            [
                'motif_id'=>19,
                'motif_outdate'=>'Manque de concentration',
            ],
            [
                'motif_id'=>19,
                'motif_outdate'=>'Manque de vigilance ',
            ],
            [
                'motif_id'=>19,
                'motif_outdate'=>'Manque de dilligence durant votre service',
            ],

            // 18
            [
                'motif_id'=>18,
                'motif_outdate'=>'Non-déclaration de 02 pesées tests',
            ],

            // 16
            [
                'motif_id'=>16,
                'motif_outdate'=>'Ecart négatif entre le rapport de quart et la recette déposée en espèces',
            ],

            // 15
            [
                'motif_id'=>15,
                'motif_outdate'=>'Retard répétitifs',
            ],
            [
                'motif_id'=>15,
                'motif_outdate'=>'Retard dans les heures de prise de service',
            ],

            // 14
            [
                'motif_id'=>14,
                'motif_outdate'=>'Présence sur plusieurs ponts bascules en même temps',
            ],
            [
                'motif_id'=>14,
                'motif_outdate'=>'Non conformité dispositions du règlement interne de l\’entreprise',
            ],

            // 13
            [
                'motif_id'=>13,
                'motif_outdate'=>'Négligence et mauvais usage des consommables en guérite',
            ],
            [
                'motif_id'=>13,
                'motif_outdate'=>'Dommages sur le téléphone de service',
            ],
            [
                'motif_id'=>13,
                'motif_outdate'=>'Injoingnable sur le téléphone de service',
            ],
            // 11
            [
                'motif_id'=>11,
                'motif_outdate'=>'Bagarre',
            ],
            [
                'motif_id'=>11,
                'motif_outdate'=>'Violence',
            ],
            // 10 
            [
                'motif_id'=>10,
                'motif_outdate'=>'Refus de répondre à une demande d\'explications',
            ],
            [
                'motif_id'=>10,
                'motif_outdate'=>'Refus d\'exécuter l\'instruction de votre hiérachie',
            ],
            [
                'motif_id'=>10,
                'motif_outdate'=>'Refus de respecter les instructions',
            ],
            [
                'motif_id'=>10,
                'motif_outdate'=>'Non respect des consignes strictes de la hiérarchie',
            ],
            [
                'motif_id'=>10,
                'motif_outdate'=>'Attitude désinvolte durant votre service',
            ],
            [
                'motif_id'=>10,
                'motif_outdate'=>'Non exécution du travail demandé',
            ],
            [
                'motif_id'=>10,
                'motif_outdate'=>'Non-respect des instructions reçues',
            ],
            [
                'motif_id'=>10,
                'motif_outdate'=>'Insubordinnation',
            ],

            // 9
            [
                'motif_id'=>9,
                'motif_outdate'=>'Non renseignement de la fiche d\'incidents',
            ],

            // 7
            [
                'motif_id'=>7,
                'motif_outdate'=>'Absences non justifiées',
            ],

            // 5
            [
                'motif_id'=>5,
                'motif_outdate'=>'Non-conformité sur les procédures sécuritaires au sein de DPWS',
            ],
            [
                'motif_id'=>5,
                'motif_outdate'=>'Négligence sur le respect de consignes HSE',
            ],
            [
                'motif_id'=>5,
                'motif_outdate'=>'Violation du règlement intérieur',
            ],
            [
                'motif_id'=>5,
                'motif_outdate'=>'Refus de se conformer aux règles de fonctionnement de DPWS',
            ],
            [
                'motif_id'=>5,
                'motif_outdate'=>'Non-respect des règles d\'hygène applicable à DPWS',
            ],
            [
                'motif_id'=>5,
                'motif_outdate'=>'Négligence et non respect des procédure HSE',
            ],
            [
                'motif_id'=>5,
                'motif_outdate'=>'Non respect des consignes de sécurité',
            ],
            [
                'motif_id'=>5,
                'motif_outdate'=>'Non respect des procédures de pesée',
            ],
            
            // 4
            [
                'motif_id'=>4,
                'motif_outdate'=>'Manque de transparence',
            ],
            
            [
                'motif_id'=>4,
                'motif_outdate'=>'Dissimulation des informations',
            ],
            
            // 3
            [
                'motif_id'=>3,
                'motif_outdate'=>'Absence du rapport de quart',
            ],

            // 2
            [
                'motif_id'=>2,
                'motif_outdate'=>'Légèreté dans l\'exercice de vos fonctions',
            ],

            // 1
            [
                'motif_id'=>1,
                'motif_outdate'=>'Saisie erronée des pesées',
            ],
            [
                'motif_id'=>1,
                'motif_outdate'=>'Non respect des procédures opérationnelles',
            ],
            [
                'motif_id'=>1,
                'motif_outdate'=>'Légèreté lors de la rédaction des rapports',
            ],            
            [
                'motif_id'=>1,
                'motif_outdate'=>'Edition erronée des factures',
            ],            
            [
                'motif_id'=>1,
                'motif_outdate'=>'Non respect des procédures de pesée',
            ],            
            [
                'motif_id'=>1,
                'motif_outdate'=>'Mutiples incohérences dans votre rapport de fin de quart',
            ],
        ]);
    }
}
