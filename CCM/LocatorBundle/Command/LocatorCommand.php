<?php

namespace CCM\LocatorBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class LocatorCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setDefinition(array(
            new InputArgument('query', InputArgument::REQUIRED, 'Any string you want.')
        ))
            ->setName('ccm:locator')
            ->setDescription('Gets all location by a query.')
            ->setHelp(<<<EOF

The <info>%command.name%</info> gets all addresses from any Locator implemented.
EOF
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $results = $this->getContainer()->get('ccm_locator.chained_locator')->searchByKeyword($input->getArgument('query'));

        foreach ($results as $result) {
            $output->writeln(sprintf('<info>%s</info>', $result['name']));
            $output->writeln(sprintf('<info>%s</info>', $result['address']));
            $output->writeln(sprintf('<comment>Found By:</comment> %s', $result['source']));

            $output->writeln('-------------------------');
        }
    }
}
