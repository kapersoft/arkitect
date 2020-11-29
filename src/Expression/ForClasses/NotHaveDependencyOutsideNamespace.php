<?php
declare(strict_types=1);

namespace Arkitect\Expression\ForClasses;

use Arkitect\Analyzer\ClassDescription;
use Arkitect\Expression\Expression;
use Arkitect\Expression\ExpressionDescription;
use Arkitect\Expression\PositiveExpressionDescription;

class NotHaveDependencyOutsideNamespace implements Expression
{
    private string $namespace;

    public function __construct(string $namespace)
    {
        $this->namespace = $namespace;
    }

    public function describe(ClassDescription $theClass): ExpressionDescription
    {
        return new PositiveExpressionDescription("{$theClass->getFQCN()} [does not depend|does depend] on classes outside in namespace {$this->namespace}");
    }

    public function evaluate(ClassDescription $theClass): bool
    {
        return $theClass->dependsOnlyOnClassesMatching($this->namespace);
    }
}
