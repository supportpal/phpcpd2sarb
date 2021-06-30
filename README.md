<p align="center">
    <a href="https://www.supportpal.com" target="_blank"><img src="https://www.supportpal.com/assets/img/logo_blue_small.png" /></a>
    <br>
    A tool to convert phpmd-phpcpd XML to sarb to facilitate the creation of a PHPCPD baseline.
</p>

<p align="center">
<a href="https://github.com/supportpal/phpcpd2sarb/actions"><img src="https://img.shields.io/github/workflow/status/supportpal/phpcpd2sarb/test" alt="Build Status"></a>
<a href="https://packagist.org/packages/supportpal/phpcpd2sarb"><img src="https://img.shields.io/packagist/v/supportpal/phpcpd2sarb" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/supportpal/phpcpd2sarb"><img src="https://img.shields.io/packagist/l/supportpal/phpcpd2sarb" alt="License"></a>
</p>

----

# Installation

```bash
composer require --dev supportpal/phpcpd2sarb
```

# Usage

Generate a phpcpd report:

```bash
php phpcpd.phar --log-pmd phpcpd-output.xml src/
```

Convert the XML report to Sarb format:

```
php vendor/bin/phpcpd2sarb convert phpcpd-output.xml > /tmp/sarb-output.json
```

Use [dave-liddament/sarb](https://github.com/DaveLiddament/sarb) to create a baseline:

```
cat /tmp/sarb-output.json | php vendor/bin/sarb create --input-format="sarb-json" phpcpd.baseline
```

If you're using sarb `v0.x` the command syntax is different:

```
php vendor/bin/sarb create-baseline /tmp/sarb-output.json phpcpd.baseline sarb-json
```
