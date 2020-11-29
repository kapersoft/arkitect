<?php
declare(strict_types=1);

namespace Arkitect\Expression\Logical;

use Arkitect\Analyzer\ClassDescription;
use Arkitect\Expression\Expression;
use Arkitect\Expression\PositiveExpressionDescription;
use Arkitect\Expression\NegativeExpressionDescription;

class Not implements Expression
{
    private Expression $expression;

    public function __construct(Expression $expression)
    {
        $this->expression = $expression;
    }

    public function describe(ClassDescription $theClass): NegativeExpressionDescription
    {
        return new NegativeExpressionDescription($this->expression->describe($theClass));
    }

    public function evaluate(ClassDescription $theClass): bool
    {
        return !$this->expression->evaluate($theClass);
    }
}
