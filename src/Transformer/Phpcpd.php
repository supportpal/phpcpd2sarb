<?php declare(strict_types=1);

namespace SupportPal\Phpcpd2Sarb\Transformer;

use InvalidArgumentException;
use RuntimeException;
use SimpleXMLElement;

use function file_exists;
use function file_get_contents;
use function implode;
use function json_encode;
use function sprintf;

use const JSON_PRETTY_PRINT;

class Phpcpd
{
    /** @var string */
    private $report;

    public function __construct(string $report)
    {
        if (! file_exists($report)) {
            throw new InvalidArgumentException('The given report does not exist.');
        }

        $this->report = $report;
    }

    public function toSarb(): string
    {
        $issues = [];

        $phpcpd = new SimpleXMLElement($this->getReportContents());
        foreach ($phpcpd->duplication as $duplication) {
            $issues[] = $this->processViolation($duplication)->toArray();
        }

        $json = json_encode($issues, JSON_PRETTY_PRINT);
        if ($json === false) {
            throw new RuntimeException('Unable to create JSON.');
        }

        return $json;
    }

    private function getReportContents(): string
    {
        $contents = file_get_contents($this->report);
        if ($contents === false) {
            throw new RuntimeException(sprintf('Unable to read file: %s', $this->report));
        }

        return $contents;
    }

    private function processViolation(SimpleXMLElement $duplication): Sarb
    {
        if (! isset($duplication->file[0]['path']) || ! isset($duplication->file[0]['line'])) {
            throw new InvalidArgumentException('Unexpected SimpleXMLElement content');
        }

        $files = [];
        foreach ($duplication->file as $item) {
            $files[] = $item['path'];
        }

        $message = sprintf(
            'Found %s duplicate lines in: %s',
            $duplication['lines'],
            implode(', ', $files)
        );

        return new Sarb(
            (string) $duplication->file[0]['path'],
            (int) $duplication->file[0]['line'],
            'duplication',
            $message
        );
    }
}
