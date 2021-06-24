<?php declare(strict_types=1);

namespace SupportPal\Phpcpd2Sarb\Transformer;

class Sarb
{
    /**
     * Full path to file.
     *
     * @var string
     */
    private $file;

    /**
     * Line number of issue.
     *
     * @var int
     */
    private $line;

    /**
     * Type of issue (e.g. rule that was violated).
     *
     * @var string
     */
    private $type;

    /**
     * Human readable description of problem.
     *
     * @var string
     */
    private $message;

    public function __construct(string $file, int $line, string $type, string $message)
    {
        $this->file = $file;
        $this->line = $line;
        $this->type = $type;
        $this->message = $message;
    }

    /**
     * @return mixed[]
     */
    public function toArray(): array
    {
        return [
            'file'    => $this->file,
            'line'    => $this->line,
            'type'    => $this->type,
            'message' => $this->message,
        ];
    }
}
