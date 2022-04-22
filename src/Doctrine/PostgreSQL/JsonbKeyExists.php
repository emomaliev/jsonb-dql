<?php

namespace Emrdev\JsonbDql\Doctrine\PostgreSQL;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\SqlWalker;
use Doctrine\DBAL\Platforms\PostgreSQLPlatform;


/**
 * JsonbKeyExistsFunction ::= "JSONB_KEY_EXISTS" "(" StringPrimary "," StringPrimary ")"
 */
class JsonbKeyExists extends  FunctionNode
{
    const FUNCTION = 'JSONB_KEY_EXISTS';

    private  $firstExpression = null;

    private  $secondExpression = null;

    public function getSql(SqlWalker $sqlWalker)
    {
        return sprintf(
            '%s ?? %s',
            $this->firstExpression->dispatch($sqlWalker),
            $this->secondExpression->dispatch($sqlWalker)
        );
    }

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