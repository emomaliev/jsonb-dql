<?php

namespace Emrdev\JsonbDql\Doctrine\PostgreSQL;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\SqlWalker;


/**
 * JsonbContainsFunction ::= "JSONB_CONTAINS" "(" StringPrimary "," StringPrimary ")"
 */
class JsonbContains extends  FunctionNode
{

    private $firstExpression = null;


    private $secondExpression = null;

    public function getSql(SqlWalker $sqlWalker)
    {


       $val =  sprintf(
            '(%s @> %s)',
            $this->firstExpression->dispatch($sqlWalker),
            $this->secondExpression->dispatch($sqlWalker)
        );

        return $val;
    }

    /**
     * @throws \Doctrine\ORM\Query\QueryException
     */
    public function parse(Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $this->firstExpression = $parser->StringPrimary();
        $parser->match(Lexer::T_COMMA);
        $this->secondExpression = $parser->StringPrimary();
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }
}