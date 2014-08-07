<?php

namespace Wallet\UserBundle\Command;

use FOS\UserBundle\Command\CreateUserCommand as FOSCreateUserCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Wallet\DataBundle\Entity\Client;
use Symfony\Component\Console\Input\InputArgument;

class CreateUserCommand extends FOSCreateUserCommand
{

    protected function configure()
    {
        parent::configure();

        //override command name
        $this->setName('wallet:user:create');

        //extend definition
        /* @var $definition \Symfony\Component\Console\Input\InputDefinition */
        $definition = $this->getDefinition();
        $definition->addArgument(new InputArgument('client-first-name', InputArgument::REQUIRED, 'The clients first name'));
        $definition->addArgument(new InputArgument('client-last-name', InputArgument::REQUIRED, 'The clients last name'));
        $this->setDefinition($definition);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $firstName = $input->getArgument('client-first-name');
        $lastName = $input->getArgument('client-last-name');

        $client = new Client();
        $client->setFirstName($firstName)
                ->setLastName($lastName)
        ;

        parent::execute($input, $output);

        $username = $input->getArgument('username');
        $user = $this->getContainer()->get('doctrine')->getRepository('WalletUserBundle:User')->findOneByUsername($username);

        $client->setCreationDate(new \DateTime('now'))
                ->setUser($user)
        ;

        $validator = $this->getContainer()->get('validator');
        $errors = $validator->validate($client);

        if (count($errors) > 0) {
            throw new \Exception((string) $errors);
        }

        $em = $this->getContainer()->get('doctrine')->getManager();
        $em->persist($client);
        $em->flush();

        $output->writeln(sprintf('Created client for User <comment>%s</comment>', $username));
    }

    protected function interact(InputInterface $input, OutputInterface $output)
    {
        if (!$input->getArgument('client-first-name')) {
            $firstName = $this->getHelper('dialog')->askAndValidate(
                    $output, 'Please choose a clients first name:', function($firstName) {
                if (empty($firstName)) {
                    throw new \Exception('First name can not be empty');
                }

                return $firstName;
            }
            );
            $input->setArgument('client-first-name', $firstName);
        }

        if (!$input->getArgument('client-last-name')) {
            $lastName = $this->getHelper('dialog')->askAndValidate(
                    $output, 'Please choose a clients last name:', function($lastName) {
                if (empty($lastName)) {
                    throw new \Exception('Last name can not be empty');
                }

                return $lastName;
            }
            );
            $input->setArgument('client-last-name', $lastName);
        }

        parent::interact($input, $output);
    }

}
