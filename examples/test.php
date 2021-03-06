<?php

require __DIR__.'/../vendor/autoload.php';

use Elfsundae\Laravel\FacadePhpdocGenerator;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class Foo
{
    const CONSTANT = 100;

    public function __construct(int $time = 123, $config = null)
    {
    }

    public function returnType(?Collection $date): Collection
    {
        return new Collection();
    }

    public function multiParams($a, callable $b, Collection|Arr|string|array|null $c = 'default'): array|Arr
    {
        return [];
    }

    public function array($a = [], $b = [1, 2], $c = ['foo' => 'bar']): ?string
    {
        return null;
    }

    public function constant(int $a = PHP_INT_MAX, int $b = self::CONSTANT, int $c = PATHINFO_DIRNAME | PATHINFO_BASENAME)
    {
    }

    public function reference(?int &$number = null)
    {
    }

    /**
     * @param int &...$numbers
     * @return mixed
     */
    public function variadic(&...$numbers)
    {
    }

    /**
     * Undocumented function
     *
     * @param  mixed  $argument
     * @return void
     */
    public function void($argument)
    {
    }

    /**
     * Get return type from doc comment.
     *
     * @return string|array|null
     */
    public function docComment()
    {
    }

    public function __toString()
    {
        return static::class;
    }
}

echo FacadePhpdocGenerator::make(Foo::class);

echo FacadePhpdocGenerator::make(Foo::class)
    ->filter(null);

echo FacadePhpdocGenerator::make(Foo::class, FacadePhpdocGenerator::class);

echo FacadePhpdocGenerator::make(new Foo)
    ->exclude(['multiParams', 'reference'])
    ->see([Foo::class, FacadePhpdocGenerator::class]);

echo FacadePhpdocGenerator::make(FacadePhpdocGenerator::class)
    ->filter(null)
    ->modifier(ReflectionMethod::IS_PUBLIC | ReflectionMethod::IS_PROTECTED)
    ->add('void addMethod1($param = [])')
    ->add(['array addMethod2($a, $b = null)', 'void addMethod3()'])
    ->addBefore('string addBefore()', 'generate')
    ->addAfter('addAfter()', 'generate')
    ->generate();
