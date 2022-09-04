<?php

declare(strict_types=1);

namespace App\Infrastructure\Command\User;

use App\Domain\Model\User;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\Persistence\ManagerRegistry;



class createCommand extends Command
{
    protected static $defaultName = 'app:create-user';

    /**
     * @var UserPasswordHasherInterface
     */
    private $passwordHasher;

    /**
     * @var ManagerRegistry
     */
    private $doctrine;

    public function __construct(UserPasswordHasherInterface $passwordHasher, ManagerRegistry $doctrine)
    {
        $this->passwordHasher = $passwordHasher;
        $this->doctrine = $doctrine;
        parent::__construct();
    }

    protected function configure()
    {
        $this->addArgument('email', InputArgument::REQUIRED, 'email of user');
        $this->addArgument('password', InputArgument::REQUIRED, 'password of the use');
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $user = new User();
        $hashedPAssword = $this->passwordHasher->hashPassword($user, $input->getArgument('password'));
        $user->setEmail($input->getArgument('email'));
        $user->setPassword($hashedPAssword);
        $em = $this->doctrine->getManager();
        $em->persist($user);
        $em->flush();

        $output->writeln("User created successfully !");
        return Command::SUCCESS;
    }
}
