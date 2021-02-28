<?php

namespace App\DataFixtures;

use App\Entity\Administrator;
use App\Entity\Agent;
use App\Entity\Contact;
use App\Entity\Country;
use App\Entity\Hideway;
use App\Entity\Mission;
use App\Entity\MissionStatus;
use App\Entity\MissionType;
use App\Entity\Nationality;
use App\Entity\Speciality;
use App\Entity\Target;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\EncoderFactory;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        // On génère quelques nationalitées
        $availableNationalities = [];

        $frenchNationality = new Nationality();
        $frenchNationality->setName('French');

        $usNationality = new Nationality();
        $usNationality->setName('Americain');

        $englishNationality = new Nationality();
        $englishNationality->setName('English');

        $canadianNationality = new Nationality();
        $canadianNationality->setName('Canadian');

        $spanishNationality = new Nationality();
        $spanishNationality->setName('Spanish');

        array_push($availableNationalities, $frenchNationality, $usNationality, $englishNationality,
            $canadianNationality, $spanishNationality);

        // On génère quelques specialitées
        $availableSpecialities = [];

        $dataSpeciality = new Speciality();
        $dataSpeciality->setName('Data');
        $manager->persist($dataSpeciality);

        $anaylistSpeciality = new Speciality();
        $anaylistSpeciality->setName('Analyst');
        $manager->persist($anaylistSpeciality);


        $fieldSpeciality = new Speciality();
        $fieldSpeciality->setName('Field');
        $manager->persist($fieldSpeciality);

        $communicationSpeciality = new Speciality();
        $communicationSpeciality->setName('Communication');
        $manager->persist($communicationSpeciality);

        array_push($availableSpecialities, $dataSpeciality, $anaylistSpeciality,
            $fieldSpeciality, $communicationSpeciality);

        // On génère quelques pays
        $availableCountries = [];

        $franceCountry = new Country();
        $franceCountry->setName('France')
            ->setNationality($frenchNationality);
        $manager->persist($franceCountry);

        $usCountry = new Country();
        $usCountry->setName('USA')
            ->setNationality($usNationality);
        $manager->persist($usCountry);

        $ukCountry = new Country();
        $ukCountry->setName('United Kingdom')
            ->setNationality($englishNationality);
        $manager->persist($ukCountry);

        $canadaCountry = new Country();
        $canadaCountry->setName('Canada')
            ->setNationality($canadianNationality);
        $manager->persist($canadaCountry);

        $espagneCountry = new Country();
        $espagneCountry->setName('Espagne')
            ->setNationality($spanishNationality);
        $manager->persist($espagneCountry);

        array_push($availableCountries, $franceCountry, $usCountry,
            $ukCountry, $canadaCountry, $espagneCountry);


        // On génère les types de missions
        $availableMissionType = [];

        $watchMissionType = new MissionType();
        $watchMissionType->setName('Watch');
        $manager->persist($watchMissionType);

        $assassinationMissionType = new MissionType();
        $assassinationMissionType->setName('Assassination');
        $manager->persist($assassinationMissionType);

        $infiltrationMissionType = new MissionType();
        $infiltrationMissionType->setName('Infiltration');
        $manager->persist($infiltrationMissionType);

        array_push($availableMissionType, $watchMissionType, $assassinationMissionType,
            $infiltrationMissionType);

        // On génère les statuts de mission
        $availableMissionStatus = [];

        $preparationMissionStatus = new MissionStatus();
        $preparationMissionStatus->setName('Preparation');
        $manager->persist($preparationMissionStatus);

        $inProgressMissionStatus = new MissionStatus();
        $inProgressMissionStatus->setName('In progress');
        $manager->persist($inProgressMissionStatus);

        $doneMissionStatus = new MissionStatus();
        $doneMissionStatus->setName('Done');
        $manager->persist($doneMissionStatus);

        $failMissionStatus = new MissionStatus();
        $failMissionStatus->setName('Fail');
        $manager->persist($failMissionStatus);

        array_push($availableMissionStatus, $preparationMissionStatus, $inProgressMissionStatus,
            $doneMissionStatus, $failMissionStatus);


        // On génère quelques agents
        $availableAgents = [];
        for ($i = 0; $i < 10; $i++) {
            $agent = new Agent();

            $numberOfSpecialities = mt_rand(1, count($availableSpecialities));
            $agentSpecialities = [];

            if ($numberOfSpecialities > 1) {
                for ($o = 0; $o < $numberOfSpecialities; $o++) {
                    array_push($agentSpecialities,
                        $availableSpecialities[$o]);
                }

                // On vérifie qu'il n'y a pas de duplication de specialitées
                $uniqueAgentSpecialities = [];

                foreach ($agentSpecialities as $speciality) {
                    if (!in_array($speciality, $uniqueAgentSpecialities)) {
                        $uniqueAgentSpecialities[] = $speciality;
                    }
                }

                $agentSpecialities = $uniqueAgentSpecialities;

            } else {
                array_push($agentSpecialities,
                    $availableSpecialities[mt_rand(0, count($availableSpecialities) - 1)]);
            }

            $agent->setName($faker->name)
                ->setFirstName($faker->firstName)
                ->setBirthdate($faker->dateTimeBetween('-50 years', '- 25 years'))
                ->setIdentificationCode($faker->uuid)
                ->setNationality($availableNationalities[mt_rand(0, count($availableNationalities) - 1)]);

            foreach ($agentSpecialities as $speciality) {
                $agent->addSpeciality($speciality);
            }

            $manager->persist($agent);

            array_push($availableAgents, $agent);
        }

        // On génère quelques cibles
        $availableTargets = [];
        for ($p = 0; $p < 20; $p++) {
            $target = new Target();
            $target->setName($faker->name)
                ->setFirstName($faker->firstName)
                ->setBirthdate($faker->dateTimeBetween('-50 years', '- 25 years'))
                ->setCodeName($faker->uuid)
                ->setNationality($availableNationalities[mt_rand(0, count($availableNationalities) - 1)]);
            $manager->persist($target);
            array_push($availableTargets, $target);
        }

        // On génère quelques contacts
        $availableContacts = [];
        for ($q = 0; $q < 30; $q++) {
            $contact = new Contact();
            $contact->setName($faker->name)
                ->setNationality($availableNationalities[mt_rand(0, count($availableNationalities) -1)])
                ->setFirstName($faker->firstName)
                ->setBirthdate($faker->dateTimeBetween('-50 years', '- 25 years'))
                ->setCodeName($faker->uuid)
                ->setBirthdate($faker->dateTimeBetween('-50 years', '- 25 years'));
            $manager->persist($contact);
            array_push($availableContacts, $contact);
        }

        // On génère quelques planques
        $availableHideways = [];
        for ($s = 0; $s < 15; $s++) {
            $hideway = new Hideway();
            $hideway->setCode($faker->uuid)
                ->setAddress($faker->address)
                ->setCountry($availableCountries[mt_rand(0, count($availableCountries) - 1)]);
            $manager->persist($hideway);
            array_push($availableHideways, $hideway);
        }

        for ($d = 0; $d < 40; $d++) {
            $mission = new Mission();
            $mission->setTitle($faker->sentence)
                ->setDescription($faker->sentence)
                ->setCodeName($faker->uuid)
                ->setType($availableMissionType[mt_rand(0, count($availableMissionType) - 1)])
                ->setCountry($availableCountries[mt_rand(0, count($availableCountries) - 1)])
                ->setSpeciality($availableSpecialities[mt_rand(0, count($availableSpecialities) - 1)])
                ->setStatus($availableMissionStatus[mt_rand(0, count($availableMissionStatus) - 1)])
                ->setStartAt($faker->dateTimeBetween('now', '+4 years'))
                ->setEndAt($faker->dateTimeBetween('now', '+4 years'));

            // On ajoute les contacts à la mission
            $matchedContacts = $this->findContactsByCountry($mission->getCountry(), $availableContacts);
            $numberOfContact = mt_rand(1, count($matchedContacts));
            if ($numberOfContact > 1) {
                for ($f = 0; $f < $numberOfContact; $f++) {
                    $mission->addContact($matchedContacts[$f]);
                }
            } else {
                $mission->addContact(($this->findContactsByCountry($mission->getCountry(), $availableContacts))[0]);
            }

            // On ajoute les planques à la mission
            $matchedHideways = $this->findHidewaysByCountry($mission->getCountry(), $availableHideways);

            $numberOfHideway = mt_rand(0, count($matchedHideways));

            if ($numberOfHideway !== 0) {
                for ($g = 0; $g < $numberOfHideway; $g++) {
                    $mission->addHideway($matchedHideways[$g]);
                }
            }

            // On ajoute un agent à la mission
            $defaultAgent = $this->findAgentBySpeciality($mission->getSpeciality(), $availableAgents);
            $mission->addAgent($defaultAgent);

            // On ajoute les cibles à la mission
            $matchedTargets = $this->findTargetsByAgent($defaultAgent, $availableTargets);
            $numberOfTargets = mt_rand(1, count($matchedTargets));
            if ($numberOfTargets > 1) {
                for ($h = 0; $h < $numberOfTargets; $h++) {
                    $mission->addTarget($matchedTargets[$h]);
                }
            } else {
                $mission->addTarget(($this->findTargetsByAgent($defaultAgent, $availableTargets))[0]);
            }


            $manager->persist($mission);
        }


        // On génère un admin
        $admin = new Administrator();

        $admin->setName($faker->name)
            ->setFirstName($faker->firstName)
            ->setEmail('admin@kgb.dev')
            ->setPlainPassword('kgb.dev');

        $encodedPassword = $this->encodePassword($admin, $admin->getPlainPassword());
        $admin->setPassword($encodedPassword);

        $manager->persist($admin);

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }

    /**
     * @param Country $country
     * @param $contacts
     * @return array
     */
    private function findContactsByCountry(Country $country, $contacts)
    {
        $matchedContacts = [];

        foreach ($contacts as $contact) {
            if ($country->getNationality()->getName() === $contact->getNationality()->getName()) {
                array_push($matchedContacts, $contact);
            }
        }

        return $matchedContacts;
    }

    /**
     * @param Country $country
     * @param $hideways
     * @return array
     */
    private function findHidewaysByCountry(Country $country, $hideways)
    {
        $matchedHideways = [];

        foreach ($hideways as $hideway) {
            if ($country->getName() === $hideway->getCountry()->getName()) {
                array_push($matchedHideways, $hideway);
            }
        }

        return $matchedHideways;
    }

    /**
     * @param Speciality $speciality
     * @param $agents
     * @return mixed
     */
    private function findAgentBySpeciality(Speciality $speciality, $agents)
    {
        $matchedAgents = [];

        foreach ($agents as $agent) {
            foreach ($agent->getSpecialities() as $agentSpeciality) {
                if ($speciality->getName() === $agentSpeciality->getName()) {
                    array_push($matchedAgents, $agent);
                }
            }
        }

        return $matchedAgents[mt_rand(1, count($matchedAgents) -1)];
    }

    /**
     * @param Agent $agent
     * @param $targets
     * @return array
     */
    private function findTargetsByAgent(Agent $agent, $targets)
    {
        $matchedTargets = [];

        foreach ($targets as $target) {
            if ($target->getNationality()->getName() !== $agent->getNationality()->getName()) {
                array_push($matchedTargets, $target);
            }
        }

        return $matchedTargets;
    }

    private function encodePassword($administrator, $password)
    {
        $passwordEncoderFactory = new EncoderFactory([
            Administrator::class => new MessageDigestPasswordEncoder('sha512', true, 5000)
        ]);

        $encoder = $passwordEncoderFactory->getEncoder($administrator);

        return $encoder->encodePassword($password, $administrator->getSalt());
    }
}
