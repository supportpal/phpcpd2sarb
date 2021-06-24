<?php declare(strict_types=1);

namespace SupportPal\Phpcpd2Sarb\Command;

use SupportPal\Phpcpd2Sarb\Transformer\Phpcpd;
use Symfony\Component\Console\Input\InputArgument;

class ConvertCommand extends Command
{
    /** @var string */
    protected static $defaultName = 'convert';

    /**
     * @return void
     */
    protected function configure()
    {
        $this
            ->setName(self::$defaultName)
            ->setDefinition([
                new InputArgument('path', InputArgument::REQUIRED, 'Path to phpmd-phpcpd xml file.'),
            ])
            ->setDescription('Convert phpmd-phpcpd xml to sarb.')
            ->setHelp(<<<EOF
The <info>%command.name%</info> converts phpmd-phpcpd xml to sarb:
<info>php %command.full_name% phpcpd-output.xml</info>
EOF
            );
    }

    public function handle(): int
    {
        $path = $this->singleArg('path');

        $this->output->write((new Phpcpd($path))->toSarb());

        return 0;
    }
}
