<?php declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use SupportPal\Phpcpd2Sarb\Transformer\Phpcpd;

class PhpcpdTest extends TestCase
{
    public function testConvert(): void
    {
        $report = __DIR__.'/__fixtures__/foo.xml';
        $phpcpd = new Phpcpd($report);

        $this->assertSame('[
    {
        "file": "\/home\/PhpstormProjects\/GoogleTranslate\/vendor\/composer\/ClassLoader.php",
        "line": 13,
        "type": "duplication",
        "message": "Found 1 duplicate lines in: \/home\/PhpstormProjects\/GoogleTranslate\/vendor\/composer\/ClassLoader.php, \/home\/PhpstormProjects\/SlackNotifications\/vendor\/composer\/ClassLoader.php"
    },
    {
        "file": "\/home\/PhpstormProjects\/GoogleTranslate\/vendor\/composer\/ClassLoader.php",
        "line": 13,
        "type": "duplication",
        "message": "Found 2 duplicate lines in: \/home\/PhpstormProjects\/GoogleTranslate\/vendor\/composer\/ClassLoader.php, \/home\/PhpstormProjects\/SlackNotifications\/vendor\/composer\/ClassLoader.php"
    }
]', $phpcpd->toSarb());
    }
}
